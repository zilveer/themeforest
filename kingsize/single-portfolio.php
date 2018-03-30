<?php
/**
 * @KingSize 2011
 **/
$tpl_body_id = 'prettyphoto';
$tpl_body_id = 'blog_overview';
global $data,$postParentPageID;

get_header(); 
update_option('current_page_template','body_portfolio body_portfolio body_gallery_2col_pp');
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $postParentPageID = $post->ID; //Page POSTID for shortcodes
$comment_status = $post->comment_status;


//comments enabled OR not checking
$CommentsEnabled = false;
if ( $data['wm_show_comments'] == 1  && $comment_status != "closed" ){
	$CommentsEnabled = true;
}elseif ( $data['wm_show_comments'] != 0   && $comment_status != "closed"  ) {
	$CommentsEnabled = true;
}

//sidebar enabled OR not checking
$page_sidebar_hide = "";
$page_sidebar_hide = get_post_meta($postParentPageID, 'portfolio_sidebar_hide', true );

//sidebar enabled OR not checking
$sidebarEnabled = false;
if ( $data['wm_sidebar_enabled'] == 1  && $page_sidebar_hide != 1 ){
	$sidebarEnabled = true;
}
elseif ( $data['wm_sidebar_enabled'] != 0   && $page_sidebar_hide != 1  ) {
	$sidebarEnabled = true;
}
///////


/// Getting the Category name ///
$terms = get_the_terms( $post->ID, 'portfolio-category' );
						
if ( $terms && ! is_wp_error( $terms ) ) : 

$portfolio_category_links = array();

foreach ( $terms as $term ) {
	$portfolio_category_links[] = $term->name;
}
					
$portfolio_category_names = join( ", ", $portfolio_category_links );
endif;
?>

		<!--Page title start-->
		<?php if ( $data['wm_show_page_post_headers'] == "" || $data['wm_show_page_post_headers'] == "0" ) { ?>
		<div class="row header">
			<div class="<?php if ( $sidebarEnabled == true ) {?>eight<?php } else { ?>twelve<?php } ?> columns">
				<h2 class="title-page"><?php echo $portfolio_category_names; ?></h2>
			</div>
		</div>
		<?php } else { ?>
		<div class="row header">
			<div class="<?php if ( $sidebarEnabled == true ) {?>eight<?php } else { ?>twelve<?php } ?> columns">
				<h2 class="title-page"></h2>
			</div>
		</div>
		<?php } ?>					
		<!-- Ends Page title --> 
		
		<!-- Begin Breadcrumbs -->
		<div class="row">
			<div class="twelve columns">
				<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p id="breadcrumbs" class="yoast-bc">','</p>');
				} ?>
			</div>
		</div>
		<!-- End Breadcrumbs -->

		<!--Blog Main Start-->
		<div class="row">

			<!-- Content has class "content_two_thirds" to leave some place for the sidebar -->
		<?php if ( $sidebarEnabled == true ) { ?>
			<div class="blog">
			<!-- Begin Left Content -->
			<div class="blog_block_left">	
		<?php } else { ?>
			<div class="twelve columns">
		<?php } ?>
				
			<!-- Post details -->
			<div class="blog_post">
				<!-- Begin Post Title -->     
				<h2><a href="<?php echo get_permalink( $post->ID );?>"><?php the_title(); ?></a></h2>
				<!-- End Post Title -->
				
				<!-- Begin Post Date -->
				<?php 
				if( $data['wm_date_enabled'] == '1' ) { //data is enabled
				?>
				<div class="blog_date">                    	
					<ul class="icon-list">
						<li><i class="fa fa-calendar"></i></li>
						<li><?php the_time(get_option('date_format')); ?></li>
					</ul>                                              
				</div>
				<?php
				}
				?>	
				<!-- End Post Date -->
			</div><!-- End blog_post -->
						
					
				<div class="blog_post page_content">		
					<?php the_content(); ?>
				</div><!-- End blog_post -->

				<!-- Begin Portfolio Tags v4 -->
				<?php
				$tags = get_tags();
				if(count($tags) > 0) :
				
				$found_tags = 0;
				foreach ( $tags as $tag ) {
					if (custom_posts_per_tag($tag->term_id, "portfolio") > 0) {
						$found_tags = 1;		
					}
				}
				?>
				<?php if(get_the_term_list(get_the_ID(), 'portfolio-tags', __('Tags: ', 'kslang'), ', ', '')) : ?>
				<div class="blog_post portfolio_tags">
					<div class="blog_date">                    	
						<ul class="icon-list tags">
							<?php if(get_the_term_list(get_the_ID(), 'portfolio-tags', __('Tags: ', 'kslang'), ', ', '')) : ?>
							<p class="post_tags"><i class="fa fa-tags"></i> <?php echo(get_the_term_list(get_the_ID(), 'portfolio-tags', __('Tags: ', 'kslang'), ', ', '')); ?></p>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<?php endif; ?>
				<?php endif; ?>
				<!-- End of Portfolio Tags v4 -->


			<?php if ( $CommentsEnabled == true) {?>
				<!-- Begin Post Comments -->
				<?php comments_template( '/comments.php' ); ?>
				<!-- End Post Comments -->
			<?php } ?>
			<!-- END blog_post comments_section -->

		
		<!-- Begin Sidebar -->
		<?php if ( $sidebarEnabled == true ) { ?>
			</div><!-- End Left Content -->
			<div id="sidebar" class="blog_block_right">			        
				<?php if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar("Main Blog Sidebar") ) : ?><?php endif; ?>
			</div> 
		<?php } ?>
		<!-- End Sidebar --> 
		
	</div><!-- END blog -->
</div>	<!-- END row  -->
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>
