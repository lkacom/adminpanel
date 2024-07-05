<p align="center"><a href="https://beshkan.org" target="_blank"><img src="/public/assets/media/logos/beshkan-logolockup-cmyk-red.png" width="400" alt="Beshkan panel Logo"></a></p>

<hr>

## About Beshkan Panel

Beshkan panel implemented on Laravel allows you to set up an VPN accounting sales panel with a few clicks.

## Installation guide
1. `composer update`<br>
2. `php artisan migrate`<br>
3. `npm run build`
4.  `php artisan db:seed`


## Usage

default Admin Login:

Username : `admin@admin.com`<br>
Password : `admin`

Open your .env file and add your api key, env, callback url like so:

```plaintext
DASHBOARD_PREFIX=panel
APP_PANEL=Custom_Name //for custom logo branding name
```


## License

This project licensed under the [MIT license](https://opensource.org/licenses/MIT).
