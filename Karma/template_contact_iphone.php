<?php
/*
Template Name: Contact (iPhone)
*/
?>
<?php 
get_header(); 
get_template_part( 'theme-template-part-slider', 'childtheme' );
?>
        
        <main role="main" id="content" class="content_full_width contact_smartphone_content">
            <div class="two_thirds">
            	<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
            	get_template_part('theme-template-part-inline-editing','childtheme');
				comments_template('/page-comments.php', true); ?>
            </div><!-- END two_thirds -->
                
            <div class="one_third_last contact_smartphone">
            	<div class="smartphone-wrap">
                	<?php if(is_active_sidebar(5)): dynamic_sidebar("Contact Sidebar (iPhone)"); else:
					
					_e('<strong>Add Widgets to this section in Wordpress Dashboard:</strong><br /><br /><ol><li><a href="'.admin_url( 'widgets.php' ).'">Appearance > Widgets</a></li><li>Add desired Widgets into<br />Contact Sidebar (iPhone)</li></ol>', 'truethemes_localize');
					
					endif; ?>
            	</div><!-- END smartphone-wrap -->
            </div><!-- END one_third_last -->
        <br class="clear" />
        </main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>