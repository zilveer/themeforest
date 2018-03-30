<?php
/**
 *	Template Name: Testimonials Page
 *
 * The template for displaying testimonials or feedback from clients
 */

get_header();
the_post();
$subtitle = rwmb_meta("subtitle");
$header_image = rwmb_meta('header_image',array('type' => 'file' ));
$header_bg_color = rwmb_meta('header_bg_color');
?>
</section>
	<?php 
if ( $header_image && count($header_image)>0 ) :
				foreach ( $header_image as $himggg ) :
			  	if (empty($himggg)) break; 
			  	if ( $header_bg_color ) : ?>
					<div class="flat_pagetop" style="color:<?php echo $header_bg_color; ?> !important;background:url(<?php echo $himggg['url'];?>);">
				<?php else : ?>
					<div class="flat_pagetop" style="background:url(<?php echo $himggg['url']; ?>);">
				<?php endif; ?>
<?php break; endforeach;

else :
 ?>
	<div class="flat_pagetop">
<?php endif; ?>
		<section id="content" class="container">

		<div class="grid12 col">
<?php if (!empty($subtitle)) : ?>
			<h1 class="page-title left"><?php the_title(); ?></h1>
			<div class="subtitle">
				<p class="small gray"><?php echo $subtitle; ?></p>
			</div>
			<div class="clear"></div>
<?php else : ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
<?php endif; ?>
		</div>

</section>
	</div>
		<section id="content" class="container">
			

		<div class="grid12 col">
			<p></p>
			<?php echo content(); ?>

		</div>
<?php
$page_no = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts(array(
	'post_type' => array('testimonials'),
	'post_status' => 'publish',
	'paged' => $page_no
));
if (have_posts()) :
	while(have_posts()) :
		the_post();
		$author_name = rwmb_meta("testimonial_author_name");
		$author_url = rwmb_meta("testimonial_author_url"); ?>
		<div class="grid2 col">
			<div class="thumb half-bottom<?php echo $smof_data['css3_animation_class']; ?>">
<?php if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 420, 420, true ); ?>
				<a href="<?php echo $full_image_url; ?>" class="lightbox"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php echo $full_image_url; ?>" class="button-fullsize"></a>
				</div>
<?php		else:
				$thumb_image_url = get_template_directory_uri().'/img/staff-member.png'; ?>
				<a><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
<?php 	endif; ?>
			</div>
		</div>

		
		<div class="grid10 col">
			<blockquote><cite class="small_text"><?php the_content(); ?></cite><?php if ($author_name) : ?>&mdash; <?php if ($author_url) : ?><a class="quote_author" href="<?php echo $author_url; ?>" target="_blank"><?php echo $author_name; ?></a><?php else: ?><strong class="quote_author"><?php echo $author_name; ?></strong><?php endif; ?><?php endif; ?></blockquote>
		</div>
		<div class="clear"></div>
<?php endwhile; ?>
		<?php pagination_links(); ?>
<?php
	else:
		get_template_part( 'noresult' );
	endif; ?>

<?php get_footer(); ?>