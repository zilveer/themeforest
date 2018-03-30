<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     99.99
 */

global $product, $woocommerce_loop ,$pmc_data ,$sitepress,$wpdb;
wp_enqueue_script('pmc_bxSlider');		
$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 99,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $upsells
);

$pc = new WP_Query( $args ); ?>

<?php if($pc->post_count > 4) { ?>
	<script type="text/javascript">


		jQuery(document).ready(function(){	  


		// Slider
		var $slider = jQuery('#relatedSP').bxSlider({
			controls: true,
			displaySlideQty: 1,
			default: 1000,
			easing : 'easeInOutQuint',
			prevText : '',
			nextText : '',
			pager :false
			
		});

 

		 });
	</script>


<?php } ?>
		

<div class="homerecent SP">
		<?php
		$currentindex = '';
		if ($pc->have_posts()) :
		$count = 1;
		$countitem = 1;
		$countPost= 1;
		?>
	<div class="titleborder"></div>
	<h3 class="titleborderh">
		<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['translation_also_like']); } else {  _e('<span>Also</span> like','buler'); } ?>
	</h3>
	<div id="homerecent">
	<ul  id="relatedSP" class="productR">
		<?php  while ($pc->have_posts()) : $pc->the_post(); global $product;	
		if($countitem == 1){
			echo '<li>';}				
		if ( has_post_thumbnail() ){
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'homeProduct', false);
			$image = $image[0];}
		else
			$image = get_template_directory_uri() .'/images/placeholder-580.png'; 
			if( has_post_format( 'link' , get_the_ID()))
			add_filter( 'the_excerpt', 'filter_content_link' );	
		
			if($countPost != 4){
				echo '<div class="one_fourth" >';
			}
			else{
				echo '<div class="one_fourth last" >';
				$countPost = 0;
			}
			if ( has_post_thumbnail() ){
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'shop', false);
				$image = $image[0];}
			else
				$image = get_template_directory_uri() .'/images/placeholder-580.png'; 						
			?>
				<div class="click">
				<a href="<?php echo get_permalink( get_the_id() ) ?>" title="<?php the_title() ?>">
				<?php if(isset($postmeta["video_active"][0]) && $postmeta["video_active"][0] == 1) { ?>
					<div class="recentimage">
						<div class="image">
							<div class="loading"></div>
							<?php
							
								if ($postmeta["selectv"][0] == 'vimeo')  
								{  
									echo '<iframe class = "productIframe full" src="http://player.vimeo.com/video/'.$postmeta["video_post_url"][0].'" width="230" height="'. $pmc_data['catalog_img_height'] .'"  ></iframe>';  
								}  
								else if ($postmeta["selectv"][0] == 'youtube')  
								{  
									echo '<iframe class = "productIframe full youtube"  width="230" height="'. $pmc_data['catalog_img_height'] .'" src="http://www.youtube.com/embed/'.$postmeta["video_post_url"][0].'"  ></iframe>';  
								}  
								else  
								{  
									//echo 'Please select a Video Site via the WordPress Admin';  
								} 

							?>
						</div>
					</div>								
					
					<?php } else { ?>
					<div class="recentimage">
						
						<div class="image">
							<div class="loading"></div>
							<?php if (has_post_thumbnail( get_the_ID() )) echo '<img src = '.$image.' alt = "'.get_the_title().'"  > '; else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="230px" height="'.$pmc_data['catalog_img_height'].'px" />'; ?>
						</div>
					</div>				
					<?php  }  ?>
				</a>
				<div class="recentdescription">
					<?php woocommerce_show_product_sale_flash( $product ); ?>
					<a href="<?php echo get_permalink( get_the_id() ) ?>" title="<?php the_title() ?>"><h3><?php the_title() ?></h3></a>				
				</div>
				</div>	
					<div class="product-price-cart">						
						<div class="recentPrice"><span class="price"><?php echo $product->get_price_html(); ?></span></div>	
						<div class="recentCart"><?php woocommerce_template_loop_add_to_cart(  $product ); ?></div>
					</div>	
					
			</div>
		<?php 
		$count++;
		
		 if($countitem == 4){ 
			$countitem = 0; ?>
			</li>
		<?php } 
		$countitem++;
		$countPost++;
		endwhile; endif;
		wp_reset_query(); ?>
		</ul>
	</div>
</div>
<?php
wp_reset_postdata(); ?>