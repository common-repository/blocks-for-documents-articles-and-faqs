<?php
namespace Echo_Doc_Blocks\Includes\Admin;
use Echo_Doc_Blocks\Includes\Features\Dynamic\KB;
use Echo_Doc_Blocks\Includes\Kb\KB_Utilities;
use Echo_Doc_Blocks\Includes\Utilities;
use Echo_Doc_Blocks\Includes\HTML_Elements;
use Echo_Doc_Blocks\Includes\System\Logging;

defined( 'ABSPATH' ) || exit();

/**
 * Display admin pages
 *
 */
class Admin_Pages {

	public function show_dashboard() {
	
		$active_tab = Utilities::get('tab') == '' ? 'home' : Utilities::get('tab');
		$HTML =  New HTML_Elements();		?>

		<div class="epbl-dashboard">

			<div class="epbl-dashboard__tabs">

					<!-- Tabs -->
					<div class="epbl-dashboard__tabs__nav">
						<a href="#epbl-nav-home-content" id="epbl-nav-home" class="epbl-dashboard-tabs__nav__item <?php echo ( $active_tab == 'home' ) ? 'epbl-dashboard-tabs__nav__item--active' : '' ?>"><?php _e( 'Home', 'blocks-for-documents-articles-and-faqs' ); ?></a>
						<!-- <a href="#epbl-nav-widgets-content" id="epbl-nav-widgets" class="epbl-dashboard-tabs__nav__item">--><?php //_e( 'Blocks', 'blocks-for-documents-articles-and-faqs' ); ?><!--</a>-->
						<a href="#epbl-nav-debug-content" id="epbl-nav-debug" class="epbl-dashboard-tabs__nav__item <?php echo ( $active_tab == 'debug' ) ? 'epbl-dashboard-tabs__nav__item--active' : '' ?>"><?php _e( 'Debug', 'blocks-for-documents-articles-and-faqs' ); ?></a>
					</div>

					<!-- Tabs Content -->
					<div class="epbl-dashboard__tabs__content">

						<!-- Home Panel -->
						<div id="epbl-nav-home-content" class="epbl-dashboard-tabs__content__panel <?php echo ( $active_tab == 'home' ) ? 'epbl-dashboard-tabs__content__panel--active' : '' ?>">

							<div class="epbl-dashboard-tabs__content__panel__header">
								<img src="<?php echo ECHO_BLOCKS_ASSETS_URL.'images/Top-banner-for-Settings-page.jpg'; ?>">
							</div>

							<div class="epbl-dashboard-tabs__content__panel__body">

								<div class="epbl-dashboard-row epbl-dashboard-margin-10">									<?php
									if ( ! Utilities::is_kb_plugin_active() ) {
										$HTML->notification_box_basic( array(
												'type' => 'error',
												'id' => 'epbl-no-kb-detected',
												'title' => 'This plugin requires the Echo Knowledge Base plugin to be active.',
												'desc' => 'Please install the Knowledge Base ' . KB::get_kb_plugin_install_link(),
										));
									}   ?>
								</div>

								<div class="epbl-dashboard-row epbl-dashboard-2col">									<?php
									 $this->info_box(
										'epblfa epblfa-book',
										__( 'Documentation', 'blocks-for-documents-articles-and-faqs' ),
										__( 'Find basic and advanced examples for our blocks.', 'blocks-for-documents-articles-and-faqs' ),
										__( 'Documentation', 'blocks-for-documents-articles-and-faqs' ),
										'https://www.echoplugins.com/knowledge-base/');
									 $this->info_box(
										'epblfa epblfa-life-ring',
										__( 'Submit Feature Request', 'blocks-for-documents-articles-and-faqs' ),
										__( 'Let us know your thoughts about our blocks and any features we can add!', 'blocks-for-documents-articles-and-faqs' ),
										__( 'Contact Us', 'blocks-for-documents-articles-and-faqs' ),
										'https://www.echoplugins.com/technical-support/'); ?>
								</div>

								<div class="epbl-dashboard-row">									<?php
									 /* $this->info_box(
										'far fa-heart',
										'Show your Love',
										'We love to have you in blocks Addons family. We are making it more awesome everyday. Take your 2 minutes to review the plugin and spread the love to encourage us to keep it going.',
										'Leave a Review',
										'#'); */ ?>
								</div>

							</div>

						</div>

						<!-- Widgets Panel -->
						<div id="epbl-nav-widgets-content" class="epbl-dashboard-tabs__content__panel <?php echo ( $active_tab == 'widgets' ) ? 'epbl-dashboard-tabs__content__panel--active' : '' ?>">
						
							<div class="epbl-dashboard-tabs__content__panel__header">
								<div class="epbl-dashboard-row epbl-dashboard-2col">

									<div class="epbl-dashboard__widget-info-container">
										<h2><?php // TODO FUTURE _e( 'Document Blocks', 'blocks-for-documents-articles-and-faqs' ); ?></h2>
										<p><?php // TODO FUTURE _e( 'Here is the list of our blocks. You can enable or disable blocks from here to optimize loading speed and Elementor editor experience. After enabling or disabling any block make sure to click the Save Changes button.', 'blocks-for-documents-articles-and-faqs' ); ?></p>
									</div>
									<div class="epbl-dashboard__widget-save-container">
										<?php wp_nonce_field( 'epbl_settings_nonce', 'epbl_settings_nonce', false ); ?>
										<button type="submit" class="epbl-dashboard__save-settings"><?php _e( 'Save Settings', 'blocks-for-documents-articles-and-faqs' ); ?></button>
										<div class="epbl-dashboard__saving-error"></div>
									</div>

								</div>

							</div>

							<div class="epbl-dashboard-tabs__content__panel__body">
								<div class="epbl-dashboard-tabs__content__panel__body__widgets">		</div>
							</div>

						</div>

						<!-- Debug Panel -->
						<div id="epbl-nav-debug-content" class="epbl-dashboard-tabs__content__panel <?php echo ( $active_tab == 'debug' ) ? 'epbl-dashboard-tabs__content__panel--active' : '' ?>">

							<div class="epbl-dashboard-tabs__content__panel__body">
								<div class="epbl-dashboard-row">
									<div class="epbl-dashboard__widget-info-container">
										<?php self::display_debug_info(); ?>
									</div>
								</div>

							</div>
						</div>

					</div>

				</div>

		</div>		<?php
	}

