<?php function humbleshop_modify_edd_download_shortcode( $display, $atts, $buy_button, $columns, $column_width, $downloads, $excerpt, $full_content, $price, $thumbnails, $query ) { ?>

<?php 

switch( intval( $columns ) ) :
		case 1:
			$column_number = 'col-1'; break;
		case 2:
			$column_number = 'col-2'; break;
		case 3:
			$column_number = 'col-3'; break;
		case 4:
			$column_number = 'col-4'; break;
	endswitch;

	ob_start(); $count = 0; ?>

	
	<div class="downloads <?php //echo $column_number; ?> row">
		
			<?php while ( $downloads->have_posts() ) : $downloads->the_post(); $count++; 

				$in_cart = ( edd_item_in_cart( get_the_ID() ) && !edd_has_variable_prices( get_the_ID() ) ) ? 'in-cart' : ''; 
				$variable_priced = ( edd_has_variable_prices( get_the_ID() ) ) ? 'variable-priced' : '';
				$column = 'col-sm-4';
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array( $in_cart, $variable_priced, $column ) ); ?> itemscope itemtype="http://data-vocabulary.org/Product">
       				<figure class="edd_download_inner">
					 	<?php 
					 	/**		
					 	 * Show thumbnails
					 	*/
					 	if( 'false' != $thumbnails ) : ?>
				        <div class="download-image">
				        	 <a title="<?php _e( 'View ', 'shop-front' ) . the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
				             
				             <?php if ( has_post_thumbnail() ) : ?>
				             	 <?php 
				                    the_post_thumbnail('download', array( 'class'	=> "img-responsive")); 
				                ?>
				            <?php else: ?>
				            	<img src="//placehold.it/500x500&text=Placeholder" alt="" class="img-responsive"/>
				            	<?php //echo apply_filters( 'humbleshop_download_icon', '<i class="i fa fa-shopping-cart"></i>');
				             endif; ?>
				        	</a>

					       <?php if ( $buy_button != 'yes' ) : ?> 	
			               <div class="overlay">
	      	
				                <a title="<?php _e('View ','shop-front') . the_title_attribute(); ?>" class="icon-action button <?php if( edd_has_variable_prices( get_the_ID() ) ) echo 'single'; ?>" href="<?php the_permalink(); ?>">
				                    <i class="icon-view"></i>
				                </a>

				                <?php 
				                if( !edd_has_variable_prices( get_the_ID() ) )
				                	echo humbleshop_get_purchase_link( array( 'id' => get_the_ID() ) ); 
				                ?>

				            </div>
				            <?php endif; ?>

				        </div>
				        <?php endif; ?>


				        <figcaption class="download-info text-center">
							<?php 
								
							/* Product Price ---------------------------------------- */
							
							if(function_exists('edd_price')) { ?>
								<div class="product-price">
									<?php 
										if(edd_has_variable_prices(get_the_ID())) {
											// if the download has variable prices, show the first one as a starting price
											echo 'From: '; edd_price(get_the_ID());
										} else {
											edd_price(get_the_ID()); 
										}
									?>
								</div><!--end .product-price-->
							<?php } ?>

				         	<?php
						        
					       	/* Excerpt ---------------------------------------- */
							
							$excerpt_length = apply_filters('excerpt_length', 12);
					        if ( has_excerpt() ) {
					        	echo '<p><small>' . wp_trim_words( get_the_excerpt(), $excerpt_length ) . '</small></p>';
					        
					        } ?>

							<?php 

					        /* Buttons ---------------------------------------- */

							if(function_exists('edd_price')) {
								if ( $buy_button == 'yes' ) : ?>
								<div class="product-buttons">
									<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
										<?php //echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
									<?php } ?>
									<a href="<?php the_permalink(); ?>" class="btn btn-default btn-sm"><i class="fa fa-search"></i> View Details</a>
								</div><!--end .product-buttons-->
								<?php endif;
							} ?>
				        </figcaption>
				    </figure>

				    <p class="edd_download_title text-center" itemprop="name">
						<a title="<?php the_title_attribute(); ?>" itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</p>
				</article>
			
			<?php if ( $count %2 == 0 ) echo '<div class="clear-2"></div>'; ?>
	        <?php if ( $count %3 == 0 ) echo '<div class="clear-3"></div>'; ?>
	        <?php if ( $count %4 == 0 ) echo '<div class="clear-4"></div>'; ?>

	       

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

			
			
		</div>
		<nav id="downloads-shortcode" class="download-navigation text-center">
			<?php
			$big = 999999;
			echo paginate_links( array(
				'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'  => '?paged=%#%',
				'current' => max( 1, $query['paged'] ),
				'total'   => $downloads->max_num_pages,
				'prev_next' => false,
				'show_all' => true,
			) );
			?>
		</nav>

