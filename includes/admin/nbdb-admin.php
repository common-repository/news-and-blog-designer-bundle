<?php
/**
 * post plugin Admin Class
 *
 * manage for the Admin side functionality of this plugin
 *
 * @package News and Blog Designer Bundle
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class nbdb_Admin {
	function __construct() {
		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'nbdb_register_menu'), 9 );
		// Filter to add plugin action link
		add_filter( 'wpoh_plugin_action_links_' .NBDB_PLUGIN_BASENAME, array($this, 'nbdb_plugin_action_links') );
	}
	/**
	 * Function to register admin menus
	 * 
	 * @package News and Blog Designer Bundle
	 * @since 1.0.4
	 */
	function nbdb_register_menu() {		
		// Getting Started Page
		add_menu_page( __('News and Blog Design', 'news-and-blog-designer-bundle'), __('News and Blog Designer', 'news-and-blog-designer-bundle'), 'edit_posts', 'nbdb-about', array($this, 'nbdb_getting_started_page'), 'dashicons-admin-customizer', 6 );		
		
	}
	/**
	 * Function to get 'How It Works' HTML
	 *
	 * @package News and Blog Designer Bundle	
	 * @since 1.0.0
	 */
	function nbdb_getting_started_page() {
	include_once( NBDB_DIR. '/includes/admin/how-it-work.php' );
	}
}

$nbdb_admin = new nbdb_Admin();