	public function get_help() { ?>
		<div class="epbl-dashboard epbl-dashboard--get-help">
			<div class="epbl-dashboard-row epbl-dashboard-2col">									<?php
				$this->info_box(
					'fas fa-laptop-medical',
					__( 'Need Help?', 'blocks-for-documents-articles-and-faqs' ),
					__( 'Stuck with something? Contact us and we will help you get going again! We provide friendly and timely support.', 'blocks-for-documents-articles-and-faqs' ),
					__( 'Contact Us', 'blocks-for-documents-articles-and-faqs' ),
					'https://www.echoplugins.com/technical-support/'
				); ?>
			</div>
		</div> <?php 
	}

	private function info_box( $icon, $title, $dec, $buttonText, $buttonURL ) { ?>

		<div class="epbl-dashboard__info-box">

			<div class="epbl-dashboard__info-box__header">
				<div class="epbl-dashboard__info-box__header__icon <?php echo $icon; ?>"></div>
				<div class="epbl-dashboard__info-box__header__title"><?php echo $title; ?></div>
			</div>

			<div class="epbl-dashboard__info-box__body">
				<p><?php echo $dec; ?></p>
				<a href="<?php echo $buttonURL; ?>" target="_blank" class="epbl-dashboard__info-box__body__btn"><?php echo $buttonText; ?></a>
			</div>

		</div>	<?php
	}

