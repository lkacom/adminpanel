<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Admin\User;

use App\Orchid\Layouts\User\UserEditLayout;
use App\Orchid\Layouts\User\UserFiltersLayout;
use App\Orchid\Layouts\User\UserListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserListScreen extends Screen
{
    public function permission(): ?iterable
    {
        return [
            'admin.users',
        ];
    }

    public function query(): iterable
    {
        return [
            'users' => User::with('roles')
                ->filters(UserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'User Management';
    }

    public function description(): ?string
    {
        return 'A comprehensive list of all registered users, including their profiles and privileges.';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->route('admin.users.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            UserFiltersLayout::class,
            UserListLayout::class,
            Layout::modal('asyncEditUserModal', UserEditLayout::class)
                ->async('asyncGetUser'),
        ];
    }

    public function asyncGetUser(User $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    public function saveUser(Request $request, User $user): void
    {
        $request->validate([
            'user.email' => [
                'required',
                Rule::unique(User::class, 'email')->ignore($user),
            ],
        ]);

        $user->fill($request->input('user'))->save();

        Toast::info(__('User was saved.'));
    }

    public function remove(Request $request): void
    {
        User::findOrFail($request->get('id'))->delete();

        Toast::info(__('User was removed'));
    }
}
