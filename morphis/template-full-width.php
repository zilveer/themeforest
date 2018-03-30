<?php
/**
 * Template Name: Full Width
 * Description: A Page Template that displays a full width page
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */

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
			
			
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

		
		<div class="clear"></div>
		</div><!-- #blog post -->
	</div>
	</div> <!-- #end cntainer -->

<?php 
global $NHP_Options; 
$options_morphis = $NHP_Options; 
?>
<?php enqueue_native_gallery_style(); ?>

 <?php if( $options_morphis['twitter_hide_below'] == '1' ) { ?>
		<?php twitter_strip($options_morphis['twitter_username']); ?>
 <?php } ?>
 
<?php get_footer(); ?>