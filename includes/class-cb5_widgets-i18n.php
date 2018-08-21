<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       //doedejaarsma.nl
 * @since      1.0.0
 *
 * @package    Cb5_widgets
 * @subpackage Cb5_widgets/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cb5_widgets
 * @subpackage Cb5_widgets/includes
 * @author     Doede Jaarsma communicatie <support@doedejaarsma.nl>
 */
class Cb5_widgets_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cb5_widgets',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
