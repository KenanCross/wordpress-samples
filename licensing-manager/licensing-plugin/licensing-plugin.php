<?php
/*
  Plugin Name: Theme Licensing
  Version: v1.0
  Author: Kenan Cross
  Description: Licensing Plugin that will authenticate your theme or plugin for continued use.
 */


// This is the secret key for API authentication. You configured it in the settings menu of the license manager plugin.
define('LICENSE_SECRET_KEY', '5421048138b321.90068894'); //Rename this constant name so it is specific to your plugin or theme.

// This is the URL where API query request will be sent to. This should be the URL of the site where you have installed the main license manager plugin. Get this value from the integration help page.
define('THEME_AUTHENTICATION_SERVER', 'http://localhost/wp/wp3-beta-testing'); //Rename this constant name so it is specific to your plugin or theme.

// This is a value that will be recorded in the license manager data so you can identify licenses for this item/product.
define('ITEM_REFERENCE', 'My Wordpress Theme'); //Rename this constant name so it is specific to your plugin or theme.

add_action('admin_menu', 'slm_sample_license_menu');

function slm_sample_license_menu()
{
    add_options_page('Theme License Activation Menu', 'Theme License', 'manage_options', __FILE__, 'theme_license_management_page');
}

function theme_license_management_page()
{
    echo '<div class="wrap">';
    echo '<h2>Theme License Management</h2>';

    /*** License activate button was clicked ***/
    if (isset($_REQUEST['activate_license'])) {
        $license_key = sanitize_text_field($_REQUEST['theme_license_key']);

        // API query parameters
        $api_params = array(
            'slm_action' => 'slm_activate',
            'secret_key' => LICENSE_SECRET_KEY,
            'license_key' => $license_key,
            'registered_domain' => $_SERVER['SERVER_NAME'],
            'item_reference' => urlencode(ITEM_REFERENCE),
        );

        // Send query to the license manager server
        $query = esc_url_raw(add_query_arg($api_params, THEME_AUTHENTICATION_SERVER));
        $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => false));

        // Check for error in the response
        if (is_wp_error($response)) {
            echo "Unexpected Error! The query returned with an error.";
        }

        //var_dump($response);//uncomment it if you want to look at the full response

        // License data.
        $license_data = json_decode(wp_remote_retrieve_body($response));

        // TODO - Do something with it.
        //var_dump($license_data);//uncomment it to look at the data

        if ($license_data->result == 'success') { //Success was returned for the license activation

            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: ' . $license_data->message;

            //Save the license key in the options table
            update_option('theme_license_key', $license_key);
        } else {
            //Show error to the user. Probably entered incorrect license key.

            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: ' . $license_data->message;
        }
    }
    /*** End of license activation ***/

    /*** License activate button was clicked ***/
    if (isset($_REQUEST['deactivate_license'])) {
        $license_key = sanitize_text_field($_REQUEST['theme_license_key']);

        // API query parameters
        $api_params = array(
            'slm_action' => 'slm_deactivate',
            'secret_key' => LICENSE_SECRET_KEY,
            'license_key' => $license_key,
            'registered_domain' => $_SERVER['SERVER_NAME'],
            'item_reference' => urlencode(ITEM_REFERENCE),
        );

        // Send query to the license manager server
        $query = esc_url_raw(add_query_arg($api_params, THEME_AUTHENTICATION_SERVER));
        $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => false));

        // Check for error in the response
        if (is_wp_error($response)) {
            echo "Unexpected Error! The query returned with an error.";
        }

        //var_dump($response);//uncomment it if you want to look at the full response

        // License data.
        $license_data = json_decode(wp_remote_retrieve_body($response));

        // TODO - Do something with it.
        //var_dump($license_data);//uncomment it to look at the data

        if ($license_data->result == 'success') { //Success was returned for the license activation

            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: ' . $license_data->message;

            //Remove the licensse key from the options table. It will need to be activated again.
            update_option('theme_license_key', '');
        } else {
            //Show error to the user. Probably entered incorrect license key.

            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: ' . $license_data->message;
        }
    }
    /*** End of sample license deactivation ***/

?>
    <p>Please enter the license key for this product to activate it. You were given a license key when you purchased this item.</p>
    <form action="" method="post">
        <table class="form-table">
            <tr>
                <th style="width:100px;"><label for="theme_license_key">License Key</label></th>
                <td><input class="regular-text" type="text" id="theme_license_key" name="theme_license_key" value="<?php echo get_option('theme_license_key'); ?>"></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="activate_license" value="Activate" class="button-primary" />
            <input type="submit" name="deactivate_license" value="Deactivate" class="button" />
        </p>
    </form>
<?php

    echo '</div>';
}
