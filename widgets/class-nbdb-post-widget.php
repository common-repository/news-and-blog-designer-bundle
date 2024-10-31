<?php
/**
* Widget Class : Latest Posts Widget Class
*
* @package WP Post and Blog Designer
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function nbdb_post_simple_widget_load_widgets() {
    register_widget( 'nbdb_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'nbdb_post_simple_widget_load_widgets' );

class nbdb_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'nbdb_post_simple_widget', 'description' => __('Display Latest WP News in a sidebar.', 'news-and-blog-designer-bundle') );
        parent::__construct( 'wpoh-nbdb-widget', __(' Latest News Widget', 'news-and-blog-designer-bundle'), $widget_ops);
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
        $value['num_items']      = $new_value['num_items'];
        $value['date']           = !empty($new_value['date']) ? 1 : 0;
        $value['post_category']  = !empty($new_value['post_category']) ? 1 : 0;
        $value['category']       = intval( $new_value['category'] );
        $value['template']       = $new_value['template'];
        $value['link_target']    = !empty($new_value['link_target']) ? 1 : 0;
        $value['exclude_post']   = !empty($new_value['exclude_post']) ? $new_value['exclude_post'] : '';
		$value['post_content']      = !empty($new_value['post_content']) ? 1 : 0;
		$value['content_words_limit']= !empty($new_value['content_words_limit']) ? $new_value['content_words_limit'] : 20;
        
        return $value;
    }

  /**
  * Outputs the settings form for the widget.
  *
  * @package WP Post and Blog Designer
  * @since 1.0.0
  */
  function form($value) {
      
    $defaults = array(
            'num_items'         => 5,
            'title'             => __( 'Latest Posts', 'news-and-blog-designer-bundle' ),
            'date'              => 1,
            'post_category'     => 1,
            'category'          => 0,
            'template'          => 'template-1',
            'link_target'       => 0,
            'exclude_post'      => '',
			'content_words_limit' => '20',
			'post_content'     	=> 0,
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

        <!-- Number of Items -->
        <p>
            <label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Posts:', 'news-and-blog-designer-bundle' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" value="<?php echo $value['num_items']; ?>" />
        </p>

        <!-- Category -->
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'news-and-blog-designer-bundle' ); ?></label>
            <?php
            $dropdown_args = array(
                                    'taxonomy'          => NDBD_CAT,
                                    'class'             => 'widefat',
                                    'show_option_all'   => __( 'All', 'news-and-blog-designer-bundle' ),
                                    'id'                => $this->get_field_id( 'category' ),
                                    'name'              => $this->get_field_name( 'category' ),
                                    'selected'          => $value['category']
                                );
            wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
        <!-- Number of content_words_limit -->
        <p>
            <label for="<?php echo $this->get_field_id('content_words_limit'); ?>"><?php esc_html_e( 'Content words limit:', 'news-and-blog-designer-bundle' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('content_words_limit'); ?>" name="<?php echo $this->get_field_name('content_words_limit'); ?>" type="number" value="<?php echo $value['content_words_limit']; ?>"  />
             <span class="description"><em><?php _e('Content words limit will only work when Display Short Content checked', 'news-and-blog-designer-bundle'); ?></em></span>
       </p>
        <!-- Query Offset -->
        <p>
            <label for="<?php echo $this->get_field_id('exclude_post'); ?>"><?php esc_html_e( 'Exclude Post:', 'news-and-blog-designer-bundle' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('exclude_post'); ?>" name="<?php echo $this->get_field_name('exclude_post'); ?>" type="number" value="<?php echo $value['exclude_post']; ?>" />
            
             <span class="description"><em><?php _e('Note: When Exclude Post work if set Number of Posts is -1.', 'news-and-blog-designer-bundle'); ?></em></span>
        </p>
        <!-- Display Date -->
        <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked($value['date'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'news-and-blog-designer-bundle' ); ?></label>
        </p>
        <!-- Display Category -->
        <p>
            <input id="<?php echo $this->get_field_id( 'post_category' ); ?>" name="<?php echo $this->get_field_name( 'post_category' ); ?>" type="checkbox" value="1" <?php checked($value['post_category'], 1); ?> />
            <label for="<?php echo $this->get_field_id( 'post_category' ); ?>"><?php _e( 'Show Category', 'news-and-blog-designer-bundle' ); ?></label>
        </p>
		 <!--  Display Short Content -->
        <p>
            <input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'post_content' ); ?>" name="<?php echo $this->get_field_name( 'post_content' ); ?>" <?php checked( $value['post_content'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'post_content' ); ?>"><?php _e( 'Show Short Content', 'news-and-blog-designer-bundle' ); ?></label>
        </p>
        <!-- Link Target -->
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $value['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'if Open post in a New Tab', 'news-and-blog-designer-bundle' ); ?></label>
        </p>
    <?php
  }
  /**
  * Outputs the content for the current widget value.
  *
  * @package WP Post and Blog Designer
  * @since 1.0.0
  */
  function widget($args, $value) {
    
    extract($args, EXTR_SKIP);

        $title          = apply_filters( 'widget_title', isset($value['title']) ? $value['title'] : __( 'Latest Posts', 'news-and-blog-designer-bundle' ), $value, $this->id_base );
        $num_items      = $value['num_items'];
        $date           = ( isset($value['date']) && ($value['date'] == 1) ) ? "true" : "false";
        $post_category  = ( isset($value['post_category']) && ($value['post_category'] == 1) ) ? "true" : "false";
        $category       = $value['category'];
        $template       = $value['template'];
        $exclude_post   = isset($value['exclude_post'])  ? $value['exclude_post'] : '';
        $link_target    = (isset($value['link_target']) && $value['link_target'] == 1) ? '_blank' : '_self';
		$words_limit        = $value['content_words_limit'];
		$post_content       = ( isset($value['post_content']) && ($value['post_content'] == 1) ) ? "true" : "false";
    
    // Shortcode file
   $post_template_file_path    = NBDB_DIR . '/widgets/view/nbdb-grid/' . $template . '.php';
   $template_file          = (file_exists($post_template_file_path)) ? $post_template_file_path : '';

        // Taking some globals
        global $post;

        // WP Query Parameter
        $post_args = array(
                    'post_type'             => NBDB_POST_TYPE,
                    'post_status'           => array( 'publish' ),
                    'posts_per_page'        => $num_items,
                    'order'                 => 'DESC',
                    'ignore_sticky_posts'   => true,
                    'offset'                => $exclude_post,
                );

        // Category Parameter
        if( !empty($category) ) {
            $post_args['tax_query'] = array(
                                        array(
                                            'taxonomy'  => NDBD_CAT,
                                            'field'     => 'term_id',
                                            'terms'     => $category
                                    ));
        }

        // WP Query
        $cust_loop  = new WP_Query($post_args);
        echo $before_widget;
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
        // If Post is there
        if ($cust_loop->have_posts()) {
    ?>
    <div class="nbdb-recent-post-widget-outter nbdb-grid-widget-<?php echo $template; ?>">            
            <?php while ($cust_loop->have_posts()) : $cust_loop->the_post();
                $cat_links  = array();
				$feat_image = nbdb_get_post_featured_image( $post->ID, 'medium' );
                $terms      = get_the_terms( $post->ID, NBDB_CAT );
                $post_link  = nbdb_get_post_link( $post->ID );                
                if($terms) {
                    foreach ( $terms as $term ) {
                        $term_link      = get_term_link( $term );
                        $cat_links[]   = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                $cate_name = join( " ", $cat_links );
            ?>

                <?php // Include shortcode html file
                if( $template_file ) {
                    include( $template_file );
                } ?>   
            <?php endwhile; ?>          
        </div>
<?php } // End of have_post()
        wp_reset_postdata(); // Reset WP Query
        echo $after_widget;
    }
}