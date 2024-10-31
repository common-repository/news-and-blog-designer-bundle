<?php
/**
 * Masonry Design template
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="nbdb-post-grid  nbdb-medium-<?php echo $grids; ?> nbdb-cell ">
	<div class="nbdb-post-grid-content <?php if ( !has_post_thumbnail() ) { echo 'nbdb-no-thumb-image'; } ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="nbdb-post-image-bg">
			<a href="<?php echo esc_url( $post_link ); ?>">
				<img src="<?php echo esc_url( $post_featured_image ); ?>" alt="<?php the_title_attribute(); ?>" />
			</a>
			<div class="nbdb-masonary-img-content">
		<?php }
		if($showCategory == "true" && $cate_name !='') { ?>
		<div class="nbdb-post-categories">
			<?php echo $cate_name; ?>
		</div>
		<?php } ?>
		<div class="nbdb-post-title">
			<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
		</div>
		
		<?php if($showDate == "true" || $showAuthor == 'true' || $show_comments =="true") { ?>
			<div class="nbdb-post-date">
				<?php if($showAuthor == 'true') { ?>
					<span class="nbdb-user-img"><i class="fa fa-user" aria-hidden="true"></i><?php the_author(); ?></span>
				<?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '/' : '' ?>
				<?php if($showDate == "true") { ?>
					<span class="nbdb-time"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_the_date(); ?> </span>
				<?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true' && $show_comments == 'true' && !empty($comments)) ? '/' : '' ?>
				<?php if(!empty($comments) && $show_comments == 'true') { ?>
					<span class="nbdb-post-comments">
						<a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comments" aria-hidden="true"></i><?php echo $comments.' '.$reply;  ?></a>
					</span>
				<?php } ?>
			</div>
				</div>
		</div>
		<div class="nbdb-masonary-inner-content">
		<?php }
		if($showContent == "true") { ?>
		<div class="nbdb-post-content">
			<div class="nbdb-post-short-content"><p><?php echo nbdb_get_post_excerpt( $post->ID, get_the_content(), $words_limit ); ?></p></div>
			<?php if($showreadmore == 'true') { ?>
				<a href="<?php echo esc_url( $post_link ); ?>" class="nbdb-readmorebtn"><?php echo _e('Read More', 'News-and-blog-designer-bundle'); ?></a>
			<?php } ?>
		</div>
		<?php }
		
		if(!empty($tags) && $show_tags == 'true') { ?>
			<div class="nbdb-post-tags"><i class="fa fa-tags" aria-hidden="true"></i><?php echo $tags; ?></div>
		<?php } ?>
	</div>
</div>
</div>