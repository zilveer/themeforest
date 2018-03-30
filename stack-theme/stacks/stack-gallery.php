<?php
if( !function_exists('gen_gallery_item') ) {
function gen_gallery_item($id, $group_id) {
	$img_attr = wp_get_attachment_image_src( $id, 'full' );
?>
	<a href="<?php echo $img_attr[0]; ?>" class="fancy-image" data-group="<?php echo $group_id; ?>">
		<div class="img-box">
		<?php 
			echo gen_responsive_image_block( $id, array(
					array( 'width' => 290 ),
					array( 'width' => 290*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
				)
			);
		?>
		<i class="icon icon-plus overlay-icon"></i>
		</div>
	</a>
<?php
}}
?>

<div class="stack stack-gallery" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">

	<?php if ( $stack['stack_title'] != '') { ?>
		<div class="span12"><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div></div>
		<div class="clear"></div>
	<?php } ?>

	
	<!-- Slide -->
	<?php if( $stack['style'] == 'slide' ): ?>
		
		<div class="span12">
			<div class="m-carousel" data-slide-per-page="4">
			<div class="m-carousel-inner">
			<?php if( is_array($stack['images']) ) foreach ($stack['images'] as $image_id): ?>
				<div class="span3 m-item">
					<div class="person-box">
						<?php gen_gallery_item( $image_id, $stack['stack_id'] ); ?>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
			</div><!-- .m-carousel -->

			<?php if( count($stack['images']) > 4 ): ?>
				<div class="m-carousel-control slide-control top-right-slide-control">
					<a href="#" class="m-carousel-prev"><i class="icon icon-angle-left"></i></a><a href="#" class="m-carousel-next"><i class="icon icon-angle-right"></i></a>
				</div>
			<?php endif; ?>

		</div><!-- .span12 -->
	<?php endif; ?>

	<!-- Masonry -->
	<?php if( $stack['style'] == 'masonry' ): ?>
		<div class="masonry-container" data-cols="4">
			<?php foreach ($stack['images'] as $image_id): 
				$img_attr = wp_get_attachment_image_src( $image_id, 'full' );
			?>
				<div class="span3 masonry-item">
					<?php gen_gallery_item( $image_id, $stack['stack_id'] ); ?>
				</div>
			<?php endforeach; ?>
		</div><!-- .masonry-container -->
	<?php endif; ?>

</div>
</div>
</div><!-- .stack-gallery -->