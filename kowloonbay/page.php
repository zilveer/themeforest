<?php
the_post();

get_header();

$related_urls = rwmb_meta( 'kowloonbay_page_related_urls', array('type'=>'text') );
$related_bg_imgs = array_values(rwmb_meta( 'kowloonbay_page_related_bg_imgs', array('type'=>'image_advanced') ));
$related_descs = rwmb_meta( 'kowloonbay_page_related_descs', array('type'=>'text') );
$related_labels = rwmb_meta( 'kowloonbay_page_related_labels', array('type'=>'text') );

$col_class = 'col-md-4';
switch (sizeof($related_urls)) {
	case '1':
		$col_class = 'col-md-12';
		break;
	case '2':
		$col_class = 'col-md-6';
	break;
}

?>

<section>
	<div class="section-heading">
		<h2><span class="inline-block"><?php the_title(); ?></span></h2>
		<p class="section-desc"><?php echo esc_html( rwmb_meta( 'kowloonbay_page_desc') ); ?></p>
	</div>
	<?php the_content(); ?>

	<?php if (is_array($related_urls) && sizeof($related_urls) > 0):
		$j = 0;
	?>
	<div class="no-page-padding">
		<div class="row col-no-gutter">

			<?php foreach ($related_urls as $i => $u): ?>

				<div class="<?php echo esc_attr( $col_class ); ?> img-bg-cover-hover-effect-container clickable-block height-1x">
					<div class="img-bg-cover page-padding-h height-full">
						<img src="<?php echo esc_url( $related_bg_imgs[$i]['full_url'] ); ?>" alt="">
						<div class="v-centered-container">
							<div class="v-centered">
								<h4 class="margin-v-1x body-font text-center text-shadow"><?php echo esc_html( array_shift($related_descs) ); ?></h4>
								<p class="text-center">
									<a href="<?php echo esc_url( $u ); ?>" class="clickable-block-link btn btn-default btn-lg btn-transparent title-style"><?php
										$label = explode('|', array_shift($related_labels));

										foreach ($label as $l) {
											$l = trim($l);
											if (strpos($l, 'fa-') === 0){
												echo '<i class="fa ' .esc_attr( $l ). '"></i>';
											} else {
												echo esc_html($l);
											}
										}

									?></a>
								</p>
							</div>
						</div>
					</div>
				</div>

			<?php if (++$j === 2) break; ?>
			<?php endforeach; ?>
			
		</div>
	</div>
	<?php endif; ?>
</section>

<?php 
get_footer();