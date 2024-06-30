<?php

use App\Helpers\V2ray;
use Illuminate\Contracts\Routing\UrlGenerator;

/* Default helpers locating at: Illuminate\Foundation\helpers.php */


function theme()
{
    return app(App\Helpers\Theme::class);
}


/**
 * Get product name
 *
 * @return void
 */
function getName()
{
    return config('settings.KT_THEME');
}


/**
 * Add HTML attributes by scope
 *
 * @param $scope
 * @param $name
 * @param $value
 *
 * @return void
 */
function addHtmlAttribute($scope, $name, $value)
{
    theme()->addHtmlAttribute($scope, $name, $value);
}


/**
 * Add multiple HTML attributes by scope
 *
 * @param $scope
 * @param $attributes
 *
 * @return void
 */
function addHtmlAttributes($scope, $attributes)
{
    theme()->addHtmlAttributes($scope, $attributes);
}


/**
 * Add HTML class by scope
 *
 * @param $scope
 * @param $value
 *
 * @return void
 */
function addHtmlClass($scope, $value)
{
    theme()->addHtmlClass($scope, $value);
}


/**
 * Print HTML attributes for the HTML template
 *
 * @param $scope
 *
 * @return string
 */
function printHtmlAttributes($scope)
{
    return theme()->printHtmlAttributes($scope);
}


/**
 * Print HTML classes for the HTML template
 *
 * @param $scope
 * @param bool $full
 *
 * @return string
 */
function printHtmlClasses($scope, bool $full = true)
{
    return theme()->printHtmlClasses($scope, $full);
}


/**
 * Get SVG icon content
 *
 * @param $path
 * @param string $classNames
 * @param string $folder
 *
 * @return string
 */
function getSvgIcon($path, string $classNames = 'svg-icon', string $folder = 'assets/media/icons/')
{
    return theme()->getSvgIcon($path, $classNames, $folder);
}


/**
 * Set dark mode enabled status
 *
 * @param $flag
 *
 * @return void
 */
function setModeSwitch($flag)
{
    theme()->setModeSwitch($flag);
}


/**
 * Check dark mode status
 *
 * @return void
 */
function isModeSwitchEnabled()
{
    return theme()->isModeSwitchEnabled();
}


/**
 * Set the mode to dark or light
 *
 * @param $mode
 *
 * @return void
 */
function setModeDefault($mode)
{
    theme()->setModeDefault($mode);
}


/**
 * Get current mode
 *
 * @return void
 */
function getModeDefault()
{
    return theme()->getModeDefault();
}


/**
 * Set style direction
 *
 * @param $direction
 *
 * @return void
 */
function setDirection($direction)
{
    theme()->setDirection($direction);
}


/**
 * Get style direction
 *
 * @return void
 */
function getDirection()
{
    return theme()->getDirection();
}


function isRtlDirection()
{
    // Function moved to WhoisMiddleware by SAYED!
    if (config()->get('app.rtl'))
        return true;
    return false;
}


/**
 * Extend CSS file name with RTL or dark mode
 *
 * @param $path
 *
 * @return void
 */
function extendCssFilename($path)
{
    return theme()->extendCssFilename($path);
}


/**
 * Include favicon from settings
 *
 * @return string
 */
function includeFavicon()
{
    return theme()->includeFavicon();
}


/**
 * Include the fonts from settings
 *
 * @return string
 */
function includeFonts()
{
    return theme()->includeFonts();
}


/**
 * Get the global assets
 *
 * @param $type
 *
 * @return array
 */
function getGlobalAssets($type = 'js')
{
    return theme()->getGlobalAssets($type);
}


/**
 * Add multiple vendors to the page by name. Refer to settings KT_THEME_VENDORS
 *
 * @param $vendors
 *
 * @return void
 */
function addVendors($vendors)
{
    theme()->addVendors($vendors);
}


/**
 * Add single vendor to the page by name. Refer to settings KT_THEME_VENDORS
 *
 * @param $vendor
 *
 * @return void
 */
function addVendor($vendor)
{
    theme()->addVendor($vendor);
}


/**
 * Add custom javascript file to the page
 *
 * @param $file
 *
 * @return void
 */
function addJavascriptFile($file)
{
    theme()->addJavascriptFile($file);
}


/**
 * Add custom CSS file to the page
 *
 * @param $file
 *
 * @return void
 */
function addCssFile($file)
{
    theme()->addCssFile($file);
}


/**
 * Get vendor files from settings. Refer to settings KT_THEME_VENDORS
 *
 * @param $type
 *
 * @return array
 */
function getVendors($type)
{
    return theme()->getVendors($type);
}


/**
 * Get custom js files from the settings
 *
 * @return array
 */
function getCustomJs()
{
    return theme()->getCustomJs();
}


/**
 * Get custom css files from the settings
 *
 * @return array
 */
function getCustomCss()
{
    return theme()->getCustomCss();
}


/**
 * Get HTML attribute based on the scope
 *
 * @param $scope
 * @param $attribute
 *
 * @return array
 */
function getHtmlAttribute($scope, $attribute)
{
    return theme()->getHtmlAttribute($scope, $attribute);
}


/**
 * Get HTML attribute based on the scope
 *
 * @param $url
 *
 * @return mixed
 */
function isUrl($url)
{
    return filter_var($url, FILTER_VALIDATE_URL);
}


/**
 * Get image url by path
 *
 * @param $path
 *
 * @return string
 */
function image($path)
{
    return asset('assets/media/' . $path);
}



    /**
     * Get icon
     *
     * @param $path
     *
     * @return string
     */
    function getIcon($name, $class = '', $type = '', $tag = 'span')
    {
        return theme()->getIcon($name, $class, $type, $tag);
    }



    function url2($path = null, $parameters = [], $secure = null)
    {
        if (is_null($path)) {
            return app(UrlGenerator::class);
        }
        $hl = request()->get('hl') ? '?' . http_build_query(['hl' => request()->get('hl')]) : '';
        return app(UrlGenerator::class)->to($path, $parameters, $secure) . $hl;
    }



function v2ray()
{
    return app(V2ray::class);
}


function getMenu()
{
    $Dashboard = app(\Orchid\Platform\Dashboard::class);
    dd($Dashboard->registerPermissions());
    dd($Dashboard->getPermission('CRUD'));
//    foreach($Dashboard->menu->get($Dashboard::MENU_MAIN) as $key => $menu) {
//        if($menu->getAttributes()['title']==='Resources')
//            $Dashboard->menu->get($Dashboard::MENU_MAIN)->forget($key);
//    }
}