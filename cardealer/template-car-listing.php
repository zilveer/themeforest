<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Template Name: Car Listings
 */

global $wpdb, $post;

$car_condition       = 0;
$carlocation         = array( 0 );
$carproducer         = 0;
$carmodels           = 0;
$car_price_min       = 0;
$car_price_max       = 0;
$car_year_from       = 1900;
$car_year_to         = date( "Y" );
$car_fuel_type       = "";
$car_body            = "";
$car_doors_count     = 0;
$car_interrior_color = "";
$car_exterior_color  = "";
$car_transmission    = "";
$car_mileage_from    = 0;
$car_mileage_to      = 0;
$adv_params          = array();
$per_page            = 0;


if ( isset( $_GET['car_condition'] ) ) {
	$car_condition = $_GET['car_condition'];
}

if ( isset( $_GET['carlocation'] ) ) {
	$carlocation = explode( ',', $_GET['carlocation'] );
	$carlocation = array_map( 'intval', $carlocation );
}

if ( isset( $_GET['carproducer'] ) ) {
	$carproducer = $_GET['carproducer'];
}

if ( isset( $_GET['carmodels'] ) ) {
	$carmodels = $_GET['carmodels'];
}

if ( isset( $_GET['car_price_min'] ) ) {
	$car_price_min = intval( $_GET['car_price_min'] );
}

if ( isset( $_GET['car_price_max'] ) ) {
	$car_price_max = intval( $_GET['car_price_max'] );
}

if ( isset( $_GET['car_year_from'] ) && $_GET['car_year_from'] !== 'any' ) {
	$car_year_from = intval( $_GET['car_year_from'] );
}

if ( isset( $_GET['car_year_to'] ) && $_GET['car_year_to'] !== 'any' ) {
	$car_year_to = intval( $_GET['car_year_to'] );
}

if ( isset( $_GET['car_fuel_type'] ) ) {
	$car_fuel_type = $_GET['car_fuel_type'];
}

if ( isset( $_GET['car_body'] ) ) {
	$car_body = $_GET['car_body'];
}

if ( isset( $_GET['car_doors_count'] ) ) {
	$car_doors_count = intval( $_GET['car_doors_count'] );
}

if ( isset( $_GET['car_interrior_color'] ) ) {
	$car_interrior_color = $_GET['car_interrior_color'];
}

if ( isset( $_GET['car_exterior_color'] ) ) {
	$car_exterior_color = $_GET['car_exterior_color'];
}

if ( isset( $_GET['car_transmission'] ) ) {
	$car_transmission = $_GET['car_transmission'];
}

if ( isset( $_GET['car_mileage_from'] ) ) {
	$car_mileage_from = $_GET['car_mileage_from'];
}

if ( isset( $_GET['car_mileage_to'] ) ) {
	$car_mileage_to = intval( $_GET['car_mileage_to'] );
}

if ( isset( $_GET['adv_params'] ) ) {
	$adv_params = unserialize( base64_decode( $_GET['adv_params'] ) );
}


$meta_query_array = array();

if ( $car_condition === 'car_is_new' || $car_condition === 'car_is_damaged' || $car_condition === 'car_is_used' ) {
	$meta_query_array[] = array(
		'key'     => ( $car_condition === 'car_is_used' ) ? 'used_car' : $car_condition,
		'value'   => 1,
		'type'    => 'numeric',
		'compare' => '='
	);
}

if ( $carlocation[0] !== 0 ) {
	$meta_query_array[] = array(
		'key'     => 'car_carlocation_' . count( $carlocation ),
		'value'   => end( $carlocation ),
		'type'    => 'numeric',
		'compare' => '='
	);
}

if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
	$meta_query_array[] = array(
		'key'     => '_icl_lang_duplicate_of',
		'value'   => '',
		'compare' => 'NOT EXISTS'
	);
}

if ( $car_year_from > $car_year_to ) {
	$car_year_from = $car_year_to;
}

$car_year_range     = range( $car_year_from, $car_year_to );
$car_year_range[]   = '';
$meta_query_array[] = array(
	'key'     => 'car_year',
	'value'   => $car_year_range,
	'type'    => 'numeric',
	'compare' => 'IN'
);

$tax_query_array = array();

if ( $carproducer > 0 ) {
	if ( $carmodels == 0 ) { //chooce all models of producer
		$tax_query_array[] = array(
			'taxonomy' => 'carproducer',
			'field'    => 'term_id',
			'terms'    => array( $carproducer ),
		);
	} else { //chooce only selected models of producer
		$tax_query_array[] = array(
			'taxonomy' => 'carproducer',
			'field'    => 'term_id',
			'terms'    => array( $carmodels ),
		);
	}
}

if ( ! empty( $car_body ) ) {
	$meta_query_array[] = array(
		'key'     => 'car_body',
		'value'   => $car_body,
		'compare' => '='
	);
}


