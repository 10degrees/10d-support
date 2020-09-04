<?php
/**
 * Dump and Die variable or whatever
 *
 * @param    $dump
 */
if (!function_exists('dd')) {
    function dd($dump)
    {
        echo "<pre>";
        var_export($dump);
        echo "</pre>";
        die();
    }
}

/**
 * Load a view and pass variables into it
 *
 * To ouput a view you would want to echo it
 *
 * @param  string $fileName excluding file extension
 * @param  array  $vars
 * @return string
 */
if (!function_exists('td_view')) {
    function td_view($fileName, $vars = array())
    {
        foreach ($vars as $key => $value) {
            ${$key} = $value;
        }
        ob_start();
        include(plugin_dir_path(__FILE__) . '../views/' .$fileName . '.php');
        return ob_get_clean();
    }
}

/**
 * Quick way to asset path.
 *
 * @param  string $filePath - Optional
 * @return string - path to file (or just directory)
 */
if (!function_exists('td_img_path')) {
    function td_img_path($filePath = '')
    {
        return plugins_url() . '/10d-wordcare-report/assets/' . $filePath;
    }
}

/**
 * Print svg code from svg file in assets/img/ directory
 *
 * @param  $svg string fileName
 * @return string - svg code
 */
if (!function_exists('td_get_svg')) {
    function td_get_svg($svg)
    {
        return td_print_svg(td_img_path($svg));
    }
}

/**
 * Print svg code from given path. Compatible with acf
 *
 * @param  string $icon Path to file
 * @return string - svg code
 */
if (!function_exists('td_print_svg')) {
    function td_print_svg($icon)
    {
        if (false !== strpos($icon, '.svg')) {
            $icon = str_replace(site_url(), '', $icon);
            include(ABSPATH . $icon);
        }
        return $icon;
    }
}
