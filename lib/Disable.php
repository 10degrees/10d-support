<?php
// Disable plugins auto-update UI elements.
add_filter('plugins_auto_update_enabled', '__return_false');

// Disable themes auto-update UI elements.
add_filter('themes_auto_update_enabled', '__return_false');

// Disable full site editing
add_filter('disable_full_site_editing', '__return_true');

// Disable the block editor for widgets
remove_theme_support('widgets-block-editor');