<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-8 main-content">
				<?php if(have_posts()):?>
				 <div <?php post_class()?>>
                    <?php woocommerce_content(); ?>
                </div><!-- /.post -->
				<?php endif;?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>