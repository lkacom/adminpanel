<?php

namespace App\Orchid\Screens\Examples;

use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ExampleCardsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'user' => User::firstOrFail(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Admin User';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Full Aceess Adminstator';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @throws \Throwable
     *
     * @return array
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('user', [
                Sight::make('id')->popover('Identifier, a symbol which uniquely identifies an object or record'),
                Sight::make('name'),
                Sight::make('email'),
                Sight::make('email_verified_at', 'Email Verified')->render(fn (User $user) => $user->email_verified_at === null
                    ? '<i class="text-danger">●</i> False'
                    : '<i class="text-success">●</i> True'),
                Sight::make('updated_at', 'Last Updated'),
                Sight::make('Note')->render(fn () => 'Full Acsess'),

            ])->title('User'),
        ];
    }

    public function showToast(Request $request): void
    {
        Toast::warning($request->get('toast', 'Hello, world! This is a toast message.'));
    }
}
