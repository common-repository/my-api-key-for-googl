<?php
/* The Settings Page 
	This file creates an options/settings page
	in the wp-admin area of your WordPress site
	for specifying your goo.gl API key
	
	This file is for use with the My API Key for Goo.gl plugin found at
	http://wordpress.org/plugins/my-api-key-for-googl/
*/

defined( 'ABSPATH' ) or die( "No script kiddies please!" );
add_action( 'admin_menu', 'googlapi_add_admin_menu' );
add_action( 'admin_init', 'googlapi_settings_init' );


function googlapi_add_admin_menu() {

	add_options_page(

		__( 'Add your Goo.gl API Key', 'my-api-key-for-googl'),

		'My API Key for Goo.gl',

		'manage_options',

		'my-api-key-for-googl',

		'googlapi_options_page' );

}

function googlapi_settings_init() {

	add_settings_section(

		'googlapi_page_section',

		__( '', 'my-api-key-for-googl' ),

		'googlapi_settings_section_callback',

		'googlapi_page'
	);

	add_settings_field(

		'googl_api_key',

		__( 'Please enter your API Key', 'my-api-key-for-googl' ),

		'googlapi_key_entry_field_render',

		'googlapi_page',

		'googlapi_page_section'
	);

	register_setting( 'googlapi_page', 'googl_api_key' );

}


function googlapi_key_entry_field_render() {

	$options = get_option( 'googl_api_key' ); ?>

	<input type='text' class='text' name='googl_api_key' value='<?php echo $options; ?>'>

	<?php

}


function googlapi_settings_section_callback() {

	echo sprintf( __( 'You can get your API key by following <a target="_blank" href="%s">these directions</a>.', 'my-api-key-for-googl' ), esc_url( 'https://developers.google.com/url-shortener/v1/getting_started?hl=en' ) );

}


function googlapi_options_page() {

	?>
	<form action='options.php' method='post'>
		<div class="wrap">

			<h2><?php _e( 'My API Key for Goo.gl — Settings', 'my-api-key-for-googl' ); ?></h2>
			<hr/>
			<div id="googlapi_admin" class="metabox-holder has-right-sidebar">
				<div class="inner-sidebar">
					<div id="normal-sortables" class="meta-box-sortables ui-sortable">
						<div class="postbox">
							<div class="inside">
								<h3 class="hndle ui-sortable-handle"><?php _e( 'About the Author', 'my-api-key-for-googl' ); ?> </h3>

								<div id="googlapi_signup">
									<form
										action="//benandjacq.us1.list-manage.com/subscribe/post?u=8f88921110b81f81744101f4d&amp;id=bd909b5f89"
										method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
										class="validate" target="_blank" novalidate>
										<div id="mc_embed_signup_scroll">
											<p> <?php echo sprintf( __( 'This plugin is developed by <a href="%s">Ben Meredith</a>. I am a freelance developer specializing in <a href="%s">outrunning and outsmarting hackers</a>.', 'my-api-key-for-googl' ), esc_url( 'https://www.wpsteward.com' ), esc_url( 'https://www.wpsteward.com/service-plans' ) ); ?></p>
											<h4><?php _e( 'Sign up to receive my FREE web strategy guide', 'my-api-key-for-googl' ); ?></h4>

											<p><input type="email" value="" name="EMAIL" class="widefat" id="mce-EMAIL"
											          placeholder="<?php _ex( 'Your Email Address', 'placeholder text for input field', 'my-api-key-for-googl' ); ?>">
												<small><?php _e( 'No Spam. One-click unsubscribe in every message', 'my-api-key-for-googl' ); ?></small>
											</p>
											<div style="position: absolute; left: -5000px;"><input type="text"
											                                                       name="b_8f88921110b81f81744101f4d_bd909b5f89"
											                                                       tabindex="-1"
											                                                       value="">
											</div>
											<p class="clear"><input type="submit" value="Subscribe" name="subscribe"
											                        id="mc-embedded-subscribe" class="button-secondary">
											</p>

										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="meta-box-sortables">
						<div class="postbox">
							<div class="inside">
								<p><?php
									$url3  = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HDSGWRJYFQQNJ';
									$link3 = sprintf( __( 'The best way you can support this and other plugins is to <a href=%s>donate</a>', 'my-api-key-for-googl' ), esc_url( $url3 ) );
									echo $link3; ?> .
									<?php
									$url4  = 'https://wordpress.org/support/view/plugin-reviews/my-api-key-for-googl';
									$link4 = sprintf( __( 'The second best way is to <a href=%s>leave an honest review.</a>', 'my-api-key-for-googl' ), esc_url( $url4 ) );
									echo $link4; ?></p>

								<p><?php
									_e( 'Did this plugin save you enough time to be worth some money?', 'my-api-key-for-googl' ); ?></p>

								<p>
									<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HDSGWRJYFQQNJ"
									   target="_blank"><?php _e( 'Click here to buy me a Coke to say thanks.', 'my-api-key-for-googl' ); ?></a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div id="post-body" class="has-sidebar">
					<div id="post-body-content" class="has-sidebar-content">
						<div id="normal-sortables" class="meta-box-sortables">
							<div class="postbox">
								<div class="inside">
									<h2 class="hndle"><?php _e( 'Settings', 'my-api-key-for-googl' ); ?></h2>

									<p><?php
										settings_fields( 'googlapi_page' );
										do_settings_sections( 'googlapi_page' );
										?></p>

									<p><input type="submit" class="button-primary"
									          value="<?php _e( 'Save Changes', 'my-api-key-for-googl' ); ?>"/>
									</p><?php
									$forum_link = 'https://wordpress.org/support/plugin/my-api-key-for-googl'
									?>
									<p> <?php $forum_link_text = sprintf( __( 'If you are having any difficulty, please post your issue in the <a href=%s>support forum</a>, where I actively help!', 'my-api-key-for-googl' ), esc_url( $forum_link ) );
										echo $forum_link_text; ?>
									</p>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<?php

}

