<?php
/**
 * Grid Design template
 * 
 * @package News and Blog Designer Bundle
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="nbdb-post-grid  nbdb-medium-<?php echo $grids; ?> nbdb-cell <?php echo $css_class; ?>">		
	<div class="nbdb-grid-content <?php if ( !has_post_thumbnail() ) { echo 'nbdb-no-image'; } ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="nbdb-post-image-outter">
			<a href="<?php echo esc_url( $post_link ); ?>">
				<img src="<?php echo esc_url( $post_image ); ?>" alt="<?php the_title_attribute(); ?>" />
			</a>
		</div>
		<?php } ?>
		<div class="nbdb-post-margin-content">
			<?php if($PostCategory  == "true" && $cate_name !='') { ?>
			<div class="nbdb-post-categories">
				<?php echo $cate_name; ?>
			</div>
			<?php } ?>
			<div class="nbdb-title-content">
			<div class="nbdb-post-title">
				<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
			</div>
			<?php if($PostDate == "true" || $PostAuthor == 'true' || $Post_Comments =="true") { ?>
				<div class="nbdb-post-other-content">
					<?php if($PostAuthor == 'true') { ?>
						<span class="nbdb-post-author"><i class="fa fa-user" aria-hidden="true"></i><?php the_author(); ?></span>
					<?php } ?>
					<?php echo ($PostAuthor == 'true' && $PostDate == 'true') ? '/' : '' ?>
					<?php if($PostDate == "true") { ?>
						<span class="nbdb-post-date"> <i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?> </span>
					<?php } ?>
					<?php echo ($PostAuthor == 'true' && $PostDate == 'true' && $Post_Comments == 'true' && !empty($comments)) ? '/' : '' ?>
					<?php if(!empty($comments) && $Post_Comments == 'true') { ?>
						<span class="nbdb-post-comments">
							<a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comments" aria-hidden="true"></i><?php echo $comments.' '.$reply;  ?></a>
						</span>
					<?php } ?>
				</div>
			</div>
			<?php }
           
			if($PostContent == "true") { ?>
				<div class="nbdb-post-content">
					<div class="nbdb-sub-content"><p>
					<?php echo nbdb_get_post_excerpt( $post->ID, get_the_content(), $words_limit ); ?></p>
					</div>
		
					<?php }

			if(!empty($tags) && $post_tags == 'true') { ?>
				<div class="nbdb-post-tags"><i class="fa fa-tags" aria-hidden="true"></i><?php echo $tags; ?></div>
			<?php } ?>
					<?php if($postreadmore == 'true') { ?>
						
						<a href="<?php echo esc_url( $post_link ); ?>" class="nbdb-btn"><?php echo _e('<span>Read More</span>', 'wp-post-and-blog-designer'); ?></a>
					<?php } ?>
				</div>
			
		</div>
	</div>
</div>