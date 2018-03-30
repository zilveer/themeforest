<?php
/**
 * The template for displaying about page with members
 *
 *
 */

/**
 Template Name: About
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

<div class="bodymid">
	<div class="stripetop">
		<div class="stripebot">
			<div class="container">
				<div class="mapdiv"></div>
				<div class="clear"></div>
				<div id="main">
					<div class="aboutpage">
						<div id="content" role="main">
							<div class="quicklinksouter" >
								<div class="grid6 first">
									<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<div class="entry-content"><?php the_content(); ?></div>							
									</div>							
								</div>						
								<?php endwhile; ?>						
								<div class="grid6 teamabout" style="width: 465px;">
									<div class="teaminner">
										<h3><?php echo get_option('nets_sptteammem')?></h3>
										<?php $linkposts = get_posts('numberposts=10000&post_type=members');
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
							</div>				
						</div>
					</div>

					<?php get_footer(); ?>