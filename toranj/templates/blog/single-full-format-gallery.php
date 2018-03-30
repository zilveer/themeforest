<?php
/**
 *  format-gallery
 * 
 * @package toranj
 * @author owwwlab
 */

?>


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
					
					<h1 class="lined"><?php the_title(); ?></h1>
					
					<div class="mb-large post-format-gallery owlabgal_container">

						<ul class="rslides" id="post-slider-<?php the_ID();?>">
						<?php 
			                
			                // get the images , fix any double comma errors , convert it to array
			                $images = explode(',' , str_replace(',,' , ',' , get_post_meta(get_the_ID()  , 'owlab_media_gallery' , true))); 

			                foreach ($images as $image) {
			                    
			                    if($image != ''){
			                        // get the cropped version of the image
			                        if(   (strpos($image , '.jpg') !== false)   ||  (strpos($image , '.png') !== false)  )
			                        {
			                                $fixedImage = str_replace('.jpg' , '-940x500.jpg' , $image);
			                                $fixedImage = str_replace('.png' , '-940x500.png' , $image);
			                                if(file_exists($fixedImage)) $image = $fixedImage;
			                        }
			                    ?>
			                        <li><a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>" alt="" /></a></li>
			                    <?php
			                    }
			                }
			            ?>
			        	</ul>
					</div>


					<?php include(locate_template(OWLAB_TEMPLATES . '/blog/single-full-content.php')); ?>