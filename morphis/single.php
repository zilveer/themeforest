<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */


global $NHP_Options; 
$options_morphis = $NHP_Options; 

get_header(); ?>


<!-- END HEADER -->	
	<div class="clear"></div>
	<!-- MAIN BODY -->
    <div id="main" role="main" class="sixteen columns">
		<!-- START BLOG CONTAINER -->
		
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
		
		<?php $selected_single_blog_layout = ''; ?>
		<?php $selected_single_blog_layout = $options_morphis['select_single_blog_layout']; ?>
		
		<?php // check single blog layout if overriden ?>
		<?php $unique_single_blog_layout = get_post_meta($post->ID,'_cmb_post_single_layout',TRUE); ?>			
		<?php if($unique_single_blog_layout != ''): ?>
			<?php $selected_single_blog_layout = $unique_single_blog_layout; ?>			
		<?php endif; ?>
		
	
		<?php if($selected_single_blog_layout == '1') : ?>

			<?php $layout_opt = 'single-post2'; ?>	

		<?php elseif($selected_single_blog_layout == '2') : ?>

			<?php $layout_opt = 'single-post'; ?>	

		<?php endif; ?>
		
		<div class="blog-post <?php echo $layout_opt; ?>">
			<!-- START BLOG MAIN -->
			<?php $sidebar_pos = $options_morphis['radio_img_select_sidebar'] ?>
			
			<?php // check if unique layout is selected ?>
			<?php $unique_sidebar_layout = get_post_meta($post->ID,'_cmb_post_single_layout_sidebar',TRUE); ?>
			
			
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
			

				<?php while ( have_posts() ) : the_post(); ?>					

					<?php get_template_part( 'content', 'single' ); ?>

					
					<?php if($selected_single_blog_layout == '1') : ?>

						<?php comments_template( '', true ); ?>

					<?php elseif($selected_single_blog_layout == '2') : ?>

						<?php comments_template( '/comments-layout-2.php', true ); ?>

					<?php endif; ?>
					
					

				<?php endwhile; // end of the loop. ?>

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