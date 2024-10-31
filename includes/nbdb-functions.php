<?php
/**
 * All functions file
 *
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Function to get Post content word limit
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_words_limit($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
		array_pop($words);
	return implode(' ', $words);
}
/**
 * WP Escape Tags & Slashes
 *
 * For Handles escapping the slashes and tags
 *
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}
/**
 * WP Strip Slashes From Array
 * If it is flag variable is passed then it will allow HTML
 *
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_slashes_deep($data = array(), $flag = false){	
	if($flag != true) {
		$data = nbdb_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}
/**
 * Strip Html Tags 
 * 
 * It will sanitize text input fields. Strip html tags and escape characters)
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_nohtml_kses($data = array()){	
	if ( is_array($data) ) {		
		$data = array_map('wtwp_nohtml_kses', $data);		
	} elseif ( is_string( $data ) ) {		
		$data = wp_filter_nohtml_kses($data);
	}	
	return $data;
}
/**
 * Function to unique number value
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_get_fix() {
	static $fix = 0;
	$fix++;

	return $fix;
}

/**
 * Function to add array after specific key
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_add_array(&$array, $value, $index, $from_last = false) {    
    if( is_array($array) && is_array($value) ) {
        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }    
    return $array;
}
/**
 * Function to get post excerpt
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_get_post_excerpt( $post_id = null, $content = '', $word_length = '45', $more = '...' ) {
	$has_excerpt 	= false;
	$word_length 	= !empty($word_length) ? $word_length : '45';
	// If post id is passed
	if( !empty($post_id) ) {
		if (has_excerpt($post_id)) {
			$has_excerpt 	= true;
			$content 		= get_the_excerpt();
		} else {
			$content = !empty($content) ? $content : get_the_content();
		}
	}
	if( !empty($content) && (!$has_excerpt) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}	
	return $content;
}
/**
 * Function to get post featured image
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_get_post_featured_image( $post_id = '', $size = 'full' ) {
    
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
    $image 	= isset($image[0]) ? $image[0] : '';
    return $image;
}
/**
 * Function to get post permalink  
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_get_post_link( $post_id = '' ) {

	$post_link = '';

	if( !empty($post_id) ) {

		if( empty($post_link) ) {
			$post_link = get_permalink( $post_id );	
		}
	}
	return $post_link;
}
/**
 * Pagination function for grid
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_post_pagination($args = array()){
	
	$large = 999999999; // for infinet integer variable value
	
	$total_paging = array(
					'base' 		=> str_replace( $large, '%#%', esc_url( get_pagenum_link( $large ) ) ),
					'format' 	=> '?paged=%#%',
					'current' 	=> max( 1, $args['paged'] ),
					'total'		=> $args['total'],
					'prev_next'	=> true,
					'prev_text'	=> __('« Previous', 'news-and-blog-designer-bundle'),
					'next_text'	=> __('Next »', 'news-and-blog-designer-bundle'),
				);
	return paginate_links($total_paging);
}
/**
 * Function to get 'nbdb post Slider' shortcode template
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_post_template() {
	$template_arr = array(
		'template-1'	=> __('Template 1', 'news-and-blog-designer-bundle'),
		'template-2'	=> __('Template 2', 'news-and-blog-designer-bundle'),
		
	);
	return $template_arr;
}

/**
 * Function to get for masonry effect
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0.0
 */
function nbdb_post_masonry_effects() {
	$effects_arr = array(
						'effect-1'	=> __('Effect 1', 'news-and-blog-designer-bundle'),
						'effect-2'	=> __('Effect 2', 'news-and-blog-designer-bundle'),	
					);
	return $effects_arr;
}