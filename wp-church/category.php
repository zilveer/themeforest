<?php
/**
 * The template for displaying Category Archive pages.
 *
 */

get_header(); ?>


<div class="lastmess">
	<div class="container">
		<div class="grid10 first">
			<h1 class="entry-title"><?php single_cat_title(); ?></h1>
		</div>
		<div class="grid2 dirr">
			<?php if (get_option('nets_reassdir')){ ?>
			<a href="<?php echo get_option('nets_reassdir'); ?>"><span><?php echo get_option('nets_sptdir'); ?></span></a>
			<?php } else { ?>
				<a class="vmp" href="#"><span><?php echo get_option('nets_sptdir'); ?></span></a>
			<?php } ?>
		</div>
	</div>
</div>

<div class="bodymid">
	<div class="stripetop">
		<div class="stripebot">
			<div class="container">
				<div class="mapdiv"></div>
					<div class="clear"></div>
						<div id="main">
							<div class="grid8 first">		
								<div id="content" role="main">
									<?php get_template_part( 'loop', 'category' ); ?>				
									<?php adminace_paging(); ?>
								</div>
							</div>
							<?php get_sidebar(); ?>
							<?php get_footer(); ?>
