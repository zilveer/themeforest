<?php
/**
 * Template Name: Sidebar Right
 */
get_header();
?>
<div class="properties">
	<div class="container">
		<div class="grid_full_width">
			<div class="row">
				<div class="col-md-8 col-sm-8">
					<?php
					while(have_posts()) {
						the_post();
						if(get_post_meta(get_the_ID(),'page_setting_title',true)) {
							?>
							<h1 class="page-title"><?php the_title();?></h1>
						<?php
						}
						?>
						<?php the_content() ?>
						<?php
					}
					?>
				</div>
				<div class="col-md-4 col-sm-4">
				<?php
				get_sidebar();
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
?>

