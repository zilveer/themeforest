<?php
/* **********************************************************
 * RMS PRICING TABLE 
 * **********************************************************/
function rms_pricegroup($params, $content = null)
{
    extract( shortcode_atts( array(
    	'id' => rand(100,1000),
        'width' => 'one_fourth'
    ), $params ) );
    
    $content = do_shortcode($content);
    
    if($width == 'one_third'):
    $tg = '<div class="col-md-4 col-lg-4"><div class="card-container"><div class="card click price-table" data-direction="right">'.$content.'</div></div></div>';
    else:
    $tg = '<div class="col-md-4 col-lg-4"><div class="card-container"><div class="card click price-table" data-direction="right">'.$content.'</div></div></div>';   
    endif;

    return $tg;
    
}

function rms_priceheading($params2, $content = null)
{
    extract(shortcode_atts(array(
        'amount'     => '',
        'title'      => ''
    ), $params2, 'rms-priceheading'));
    
    $content = do_shortcode($content);
    
        $rma = '<div class="front price-table-header">
					<p class="price">'.esc_html($amount).'</p>
					<p class="title">'.esc_html($title).'</p>
				</div>';
        
    return $rma; 
}


function rms_pricefull($params, $content = null)
{
    extract( shortcode_atts( array(
    	'id' => rand(100,1000),
        'width' => 'one_fourth'
    ), $params ) );
    
    $content = do_shortcode($content);
	
    $tfull = '<div class="back"><ul class="price-table-description">'.$content.'</ul></div>';

    return $tfull;
    
}


function rms_pricedata($params3, $content = null)
{
    extract(shortcode_atts(array(
        'amount'     => '',
        'title'      => ''
    ), $params3));
    
    $rmt = '<li class="description-item">'.$content.'</li>';
    
    return $rmt;
}

add_shortcode('rms-pricgroup', 'rms_pricegroup');
add_shortcode('rms-priceheading', 'rms_priceheading');
add_shortcode('rms-pricefull', 'rms_pricefull');
add_shortcode('rms-pricedata', 'rms_pricedata');