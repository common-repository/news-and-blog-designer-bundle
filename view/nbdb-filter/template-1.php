<div class="filter-grid">
<div class="nbdb-post-grid">		
	<div class="nbdb-post-grid-content <?php if ( !has_post_thumbnail() ) { echo 'no-thumb-image'; } ?>">
		<?php		
		if ( has_post_thumbnail() ) { ?>
		<div class="nbdb-post-image-bg" style="<?php echo $height_css; ?>">
			<a href="<?php echo $post_link; ?>">
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			</a>
		</div>
		<?php } ?>		
		<div class="nbdb-inner-content">
		<div class="nbdb-post-title">
			<a href="<?php echo $post_link; ?>"><?php the_title(); ?></a>
		</div>

		<?php if($showCategory == "true" && $cate_name !='') { ?>
		<div class="nbdb-post-categories">
			<?php echo $cate_name; ?>
		</div>
		<?php } 
		  if($showDate == "true" || $showAuthor == 'true' || $show_comments =="true") { ?>
				<div class="nbdb-post-date">
					<?php if($showAuthor == 'true') { ?>
						<span class="nbdb-user-img"><i class="fa fa-user" aria-hidden="true"></i> <?php the_author(); ?></span>
					<?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;' : '' ?>
					<?php if($showDate == "true") { ?>
						<span class="nbdb-time"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?> </span>
					<?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true' && $show_comments == 'true') ? '&nbsp;' : '' ?>
					<?php if(!empty($comments) && $show_comments == 'true') { ?>
						<span class="nbdb-post-comments">
							
							<a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comments" aria-hidden="true"></i><?php echo $comments.' '.$reply;  ?></a>
						</span>
					<?php } ?>	
				</div>
			<?php } 
			if($showContent == "true") { ?>
			<div class="nbdb-post-content">				
					<div class="nbdb-post-short-content"><p><?php echo nbdb_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></p></div>
					<?php if($show_read_more == 'true') { ?>
						<a href="<?php echo $post_link; ?>" class="readmorebtn"><?php _e( 'Read More', 'post-grid-and-filter-ultimate' ); ?></a>
					<?php } ?>				
			</div>
		<?php } ?>		
	</div>
</div>
</div>
</div>