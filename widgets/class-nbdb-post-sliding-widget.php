<?php
/**
* Widget Class : Latest Post Scrolling Widget
*
* @package News and Blog Designer Bundle
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function nbdb_post_scroll_widget() {
  register_widget( 'nbdb_Post_slider_Widget' );
}

// add action for the register widget
add_action( 'widgets_init', 'nbdb_post_scroll_widget' );

class nbdb_Post_slider_Widget extends WP_Widget {

    function __construct() {
        $nbdb_widget = array('classname' => 'nbdb_post_slider_widget', 'description' => __('Show Latest News in a sidebar with vertical slider.', 'news-and-blog-designer-bundle') );
        parent::__construct( 'nbdb_post_slider_widget', __('Latest News slider Widget', 'news-and-blog-designer-bundle'), $nbdb_widget);
    }
    /**
     * Handles updating settings for the current widget value.
     *
     * @package WP Post and Blog Designer
     * @since 1.0.0
    */
    function update($new_value, $old_value) {
        $value = $old_value;
        $value['title']          = sanitize_text_field($new_value['title']);
        $value['num_post']      = $new_value['num_post'];
        $value['date']           = !empty($new_value['date']) ? 1 : 0;
        $value['show_category']  = !empty($new_value['show_category']) ? 1 : 0;
        $value['show_thumb']     = !empty($new_value['show_thumb']) ? 1 : 0;
        $value['category']       = $new_value['category'];
        $value['template']       = $new_value['template'];
        $value['height']         = $new_value['height'];
        $value['pause']          = $new_value['pause'];
        $value['speed']          = $new_value['speed'];
        $value['link_target']    = !empty($new_value['link_target']) ? 1 : 0;
        $value['exclude_post']   = !empty($new_value['exclude_post']) ? $new_value['exclude_post'] : '';
		$value['show_content']      = !empty($new_value['show_content']) ? 1 : 0;
		$value['content_words_limit']= !empty($new_value['content_words_limit']) ? $new_value['content_words_limit'] : 20;
        
        return $value;
    }
  /**
  * Outputs settings form for the widget.
  *
  * @package WP Post and Blog Designer
  * @since 1.0.0
  */
  function form($value) {

    $defaults = array(
            'num_post'         => 5,
            'title'             => __( 'Latest Posts Slider', 'news-and-blog-designer-bundle' ),
            'date'              => 1, 
            'show_category'     => 1,
            'show_thumb'        => 1,
            'category'          => 0,
            'template'          => 'tempalte-1',
            'height'            => 400,      
            'pause'             => 2000,                
            'speed'             => 500,
            'link_target'       => 0,
            'exclude_post'      => '',
			'content_words_limit' => '20',
			'show_content'     	=> 0,
        );
        
        $value = wp_parse_args( (array) $value, $defaults );
    ?>
        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'news-and-blog-designer-bundle' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($value['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e( 'Select Template:', 'news-and-blog-designer-bundle' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'template' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'template' ); ?>">
                <option value="template-1" <?php selected( $value['template'], 'template-1' ); ?>> 
                    <?php _e( 'template-1', 'wp-logo-slider-and-widget' ); ?></option>
                <option value="template-2" <?php selected( $value['template'], 'template-2' ); ?>>
                    <?php _e( 'template-2', 'wp-logo-slider-and-widget' ); ?></option>
                <option value="template-3" <?php selected( $value['template'], 'template-3' ); ?>>
                    <?php _e( 'template-3', 'wp-logo-slider-and-widget' ); ?></option>
                    <option value="template-4" <?php selected( $value['template'], 'template-4' ); ?>>
                    <?php _e( 'template-4', 'wp-logo-slider-and-widget' ); ?></option>
                    <option value="template-5" <?php selected( $value['template'], 'template-5' ); ?>>
                    <?php _e( 'template-5', 'wp-logo-slider-and-widget' ); ?></option>                    
            </select>
        </p>

        <!-- Post Category -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select Category:', 'news-and-blog-designer-bundle' ); ?></label>
            <?php
                $dropdown_args = array(
                                        'taxonomy'          => NBDB_CAT,
                                        'class'             => 'widefat',
                                        'show_option_all'   => __( 'All', 'news-and-blog-designer-bundle' ),
                                        'id'                => $this->get_field_id( 'category' ),
                                        'name'              => $this->get_field_name( 'category' ),
                                        'selected'          => $value['category'],
                                    );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>

        <!-- Number of Post -->
        <p>
            <label for="<?php echo $this->get_field_id('num_post'); ?>"><?php esc_html_e( 'Number of Post:', 'news-and-blog-designer-bundle' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_post'); ?>" name="<?php echo $this->get_field_name('num_post'); ?>" type="number" value="<?php echo $value['num_post']; ?>" />
        </p>

        <!-- set post content words limit -->
        <p>
            <label for="<?php echo $this->get_field_id('content_words_limit'); ?>"><?php esc_html_e( 'Post Content Words limit:', 'news-and-blog-designer-bundle' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('content_words_limit'); ?>" name="<?php echo $this->get_field_name('content_words_limit'); ?>" type="number" value="<?php echo $value['content_words_limit']; ?>"  />
             <span class="description"><em><?php _e('Content words limit will only work if Show Short Content checked', 'news-and-blog-designer-bundle'); ?></em></span>
       </p>

        <!-- Exclude Post -->
        <p>
            <label for="<?php echo $this->get_field_id('exclude_post'); ?>"><?php esc_html_e( 'Exclude Post:', 'news-and-blog-designer-bundle' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('exclude_post'); ?>" name="<?php echo $this->get_field_name('exclude_post'); ?>" type="number" value="<?php echo $value['exclude_post']; ?>"  />
            
            <span class="description"><em><?php _e('Note: When Exclude Post work if set Number of Posts is -1.', 'news-and-blog-designer-bundle'); ?></em></span>
        </p>      

        <!-- Set Height -->
        <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'news-and-blog-designer-bundle' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'height' ); ?>"  value="<?php echo $value['height']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" />
        </p>
        <!-- Post Pause -->
        <p>
            <label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e( 'Pause:', 'news-and-blog-designer-bundle' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'pause' ); ?>"  value="<?php echo $value['pause']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" />
        </p>
        <!-- Post Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'news-and-blog-designer-bundle' ); ?></label>
            <input type="number" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $value['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>
         <!-- Show Post Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $value['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Show Post Date', 'news-and-blog-designer-bundle' ); ?></label>
        </p>
        <!-- Show Post Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $value['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Show Post Category', 'news-and-blog-designer-bundle' ); ?></label>
        </p>
         <!--  Show Post Short Content -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>" <?php checked( $value['show_content'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Show Short Post Content', 'news-and-blog-designer-bundle' ); ?></label>
        </p>

        <!-- Show Post image -->
        <p>
            <input id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" type="checkbox" value="1" <?php checked( $value['show_thumb'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Show Post Image', 'news-and-blog-designer-bundle' ); ?></label>
        </p>

        <!-- Open Post in a New Tab -->
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $value['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Post in a New Tab', 'news-and-blog-designer-bundle' ); ?></label>
        </p>
    <?php
  }
    /**
     * Output the content for the current widget value.
     *
     * @package WP Post and Blog Designer
     * @since 1.0.0
    */
    function widget($args, $value) {
        extract($args, EXTR_SKIP);
        $title          = apply_filters( 'widget_title', isset( $value['title'] ) ? $value['title'] : __( 'Latest Posts', 'news-and-blog-designer-bundle' ), $value, $this->id_base );
        $num_post      = $value['num_post'];
        $date           = ( isset($value['date']) && ($value['date'] == 1) ) ? "true" : "false";
        $show_category  = ( isset($value['show_category']) && ($value['show_category'] == 1) ) ? "true" : "false";
        $show_thumb     = ( isset($value['show_thumb']) && ($value['show_thumb'] == 1) ) ? "true" : "false";
        $exclude_post   = isset($value['exclude_post'])  ? $value['exclude_post'] : '';
        $category       = $value['category'];
        $template       = $value['template'];
        $height         = $value['height'];
        $pause          = $value['pause'];
        $speed          = $value['speed'];
        $link_target    = (isset($value['link_target']) && $value['link_target'] == 1) ? '_blank' : '_self';
		$words_limit        = $value['content_words_limit'];
		$show_content       = ( isset($value['show_content']) && ($value['show_content'] == 1) ) ? "true" : "false";
        $fix         = nbdb_get_fix();
         // Shortcode file
       $post_template_file_path    = NBDB_DIR . '/widgets/view/nbdb-slider/' . $template . '.php';
       $template_file          = (file_exists($post_template_file_path)) ? $post_template_file_path : '';
        // Slider configuration
        $slider_conf = compact( 'speed', 'height', 'pause' );
        // Enqueue required script        
        wp_enqueue_script( 'wpoh-vartical-ticker-js' );
        wp_enqueue_script( 'nbdb-custom-script' );
        // Taking some global
        global $post;
        // WP Query Parameter
        $post_args = array(
                    'post_type'             => NBDB_POST_TYPE,
                    'post_status'           => array( 'publish' ),
                    'posts_per_page'        => $num_post,
                    'order'                 => 'DESC',
                    'ignore_sticky_posts'   => true,
                    'offset'                => $exclude_post,
                );
        // Category Parameter
        if( !empty($category) ) {
            $post_args['tax_query'] = array(
                                        array(
                                            'taxonomy'  => NBDB_CAT,
                                            'field'     => 'term_id',
                                            'terms'     => $category
                                    ));
        }
        // WP Query
        $cust_loop = new WP_Query($post_args);
        // Start Widget Output
        echo $before_widget;
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
        // If Post is there
        if ($cust_loop->have_posts()) {
    ?>
    <div class="nbdb-widget-outter">      
            <div class="nbdb-ticker-jcarousellite nbdb-widget-<?php echo $template; ?>" id="nbdb-post-ticker-<?php echo $fix; ?>">
                <ul>
                    <?php while ($cust_loop->have_posts()) : $cust_loop->the_post();                        
                        $cat_links      = array();
                        $feat_image     = nbdb_get_post_featured_image( $post->ID, array(100,100) );
                        $post_link      = nbdb_get_post_link( $post->ID );
                        $terms          = get_the_terms( $post->ID, NBDB_CAT );                        
                        if($terms) {
                          foreach ( $terms as $term ) {
                                $term_link      = get_term_link( $term );
                                $cat_links[]    = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                            }
                        }
                        $cate_name = join( " ", $cat_links );
                    ?>
                     <?php // Include shortcode html file
                           if( $template_file ) {
                           include( $template_file );
                           } ?>   
                    <?php endwhile; ?>
               </ul>
            </div>
        
        <div class="nbdb-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
    </div>

    <?php } // End of widget have_post()
        wp_reset_postdata(); // Reset WP Query for widget
        echo $after_widget;
    }
}