if ( ! empty( $car_interrior_color ) ) {
	$meta_query_array[] = array(
		'key'     => 'car_interrior_color',
		'value'   => $car_interrior_color,
		'compare' => '='
	);
}


if ( ! empty( $car_exterior_color ) ) {
	$meta_query_array[] = array(
		'key'     => 'car_exterior_color',
		'value'   => $car_exterior_color,
		'compare' => '='
	);
}

if ( ! empty( $car_doors_count ) ) {
	$meta_query_array[] = array(
		'key'     => 'car_doors_count',
		'value'   => $car_doors_count,
		'type'    => 'numeric',
		'compare' => '='
	);
}

if ( ! empty( $car_fuel_type ) ) {
	$meta_query_array[] = array(
		'key'     => 'car_fuel_type',
		'value'   => $car_fuel_type,
		'compare' => '='
	);
}

if ( ! empty( $car_transmission ) ) {
	$meta_query_array[] = array(
		'key'     => 'car_transmission',
		'value'   => $car_transmission,
		'compare' => '='
	);
}


if ( $car_condition !== 'car_is_new' ) {

	if ( $car_mileage_from > 0 AND $car_mileage_to == 0 ) {
		$car_mileage_to = 99999999;
	}

	if ( $car_mileage_from > $car_mileage_to ) {
		$car_mileage_from = $car_mileage_to = 0;
	}

	if ( $car_mileage_to > 0 ) {
		$meta_query_array[] = array(
			'key'     => 'car_mileage',
			'value'   => array( $car_mileage_from, $car_mileage_to ),
			'type'    => 'numeric',
			'compare' => 'BETWEEN'
		);
	}
}


if ( $car_price_max > 0 ) {
	if ( $car_price_max >= $car_price_min ) {
		$meta_query_array[] = array(
			'key'     => 'car_price',
			'value'   => array( $car_price_min, $car_price_max ),
			'type'    => 'numeric',
			'compare' => 'BETWEEN'
		);
	}
}


/* Advanced options */
if ( isset( $adv_params['advanced'] ) && ! empty( $adv_params['advanced'] ) ) {
	foreach ( $adv_params['advanced'] as $group_key => $group_values ) {
		if ( ! empty( $group_values ) ) {
			foreach ( $group_values as $value_key => $value ) {
				if ( $value ) {
					$s = count( $value );
					if ( is_string( $value ) ) {
						$s = strlen( $value );
					}
					$meta_query_array[] = array(
						'key'     => 'advanced',
						'value'   => '"' . $value_key . '";s:' . $s . ':"' . $value . '";',
						'compare' => 'LIKE'
					);
				}
			}
		}
	}
}

/* Order */
$orderby_array = array(
	'post_date' => __( "Post date", 'cardealer' ),
	'car_price'     => __( "Price", 'cardealer' ),
	'car_mileage'   => __( "Mileage", 'cardealer' ),
	'car_year'      => __( "YOR", 'cardealer' ),
);

$orderby       = 'post_date';
if ( isset( $_GET['orderby'] ) ) {
	$orderby = $_GET['orderby'];
}

$order = 'DESC';
if ( isset( $_GET['order'] ) ) {
	$order = $_GET['order'];
}

/* Thumbnail size */
$thumbnail_size = TMM::get_option('car_listing_thumbnail_size', TMM_APP_CARDEALER_PREFIX) ? TMM::get_option('car_listing_thumbnail_size', TMM_APP_CARDEALER_PREFIX) : 'large';
$pagination_values = array(
	'small' => array(6, 12, 18, 24, 30),
	'middle' => array(4, 8, 12, 16, 20, 24, 36),
	'large' => array(3, 6, 9, 12, 15, 30, 45, 60),
);

/* Pagination */
$pagination_values = $pagination_values[$thumbnail_size];

if ( isset( $_GET['per_page'] ) ) {
	$per_page = (int) $_GET['per_page'];
} else if (TMM::get_option('car_listing_items_per_page', TMM_APP_CARDEALER_PREFIX)) {
	$per_page = (int) TMM::get_option('car_listing_items_per_page', TMM_APP_CARDEALER_PREFIX);
} else {
	$per_page = $pagination_values[0];
}

/* Content */
$content = get_the_content();
$layout_content = get_post_meta(get_the_ID(), 'thememakers_layout_constructor', true);

get_header();
?>

