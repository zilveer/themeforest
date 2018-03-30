<?php
/**
*  If 'Default Events Template' is selected in Settings -> The Events Calendar -> Theme Settings -> Events Template, 
*  then this file loads the page template for all ECP views except for the individual 
*  event view.  Generally, this setting should only be used if you want to manually 
*  specify all the shell HTML of your ECP pages in this template file.  Use one of the other Theme 
*  Settings -> Events Template to automatically integrate views into your 
*  theme.
*
* You can customize this view by putting a replacement file of the same name (ecp-page-template.php) in the events/ directory of your theme.
*/

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

?>	

<?php get_header(); ?>

	<?php tribe_events_before_html() ?>
	
		<div class="page-title">

			<h1><span class="the-page-title"><?php tribe_events_title(); ?></span>			
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

			<div class="sixteen columns">
		
				<?php include(tribe_get_current_template()); ?>
				
			</div>

		</div>
		
	<?php tribe_events_after_html() ?>

<?php get_footer(); ?>