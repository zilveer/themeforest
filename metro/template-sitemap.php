<?php
/*
Template Name: Sitemap
*/

get_header(); ?>

		<div class="block-full bg-color-main content-without-sidebar">
			<div class="block-inner">
				<?php
          if ( current_user_can( 'edit_post', $post->ID ) )
      	    edit_post_link( __('edit', 'om_theme'), '<div class="edit-post-link">[', ']</div>' );
    		?>
				<div class="tbl-bottom">
					<div class="tbl-td">
						<h1 class="page-h1"><?php the_title(); ?></h1>
					</div>
					<?php if(get_option(OM_THEME_PREFIX . 'show_breadcrumbs') == 'true') { ?>
						<div class="tbl-td">
							<?php om_breadcrumbs(get_option(OM_THEME_PREFIX . 'breadcrumbs_caption')) ?>
						</div>
					<?php } ?>
				</div>
				<div class="clear page-h1-divider"></div>
      		
          <?php echo get_option(OM_THEME_PREFIX . 'code_after_page_h1'); ?>
          
          <div class="sitemap">

						<div class="one-third">
	
						<h3><?php _e('Site Feeds','om_theme'); ?></h3>
						<ul>
							<li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS Feed','om_theme'); ?></a></li>
							<li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments RSS Feed','om_theme'); ?></a></li>
						</ul>
						
						<?php $list=wp_list_pages('title_li=&echo=0'); ?>
						<?php if($list) : ?>
							<h3><?php _e('Pages','om_theme'); ?></h3>
							<ul>
								<?php echo $list ?>
							</ul>
						<?php endif; ?>
						
						</div>
						
						<div class="one-third">
	
							<?php $list=get_posts('numberposts=-1&orderby=title&order=ASC'); ?>
							<?php if(!empty($list)) : ?>
								<h3><?php _e('Posts','om_theme'); ?></h3>
								<ul>
									<?php
										foreach($list as $item) {
											echo '<li><a href="'. get_permalink($item->ID) .'">'.$item->post_title.'</a></li>';
										}
									?>
								</ul>
							<?php endif; ?>			
	
							<?php $list=wp_list_categories('title_li=&echo=0'); ?>
							<?php $list2=wp_list_categories('title_li=&taxonomy=portfolio-type&echo=0'); ?>
							<?php if($list || $list2) : ?>
								<h3><?php _e('Categories','om_theme'); ?></h3>
								<ul>
									<?php if($list) : ?>
										<li>
											<?php _e('Blog','om_theme'); ?>
											<ul>
												<?php echo $list; ?>
											</ul>
										</li>
									<?php endif; ?>
									<?php if($list2) : ?>
										<li>
											<?php _e('Portfolio','om_theme'); ?>
											<ul>
												<?php echo $list2; ?>
											</ul>
										</li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>
		
							<?php
								$tags = get_terms( 'post_tag' );
								if( !empty($tags) ) {
									?>
									<h3><?php _e('Tags','om_theme'); ?></h3>
									<ul>
									<?php
									foreach( $tags as $tag ) {
										$url = attribute_escape( get_tag_link( $tag->term_id ) );
										echo '<li><a href="' . $url . '">' . $tag->name . '</a></li>';
									}
									?>
									</ul>
									<?php
								}
							?>		
							
							<?php $list=wp_get_archives('type=monthly&echo=0'); ?>
							<?php if($list) : ?>
								<h3><?php _e('Monthly Archives','om_theme'); ?></h3>
								<ul>
									<?php echo $list ?>
								</ul>
							<?php endif; ?>
							
																
						</div>
						
						<div class="one-third last">
							
							<?php $list=get_posts('numberposts=-1&orderby=title&order=ASC&post_type=portfolio'); ?>
							<?php if(!empty($list)) : ?>
								<h3><?php _e('Portfolio','om_theme'); ?></h3>
								<ul>
									<?php
										foreach($list as $item) {
											echo '<li><a href="'. get_permalink($item->ID) .'">'.$item->post_title.'</a></li>';
										}
									?>
								</ul>
							<?php endif; ?>		
							
							<?php $list=get_posts('numberposts=-1&orderby=title&order=ASC&post_type=testimonials'); ?>
							<?php if(!empty($list)) : ?>
								<h3><?php _e('Testimonials','om_theme'); ?></h3>
								<ul>
									<?php
										foreach($list as $item) {
											echo '<li><a href="'. get_permalink($item->ID) .'">'.$item->post_title.'</a></li>';
										}
									?>
								</ul>
							<?php endif; ?>
							
						</div>		
						
						<div class="clear"></div>
						
					</div>
					
					
					<?php echo get_option(OM_THEME_PREFIX . 'code_after_page_content'); ?>
					
			</div>
		</div>
		
		<?php if(get_option(OM_THEME_PREFIX . 'hide_comments_pages') != 'true') : ?>
			<?php comments_template('',true); ?>
		<?php endif; ?>		
		
		<!-- /Content -->
		
		<div class="clear anti-mar">&nbsp;</div>

<?php get_footer(); ?>