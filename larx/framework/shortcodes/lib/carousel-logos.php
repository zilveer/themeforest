<?php

/*-----------------------------------------------------------------------------------*/
/*	Logos Carousel
/*-----------------------------------------------------------------------------------*/

function th_logos($atts, $content = null) {
    extract(shortcode_atts(array(
        "images" => '',
        "onclick" => '',
        "custom_links" => '',
		"url_target" => '_self'
    ), $atts));


    ob_start();

    ?>

    <div class="row">

        <div id="owl-demo">

			<?php

			$link_href = '';

			if($onclick == 'custom_link') {
				$custom_links = explode(',',$custom_links);
			}

			$images = explode( ',', $images );
			$i = - 1;

			foreach ( $images as $attach_id ) {
				$i ++;
				$link_href = '';
				if($onclick == 'custom_link') {
					$link_href = ' href="'.$custom_links[$i].'"';
				}
				$img = wp_get_attachment_image_src($attach_id, 'full');

				echo '<a'.$link_href.' target="'.$url_target.'" class="item"><img src="'.$img[0].'" alt></a>';
			}


	echo '</div></div><!-- /row -->';

	$content = ob_get_contents();
	ob_end_clean();

	return $content;

}
remove_shortcode('logos_carousel');
add_shortcode('logos_carousel', 'th_logos');