<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */
        
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $theretailer_theme_options;

$owl_product_thumbs = 4;
$slider_class ="";

if ((isset($theretailer_theme_options['products_layout'])) && ($theretailer_theme_options['products_layout'] == "1")) {
	$owl_product_thumbs = 3 ;
	$slider_class = " with-sidebar-doubleSlider";
}

$attachment_ids = $product->get_gallery_attachment_ids();

?>

<?php 
/**
* Check if Cloud Zoom is active
**/
if ( in_array( 'cloud-zoom-for-woocommerce/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
?>
        
        <div class="images">
        
            <?php
                if ( has_post_thumbnail() ) {
        
                    $image       		= get_the_post_thumbnail( $post->ID, 'shop_single' );
                    $image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
                    $image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
                    $attachment_count   = count( $product->get_gallery_attachment_ids() );
        
                    if ( $attachment_count > 0 ) {
                        $gallery = '[product-gallery]';
                    } else {
                        $gallery = '';
                    }
        
                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );
        
                } else {
        
                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );
        
                }
            ?>
        
            <?php do_action( 'woocommerce_product_thumbnails' ); ?>
        
        </div>

<?php } else { ?>
            
            <?php
            // get the width and height of shop_single thumb
			
			$tn_id = get_post_thumbnail_id( $post->ID );

			$img = wp_get_attachment_image_src( $tn_id, 'shop_single' );
			$width = $img[1];
			$height = $img[2];
			?>
            
            <style>
				.doubleSlider-1 {
					height: <?php echo $height; ?>px;
				}
			</style>
            
            <div class="images gbtr_images">
                
                <script type="text/javascript">
					
					jQuery(document).ready(function($) {
						var sync1 = $("#sync1");
						var sync2 = $("#sync2");
						 
						sync1.owlCarousel({
							singleItem : true,
							slideSpeed : 600,
							navigation: true,
							pagination:false,
							autoHeight : true,
							afterAction : syncPosition,
							responsiveRefreshRate : 200,
						});
						 
						sync2.owlCarousel({
							items : <?php echo $owl_product_thumbs; ?>,
							itemsDesktop : false,
							itemsDesktopSmall : [1023,4],
							itemsTablet : [479,3],
							itemsMobile : [320,2],
							pagination:false,
							responsiveRefreshRate : 100,
							afterInit : function(el){
								el.find(".owl-item").eq(0).addClass("synced");
							}
						});
						 
						function syncPosition(el){
							var current = this.currentItem;
							$("#sync2")
								.find(".owl-item")
								.removeClass("synced")
								.eq(current)
								.addClass("synced")
							if($("#sync2").data("owlCarousel") !== undefined){
								center(current)
							}
						}
						 
						$("#sync2").on("click", ".owl-item", function(e){
							e.preventDefault();
							var number = $(this).data("owlItem");
							sync1.trigger("owl.goTo",number);
						});
						
						$(".variations").on('change', 'select', function(e) {
							sync1.trigger("owl.goTo",0);
						});
						 
						function center(number){
							var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
							var num = number;
							var found = false;
							for(var i in sync2visible){
								if(num === sync2visible[i]){
									var found = true;
								}
							}
						 
							if(found===false){
								if(num>sync2visible[sync2visible.length-1]){
									sync2.trigger("owl.goTo", num - sync2visible.length+2)
								}else{
									if(num - 1 === -1){
										num = 0;
									}
									sync2.trigger("owl.goTo", num);
								}
							} else if(num === sync2visible[sync2visible.length-1]){
								sync2.trigger("owl.goTo", sync2visible[1])
							} else if(num === sync2visible[0]){
								sync2.trigger("owl.goTo", num-1)
							}
						}
					 
					});
        
                </script>
            
            
               <!-- <div class='doubleSlider-1'>-->
                
                    <div id="sync1" class="slider product_images doubleSlider-1<?php echo $slider_class; ?>">
                    
                        <?php if ( has_post_thumbnail() ) : ?>
                        
                        <?php
                            //Get the Thumbnail URL
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
                            
                            $attachment_count   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );
                    
                        ?>
                        
                        <div class="item">
                            <a href="<?php echo $src[0] ?>" 
                            <?php if (get_option( 'woocommerce_enable_lightbox' ) == "yes") : ?>
                            class="fresco zoom"
                            <?php endif; ?>
                            data-fresco-group="product-gallery" data-fresco-options="fit: 'width'"><span itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_single' ) ?></span>
                            <span class="theretailer_zoom"></span></a>
                        </div>
                        
                        <?php endif; ?>	
                        
                        <?php
        
                            if ( $attachment_ids ) {
                        
                                $loop = 0;
                                $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );						
                                
                                foreach ( $attachment_ids as $attachment_id ) {
        
                                    $classes = array( 'zoom' );
                        
                                    if ( $loop == 0 || $loop % $columns == 0 )
                                        $classes[] = 'first';
                        
                                    if ( ( $loop + 1 ) % $columns == 0 )
                                        $classes[] = 'last';
                        
                                    $image_link = wp_get_attachment_url( $attachment_id );
                        
                                    if ( ! $image_link )
                                        continue;
                        
                                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                                    $image_class = esc_attr( implode( ' ', $classes ) );
                                    $image_title = esc_attr( get_the_title( $attachment_id ) );

									if (get_option( 'woocommerce_enable_lightbox' ) == "yes") {
										printf( '<div class="item"><a href="%s" class="fresco" data-fresco-group="product-gallery" data-fresco-options="fit: \'width\'"><span>%s</span><span class="theretailer_zoom"></span></a></div>', wp_get_attachment_url( $attachment_id ), wp_get_attachment_image( $attachment_id, 'shop_single' ) );
									} else {
										printf( '<div class="item"><a href="%s" data-fresco-group="product-gallery" data-fresco-options="fit: \'width\'"><span>%s</span><span class="theretailer_zoom"></span></a></div>', wp_get_attachment_url( $attachment_id ), wp_get_attachment_image( $attachment_id, 'shop_single' ) );
									}
									
                                    $loop++;
                                }
                                
                                
                        
                            }
                        ?>
                    
                    </div>
                    
                    <?php /*if ( $attachment_count != 1 ) { ?>
                    <div class='product_single_slider_previous'></div>
                    <div class='product_single_slider_next'></div>
                    <?php } */?>
                    
               <!-- </div>-->
                
                <link rel="image_src" href="<?php echo $src[0] ?>" />
                
                <?php 
        
                if ( $attachment_ids ) {
                
                ?>
                
               <!-- <div class = 'doubleSlider-2'>-->
                <div class="product_thumbs">
					<div class="product_thumbs_inner"> 
						<div  id="sync2" class = 'slider doubleSlider-2'>
									
									<?php if ( has_post_thumbnail() ) : ?>
									<div class="button"><div itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ) ?></div></div>
									<?php endif; ?>
									
									<?php
							
									$loop = 0;
									$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
									
									foreach ( $attachment_ids as $attachment_id ) {
			
										$classes = array( 'zoom' );
							
										if ( $loop == 0 || $loop % $columns == 0 )
											$classes[] = 'first';
							
										if ( ( $loop + 1 ) % $columns == 0 )
											$classes[] = 'last';
							
										$image_link = wp_get_attachment_url( $attachment_id );
							
										if ( ! $image_link )
											continue;
							
										$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
										$image_class = esc_attr( implode( ' ', $classes ) );
										$image_title = esc_attr( get_the_title( $attachment_id ) );
										
										echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="button">%s</div>', $image ), $attachment_id, $post->ID, $image_class );
										
										$loop++;
									}
									
									if ($loop < 4) {
										for ($i=1; $i<(4-$loop); $i++) {
										?>
											<div class="button"><!-- empty placeholder --></div>
										<?php
										}
									}
									?>
						
						</div>
					</div><!--.product_thumbs-inner-->
                </div><!--.product_thumbs-->
                
                <?php } ?>
            
            </div>
    
<?php } ?>
