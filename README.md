<p align="center">
    <a href="https://beshkan.org" target="_blank">
        <img src="/public/assets/media/logos/beshkan-logo-lockup-cmyk-red.png" width="400" alt="Beshkan panel Logo">
    </a>
</p>


## About Beshkan Panel

Beshkan panel implemented on Laravel allows you to set up an VPN accounting sales panel with a few clicks. This panel is implemented under the [Orchid](https://github.com/orchidsoftware) and [JetStream](https://github.com/laravel/jetstream) packages:

- Orchid is a free [Laravel](https://laravel.com) package that abstracts standard business logic and allows code-driven rapid application development of back-office applications, admin/user panels, and dashboards.

- Laravel JetStream is a beautifully designed application scaffolding for Laravel. JetStream provides the perfect starting point for your next Laravel application and includes login, registration, email verification, two-factor authentication, session management, API support via [Laravel Sanctum](https://github.com/laravel/sanctum), and optional team management.<br>
JetStream is designed using [Tailwind CSS](https://tailwindcss.com) and offers your choice of [Livewire](https://jetstream.laravel.com/stacks/livewire.html) or [Inertia](https://jetstream.laravel.com/stacks/inertia.html) scaffolding.

## Installation guide
Before starting the installation process, first create your `.env` file.<br>
Make a copy of the `.env.example` file and rename it to `.env`. Then change the database specifications according to your needs.

In continue, do the following steps in order:
1. `composer install`<br>
2. `php artisan migrate`<br>
3. `npm run build`
4.  `php artisan db:seed`
5. [Optional] Define panel prefix in your `.env` file.<br>The prefix parameter allows you to change the default panel prefix to any other name, such as `panel`, `admin`, `administrator`, `client` or `/` (root of  site).<br>
This is useful if you want to use a different prefix for your  panel or if the default prefix is already in use by another part of your application. We're suggesting `DASHBOARD_PREFIX=panel`<br>
For example, if you set the prefix to `panel`, the URL for the panel dashboard page would be https://example.com/panel/dashboard instead of https://example.com/dashboard.

## Usage

Default administrator login information:<br>
Username : `admin@admin.com`<br>
Password : `admin`

## License

This project licensed under the [MIT license](https://opensource.org/licenses/MIT).