	/**
	 * Display Debug Data
	 */
	public function display_debug_info() {

		$is_debug_on = Utilities::get_wp_option( Admin_Handlers::EPBL_DEBUG, false );
		$heading = $is_debug_on ? esc_html__( 'Debug Information:', 'blocks-for-documents-articles-and-faqs' ) :
			esc_html__( 'Enable debug when asked by Echo KB support team.', 'blocks-for-documents-articles-and-faqs' );     ?>

		<div class="form_options" id="epbl_debug_info_tab_page">

			<section class="save-settings">    <?php
				$button_text = $is_debug_on ? __( 'Disable Debug', 'blocks-for-documents-articles-and-faqs' ) : __( 'Enable Debug', 'blocks-for-documents-articles-and-faqs' ); ?>
				<div class="submit epbl_toggle_debug">
					<input type="hidden" id="_wpnonce_epbl_toggle_debug" name="_wpnonce_epbl_toggle_debug" value="<?php echo wp_create_nonce( "_wpnonce_epbl_toggle_debug" ); ?>"/>
					<input type="hidden" name="action" value="epbl_toggle_debug"/>
					<input type="submit" id="epbl_toggle_debug" class="epbl_toggle_debug epbl-dashboard__btn" value="<?php echo $button_text; ?>" />
				</div>
			</section>

			<section>
				<h3><?php echo $heading; ?></h3>
			</section>     <?php
			if ( $is_debug_on ) {
				echo self::display_debug_data();        ?>

				<form action="<?php echo esc_url( admin_url( 'admin.php?page=blocks-for-documents-articles-and-faqs' ) ); ?>" method="post" dir="ltr">

					<section class="save-settings checkbox-input">
						<div class="epbl_download_debug_info">
							<input type="hidden" id="_wpnonce_epbl_download_debug_info" name="_wpnonce_epbl_download_debug_info" value="<?php echo wp_create_nonce( "_wpnonce_epbl_download_debug_info" ); ?>">
							<input type="hidden" name="action" value="epbl_download_debug_info">
							<input type="submit" id="epbl_download_debug_info" class="epbl-dashboard__btn" value="<?php echo __( 'Download System Information', 'blocks-for-documents-articles-and-faqs' ); ?>">
						</div>
					</section>
				</form>     <?php
			}    ?>

		</div>      		<?php
	}

	public static function display_debug_data() {

		// ensure user has correct permissions
		if ( ! current_user_can( 'manage_options' ) ) {
			return __( 'No access', 'blocks-for-documents-articles-and-faqs' );
		}

		$output = '<textarea rows="30" cols="150" style="overflow:scroll;">';

		// display PHP and WP settings
		$output .= self::get_system_info();

		// display error logs
		$output .= "\n\nERROR LOG:\n";
		$output .= "==========\n";
		$logs = Logging::get_logs();
		foreach( $logs as $log ) {
			$output .= empty($log['plugin']) ? '' : $log['plugin'] . " ";
			$output .= empty($log['kb']) ? '' : $log['kb'] . " ";
			$output .= empty($log['date']) ? '' : $log['date'] . "\n";
			$output .= empty($log['message']) ? '' : $log['message'] . "\n";
			$output .= empty($log['trace']) ? '' : $log['trace'] . "\n\n";
		}

		// retrieve add-on data
		$add_on_output = apply_filters( 'epbl_add_on_debug_data', '' );
		$output .= is_string($add_on_output) ? $add_on_output : '';

		$output .= '</textarea>';

		return $output;
	}

