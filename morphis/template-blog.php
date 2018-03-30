<?php
/*
Template Name: Blog
*/

global $NHP_Options; 
$options_morphis = $NHP_Options; 

get_header(); ?>

<!-- END HEADER -->	
	<div class="clear"></div>
	<!-- MAIN BODY -->
    <div id="main" role="main" class="sixteen columns">
	
		<!-- HEADLINE -->
        <div id="headline">                
            <?php $headline_main_caps = get_post_meta($post->ID,'_cmb_headline_pages_posts_main_caps',TRUE); ?>
            <?php $headline_sec_caps = get_post_meta($post->ID,'_cmb_headline_pages_posts_sec_caps',TRUE); ?>
            <?php $headline_para = get_post_meta($post->ID,'_cmb_headline_pages_posts_para',TRUE); ?>

            <?php if($headline_main_caps != '' || $headline_sec_caps != '') : ?>
            <hgroup>
                <h1><?php echo $headline_main_caps; ?></h1>
                <h2><?php echo $headline_sec_caps; ?></h2>
            </hgroup>
            <?php endif; ?>

            <?php if($headline_para != '') : ?>
            <p><?php echo $headline_para; ?></p>
            <?php endif; ?>
        </div>
        <!-- END HEADLINE -->
	
		<!-- START BLOG CONTAINER -->
		<div class="blog-post">
			<!-- START BLOG MAIN -->
			
			<?php $sidebar_pos = $options_morphis['radio_img_select_sidebar'] ?>
			
			<?php // check if unique layout is selected ?>
			<?php $unique_sidebar_layout = get_post_meta($post->ID,'_cmb_page_layout_sidebar',TRUE); ?>
			
			
			<?php if($unique_sidebar_layout == 'right_sidebar'): ?>
				<?php $sidebar_pos = '2' ?>
			<?php elseif($unique_sidebar_layout == 'left_sidebar'): ?>			
				<?php $sidebar_pos = '1' ?>
			<?php elseif($unique_sidebar_layout == 'no_sidebar'): ?>			
				<?php $sidebar_pos = '3' ?>
				
			<?php endif; ?>
					
			<?php if($sidebar_pos == '1') : ?>
				<?php get_sidebar('left'); ?>
				<div class="twelve columns omega">			
			<?php elseif($sidebar_pos == '2') : ?>
				<div class="twelve columns alpha">			
			<?php else :  ?>
				<div>
			<?php endif; ?>
			<?php //if ( have_posts() ) : ?>			
		
				<?php 

				if ( get_query_var('paged') ) {

					$paged = get_query_var('paged');

				} elseif ( get_query_var('page') ) {

					$paged = get_query_var('page');

				} else {

					$paged = 1;

				}
				
				// page level category exclude OR site-wide level category exclude
				$page_level_exclude_post_cat = get_post_meta($post->ID,'_cmb_exclude_post_cat_multi',FALSE);
				
				$exclude_post_cat = ( !empty( $page_level_exclude_post_cat ) ) ? $page_level_exclude_post_cat : isset( $options_morphis['blog_exclude_cats'] ) ? $options_morphis['blog_exclude_cats'] : ''; 
				
				if (!empty( $exclude_post_cat )) {																	
					$query_args = array(
						'post_type' => 'post',
						'paged' => $paged,
						'category__not_in' => $exclude_post_cat 		
					);
					
				} else {
				
						$query_args = 'post_type=post&paged='. $paged;							
				}					
				
				
				$queryblog = new WP_Query( $query_args );
					
				if ( $queryblog->have_posts() ) {
					
				?>

				<?php /* Start the Loop */ ?>
				<?php while ($queryblog->have_posts()) : $queryblog->the_post();  ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content' );
					?>

				<?php endwhile; ?>
	
				<?php 						
								
				numbered_pagination($queryblog->max_num_pages);							?>

				
				
				<?php } else { ?>
				
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h4 class="entry-title"><?php _e( 'Nothing Found', 'morphis' ); ?></h4>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'morphis' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

				
				<?php } ?>
				

			
			<?php//endif; ?>
			
		</div><!-- end .twelve columns content -->
		<?php if($sidebar_pos == '2') : ?>
		<?php get_sidebar(); ?>
		<?php endif; ?>
		<div class="clear"></div>
		</div><!-- #blog post -->
	</div>
	</div> <!-- #end cntainer -->


 <?php if( $options_morphis['twitter_hide_below'] == '1' ) { ?>
		<?php twitter_strip($options_morphis['twitter_username']); ?>
 <?php } ?>
 
<?php get_footer(); ?>