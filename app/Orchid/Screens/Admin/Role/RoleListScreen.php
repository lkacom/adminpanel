<?php
namespace App\Orchid\Screens\Admin\Role;

use App\Orchid\Layouts\Role\RoleListLayout;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoleListScreen extends Screen
{

    public function permission(): ?iterable
    {
        return [
            'admin.roles',
        ];
    }

    public function query(): iterable
    {
        return [
            'roles' => Role::filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'Role Management';
    }

    public function description(): ?string
    {
        return 'A comprehensive list of all roles, including their permissions and associated users.';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('admin.roles.create')),
        ];
    }

    public function layout(): iterable
    {
        return [
            RoleListLayout::class,
        ];
    }
}
