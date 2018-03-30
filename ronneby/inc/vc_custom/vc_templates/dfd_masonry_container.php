<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$layout_style = $enable_sort_panel = $sort_panel_alignment = $categories_strings = $el_class = $columns_number_wide = $columns_number_normal = $columns_number_medium = $columns_number_small = $columns_number_mobile = '';
$args = array(
    'layout_style' => 'masonry',
    'enable_sort_panel' => '',
    'sort_panel_alignment' => 'text-left',
    'categories_strings' => '',
    'columns_number_wide' => '',
    'columns_number_normal' => '',
    'columns_number_medium' => '',
    'columns_number_small' => '',
    'columns_number_mobile' => '',
    'el_class' => ''
);
extract(shortcode_atts($args, $atts));

wp_enqueue_script('isotope');

$sort_panel_html = '';

if(strcmp($enable_sort_panel, 'enabled') === 0) {
	$order   = array("\r\n", "\n", "\r", "<br/>", "<br>");
	$replace = '|';

	$str = str_replace($order, $replace, $categories_strings);

	$lines = explode("|", $str);

	$sort_panel_html .= '<div class="sort-panel '.esc_attr($sort_panel_alignment).'">';
	$sort_panel_html .= '<ul class="filter filter-buttons">';
	$sort_panel_html .= '<li class="active"><a data-filter=".dfd-isotope-item" href="#">'. __('All', 'dfd') .'</a></li>';
	foreach($lines as $key => $line)  {
		$category_name = __(trim(htmlspecialchars_decode(strip_tags($line))),'js_composer');
		$sort_panel_html .= '<li><a href="#" data-filter=".dfd-isotope-item[data-category~=\''.strtolower(preg_replace('/\s+/', '-', $category_name)).'\']">'.esc_attr($category_name).'</a></li>';
	} 
	$sort_panel_html .= '</ul>';
	$sort_panel_html .= '</div>';
}	

$unique_id = uniqid('dfd-isotope-container-');

$output = '';


$output .= '<div id="'.esc_attr($unique_id).'" class="dfd-masonry-container-wrap '.esc_attr($el_class).'" data-dfd_style="'.esc_attr($layout_style).'" data-dfd_columns-wide="'.esc_attr($columns_number_wide).'" data-dfd_columns-normal="'.esc_attr($columns_number_normal).'" data-dfd_columns-medium="'.esc_attr($columns_number_medium).'" data-dfd_columns-small="'.esc_attr($columns_number_small).'" data-dfd_columns-mobile="'.esc_attr($columns_number_mobile).'">';
$output .= $sort_panel_html;
$output .= '<div class="dfd-masonry-container">';
$output .= do_shortcode($content);
$output .= '</div>';
$output .= '</div>';

ob_start();
?>
<script type="text/javascript">
(function($){
	"use strict";
	
	var $window = $(window);
	
	$(document).ready(function () {
		var $wrapper = $('#<?php echo esc_js($unique_id); ?>');
		var $container = $('.dfd-masonry-container', $wrapper);
		var $items = $('.dfd-isotope-item', $container);
		var layout_style = $wrapper.data('dfd_style');
		var columns_wide = $wrapper.data('dfd_columns-wide');
		var columns_normal = $wrapper.data('dfd_columns-normal');
		var columns_medium = $wrapper.data('dfd_columns-medium');
		var columns_small = $wrapper.data('dfd_columns-small');
		var columns_mobile = $wrapper.data('dfd_columns-mobile');
		
		if(!layout_style) layout_style = 'masonry';
		if(!columns_wide) columns_wide = 5;
		if(!columns_normal) columns_normal = 4;
		if(!columns_medium) columns_medium = 3;
		if(!columns_small) columns_small = 2;
		if(!columns_mobile) columns_mobile = 1;
		
		var columns = 3;
		var columnsWidth;

		var setColumns = function () {
			$items = $('.dfd-isotope-item', $container);
			var width = $container.width();

			switch(true) {
				case (width > 1280): columns = columns_wide; break;
				case (width > 1024): columns = columns_normal; break;
				case (width > 800): columns = columns_medium; break;
				case (width > 460): columns = columns_small; break;
				default: columns = columns_mobile;
			}

			columnsWidth = Math.floor($container.width() / columns);
			$items.width(columnsWidth);
		};

		var runIsotope = function() {
			setColumns();
			
			$container.isotope({
				layoutMode: layout_style,
				masonry: {
					columnWidth: columnsWidth
				},
				itemSelector : '.dfd-isotope-item', 
				resizable : true
			});
			
			$('body').bind('isotope-add-item', function(e, item) {
				$(item).width(columnsWidth);
				$(item).imagesLoaded(function() {
					$container.isotope('insert', $(item));
				});
			});
		};

		runIsotope();
		$container.imagesLoaded(runIsotope);
		
		$window.on('resize',runIsotope);

		$('.sort-panel .filter a', $wrapper).click(function () { 
			var selector = $(this).attr('data-filter');

			$(this).parent().parent().find('> li.active').removeClass('active');
			$(this).parent().addClass('active');

			$container.isotope( { 
				filter : selector 
			});

			return false;
		});
	});
	
})(jQuery);

</script>
<?php
$output .= ob_get_clean();

print $output;

