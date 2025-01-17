<?php
/*
Plugin Name: My API Key for Goo.gl
Description: Add your custom Goo.gl API key to the Goo.gl plugin by Konstantin Kovshenin
Version: 0.1.2
Author: Ben Meredith
Author URI: http://benandjacq.com
Plugin URI: https://wordpress.org/plugins/my-api-key-for-googl/
License: GPL2
Text Domain: googl-api-key
*/

//wraps the whole thing in a function that waits to check for the parent plugin until all plugins are loaded.
function mygapi_init() {

	if( function_exists( 'googl_shorten' ) ) {

		// calls the file to load the settings/options page
		include 'mygapi-options.php';

		// this is the line doing all the hard work, drawing from the API key entered into the settings page
		add_filter( 'googl_api_key', 'mygapi_myAPI', 9999, 1 );

		function mygapi_myAPI() {

			//checks to make sure it's a 39-character string with no spaces
			$key = trim(get_option( 'googl_api_key' ) );

			if ( strlen( $key ) === 39 ) {

				//and if so, returns the new API key into the original plugin
				return ( get_option( 'googl_api_key' ) );
			}

			//if it's not 39 characters, it defaults back to the API key that ships with the original plugin.
			else {

				return 'AIzaSyBEPh-As7b5US77SgxbZUfMXAwWYjfpWYg';

			}
		}

		//adds a link to the plugins page to our settings admin area page
		function mygapi_options_link( $links ) {

			$settings_text = sprintf( _x( 'Settings', 'text for the link on the plugins page', 'my-api-key-for-googl' ) );

			$settings_link = '<a href="options-general.php?page=my-api-key-for-googl">' . $settings_text . '</a>';

			array_unshift( $links, $settings_link );

			return $links;
		}

		$plugin = plugin_basename( __FILE__ );

		add_filter( "plugin_action_links_$plugin", 'mygapi_options_link' );

		//cleans up after ourselves on uninstall (removes the Key added to the options database table)
		function mygapi_on_uninstall() {

			delete_option( 'googl_api_key' );

		}

		register_uninstall_hook( __FILE__, 'mygapi_on_uninstall' );

	} else {

		//if the original plugin is not activated, displays a warning with link to the "parent plugin"
		add_action( 'admin_notices', 'mygapi_activation_error' );

		function mygapi_activation_error() {

			$html = '<div class="error">';

			$html .= '<p>';

			$html .= sprintf( __( 'The Goo.gl API Key plugin is activated, but not doing much. You need to install the <a href="%s">Goo.gl plugin by Konstantin Kovshenin.</a>', 'my-api-key-for-googl' ), esc_url( 'https://wordpress.org/plugins/googl/' ) );

			$html .= '</p>';

			$html .= '</div><!-- /.updated -->';

			echo $html;
		}
	}
}

add_action( 'plugins_loaded', 'mygapi_init' );



