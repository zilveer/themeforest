<?php 
	get_header();
?>

<section id="content" class="clearfix">
	
	<article>
	
		<div class="whoopsie-daisy-wrapper">
			<h1 class="whoopsie-daisy">
				<small><?php _e('Uh, Oh.','ebor_starter'); ?></small>
				<?php _e('404','ebor_starter'); ?>
			</h1>
			<a href="<?php echo home_url(); ?>"><?php _e('&larr; Head Home','ebor_starter'); ?></a>
		</div>
	
	</article>
	
</section>
	
<?php	
	get_footer();