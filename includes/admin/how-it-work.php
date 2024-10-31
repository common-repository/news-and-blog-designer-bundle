<?php
/**
 * Getting Started Page
 *
 * @package News and Blog Designer Bundle
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<style type="text/css">
	.postbox-feedback.postbox{background:#48BF91; border:1px solid #48BF91; color:#fff; }
	.postbox-feedback.postbox p{font-size:15px;}
	.postbox-container .nbdb-list li{list-style:square inside;}
	.postbox-container .nbdb-list .nbdb-tag{display: inline-block; background-color: #fd6448; padding: 1px 5px; color: #fff; border-radius: 3px; font-weight: 600; font-size: 12px;}
	.nbdb-wrap .nbdb-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
	.nbdb-shortcode-preview{background-color: #e7e7e7; font-weight:bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	.nbdb-feedback{clear:both; text-align:center;}
	.nbdb-feedback h3{font-size:24px; margin-bottom:0px;}
	.nbdb-feedback p{font-size:15px;}
	.nbdb-feedback .nbdb-feedback-btn { font-weight: 600;  color: #fff;text-decoration: none;
		text-transform: uppercase;padding: 1em 2em; background:#0bf;    border-radius: 0.2em;}
</style>
<div class="wrap nbdb-wrap">
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
				<div class="meta-box-sortables">					
					<div class="postbox">
						<h3 class="hndle">
							<span><?php _e( 'How to Use - News and Blog Designer Bundle', 'news-and-blog-designer-bundle' ); ?></span>
						</h3>

						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th>
											<label><?php _e('How to add Post', 'news-and-blog-designer-bundle'); ?></label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Go to "Post -- Add New".', 'news-and-blog-designer-bundle'); ?></li>
												<li><?php _e('Step-2. Add Post Title, Description and Featured image with relevant fields.', 'news-and-blog-designer-bundle'); ?></li>
												<li><?php _e('Step-3. Select post category and tag ( if need )', 'news-and-blog-designer-bundle'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('Create Page', 'news-and-blog-designer-bundle'); ?></label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Create a page as per need', 'news-and-blog-designer-bundle'); ?></li>
												<li><?php _e('Step-2. use below shortcode as per your need design.', 'news-and-blog-designer-bundle'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('All Shortcodes', 'news-and-blog-designer-bundle'); ?></label>
										</th>
										<td>														
											<span class="nbdb-shortcode-preview">[nbdb_grid template="template-1"]</span> – <?php _e('News Grid Shortcode -2 design', 'news-and-blog-designer-bundle'); ?> <br />
											<span class="nbdb-shortcode-preview">[nbdb_row template="template-1"]</span> – <?php _e('News List Shortcode -2 design', 'news-and-blog-designer-bundle'); ?> <br />
											<span class="nbdb-shortcode-preview">[nbdb_masonry template="template-1"]</span> – <?php _e('News Masonry Shortcode -2 design', 'news-and-blog-designer-bundle'); ?> <br />
											<span class="nbdb-shortcode-preview">[nbdb_slider template="template-1"]</span> – <?php _e('News Slider Shortcode -2 design', 'news-and-blog-designer-bundle'); ?> <br />
											<span class="nbdb-shortcode-preview">[nbdb_carousel template="template-1"]</span> – <?php _e('News Carousel Shortcode -2 design', 'news-and-blog-designer-bundle'); ?> <br />
											<span class="nbdb-shortcode-preview">[nbdb_cell_box template="template-1"]</span> – <?php _e('News gridbox Shortcode -2 design', 'news-and-blog-designer-bundle'); ?> <br />
											<span class="nbdb-shortcode-preview">[nbdb_ticker]</span> – <?php _e('News Ticker Shortcode -2 design', 'news-and-blog-designer-bundle'); ?><br />
											<span class="nbdb-shortcode-preview">[nbdb_filter template="template-1"]</span> – <?php _e('News filter Shortcode -2 design', 'news-and-blog-designer-bundle'); ?><br />

										</td>
									</tr>	
									<tr>
												<th>
													<label><?php _e('Please Contact us:', 'news-and-blog-designer-bundle'); ?></label>
												</th>
												<td>
													<a  href="mailto:gbvaghasiya1@yahoo.com">gbvaghasiya1@yahoo.com</a><br/> <br/>
													
												</td>
											</tr>										
								</tbody>
							</table>
						</div><!-- .inside -->
						
					</div><!-- .postbox -->
				
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->			
	</div><!-- #poststuff -->
</div><!-- end .wrap -->