<?php 
/**
 * format-gallery.php
 *
 * The default template for post contents.
 */

?>



<div class="image-wrapper owlabgal_container">
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
    <div class="owlabgal_nav"></div>
	</div>
		
