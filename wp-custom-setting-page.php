<?php
/*
 * Plugin Name:       WP Custom Setting Page
 * Description:       A plugin to demonstrate how to create a settings page in WordPress.
 * Version:           1.0
 * Author:            kahnu044
 * Author URI:        https://github.com/kahnu044
 * Plugin URI:        https://github.com/kahnu044/wp-custom-setting-page
 */

// Hook to add a menu item in the admin dashboard
add_action('admin_menu', 'wp_custom_plugin_menu');

/**
 * Adds a custom menu item in the WordPress admin dashboard.
 *
 * This function hooks into the 'admin_menu' action to add a new menu item
 * to the WordPress admin dashboard. The menu item will link to the plugin's
 * settings page.
 *
 * @return void
 *
 * Docs - https://developer.wordpress.org/reference/functions/add_menu_page/
 */
function wp_custom_plugin_menu()
{
    add_menu_page(
        'WP Custom Plugin Settings', // Page title
        'WP Custom Settings',        // Menu title
        'manage_options',            // Capability required to access this menu
        'wp-custom-plugin',          // Menu slug
        'wp_custom_plugin_settings_page', // Callback function to render the settings page
        'dashicons-smiley'           // Icon URL or dashicon class
    );
}

function wp_custom_plugin_settings_page()
{
?>
    <div class="wrap">
        <h1>WP Custom Plugin Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wp_custom_plugin_settings_group');
            do_settings_sections('wp-custom-plugin');
            submit_button();
            ?>
        </form>
    </div>
<?php
}


// Hook to register settings
add_action('admin_init', 'wp_custom_plugin_settings_init');

/**
 * Registers settings, sections, and fields for the plugin.
 *
 * This function hooks into the 'admin_init' action to register the settings,
 * sections, and fields for the plugin's settings page. It includes examples
 * of various types of input fields.
 *
 * @return void
 */
function wp_custom_plugin_settings_init()
{
    register_setting('wp_custom_plugin_settings_group', 'wp_custom_plugin_text_setting');
    register_setting('wp_custom_plugin_settings_group', 'wp_custom_plugin_checkbox_setting');
    register_setting('wp_custom_plugin_settings_group', 'wp_custom_plugin_radio_setting');
    register_setting('wp_custom_plugin_settings_group', 'wp_custom_plugin_select_setting');
    register_setting('wp_custom_plugin_settings_group', 'wp_custom_plugin_textarea_setting');

    add_settings_section(
        'wp_custom_plugin_settings_section',
        'General Settings',
        null,
        'wp-custom-plugin'
    );

    add_settings_field(
        'wp_custom_plugin_text_setting',
        'Text Input',
        'wp_custom_plugin_text_setting_render',
        'wp-custom-plugin',
        'wp_custom_plugin_settings_section'
    );

    add_settings_field(
        'wp_custom_plugin_checkbox_setting',
        'Checkbox',
        'wp_custom_plugin_checkbox_setting_render',
        'wp-custom-plugin',
        'wp_custom_plugin_settings_section'
    );

    add_settings_field(
        'wp_custom_plugin_radio_setting',
        'Radio Buttons',
        'wp_custom_plugin_radio_setting_render',
        'wp-custom-plugin',
        'wp_custom_plugin_settings_section'
    );

    add_settings_field(
        'wp_custom_plugin_select_setting',
        'Dropdown',
        'wp_custom_plugin_select_setting_render',
        'wp-custom-plugin',
        'wp_custom_plugin_settings_section'
    );

    add_settings_field(
        'wp_custom_plugin_textarea_setting',
        'Textarea',
        'wp_custom_plugin_textarea_setting_render',
        'wp-custom-plugin',
        'wp_custom_plugin_settings_section'
    );
}

// Function to render the text input field
function wp_custom_plugin_text_setting_render()
{
    $value = get_option('wp_custom_plugin_text_setting', '');
?>
    <input type="text" name="wp_custom_plugin_text_setting" value="<?php echo esc_attr($value); ?>" />
    <label for="wp_custom_plugin_text_setting">Enter a value</label>
<?php
}


// Function to render the checkbox field
function wp_custom_plugin_checkbox_setting_render()
{
    $value = get_option('wp_custom_plugin_checkbox_setting', 0);
?>
    <input type="checkbox" name="wp_custom_plugin_checkbox_setting" value="1" <?php checked(1, $value, true); ?> />
    <label for="wp_custom_plugin_checkbox_setting">Check this box</label>
<?php
}

function wp_custom_plugin_radio_setting_render()
{
    $value = get_option('wp_custom_plugin_radio_setting', 'option1');
?>
    <input type="radio" name="wp_custom_plugin_radio_setting" value="option1" <?php checked('option1', $value); ?> /> Option 1
    <input type="radio" name="wp_custom_plugin_radio_setting" value="option2" <?php checked('option2', $value); ?> /> Option 2
<?php
}


function wp_custom_plugin_select_setting_render()
{
    $value = get_option('wp_custom_plugin_select_setting', 'option1');
?>
    <select name="wp_custom_plugin_select_setting">
        <option value="option1" <?php selected('option1', $value); ?>>Option 1</option>
        <option value="option2" <?php selected('option2', $value); ?>>Option 2</option>
    </select>
    <label for="wp_custom_plugin_select_setting">Choose an option</label>
<?php
}

function wp_custom_plugin_textarea_setting_render()
{
    $value = get_option('wp_custom_plugin_textarea_setting', '');
?>
    <textarea name="wp_custom_plugin_textarea_setting"><?php echo esc_textarea($value); ?></textarea>
    <label for="wp_custom_plugin_textarea_setting">Enter some text</label>
<?php
}
