<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header();?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<div class="col-sm-8 main-content">
            	<div class="section-header">
                    <h3>
                    	<?php the_archive_title()?>
                    </h3>
                </div>				
				<?php if( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('loop','post');?>
				<?php endwhile;?>
                <ul class="pager">
                	<?php posts_nav_link(' ','<li class="previous">'.__('&larr; Previous','mars').'</a></li>',' <li class="next">'.__('Next &rarr;','mars').'</a></li>'); ?>
                </ul>
				<?php else:?>
					<div class="alert alert-info"><?php _e('Oops...nothing.','mars')?></div>
				<?php endif;?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->			
<?php get_footer();?>