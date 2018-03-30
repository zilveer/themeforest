<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for create a box of prices
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

	$last = ( isset($last) && $last == 'yes' ) ? ' last' : '';

    $centered = ( isset($centered) && $centered == 'yes' ) ? ' centered' : '';
    
    $content = str_replace( '<ul>', '', $content );
	$content = str_replace( '</ul>', '', $content );

    /* Empty <p> Fix*/
    $content = wpautop(trim($content));
    if (strpos($content,'<p>') && !strpos($content,'</p>')){
        $content = str_replace( '<p>', '', $content );
    }
    /* */

    /* splitting price in two part*/
    $price1=$price;
    $price2="";

    if(strpos($price1,$price_separator) !== false){
        $array=explode($price_separator,$price1);
        $price1=$array[0];
        $price2=$array[1];
    }
?>
<div class="one-third<?php echo esc_attr( $last . $vc_css ) ; ?>">
	<div class="price-table <?php echo $centered; ?>">
       <div class="price-table-container">
		<div class="head" style="background-color:<?php echo $color; ?>;">
			<h2 style="color:<?php echo $textcolor; ?>;"><?php echo $title; ?></h2>
		</div>
        <div class="price">

            <span class="prefix"><sup><?php echo $price_prefix; ?></sup></span>
            <span class="price" style="color:<?php echo $color; ?>"><?php echo $price1; ?></span>
            <span class="price-decimal" style="color:<?php echo $color; ?>"><sup><?php echo $price2; ?></sup></span>
            <span class="suffix"><?php echo $price_suffix; ?></span>

        </div>
		<div class="body">
			<ul>
				<?php echo do_shortcode($content); ?>
			</ul>
		</div>
        <div class="button-container">
            <?php if ( isset($href) && $href != '' && isset($buttontext) && $buttontext ) : ?>
              <a class="btn btn-alternative" href="<?php echo esc_url($href); ?>"><?php echo $buttontext; ?></a>
            <?php endif; ?>
        </div>
       </div>
	</div>
</div>