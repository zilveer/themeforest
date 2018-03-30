<?php
/**
 * @package WordPress
 * @subpackage Smartbox
 */

get_header(); ?>

	
	<?php 
		if (have_posts()) {
			the_post(); 
			$type = get_post_type();
			$portfolio_permalink = get_option(DESIGNARE_SHORTNAME."_portfolio_permalink");
			switch ($type){
				case "post":
					get_template_part('post-single', 'single');
				break;
				case $portfolio_permalink:
					get_template_part('proj-single', 'single');
				break;
				default:
					?>
					<div id="white_content">
						<div id="wrapper">
							<div class="container" style="margin-top:170px;">
								<div class="reset_960">
									<article class="<?php post_class(); ?>">
										<div class="entry-content">
											<?php the_content(); ?>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>
					<?php
				break;
			}
		}
	?>

	
<?php get_footer(); ?>