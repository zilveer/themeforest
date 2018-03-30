<?php
/**
* Catalyst Single Page
 */
?>
<?php
$two_column_div='<div class="contents-wrap float-left two-column">';
$width=MIN_CONTENT_WIDTH;
$height=280;
$fullwidth_post=false;
$single_posthead= get_post_meta($post->ID, MTHEME . '_post_head_options', true);
$single_video_type= get_post_meta($post->ID, MTHEME . '_post_video_type', true);
if ( $single_posthead == "" || $single_posthead == "Default" || $single_posthead == "Fullwidth Image" ) { $post_head="image"; }
if ( $single_posthead == "Video" || $single_posthead == "Fullwidth Video" ) { $post_head_video = true; $post_head="video"; }
if ( $single_posthead == "Nivo Slides" || $single_posthead == "Fullwidth Nivo Slides" ) { $post_head="nivo"; }
if ( $single_posthead=="Fullwidth Image" || $single_posthead=="Fullwidth Video" || $single_posthead == "Fullwidth Nivo Slides" ) { $width=FULLPAGE_WIDTH; $height=0; $fullwidth_post=true; }
$image_type="blog-full";
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php // get_sidebar(); ?>
		<?php
		if ($fullwidth_post==false) {
			echo $two_column_div;
			$image_type="blog-post";
		}
		?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content-wrapper">
				
					<?php
					if ($fullwidth_post==false) {
						echo '<div class="single-header-space"></div>';
						echo '<div class="entry-single-title"><h1>';
						echo the_title();
						echo '</h1></div>';
					}
					?>
					
					
						<?php
						switch ($post_head) {
						
						case "image":
							// Show Image
							echo mtheme_display_post_image (
							$ID=get_the_id(),
							$image_url=false,
							$linked,
							$image_type,
							$post->post_title,
							$class=""
							);
							break;
							
						case "video":					
							$single_video_code= get_post_meta($post->ID, MTHEME . '_post_video', true);
							if ($single_video_type=="Vimeo") {
								echo do_shortcode('[video type="vimeo" clip_id="' . $single_video_code . '" height="" width="' . $width . '"]');
								}
							if ($single_video_type=="Youtube") {
								echo do_shortcode('[video type="youtube" clip_id="' . $single_video_code . '" height="" width="' . $width . '"]');
							}
							break;
							
						case "nivo":	
							$nivoslider = do_shortcode('[nivoslides width="' . $width . '"]');
							echo $nivoslider;
							break;
						}
						?>
					<div class="clear"></div>
					<?php
					if ($fullwidth_post==true) {
						echo $two_column_div;
					}
					?>
					<div class="postsummarywrap">
						<div class="datecomment">
							<?php
							$mtheme_datetime=of_get_option( 'mtheme_datetime');
							if ($mtheme_datetime=="Traditional") { ?>
							<span class="posted-date"><?php echo esc_attr( get_the_time() ); echo " , "; echo get_the_date(); ?></span>
							<?php } else { ?>
							<span class="posted-date"><?php echo time_since(abs(strtotime($post->post_date_gmt . " GMT")), time()); ?> ago</span>
							<?php } ?>
							<span class="comments"><?php comments_popup_link('0', '1', '%'); ?></span>
							<?php
							$post_category = get_the_category($post->ID); 
							if ( $post_category==true ) { ?>
								<div class="postedin"><?php _e('Posted in:','mthemelocal');?> <?php the_category(', ') ?></div>
							<?php } ?>
							
						</div>
					</div>
					
					<?php
					if ($fullwidth_post) {
						echo '<div class="single-header-space"></div>';
						echo '<div class="entry-single-title"><h1>';
						echo the_title();
						echo '</h1></div>';
					}
					?>
					
					<div class="contents-column">
						
						<div class="entry-content clearfix">
						
						<?php the_content(); ?>
						<?php 
							wp_link_pages( array(
							'pagelink' => __( 'Page', 'mthemelocal' ) . ' %',
							'before' => '<div class="page-link">', 
							'after' => '</div>' ));
						?>
						</div>
						<div class="clear"></div>		
						<div class="postinfo">
							<p><?php the_tags( __('Tags: ','mthemelocal'), ', ', ''); ?></p>
							<p><?php _e('This entry was posted on','mthemelocal');?> <?php the_time('l, F jS, Y') ?> at <?php the_time() ?></p>
							<p><?php _e('You can follow any responses to this entry through the','mthemelocal'); ?> <?php post_comments_feed_link('RSS 2.0');?> <?php _e('feed.','mthemelocal'); ?></p>
						</div>
						
						
						<?php
						if (of_get_option('authorstatus')) : ?>
							<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
							<div id="entry-author-info">
								<div id="author-description">
									<div id="author-avatar">
										<?php echo get_avatar( get_the_author_meta( 'user_email' ), of_get_option( 'author_avatar_size') ); ?>
									</div><!-- #author-avatar -->
									<h2>About <?php echo get_the_author(); ?></h2>
									<?php 
									echo nl2br( get_the_author_meta( 'description' ) ); ?>
									<div id="author-link">
										<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
											<?php _e('View all posts by','mthemelocal');?> <?php echo get_the_author(); ?>
										</a>
									</div><!-- #author-link	-->
								</div><!-- #author-description -->
							</div><!-- #entry-author-info -->
						<?php
							endif;
						endif;
						?>
						<div class="clear"></div>
						
						<?php
						if (of_get_option( 'relatedposts')) :
							include (TEMPLATEPATH . "/includes/post-related.php");
						endif;
						?>
						
						
						<?php edit_post_link( __('edit this entry','mthemelocal') ,'<p class="edit-entry">','</p>'); ?>	
						<?php comments_template(); ?>					
					</div>
				</div>
			</div>
		</div>
<?php endwhile; // end of the loop. ?>