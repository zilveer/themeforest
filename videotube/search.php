<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header(); ?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<div class="col-sm-8">
            	<div class="section-header">
            		<?php global $wp_query;?>
            		<?php if( $wp_query->found_posts > 1 ):?>
                    	<h3><?php printf( __('About %s results','mars') , $wp_query->found_posts )?></h3>
                    <?php else:?>
                    	<h3><?php printf( __('About %s result','mars') , $wp_query->found_posts )?></h3>
                    <?php endif;?>
                    <?php do_action('mars_orderblock_videos');?>
                </div>
				<?php if( have_posts() ):?>
				<div class="row video-section meta-maxwidth-230">
					<?php 			
						while ( have_posts() ) : the_post();
						
							get_template_part( 'loop', 'video' );
						
						endwhile;
					?>
				</div>
                <?php do_action( 'mars_pagination', null );?>
                <?php else:?>
                	<div class="alert alert-info"><?php _e('Nothing Found.','mars')?></div>
                <?php endif;?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>