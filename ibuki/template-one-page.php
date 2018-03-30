<?php
/* Template Name: Template One Page */
?>
<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>

<?php get_header(); ?>

<div id="content">
	<?php az_page_header($post->ID); ?>

	<section class="wrap_content">
	<?php if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) { ?>
		<?php if ( is_cart() || is_checkout() || is_account_page() ) { ?>
		<section class="main-content default-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				        <?php //edit_post_link( __('Edit', AZ_THEME_NAME), '<span class="edit-post">[', ']</span>' ); ?>
				        <?php the_content(); ?>
				        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', AZ_THEME_NAME).'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				    <?php endwhile; endif; ?>
					</div>
				</div>
			</div>
		</section>
		<?php } else { ?>
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		        <?php //edit_post_link( __('Edit', AZ_THEME_NAME), '<span class="edit-post">[', ']</span>' ); ?>
		        <?php the_content(); ?>
		        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', AZ_THEME_NAME).'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		    <?php endwhile; endif; ?>
		<?php } ?>

    <?php } else { ?>

    	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	        <?php //edit_post_link( __('Edit', AZ_THEME_NAME), '<span class="edit-post">[', ']</span>' ); ?>
	        <?php the_content(); ?>
	        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', AZ_THEME_NAME).'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	    <?php endwhile; endif; ?>

    <?php } ?>
	</section>
</div>

<?php get_footer(); ?>