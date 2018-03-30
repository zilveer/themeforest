<?php
/**
 * The template for displaying generic pages.
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
			<?php echo content(); ?>

		</div>

<?php get_footer(); ?>