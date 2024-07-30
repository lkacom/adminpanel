<?php

namespace App\Orchid\Screens;

use App\Models\Setting;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;

class SettingsScreen extends Screen
{
    public function query(): array
    {
        return [
            'address' => Setting::where('key', 'address')->first()->value ?? '',
            'phone' => Setting::where('key', 'phone')->first()->value ?? '',
        ];
    }

    public function name(): ?string
    {
        return 'Site Settings';
    }

    public function description(): ?string
    {
        return 'Setting Management';
    }

    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('save')
                ->method('save'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('address')
                    ->title('address')
                    ->placeholder('Enter Your Address'),
                Input::make('phone')
                    ->title('phone')
                    ->placeholder('Enter Your Phone Number'),
            ]),
        ];
    }

    public function save(Request $request)
    {
        $fields = $request->only(['address', 'phone']);

        foreach ($fields as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('platform.settings');
    }
}
