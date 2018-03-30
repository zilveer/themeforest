<?php get_header(); ?>



</section>
	<div class="flat_pagetop">
		<section id="content" class="container">

		<div class="grid12 col">
			<h1 class="page-title"><?php _e( '404 Error ', 'flatbox' ); wp_title('-', true); ?></h1>


		</div>


</section>
	</div>
		<section id="content" class="container">

			<div class="grid12 col">
			<p></p>
<?php if(!empty($smof_data['404_text'])) : ?>
			<p class="gray small_text"><?php echo $smof_data['404_text'] ?></p>
<?php endif; ?>
<p class="centerimg">
<?php if(!empty($smof_data['404_image'])) { ?>
<img src="<?php echo $smof_data['404_image'] ?>" class="scale" alt="" />
<?php } else { ?>
<img src="<?php echo get_template_directory_uri(); ?>/img/404.png" class="scale" alt="" />
<?php }  ?>
</p>

		<div class="grid4 col">
			<p>   </p>
			</div>
			<div class="grid4 col">
			<p class="centerimg">
			<?php get_search_form(); ?>
			</p>

		</div>

<p></p>
		</div>


<?php get_footer(); ?>