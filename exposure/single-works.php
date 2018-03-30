<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */
$thb_page_id = get_the_ID();

$work_types = wp_get_object_terms( $thb_page_id, "portfolio_categories" );
$meta = thb_get_post_meta_all($thb_page_id);

$types = array();
	if( !empty($work_types) )
		foreach($work_types as $type)
			$types[] = $type->name;

$subtitle = join($types, ", ");

get_header(); ?>

	<?php
		thb_pagination(array(
			'type' => 'links',
			'id' => 'thb-works-navigation',
			'nextPostTitle' => __('Next', 'thb_text_domain'),
			'previousPostTitle' => __('Previous', 'thb_text_domain')
		));
	?>

	<div class="single-work-details">
		<div class="single-work-details-wrapper">

			<div class="single-work-content">
				<header class="pageheader">
					<h1><?php the_title(); ?></h1>
					<?php if( !empty($subtitle) ) : ?>
						<h2 class="meta"><?php echo $subtitle; ?></h2>
					<?php endif; ?>
				</header><!-- /.pageheader -->

				<?php thb_page_before(); ?>

					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
						<?php thb_page_start(); ?>

						<?php $content = get_the_content(); ?>

						<?php if( !empty($content) ) : ?>
						<div class="thb-text">
							<?php the_content(); ?>
						</div>
						<?php endif; ?>

						<?php if( thb_show_comments() ) : ?>
						<section class="secondary">
							<?php thb_comments(); ?>
						</section>
						<?php endif; ?>

						<?php thb_page_end(); ?>
					<?php endwhile; endif; ?>

				<?php thb_page_after(); ?>

			</div>
		</div>
	</div>

	<?php
		$slideshow = new THB_Slideshow( thb_get_page_ID() );
		$slides = $slideshow->getSlides();
		$more_than_one_slide = count($slides) > 1;

		$nav = array();

		if( $more_than_one_slide ) {
			$nav[] = 'drawer';
		}

		$nav[] = 'fit';

		if( $more_than_one_slide ) {
			$nav[] = 'prev';
			$nav[] = 'next';
		}

		$nav[] = 'info';

		thb_get_template_part('part-nav', array(
			'controls' => $nav
		));
	?>

<?php get_footer(); ?>