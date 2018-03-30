<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */

switch( thb_get_post_format() ) :

	// Format: link --------------------------------------------

	case 'link': ?>
	
		<header class="pageheader">
			<h1>
				<a href="<?php echo $meta['link_url']; ?>" rel="permalink">
					<?php the_title(); ?>
				</a>
			</h1>
			<a class="linkurl" href="<?php echo $meta['link_url']; ?>" title="<?php the_title(); ?>">
				<?php echo $meta['link_url']; ?>
			</a>
			<h2 class="meta"><?php the_date(); ?></h2>
		</header>
	
		<?php break;

	// Format: video -------------------------------------------
	
	case 'video': ?>
		
		<?php
			echo do_shortcode('[thb_video url="'. $meta['video_url'] .'"]');
		?>

		<header class="pageheader">
			<h1><?php the_title(); ?></h1>
			<h2 class="meta"><?php the_date(); ?></h2>
		</header>


	<?php
		break;

	// Format: gallery -------------------------------------------
	
	case 'gallery': ?>
		
		<?php
			echo do_shortcode('[thb_gallery size="medium-cropped" gallery_id="gallery-stream" link="file"]');
		?>

		<header class="pageheader">
			<h1><?php the_title(); ?></h1>
			<h2 class="meta"><?php the_date(); ?></h2>
		</header>

	<?php 
		break;

	// Format: audio -------------------------------------------
	
	case 'audio': ?>
	
		<header class="pageheader">
			<h1><?php the_title(); ?></h1>
			<h2 class="meta"><?php the_date(); ?></h2>
		</header>

		<?php

			echo do_shortcode('[thb_audio src="'. $meta['audio_url'] .'"]');

		break;		

	// Format: quote -------------------------------------------

	case 'quote': ?>
	
		<header class="pageheader">
			<h1><?php echo thb_text_format($meta['quote']); ?></h1>
			<?php if( !empty($meta['quote_author']) ) : ?>
				<cite>
					<?php if( !empty($meta['quote_url']) ) : ?>
						<a href="<?php echo $meta['quote_url']; ?>"><?php echo $meta['quote_author']; ?></a>
					<?php else : ?>
						<?php echo $meta['quote_author']; ?>
					<?php endif; ?>
				</cite>
			<?php endif; ?>
		</header>
		
		<?php break;

	// Default -------------------------------------------------

	default: ?>
	
		<header class="pageheader">
			<h1><?php the_title(); ?></h1>
			<h2 class="meta"><?php the_date(); ?></h2>
		</header>
	
		<?php break; ?>

<?php endswitch; ?>
