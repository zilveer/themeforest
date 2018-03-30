<?php
/**
 *  Single template page for bulk gallery slider
 * 
 * @package Toranj
 * @author owwwlab
 */


if ( !is_array($imgs)){
	$imgs = array();
}

?>


<div id="main-content" class="abs dark-template"> 

	<?php if($config['sidebar']== 'on'): ?>

	<!-- Page sidebar -->
	<div class="page-side">
		<div class="inner-wrapper vcenter-wrapper">
			<div class="side-content vcenter">

				<!-- Page title -->
				<h1 class="title">
					<?php the_title(); ?>
				</h1>
				<!-- /Page title -->

				<?php 
				if ( !post_password_required() )
					echo $config['sidebar_content'];
				?>

			</div>
		</div>
	</div>
	<!-- /Page sidebar -->

	<?php endif; ?>

	<?php 
	$nosideClass='';
	if($config['sidebar']!= 'on'){
		$nosideClass = " no-side";
	} 
	?>

	<!-- Page main content -->
	<div class="page-main <?php echo $nosideClass ?>">

		<?php if ( post_password_required() ) : ?>
			<?php include(locate_template(OWLAB_TEMPLATES . '/password-protect/form-center.php')); ?>
		<?php else: ?>

			<?php 
				

				switch ($config['slider_thumb']) {
					case 'vertical':
						$s_dir = 'data-dir="v"';
						$s_class = ' tj-vertical-gallery ';
						$s_gallery = 'data-gallery="true"';
						$s_show_thumb = true;
						break;
					
					case 'horizontal':
						$s_dir = 'data-dir="h"';
						$s_class = '';
						$s_gallery = 'data-gallery="true"';
						$s_show_thumb = true;
						break;

					default:
						# is none
						$s_dir = 'data-dir="h"';
						$s_class = 'no-thumbnails';
						$s_gallery = '';
						$s_show_thumb = false;
						break;
				}
			?>
			<!-- Gallery full -->
			<div 
				class="tj-ms-slider tj-ms-skin tj-ms-gallery <?php echo $s_class; ?> fillmode" 
				<?php echo $s_gallery; ?> 
				<?php echo $s_dir; ?> 
				data-view="basic" 
				data-counter="false" 
				data-layout="autofill"
				id = "masterslider-<?php echo get_the_ID();?>">

				<?php foreach ($imgs as $img_id=>$img_data): ?>
					<?php
					$thumb_url = wp_get_attachment_image_src( $img_id );
					$img_url = $img_data['src'];
					?>

					
					<div class="ms-slide">
						<img src="<?php echo get_template_directory_uri();?>/assets/img/blank.gif" data-src="<?php echo $img_url;?>" alt="<?php echo $img_data['title'] ?>"/>
						<?php if ($s_show_thumb):?>
							<img src="<?php echo $thumb_url[0] ?>" alt="<?php echo $img_data['title'] ?>" class="ms-thumb"/>
						<?php endif; ?>
						
						<?php if($config['show_captions'] == 'on'):?>
							<div 
								class="ms-layer caption cap-bordered cap-bottom cap-left" 
								data-effect="left(30)"
								data-duration="1000"
								data-ease="easeOutExpo"
								data-delay="0">

								<h2 class="cap-title">
									<?php echo $img_data['title'] ?>
								</h2>
								
							</div>
						<?php endif;?>

					</div>



				<?php endforeach; ?>
			</div>
			<!-- Gallery full -->
		<?php endif; ?>
	</div>
	<!-- Page main content -->

</div>
<?php do_action('owlab_after_content'); ?>