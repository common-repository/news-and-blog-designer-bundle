<?php
/**
 * Script and CSS Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class nbdb_Script {	
	function __construct() {		
		// Action for add style on front side
		add_action( 'wp_enqueue_scripts', array($this, 'nbdb_front_style') );		
		// Action for add script on front side
		add_action( 'wp_enqueue_scripts', array($this, 'nbdb_front_script') );		
	}
	/**
	 * Function to add style at front side
	 * 
	 * @package News and Blog Designer Bundle
	 * @since 1.0.0
	 */
	function nbdb_front_style() {

          // Registring font awesome css
		 if( !wp_style_is( 'wpoh-fontawesome-css', 'registered' ) ) {
			wp_register_style( 'wpoh-fontawesome-css', NBDB_URL.'assets/css/font-awesome.min.css', array(), NBDB_VERSION  );
			wp_enqueue_style( 'wpoh-fontawesome-css' );
			
		} 
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpoh-slick-css', 'registered' ) ) {
			wp_register_style( 'slick-style', NBDB_URL.'assets/css/nbdb-slick.css', array(), NBDB_VERSION );
			wp_enqueue_style( 'slick-style' );
		}
		// Register and enqueing custom css
		wp_register_style( 'nbdb-custom-style', NBDB_URL.'assets/css/nbdb-custom.css', array(), NBDB_VERSION );
		wp_enqueue_style( 'nbdb-custom-style' );
	}
	/**
	 * Function for add script at front side 
	 * 
	 * @package News and Blog Designer Bundle
	 * @since 1.0.0
	 */
	function nbdb_front_script() {
		// Register slick slider script for post design
		if( !wp_script_is( 'wpoh-slick-js', 'registered' ) ) {
			wp_register_script( 'wpoh-slick-js', NBDB_URL. 'assets/js/nbdb-slick.min.js', array('jquery'), NBDB_VERSION, true);
		}
		
		// Register vertical ticker script for post designer
		if( !wp_script_is( 'wpoh-vartical-ticker-js', 'registered' ) ) {
			wp_register_script( 'wpoh-vartical-ticker-js', NBDB_URL. 'assets/js/nbdb-post-ticker.js', array('jquery'), NBDB_VERSION, true);
		}

		// Register all ticker script for post and blog designer
		if( !wp_script_is( 'nbdb-ticker-js', 'registered' ) ) {
			wp_register_script( 'nbdb-ticker-js', NBDB_URL . 'assets/js/nbdb-costum-ticker.js', array('jquery'), NBDB_VERSION, true );
		}

		// Register all ticker script for post and blog designer
		if( !wp_script_is( 'wpoh-filter-js', 'registered' ) ) {
			wp_register_script( 'wpoh-filter-js', NBDB_URL . 'assets/js/filterizr.js', array('jquery'), NBDB_VERSION, true );
			
		}
		
		// Register and enque custom script
		wp_register_script( 'nbdb-custom-script', NBDB_URL. 'assets/js/nbdb-costum.js', array('jquery'), NBDB_VERSION, true );
		wp_localize_script( 'nbdb-custom-script', 'nbdb', array(
																		'is_mobile' => (wp_is_mobile()) ? 1 : 0,
																		'is_rtl' 	=> (is_rtl()) ? 1 : 0
																	));
		// Register Custom Mmasonry Script
		wp_register_script( 'nbdb-custom-masonry-script', NBDB_URL.'assets/js/nbdb-custom-masonry.js', array('jquery'), NBDB_VERSION, true );

		// Register  script for SSL certificate for AJAX
		wp_localize_script( 'nbdb-custom-masonry-script', 'nbdb', array( 
																	'ajaxurl' 		=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
																	'no_post_msg'	=> __('Sorry, No more post Available.', 'wp-post-and-blog-designer')
																));															
	}	

}

$nbdb_script = new nbdb_Script();