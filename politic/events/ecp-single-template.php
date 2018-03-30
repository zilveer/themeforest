<?php
/**
*  If 'Default Events Template' is selected in Settings -> The Events Calendar -> Theme Settings -> Events Template, 
*  then this file loads the page template for all for the individual 
*  event view.  Generally, this setting should only be used if you want to manually 
*  specify all the shell HTML of your ECP pages in this template file.  Use one of the other Theme 
*  Settings -> Events Template to automatically integrate views into your 
*  theme.
*
* You can customize this view by putting a replacement file of the same name (ecp-single-template.php) in the events/ directory of your theme.
*/

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }
?>
<?php get_header(); ?>
<?php tribe_events_before_html() ?>		


		<div class="page-title">

			<h1><span class="the-page-title"><?php the_title() ?></span>			
				<span class="page-subtitle">
					<?php 
					global $post;
					if(get_post_meta($post->ID, 'heading_value', true) != '') 
						echo get_post_meta($post->ID, 'heading_value', true); 
					?>
				</span>
			</h1>
	        <!-- #searchbar -->
	        <form role="search" method="get" id="searchform-top" action="<?php echo home_url( '/' ); ?>" class="clearfix" >
	            <div>
	                <input type="text" value="Search..." name="s" id="s" onfocus="if(this.value=='Search...')this.value='';" onblur="if(this.value=='')this.value='Search...';" />
	            </div>
	        </form>
	        <!-- /#searchbar-->    
		</div>

		<div class="shadow-separator"></div>

		<div class="container background">

			<div class="eleven columns">
				<div id="content" class="tribe-events-event widecolumn">
					<?php the_post(); global $post; ?>
					<div id="post-<?php the_ID() ?>" <?php post_class() ?>>

						<?php include(tribe_get_current_template()) ?>
						<?php edit_post_link(__('Edit','tribe-events-calendar'), '<span class="edit-link">', '</span>'); ?>
					
					</div><!-- post -->
					
					<?php if(tribe_get_option('showComments','no') == 'yes'){ comments_template();} ?>
			
			</div><!-- #content -->
		
		</div><!--#container-->

		<?php get_sidebar(); ?>
		
	</div>

</div>

	<?php tribe_events_after_html() ?>

<?php get_footer(); ?>
