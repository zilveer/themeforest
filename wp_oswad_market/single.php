<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Oswad Market
 * @since WD_Responsive
 */

get_header(); ?>
		<?php 
		global $smof_data;
		$has_breadcrumb = true;
		$has_page_title = true;
		if( $has_breadcrumb || $has_page_title ){
			$style = '';
			if( isset($smof_data['wd_bg_breadcrumbs']) && $smof_data['wd_bg_breadcrumbs'] != '' )
				$style = 'style="background: url('.$smof_data['wd_bg_breadcrumbs'].')"';
			echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.$style.'>';
				if( $has_page_title )
					echo '<h1 class="heading-title page-title">'.get_the_title().'</h1>';
				if( $has_breadcrumb )
					wd_show_breadcrumbs();
			echo '</div></div>';
		} 
		/* Post Layout */
		$_layout_config = explode("-",$smof_data['wd_blog_details_layout']);
		$_left_sidebar = (int)$_layout_config[0];
		$_right_sidebar = (int)$_layout_config[2];
		$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );			
		?>
		<div id="container">
			<div id="content" class="container single-blog">
				
				<?php if( $_left_sidebar ): ?>
						<div id="left-sidebar" class="col-sm-6 hidden-xs">
							<div class="left-sidebar-content">
								<?php
									if ( is_active_sidebar( $smof_data['wd_blog_details_left_sidebar'] ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( $smof_data['wd_blog_details_left_sidebar'] ); ?>
										</ul>
								<?php endif; ?>
							</div>
						</div><!-- end left sidebar -->		
					<?php wp_reset_query();?>
				<?php endif; ?>
			
				<div id="main" class="<?php echo $_main_class; ?>">
					<div class="main-content">
						<div class="single-content">
							<?php	
								if(have_posts()) : while(have_posts()) : the_post(); 
								global $post,$smof_data;
								$sticky = (is_sticky())?" sticky":"";
								?>
									<div <?php post_class("single-post".$sticky);?>>
										<?php echo stripslashes($smof_data['wd_top_blog_code']);?>
													
										<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>	
										
										
										
										<div class="post-title">
											<div class="single-navigation clearfix">
												<?php previous_post_link('%link', __('Previous', 'wpdance')); ?>
												<?php next_post_link('%link', __('Next', 'wpdance')); ?>
											</div>
										</div>
										<div class="post-info-meta">												
											
											<?php if( !(isset($smof_data['wd_blog_details_author']) && absint($smof_data['wd_blog_details_author']) == 0) ) : ?>
												<span class="author">	
													<?php _e('','wpdance'); ?>  
													<?php the_author_posts_link(); ?> 
												</span>
											<?php endif; ?>	
											
											<?php if( !(isset($smof_data['wd_blog_details_time']) && absint($smof_data['wd_blog_details_time']) == 0) ) : ?>
												<span class="date-time">
														<?php echo get_the_date('d M, Y') ?>
												</span>
											<?php endif; ?>	
											
											<?php if( !(isset($smof_data['wd_blog_details_comment']) && absint($smof_data['wd_blog_details_comment']) == 0) ) : ?>
												<span class="comments-count">
													<?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo absint($comments_count->approved);?>
													<?php _e('comment(s)','wpdance'); ?>
												</span>
											<?php endif; ?>
											
											<!--Category List-->
											<?php if( !(isset($smof_data['wd_blog_details_categories']) && $smof_data['wd_blog_details_categories'] == 0) ) : ?>
												<?php if ( is_object_in_taxonomy( get_post_type(), 'category' ) ) : // Hide category text when not supported ?>
												<?php
													/* translators: used between list items, there is a space after the comma */
													$categories_list = get_the_category_list( __( ', ', 'wpdance' ) );
														if ( $categories_list ):
														?>
														<span class="cat-links">
															<?php printf( __( '<span class="%1$s heading-title">'.__( ' Categories:', 'wpdance' ).'</span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );?>
														</span>
														<?php endif; // End if categories ?>
												<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'category' ) ?>	
														
											<?php endif;?>
										
										</div>
										<?php if ( !(isset($smof_data['wd_blog_details_thumbnail']) && (int) $smof_data['wd_blog_details_thumbnail'] == 0) ): ?>
											<div class="thumbnail">
												<?php 
													$video_url = esc_url(get_post_meta( $post->ID, '_video_url', true));
													if( $video_url!= ''){
														$video_width = get_post_meta($post->ID, '_video_width', true);
														$video_height = get_post_meta($post->ID, '_video_height', true);
														if( !$video_width ){
															$video_width = 700;
														}
														if( !$video_height ){
															$video_height = 400;
														}
														echo wd_get_embbed_video( $video_url, $video_width, $video_height );
													}
													else{
														?>
														<div class="image">
															<a class="thumb-image" href="<?php the_permalink() ; ?>">
															<?php 
																if ( has_post_thumbnail() ) {
																	the_post_thumbnail('<?php if( $show_avatar ){ ?>',array('class' => 'thumbnail-blog'));
																	//the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-effect-2'));
																} 			
															?>	
															</a>
															
														</div>
														<?php
													}
												?>	
											</div>
										<?php endif; ?>
										
										<div class="post-info-content">
											
											<div class="short-content"><?php the_content(); ?></div>
											
											<?php wp_link_pages(); ?>
																																		
										</div>
										
										
									
									<?php echo stripslashes($smof_data['wd_bottom_blog_code']);?>
									</div>
									<div class="clear"></div>
									
									
									<div class="tags_social">
										<?php if( !(isset($smof_data['wd_blog_details_tags']) && absint($smof_data['wd_blog_details_tags']) == 0) ) : ?>
											<?php if ( is_object_in_taxonomy( get_post_type(), 'post_tag' ) ) : // Hide tag text when not supported ?>
											<?php
												/* translators: used between list items, there is a space after the comma */
												$tags_list = get_the_tag_list( '', __( '', 'wpdance' ) );
												if ( $tags_list ):
												?>
													<div class="tags">
														<span class="tag-title"><?php _e('Tags','wpdance');?></span>
														<span class="tag-links">
															<?php printf( __( '<span class="%1$s"></span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
															$show_sep = true; ?>
														</span>
													</div>
												<?php endif; // End if $tags_list ?>
											<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'post_tag' ) ?>
										<?php endif; ?>	
										<?php if( !(isset($smof_data['wd_blog_details_socialsharing']) && absint($smof_data['wd_blog_details_socialsharing']) == 0) ) : ?>
											<div class="share_list">
												<!-- WIDGET SOCIAL -->
												<?php wd_template_single_social_sharing(); ?>
											</div>
										<?php endif;?>
									</div>
									<?php if( !(isset($smof_data['wd_blog_details_authorbox']) && absint($smof_data['wd_blog_details_authorbox']) == 0) ) : ?>
										<div id="entry-author-info">
											<div class="author-inner">
												
												<div id="author-description">
													<div id="author-avatar" class="image-style">
														<div class="thumbnail">
															<?php echo get_avatar( get_the_author_meta( 'user_email' ), 133, get_template_directory_uri() . '/images/mycustomgravatar.png' ); ?>
														</div>
													</div><!-- #author-avatar -->		
													<div class="author-desc">		
														<div class="description"><?php the_author_meta( 'description' ); ?></div>
														<span class="author-name"><?php the_author_posts_link();?></span>
														<?php $roles = get_user_by('id',$post->post_author)->roles; ?> 
														- <span class="role"> <?php echo isset($roles[0])?$roles[0]:''; ?> </span> -
													</div>
												</div><!-- #author-description -->
												
											</div><!-- #author-inner -->
										</div><!-- #entry-author-info -->
									<?php endif; ?>	
									
									<?php if( !(isset($smof_data['wd_blog_details_related']) && absint($smof_data['wd_blog_details_related']) == 0) ) : ?>
										<?php 
											get_template_part( 'templates/related_posts' );
										?>
									<?php endif;?>
									
									<?php comments_template( '', true );?>
									
								<?php						
								endwhile;
								endif;	
								wp_reset_query();
							?>	
						</div>
					</div>
				</div>
				
				<?php if( $_right_sidebar ): ?>
				<div id="right-sidebar" class="col-sm-6">
					<div class="right-sidebar-content">
					<?php
						if ( is_active_sidebar( $smof_data['wd_blog_details_right_sidebar'] ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( $smof_data['wd_blog_details_right_sidebar'] ); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end right sidebar -->
				<?php endif; ?>
				
			</div><!-- #content -->
			
		</div><!-- #container -->
<?php get_footer(); ?>