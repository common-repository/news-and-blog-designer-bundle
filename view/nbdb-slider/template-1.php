<?php
/**
 * Slider Design 1
 * 
 * @package News and Blog Designer Pack
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="nbdb-post-slides">
	
	<div class="nbdb-post-overlay">
		<?php if($postCategory == "true") { ?>
			<div class="nbdb-post-categories"><?php echo $cate_name; ?></div>
		<?php } ?>
		<div class="nbdb-post-title">
			<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
		</div>
		<?php if($postDate == "true" || $postAuthor == 'true' || $post_comments =="true") { ?>
			<div class="nbdb-post-date">
				<?php if($postAuthor == 'true') { ?>
					<span class="nbdb-user-img"><i class="fa fa-user" aria-hidden="true"></i><?php the_author(); ?></span>
				<?php } ?>
				<?php echo ($postAuthor == 'true' && $postDate == 'true') ? '/' : '' ?>
				<?php if($postDate == "true") { ?>
					<span class="nbdb-time"> <i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?> </span>
				<?php } ?>
				<?php echo ($postAuthor == 'true' && $postDate == 'true' && $post_comments == 'true' && !empty($comments)) ? '/' : '' ?>
				<?php if(!empty($comments) && $post_comments == 'true') { ?>
					<span class="nbdb-post-comments">
						<a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comments" aria-hidden="true"></i><?php echo $comments.' '.$reply;  ?></a>
					</span>
				<?php } ?>
			</div>
		<?php }
		if($postContent == "true") { ?>
			<div class="nbdb-post-content">
				<div class="nbdb-post-short-content"><p><?php echo nbdb_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?></p></div>				
				<?php if($postreadmore == 'true') { ?>
				<a href="<?php echo esc_url( $post_link ); ?>" class="nbdb-readmorebtn"><?php echo _e('Read More', 'blog-designer-pack'); ?></a>
				<?php } ?>
			</div>
		<?php }
		if(!empty($tags) && $post_tags == 'true') { ?>
			<div class="nbdb-post-tags"><i class="fa fa-tags" aria-hidden="true"></i><?php echo $tags; ?></div>
		<?php } ?>
	</div>
	<div class="nbdb-post-image-bg">
	<?php if( !empty($feat_image) ) { ?>
		<a href="<?php echo esc_url( $post_link ); ?>">
			<img src="<?php echo esc_url( $feat_image ); ?>" alt="<?php the_title_attribute(); ?>" />
		</a>
	<?php } ?>
	</div>
</div>