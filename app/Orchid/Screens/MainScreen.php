<?php
namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class MainScreen extends Screen
{


    public function query(): iterable
    {
        return [];
    }

    public function name(): ?string
    {
        return 'Home';
    }

    public function layout(): iterable
    {
        $template = Layout::view('platform::main.home');
        return [
            Layout::Blank([
                $template,
            ]),
        ];
    }
}