	/**
	 * Based on EDD system-info.php file
	 * @return string
	 */
	private static function get_system_info() {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$host = defined( 'WPE_APIKEY' ) ? "Host: WP Engine" : '<unknown>';
		/** @var $theme_data WP_Theme */
		$theme_data = wp_get_theme();
		/** @noinspection PhpUndefinedFieldInspection */
		$theme = $theme_data->Name . ' ' . $theme_data->Version;

		ob_start();     ?>

		PHP and WordPress Information:
		==============================

		Multisite:                <?php echo is_multisite() ? 'Yes' . "\n" : 'No' . "\n" ?>

		SITE_URL:                 <?php echo site_url() . "\n"; ?>
		HOME_URL:                 <?php echo home_url() . "\n"; ?>

		WordPress Version:        <?php echo get_bloginfo( 'version' ) . "\n"; ?>
		Permalink Structure:      <?php echo get_option( 'permalink_structure' ) . "\n"; ?>
		Active Theme:             <?php echo $theme . "\n"; ?>
		Host:                     <?php echo $host . "\n"; ?>

		PHP Version:              <?php echo PHP_VERSION . "\n"; ?>

		PHP Post Max Size:        <?php echo ini_get( 'post_max_size' ) . "\n"; ?>
		PHP Time Limit:           <?php echo ini_get( 'max_execution_time' ) . "\n"; ?>
		PHP Max Input Vars:       <?php echo ini_get( 'max_input_vars' ) . "\n"; ?>
		WP_DEBUG:                 <?php echo defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' . "\n" : 'Disabled' . "\n" : 'Not set' . "\n" ?>

		WP Table Prefix:          <?php echo "Length: ". strlen( $wpdb->prefix ); ?>

		DISPLAY ERRORS:           <?php echo ( ini_get( 'display_errors' ) ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A'; ?><?php echo "\n"; ?>
		FSOCKOPEN:                <?php echo ( function_exists( 'fsockopen' ) ) ? 'Your server supports fsockopen.' : 'Your server does not support fsockopen.'; ?><?php echo "\n"; ?>
		cURL:                     <?php echo ( function_exists( 'curl_init' ) ) ? 'Your server supports cURL:' : 'Your server does not support cURL.'; ?><?php echo "\n";

		if ( function_exists( 'curl_init' ) ) {
			$curl_values = curl_version();
			echo "\n\t\t\t\tVersion: " . $curl_values["version"];
			echo "\n\t\t\t\tSSL Version: " . $curl_values["ssl_version"];
			echo "\n\t\t\t\tLib Version: " . $curl_values["libz_version"] . "\n";
		}		?>

		SOAP Client:              <?php echo ( class_exists( 'SoapClient' ) ) ? 'Your server has the SOAP Client enabled.' : 'Your server does not have the SOAP Client enabled.'; ?><?php echo "\n";

		$plugins = get_plugins();
		$active_plugins = get_option( 'active_plugins', array() );

		echo "\n\n";
		echo "KB PLUGINS:	         \n\n";

		foreach ( $plugins as $plugin_path => $plugin ) {
			// If the plugin isn't active, don't show it.
			if ( ! in_array( $plugin_path, $active_plugins ) )
				continue;

			if ( in_array($plugin['Name'], array('KB - Article Rating and Feedback','KB - Links Editor','KB - Import Export','KB - Multiple Knowledge Bases','KB - Widgets',
				'Knowledge Base for Documents and FAQs', 'KB - Elegant Layouts'))) {
				echo "		" . $plugin['Name'] . ': ' . $plugin['Version'] ."\n";
			}
		}

		echo "\n\n";
		echo "OTHER PLUGINS:	         \n\n";

		foreach ( $plugins as $plugin_path => $plugin ) {
			// If the plugin isn't active, don't show it.
			if ( ! in_array( $plugin_path, $active_plugins ) )
				continue;

			if ( ! in_array($plugin['Name'], array('KB - Article Rating and Feedback','KB - Links Editor','KB - Import Export','KB - Multiple Knowledge Bases','KB - Widgets',
				'Knowledge Base for Documents and FAQs'))) {
				echo "		" . $plugin['Name'] . ': ' . $plugin['Version'] ."\n";
			}
		}

		if ( is_multisite() ) {		?>
			NETWORK ACTIVE PLUGINS:		<?php  echo "\n";

			$plugins = wp_get_active_network_plugins();
			$active_plugins = get_site_option( 'active_sitewide_plugins', array() );

			foreach ( $plugins as $plugin_path ) {
				$plugin_base = plugin_basename( $plugin_path );

				// If the plugin isn't active, don't show it.
				if ( ! array_key_exists( $plugin_base, $active_plugins ) ) {
					continue;
				}

				$plugin = get_plugin_data( $plugin_path );

				echo "		" . $plugin['Name'] . ': ' . $plugin['Version'] ."\n";
			}
		}

		return ob_get_clean();
	}
}
