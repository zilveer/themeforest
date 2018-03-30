<?php
/*
Template Name: Page - Left Sidebar
*/
?>


<?php get_header(); ?>

		<div class="page-title">

			<h1><span class="the-page-title"><?php the_title(); ?></span>			
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

			<?php get_sidebar(); ?>

			<!--BEGIN #main-content -->
			<section class="main-content twelve columns bot-margin-triple">
	            		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN .post -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">		                
	    
	                        <!--BEGIN .entry-content -->
	                        <div class="entry-content">
	                        
	                            <?php the_content(); ?>
	                            
	                        <!--END .entry-content -->
	                        </div>     
	                          
					<!--END .post-->  
					</div>

					<?php endwhile; ?>
	                
	                <?php comment_form('', true); ?>

				<?php else : ?>

					<!--BEGIN #post-0-->
					<div id="post-0" <?php post_class(); ?>>
					
						<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
					
						<!--BEGIN .entry-content-->
						<div class="entry-content">
							<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
						<!--END .entry-content-->
						</div>
					
					<!--END #post-0-->
					</div>

				<?php endif; ?>

			<!--END main-content -->
			</section>

</div>

<?php get_footer(); ?>