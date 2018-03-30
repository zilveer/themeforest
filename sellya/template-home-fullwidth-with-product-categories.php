<?php
/*
* Template Name: Homepage Full Width With Product Categories
*
*/

global $smof_data;

get_header(); 
/*
 * Disable/Enable Lastest Product Carousel. 
 * To disable Lastest Product Carousel Change TRUE to FALSE
 */
$showlatest = TRUE;

/*
 * Disable/Enable Featured Product Carousel. 
 * To disable Featured Product Carousel Change TRUE to FALSE
 */
$showfeatured = TRUE;

?>
<section id="midsection" class="container">
<div class="row"> 
<div id="content-home" class="span12">
	<?php if($smof_data['sellya_show_slider_on_homepage'] == 1):?>
    <section id="banner-slider" class="fluid_container">
       <div class="camera_wrap camera_azure_skin" id="camera_wrap_0">
		<?php
            $slides = $smof_data['home_camera_slider']; //get the slides array
        
			if(!empty($slides)){
		
            foreach ($slides as $slide) {
            ?>
            <div data-link="<?php echo  $slide['link']; ?>" data-thumb="<?php echo  $slide['url']; ?>" data-src="<?php echo  $slide['url']; ?>">
            <?php if(!empty($slide['description']))
                echo "<div class=\"camera_caption\">{$slide['description']}</div>";
                ?>
            </div>
		<?php } 
			}	
		?>
		</div>
    </section>
    <?php endif;?>
    
    <div class="row-fluid">
    <div class="home_page_content">
	<?php
		
		if(have_posts()):while(have_posts()):the_post();
		
			the_content();
			
		endwhile; endif;
		
	?>
    </div>
    </div><!--.row-fluid -->
    <?php if($showfeatured){?>
    <section id="featured" class="featured span">
    	<?php 
		$args = array(
				'id'=>'featured-slider',
				'title'=>__('Featured','sellya'),
				'type'=>'featured',
				'number'=>-1
				);
		get_product_slider($args);
		?>
    </section>
 
 	<?php
    }
	$carousel_banners = $smof_data['carousel_top_banner_slider'];		
	if(!empty($carousel_banners)):
	?>
    
    <section id="banners-0" class="span">
	<div class="es-carousel-banners-wrapper">
	<div id="carousel0" class="es-carousel-banners">
	    
	    <ul>
        <?php
        foreach($carousel_banners as $b):
		
			if($b['url']):
		
		?>
        	<li><a href="<?php echo $b['link']?>"><img src="<?php echo $b['url']?>"  alt="<?php echo $b['title']?>" title="<?php echo $b['title']?>" width="300" /></a></li>        
		
        <?php
			endif;
		endforeach;
		?>        
	    </ul>
	</div>
	</div>
    </section>
    
    <?php
	endif;
	?>
 	<?php 
	/**
	*	@sellya_product_category_markup function
	*	prints categories with corresponding subcategories and images
	**/
	sellya_product_category_markup();
        if ($showlatest) {
	?>
    
    <section id="latest" class="featured span">
    	<?php 
		$args = array(
				'id'=>'latest-slider',
				'title'=>__('Latest','sellya'),
				'type'=>'recent',
				'number'=>8
				);
		get_product_slider($args);
		?>
    </section>
    <?php
         }
	get_brands_carousel();
	?>
	
</div>
</div></section>
<?php get_footer(); ?>