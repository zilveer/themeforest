<?php if(! defined('ABSPATH')){ return; }
$zn_sp_client = get_post_meta( get_the_ID(), 'zn_sp_client', true );
$zn_sp_year = get_post_meta( get_the_ID(), 'zn_sp_year', true );
$zn_sp_services = get_post_meta( get_the_ID(), 'zn_sp_services', true );
$sp_col = get_post_meta( get_the_ID(), 'zn_sp_col', true );

echo '<ul class="portfolio-item-details clearfix">';

if ( ! empty ( $zn_sp_client ) || ! empty ( $zn_sp_year ) || ! empty ( $zn_sp_services ) || ! empty ( $sp_col ) ) {

	if ( ! empty ( $zn_sp_client ) ) {
	echo '
		<li class="portfolio-item-details-client clearfix">
			<span class="portfolio-item-details-label">' . __( "CLIENT ", 'zn_framework' ) . '</span>
			<span class="portfolio-item-details-item">' . $zn_sp_client . '</span>
		</li>';
	}

	if ( ! empty ( $zn_sp_year ) ) {
	echo '
		<li class="portfolio-item-details-year clearfix">
			<span class="portfolio-item-details-label">' . __( "YEAR ", 'zn_framework' ) . '</span>
			<span class="portfolio-item-details-item">' . $zn_sp_year . '</span>
		</li>';
	}

	if ( ! empty ( $zn_sp_services ) ) {
	echo '
		<li class="portfolio-item-details-services clearfix">
			<span class="portfolio-item-details-label">' . __( "WE DID ", 'zn_framework' ) . '</span>
			<span class="portfolio-item-details-item">' . $zn_sp_services . '</span>
		</li>';
	}

	if ( ! empty ( $sp_col ) ) {
	echo '
		<li class="portfolio-item-details-partners clearfix">
			<span class="portfolio-item-details-label">' . __( "PARTNERS ", 'zn_framework' ) . '</span>
			<span class="portfolio-item-details-item">' . $sp_col . '</span>
		</li>';
	}
}

// Dynamic Rows
// $sp_show_dyn_rows = get_post_meta( get_the_ID(), 'sp_show_dyn_rows', true );
// if( !empty($sp_show_dyn_rows) && $sp_show_dyn_rows == 1){

	$sp_dyn_row = get_post_meta( get_the_ID(), 'sp_dyn_row', true );

	if(!empty($sp_dyn_row) && is_array($sp_dyn_row)){
		foreach($sp_dyn_row as $sp_row){
			echo '<li class="portfolio-item-details-dyn clearfix">';
			if( isset($sp_row['row_title']) && !empty($sp_row['row_title']) ){
				echo '<span class="portfolio-item-details-label">' . $sp_row['row_title'] . '</span>';
			}
			if( isset($sp_row['row_content']) && !empty($sp_row['row_content']) ){
				echo '<span class="portfolio-item-details-item">' . $sp_row['row_content'] . '</span>';
			}
			echo '</li>';
		}
	}
// }

// Show Category
$sp_cat = get_post_meta( get_the_ID(), 'sp_show_cat', true );
$sp_cat = empty ( $sp_cat ) ? 'yes' : $sp_cat;
if( $sp_cat != 'no' ){
	echo '
		<li class="portfolio-item-details-cat clearfix">
			<span class="portfolio-item-details-label">' . __( "CATEGORY ", 'zn_framework' ) . '</span>
			<span class="portfolio-item-details-item">' . get_the_term_list( get_the_ID(), 'project_category', '', ' , ', '' ) . '</span>
		</li>';
}

echo '</ul>';
