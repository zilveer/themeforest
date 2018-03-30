<?php
/**
 * Template used for displaying single post information
 */

get_header();

the_post();
$author_name = rwmb_meta("testimonial_author_name");
$author_url = rwmb_meta("testimonial_author_url");
$journal_layout = $smof_data['journal_layout'];
if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
	$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
	$thumb_image_url = aq_resize( $full_image_url, 480, 320, true );
else :
	$thumb_image_url = get_template_directory_uri().'/img/480x320.gif';
endif; ?>

</section>
	<div class="flat_pagetop">
		<section id="content" class="container">

		<div class="grid12 col">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>


</section>
	</div>
		<section id="content" class="container">
			<p></p>
		<div class="grid4 col">
			<div class="thumb<?php echo $smof_data['css3_animation_class']; ?>">
<?php if (!empty($full_image_url)) : ?>
				<a href="<?php echo $full_image_url; ?>" class="lightbox"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php echo $full_image_url; ?>" class="button-fullsize"></a>
				</div>
<?php else : ?>
				<a><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
<?php endif; ?>
			</div>
			<div class="meta">
				<p class=" quotedate"><span class="icon-date"></span><?php _e( 'Posted on ', 'flatbox' ); echo the_time(get_option('date_format')); ?></p>

<?php if (get_the_tags()) : ?>
				<p class="smaller"><span class="icon-tag"></span><?php the_tags(); ?></p>
<?php endif; ?>

			</div>
		</div>
		<div class="grid8 col">
			<blockquote><cite class="small_text"><?php the_content(); ?></cite><?php if ($author_name) : ?>&mdash; <?php if ($author_url) : ?><a class="quote_author" href="<?php echo $author_url; ?>" target="_blank"><?php echo $author_name; ?></a><?php else: ?><strong class="quote_author"><?php echo $author_name; ?></strong><?php endif; ?><?php endif; ?></blockquote>

		</div>
		


<?php get_footer(); ?>