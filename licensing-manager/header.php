<?php
// VERIFY

// This is the secret key for API authentication. You configured it in the settings menu of the license manager plugin.
define('LICENSE_SECRET_KEY', '59b41c7a24e101.75530248'); //Rename this constant name so it is specific to your plugin or theme.

// This is the URL where API query request will be sent to. This should be the URL of the site where you have installed the main license manager plugin. Get this value from the integration help page.
define('THEME_AUTHENTICATION_SERVER', 'http://localhost/wp/wp3-beta-testing'); //Rename this constant name so it is specific to your plugin or theme.


//////////////////////////////////////////////////////////////////////////////////////
/*** Verify license key is active ***/
$api_params = array(
    'slm_action' => 'slm_check',
    'secret_key' => '5c157a144c5bf31aff6022b15da457b0b6bd917185f7335ea5f6fa5fd32f2b48',
    'license_key' => get_option('theme_license_key'), //replace with your license key field name.

);
// Send query to the license manager server
$response = wp_remote_get(add_query_arg($api_params, THEME_AUTHENTICATION_SERVER), array('timeout' => 20, 'sslverify' => false));

$license_data = json_decode(wp_remote_retrieve_body($response));
global $active, $message;
if ($license_data->result == 'success') {
    if ($license_data->status == 'expired') { ?>
        <script>
            alert('The license for this theme has expired.');
        </script>
    <?php } else { ?>
        <script>
            alert('Activated');
        </script>
<?php }
} else {
    wp_die(__('This website uses unlicensed software.'));
}
 // END LICENSE