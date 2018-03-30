<?php
/**
 * The template for displaying single the team page
 *
 *
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="lastmess">
	<div class="container">
		<div class="grid10 first">
			<h1 class="entry-title"><?php the_title(); ?></h1>
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

<div id="main">
	<div class="bodymid">
		<div class="stripetop">
			<div class="stripebot">
				<div class="container">
					<div class="mapdiv"></div>
					<div class="clear"></div>
					<div id="main">
						<div class="saboutpage">
							<div id="content" role="main">
								<div class="grid3 teampostimg first">
									<?php echo get_the_post_thumbnail(get_the_ID(),'medium'); ?>
								</div>
								<div class="grid4 teampost">
									<h1 class="entry-title"><?php the_title(); ?></h1>
									<div class="entry-content"><?php the_content(); ?></div>
								</div>
								<div class="grid5 teamabout" >
									<div class="teaminner">
										<h3><?php echo get_option('nets_sptteammem')?></h3>
										<?php $linkposts = get_posts('numberposts=0&post_type=members');
            							foreach($linkposts as $linkentry) :
										$linkvalue = $linkentry->ID;
										$linkto = get_post_meta($linkvalue, 'netlabs_memtitle' , true); 
										echo '<div class="singleteam">';
										echo '<a href="' . get_permalink($linkvalue) . '">' . get_the_post_thumbnail($linkvalue,'medium') . '</a>';	
										echo '<p class="memtitle"><strong>' . get_the_title($linkvalue) . '</strong></p>';
										echo '<p>' . $linkto . '</p>';
										echo '</div>';	
										endforeach;	
										?>
										<div class="clear"></div>
									</div>						
								</div>
								<div class="clear"></div>
								<?php endwhile; ?>
							</div>
						</div><!-- #container -->

						<?php get_footer(); ?>
