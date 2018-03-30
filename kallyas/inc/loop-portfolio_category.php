<?php if(! defined('ABSPATH')){ return; }
global $zn_config, $colWidth,$zn_link_portfolio,$ports_num_columns,$extra_content;
//Items per page
$ports_num_columns = ! empty( $zn_config['port_columns'] ) ? $zn_config['port_columns'] : zget_option( 'ports_num_columns', 'portfolio_options', false, '4' );
$extra_content = ! empty( $zn_config['ports_extra_content'] ) ? $zn_config['ports_extra_content'] : zget_option( 'ports_extra_content', 'portfolio_options', false, 'no' );
$saved_alt = $saved_title = '';
$colWidth = str_replace('.', '', 12 / intval($ports_num_columns));

// Check if PB Element has style selected, if not use Portfolio style option. If no blog style option, use Global site skin.
$portfolio_scheme_global = zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) != '' ? zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
$portfolio_scheme = isset($zn_config['portfolio_scheme']) && $zn_config['portfolio_scheme'] != '' ? $zn_config['portfolio_scheme'] : $portfolio_scheme_global;

$zn_link_portfolio = isset( $zn_config['zn_link_portfolio'] ) && !empty($zn_config['zn_link_portfolio']) ? $zn_config['zn_link_portfolio'] : zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' );

echo '<div class="row kl-portfolio-category portfolio-cat--'.$portfolio_scheme.' element-scheme--'.$portfolio_scheme.'">';

	the_archive_description( '<div class="col-sm-12"><div class="kl-portfolio-category-description u-mb-50">', '</div></div>' );

	$i = 0; // size(width) counter
	// Start the loop
	if ( have_posts() ) : while ( have_posts() ) :  the_post();

		get_template_part( 'inc/loop', 'portfolio_category_item' );

		if( ($i + 1) % intval($ports_num_columns) == 0 ){
			echo '<div class="clearfix hidden-xs hidden-sm hidden-md"></div>';
		}
		// Add clearfix for tablets on every 3rd
		elseif( ($i + 1) % 3 == 0 ){
			echo '<div class="clearfix hidden-sm hidden-lg"></div>';
		}

		$i++;
		endwhile;
	endif;
echo '</div>'; ?>
<div class="pagination--<?php echo $portfolio_scheme; ?>">
	<?php zn_pagination(); ?>
</div>
