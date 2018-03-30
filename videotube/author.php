<?php if( !defined('ABSPATH') ) exit;?>
<?php global $videotube;?>
<?php get_header();?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<div class="col-sm-8 main-content">
            	<div class="section-header">
            		<?php print apply_filters('videotube_author_header',null);?>
                </div>
				<?php if( have_posts() ) : ?>
					<?php print apply_filters('videotube_author_loop_before', null);?>
						<?php while ( have_posts() ) : the_post();?>
							<?php apply_filters('videotube_author_loop_content',null);?>
						<?php endwhile;?>
					<?php print apply_filters('videotube_author_loop_after', null);?>
					<?php 
						if( $videotube['enable_channelpage'] == 1 ){
							do_action( 'mars_pagination', null );
						}
						else{?>
			                <ul class="pager">
			                	<?php posts_nav_link(' ','<li class="previous">'.__('&larr; Older','mars').'</a></li>',' <li class="next">'.__('Newer &rarr;','mars').'</a></li>'); ?>
			                </ul>							
						<?php }
					?>
				<?php else:?>
					<div class="alert alert-info"><?php _e('Oops...nothing.','mars')?></div>
				<?php endif;?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>