<?php
/**
 * Plugin Name: News and Blog Designer Bundle
 * Plugin URI: https://profiles.wordpress.org
 * Version: 1.1
 * Description: Display Posts on your website with 8 layouts (2 designs for each layout) plus 1 Ticker and 2 Widgets.
 * Text Domain: news-and-blog-designer-bundle
 * Domain Path: /languages/
 * Author: vaghasia3
 * Author URI: https://profiles.wordpress.org/vaghasia3
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * defind variable for plugin definitions
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
if( !defined( 'NBDB_VERSION' ) ) {
	define( 'NBDB_VERSION', '1.1' ); // Version of plugin
}
if( !defined( 'NBDB_DIR' ) ) {
	define( 'NBDB_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'NBDB_URL' ) ) {
	define( 'NBDB_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'NBDB_PLUGIN_BASENAME' ) ) {
	define( 'NBDB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined('NBDB_POST_TYPE') ) {
	define('NBDB_POST_TYPE', 'post'); // Post type name
}
if( !defined('NBDB_CAT') ) {
	define('NBDB_CAT', 'category'); // Plugin category name
}
/**
 * Load plugin Text Domain
 * This gets the plugin ready to translation
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_load_textdomain() {

	global $wp_version;
	
	// Set filter for plugin languages directory.
	$nbdb_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$nbdb_lang_dir = apply_filters( 'nbdb_get_languages_directory', $nbdb_lang_dir );
	
	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter.
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'news-and-blog-designer-bundle' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'news-and-blog-designer-bundle', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $nbdb_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/plugins/' . NBDB_PLUGIN_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // check it in global /wp-content/languages/news-and-blog-designer-bundle folder
		
		load_textdomain( 'news-and-blog-designer-bundle', $mofile_global );
		
	} else { // Load the default language files
		load_plugin_textdomain( 'news-and-blog-designer-bundle', false, $nbdb_lang_dir );
	}	
}
// Action to load plugin text domain
add_action('plugins_loaded', 'nbdb_load_textdomain');
// Functions file
require_once( NBDB_DIR . '/includes/nbdb-functions.php' );
// common Script file with Class 
require_once( NBDB_DIR . '/includes/class-nbdb-script.php' );
// for Admin file
require_once( NBDB_DIR . '/includes/admin/nbdb-admin.php' );
require_once( NBDB_DIR . '/includes/class-nbdb-ajax.php' );


// all Shortcode files
require_once( NBDB_DIR . '/shortcodes/class-nbdb-shortcode.php' );

// Widgets Files 
require_once( NBDB_DIR . '/widgets/class-nbdb-post-widget.php' );
require_once( NBDB_DIR . '/widgets/class-nbdb-post-sliding-widget.php' );