<?php if (!empty($content) || !empty($layout_content)) { ?>
	<div class="entry-body">
		<?php
		the_content();
		tmm_link_pages();
		tmm_layout_content(get_the_ID());
		?>
	</div><!--/ .entry-body -->
<?php } ?>

	<?php $GLOBALS['tmm_car_listing_layout_switcher'] = 1; ?>
	<?php get_template_part('content', 'header'); ?>

	<div class="page-subheader sorting">

		<div class="sort-by"><?php _e( "Sort by:", 'cardealer' ) ?></div>

		<ul class="sort-by-list">

			<?php foreach ( $orderby_array as $key => $value ) { ?>
				<li class="<?php echo ( $orderby == $key ) ? 'active' : '' ?>">
					<a href="javascript:void(0);"
					   class="js_order_cars_by order_cars_by search_order_<?php echo strtolower( $order ) ?>"
					   data-orderby="<?php echo $key ?>"
					   data-order="<?php echo ($orderby === $key && $order == 'DESC') ? 'ASC' : 'DESC'; ?>"<?php echo strtoupper( $value ) == 'YOR' ? ' title="Year of registration"' : ''; ?>>
						<?php echo $value ?>
					</a>
				</li>
			<?php } ?>

		</ul><!--/ .sort-by-list-->

		<div class="items-per-page">

			<label for="items_per_page"><b><?php _e( "Items per page:", 'cardealer' ) ?></b></label>

			<div class="sel">
				<select id="items_per_page" name="per_page">
					<?php foreach ( $pagination_values as $value ) { ?>
						<option <?php selected($per_page, $value) ?>
							value="<?php echo $value ?>"><?php echo $value ?></option>
					<?php } ?>
				</select>
			</div><!--/ .sel-->

		</div><!--/ .items-per-page-->

	</div><!--/ .page-subheader-->

<?php
$meta_query_array = array_merge( array( 'relation' => 'AND' ), $meta_query_array );

//query without featured car
if (is_front_page()) {
	$cur_page = get_query_var('page');
} else {
	$cur_page = get_query_var('paged');
}

$args = array(
	'post_type'   => TMM_Ext_PostType_Car::$slug,
	'meta_query'  => $meta_query_array,
	'tax_query'   => $tax_query_array,
	'post_status' => array( 'publish' ),
	'paged'       => $cur_page ? $cur_page : 1,
	'orderby'     => $orderby,
	'order'       => $order,
);

if ( $per_page > 0 ) {
	$args = array_merge( $args, array( 'posts_per_page' => $per_page ) );
}

if ( $orderby != 'post_date' ) {
	$meta_order_array = array(
		'orderby'  => 'meta_value_num',
		'meta_key' => $orderby
	);
	$args             = array_merge( $args, $meta_order_array );
}

global $wp_query;
$old_wp_query = $wp_query;
$wp_query = new WP_Query( $args );

//step 1
$request = str_replace( "SQL_CALC_FOUND_ROWS", "", $wp_query->request );
//step 2
$tmp_request_array1 = explode( 'WHERE 1=1', $request );
$tmp_request_array1[0] .= " INNER JOIN $wpdb->postmeta featured ON ($wpdb->posts.ID = featured.post_id) ";
$request = $tmp_request_array1[0] . " WHERE 1=1 " . $tmp_request_array1[1];
//step 3
$tmp_request_array1 = explode( 'ORDER BY', $request );
$tmp_request_array2 = explode( $order, $tmp_request_array1[1] );

$order = esc_sql($order);

if ( $orderby == 'post_date' ) {
	$request = $tmp_request_array1[0] . ' ORDER BY ' . "featured.meta_value DESC, $wpdb->posts.post_date $order" . $tmp_request_array2[1];
} else {
	$request = $tmp_request_array1[0] . ' ORDER BY ' . "featured.meta_value DESC, $wpdb->postmeta.meta_value+0 $order" . $tmp_request_array2[1];
}
//step 4
$tmp_request_array1 = explode( 'GROUP BY', $request );
$request            = $tmp_request_array1[0] . " AND ( (featured.meta_key = 'car_is_featured') ) " . " GROUP BY " . $tmp_request_array1[1];

//if sorting by post_date,car_price,car_mileage
if ( $orderby != 'car_year' AND $orderby != 'post_date' ) {
	$orderby = esc_sql($orderby);
	$request = str_replace( "wp_postmeta.meta_key = 'car_year'", "wp_postmeta.meta_key = '$orderby'", $request );
	$request = str_replace( "AND CAST(wp_postmeta.meta_value AS SIGNED) BETWEEN '$car_year_from' AND '$car_year_to'", "", $request );
}

$posts = array();
$tmp            = $wpdb->get_results( $request, ARRAY_N );
foreach ( $tmp as $value ) {
	$posts[] = $value[0];
}

if ( !empty($posts) ) {
	?>

	<div id="change-items" class="row tmm-view-mode <?php echo tmm_get_car_listing_layout_type() ?>">

		<?php
		foreach ( $posts as $post_id ) {
			$GLOBALS['post_id']                 = $post_id;
			$GLOBALS['featured_cars_autoslide'] = (bool) TMM::get_option( 'autoslide_featured_cars', TMM_APP_CARDEALER_PREFIX );
			$GLOBALS['thumbnail_size']          = $thumbnail_size;
			get_template_part( 'article', 'car' );
		}
		?>

	</div><!--/ #change-items-->

	<?php
} else {
	_e( "NO RESULTS!", 'cardealer' );
}

$show_total_items = true;
get_template_part( 'content', 'pagenavi' );

$wp_query = $old_wp_query;
wp_reset_postdata();

get_footer();
