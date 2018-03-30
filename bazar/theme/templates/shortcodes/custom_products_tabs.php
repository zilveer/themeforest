<?php
	wp_enqueue_script( 'caroufredsel' );
	wp_enqueue_script( 'touch-swipe' );
	wp_enqueue_script( 'mousewheel' );

global $yit_products_tabs_index;
if ( ! isset( $yit_products_tabs_index )  ) $yit_products_tabs_index = 0;

$sc = array();

?>
<div class="tabs-container products_tabs">
	<ul class="tabs">
		<?php for( $i = 1; isset($var['title_'.$i]); $i++ ) :
            $title = ( !empty( $var['title_'.$i] ) ) ? $var['title_'.$i] : '' ;
            $per_page = ( !empty( $var['per_page_'.$i] ) ) ? $var['per_page_'.$i] : '0' ;
            $category = ( !empty( $var['category_'.$i] ) ) ? $var['category_'.$i] : '0' ;
            $show = ( !empty( $var['show_'.$i] ) ) ? $var['show_'.$i] : 'all' ;
            $featured = $best_sellers = $on_sale = 'no';
            if ( $show == 'featured' ) { $featured = 'yes'; }
            elseif ( $show == 'best_sellers' ) { $best_sellers = 'yes'; }
            elseif ( $show == 'onsale' ) { $on_sale = 'yes'; }
            $orderby = ( !empty( $var['orderby_'.$i] ) ) ? $var['orderby_'.$i] : '0' ;
            $order = ( !empty( $var['order_'.$i] ) ) ? $var['order_'.$i] : '0' ;

            echo '<li><h4><a href="javascript:void()" data-tab="tab-' . $yit_products_tabs_index . '" title="' . $title . '">' . $title . '</a></h4></li>';
            $sc[$yit_products_tabs_index] = '[products_slider title="' . $title . '" per_page="' . $per_page . '" featured="' . $featured . '" best_sellers="' . $best_sellers . '" on_sale="' . $on_sale . '" category="' . $category . '" orderby="' . $orderby . '" order="' . $order . '" layout="default" ]';
            $yit_products_tabs_index++;

        endfor ?>
	</ul>
	<div class="border-box group">
        <?php foreach ( $sc as $sc_key => $sc_value ) { ?>
            <div id="tab-<?php echo $sc_key ?>" class="panel group"><?php echo do_shortcode( $sc_value ); ?></div>
        <?php } ?>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
<?php global $woocommerce_loop; ?>
jQuery(function($){
	var carouFredSel;
	var carouFredSelOptions = {
		responsive: false,
		auto: true,
		items: <?php echo empty( $woocommerce_loop['columns'] ) ? 3 : $woocommerce_loop['columns'] ?>,
		circular: true,
		infinite: true,
		debug: false,
        prev: '.section-portfolio-slider .prev',
        next: '.section-portfolio-slider .next',
        swipe: {
          	onTouch: true
        },
        scroll : {
            items     : 1,
            pauseOnHover: true
        }
	};

	$('.panel', $('.products_tabs')).on('yit_tabopened', function(){

		var t = $(this);
   		var prev = $(this).find('.es-nav-prev');
   		var next = $(this).find('.es-nav-next');

   		carouFredSelOptions.prev = prev;
   		carouFredSelOptions.next = next;

		if( $('body').outerWidth() <= 767 ) {
			t.find('li').each(function(){
				$(this).width( t.width() );
			});

			carouFredSelOptions.items = 1;
		} else {
			t.find('li').each(function(){
				$(this).attr('style', '');
			});

			carouFredSelOptions.items = <?php echo empty( $woocommerce_loop['columns'] ) ? 3 : $woocommerce_loop['columns'] ?>;
		}

		carouFredSel = $(this).find('.products').carouFredSel(carouFredSelOptions);
	});

    $('.panel', $('.products_tabs')).on('yit_tabclosed', function(){
    	//carouFredSel.trigger('destroy', false).attr('style','');
    });

    // create slider when page is loaded
    $('.panel', $('.products_tabs')).imagesLoaded(function(){
        $(window).trigger('resize');
    });

    $(window).resize(function(){
    	var t = carouFredSel.parents('.panel');
    	carouFredSel.trigger('destroy', false).attr('style','');

		if( $('body').outerWidth() <= 767 ) {
			t.find('li').each(function(){
				$(this).width( t.width() );
			});

			carouFredSelOptions.items = 1;
		} else {
			t.find('li').each(function(){
				$(this).attr('style', '');
			});

			carouFredSelOptions.items = <?php echo empty( $woocommerce_loop['columns'] ) ? 3 : $woocommerce_loop['columns'] ?>;
		}

    	carouFredSel.carouFredSel(carouFredSelOptions);
    });

    $(document).on('feature_tab_opened', function(){ $(window).trigger('resize') } );
});
</script>