<?php 

$display = ob_get_clean();
return $display; }

add_filter( 'downloads_shortcode', 'humbleshop_modify_edd_download_shortcode', 10, 11);

/**        
 * Modify Gallery output
 * @since 1.0
*/
function humbleshop_gallery( $output, $attr ) {
    global $post;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';

    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
            }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->";
    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $count = 0;
    foreach ( $attachments as $id => $attachment ) {
        $count++;
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";

        if ( $count %2 == 0 )
            $output .= '<div class="clear-2"></div>';

        if ( $count %3 == 0 )
            $output .= '<div class="clear-3"></div>';

        if ( $count %4 == 0 )
            $output .= '<div class="clear-4"></div>';

        if ( $count %5 == 0 )
            $output .= '<div class="clear-5"></div>';
    }

    $output .= "
           
        </div>\n";

    return $output;
}
add_filter( 'post_gallery', 'humbleshop_gallery', 10, 2 );

function humbleshop_single_download_image() {

	if ( has_post_thumbnail() ) {
		$url = wp_get_attachment_url( get_post_thumbnail_id() );
		echo '<div class="download-image col-sm-5"><a href="'.$url.'" alt="">';
		the_post_thumbnail('featured-image', array( 'class'	=> "img-responsive"));
		echo '</a>';

		// Additional images
		if( function_exists( 'edd_di_display_images') ) {
    		echo '<hr /><div class="row download-thumb">';
    		edd_di_display_images();
    		echo '</div>';
		}
		echo '</div>';
	} else {
		echo '<div class="col-sm-5 download-image">';
		echo '<img src="//placehold.it/600x600&text=Placeholder" alt="" class="img-responsive" />';
		echo '</div>';
	}

}
add_action( 'humbleshop_single_download_image', 'humbleshop_single_download_image' );

function themename_edd_di_display_images( $html, $download_image ) {
    // here a div tag is wrapped around each image
    $html = '<article class="col-sm-4 col-xs-6"><a href="' . $download_image['image'] . '"><img class="edd-di-image" src="' . $download_image['image'] . '" alt="" /></a></article>';
    return $html;
}
add_filter( 'edd_di_display_images', 'themename_edd_di_display_images', 10, 2 );

function download_category_id_class($classes) {
   global $post;
   $categories = get_the_terms( $post->ID, 'download_category' );
   if( $categories ) {
	    foreach( $categories as $category ) {
	        $classes[] = $category->slug;
	    }
	}
	return $classes;
}
add_filter('post_class', 'download_category_id_class');

function download_tag_id_class($classes) {
   global $post;
   $tags = get_the_terms( $post->ID, 'download_tag' );
   if($tags) {
	    foreach( $tags as $tag ) {
   	     $classes[] = $tag->slug;
		}
	}
   return $classes;
}
add_filter('post_class', 'download_tag_id_class');

if (!current_user_can('manage_options') ) { show_admin_bar(false); }

// EDD login
/**
 * Login / Register Functions
 *
 * @package     EDD
 * @subpackage  Functions/Login
 * @copyright   Copyright (c) 2013, Pippin Williamson
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;