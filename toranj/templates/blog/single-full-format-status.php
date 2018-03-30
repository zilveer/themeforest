<?php
/**
 *  format-image
 * 
 * @package toranj
 * @author owwwlab
 */

?>


<?php if ( has_post_thumbnail() ): ?>
<!-- Post header -->
<div id="post-header" class="parallax-parent">

	<!-- Header image -->
	<div class="header-cover set-bg">
		<?php the_post_thumbnail('full',array(
			'class' => 'img-fit'
		)); ?>
	</div>
	<!-- /Header image -->

	<!-- Header content -->
	<div class="header-content tj-parallax" data-ratio="1">
		<div class="container">
			<h1 class="post-title">
				<?php the_title(); ?>
			</h1>
		</div>
	</div>
	<!-- /Header content -->
	

</div>
<!-- /Post header -->
<?php endif; ?>

<div class="container">

	<!-- Post body -->
	<div id="post-body">
		<div class="row">

			<!-- Post sidebar -->
			<div id="post-side" class="col-md-3">

				<!-- Post meta -->
				<div class="post-meta">
					<?php owlab_post_meta_single_full(); ?>
				</div>
				<!-- /Post meta -->

				<?php owlab_sharing_btns_style1(); ?>

			</div>
			<!-- /Post sidebar -->

			<!-- Post main area -->
			<div class="col-md-9">
				<div class="post mb-xlarge">
					
					<?php if ( !has_post_thumbnail() ): ?>
					<h1 class="lined"><?php the_title(); ?></h1>
					<?php endif; ?>
					
					<div class="post-format-status mb-large">
						<?php 

						$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
					    $imagesrc = $imagesrc[0];
						?>
					    <div class="inner-wrap" style="background-image: url(<?php echo $imagesrc; ?>) ; background-repeat: no-repeat;">
					    	<div class="status-wrap">			
					    		<?php echo get_post_meta(get_the_ID() , 'status' , true); ?>
					    	</div>
					    </div><!-- end inner wrap -->
					</div>


					<?php include(locate_template(OWLAB_TEMPLATES . '/blog/single-full-content.php')); ?>