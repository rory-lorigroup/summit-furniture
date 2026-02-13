<?php

function restrict_themes_and_plugins_menu() {
    // Get the current user's email
    $current_user = wp_get_current_user();
    $email = $current_user->user_email;

    // Check if the email domain is @thelorigroup.com
    if (strpos($email, '@thelorigroup.com') === false) {
        // Remove the Themes menu
        remove_submenu_page('themes.php', 'themes.php');

        // Remove the Plugins menu
        remove_menu_page('plugins.php');
    }
}
add_action('admin_menu', 'restrict_themes_and_plugins_menu', 999);

function restrict_themes_and_plugins_access() {
    // Get the current user's email
    $current_user = wp_get_current_user();
    $email = $current_user->user_email;

    // Check if the email domain is @thelorigroup.com
    if (strpos($email, '@thelorigroup.com') === false) {
        // Get the current page in the admin
        $current_screen = get_current_screen();

        // Check if the user is on the Themes or Plugins page
        if (in_array($current_screen->id, ['themes', 'plugins'])) {
            // Redirect to the dashboard
            wp_redirect(admin_url());
            exit;
        }
    }
}
add_action('admin_init', 'restrict_themes_and_plugins_access');