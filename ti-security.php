<?php
/**
 * Plugin Name: TI Security
 * Plugin URI: https://github.io/thoughtsideas/ti-security/
 * Description: Improve WordPress security
 * Author: Michael Bragg
 * Author URI: http://www.thoughtsandideas.co.uk
 * Version: 0.1.0
*/


class TI_Security {

	/**
	 * Maintain the single instance of TI_Security
	 *
	 * @var bool
	 */
	private static $instance = false;

	/**
	 * Add required hooks
	 */
	function __construct() {

		add_action(
			'login_errors',
			array( $this, 'ti_disable_login_hints' )
		);

		add_action(
			'the_generator',
			array( $this, 'ti_remove_version_generator' )
		);

	}

	/**
	 * Handle requests for the instance.
	 *
	 * @return bool
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new TI_Security();
		}
		return self::$instance;
	}

	/**
	 * Removes the SEO item from the admin bar
	 *
	 * @since 0.1.0
	 * @uses remove_menu
	 */
	protected function ti_disable_login_hints() {
		return __( 'Please double check your username, email or password.', 'ti-security' );
	}

	/**
	* Remove version generator
	* @since 0.1.0
	*/
	protected function ti_remove_version_generator() {
		return false;
	}

}

function ti_security_init() {
	TI_Security::get_instance();
}

add_action( 'plugins_loaded', 'ti_security_init' );
