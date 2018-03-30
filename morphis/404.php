<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */

global $NHP_Options; 
//$options_morphis = $NHP_Options; 
get_header(); ?>

<!-- END HEADER -->	
	<div class="clear"></div>
	<!-- MAIN BODY -->
    <div id="main" role="main" class="sixteen columns">
	
		<!-- START BLOG CONTAINER -->
		<div class="blog-post">
			<!-- START BLOG MAIN -->
			<?php $sidebar_pos = pf_get_theme_option( 'radio_img_select_sidebar', '2' ); ?>
			
			<?php if($sidebar_pos == '1') : ?>
				<?php get_sidebar('left'); ?>
				<div class="twelve columns omega">			
			<?php elseif($sidebar_pos == '2') : ?>
				<div class="twelve columns alpha">			
			<?php else :  ?>
					
			<?php endif; ?>
			
			
			<article id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( '404 error. We Are Sorry.', 'morphis' ); ?></h1>		
				
				<div class="clear"></div>
				<div class="entry-content">
					<p class="sub-desc"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps one of the links below, can help.', 'morphis' ); ?></p>
					
					<hr />
					<div class="four columns alpha">
						<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404', 'before_title' => '<h2 class="widgettitle">' ) ); ?>
					</div>

					<div class="four columns widget">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'morphis' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 0, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>
					
					<div class="four columns widget omega">
					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives.', 'morphis' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 0 ), array( 'after_title' => '</h2>', 'before_title' => '<h2 class="widgettitle">' ) );
					?>
					</div>
					<div class="clear"></div>
					<?php get_template_part('inc/sitemap'); ?>
					<hr />
					
					
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
</div><!-- end .twelve columns content -->
		<?php if($sidebar_pos == '2') : ?>
		<?php get_sidebar(); ?>
		<?php endif; ?>
		<div class="clear"></div>
		</div><!-- #blog post -->
	</div>
	</div> <!-- #end cntainer -->


 <?php if( pf_get_theme_option( 'twitter_hide_below', '1' ) == '1' ) { ?>
		<?php twitter_strip( pf_get_theme_option( 'twitter_hide_below', '1' ) ); ?>
 <?php } ?>
 
<?php get_footer(); ?>