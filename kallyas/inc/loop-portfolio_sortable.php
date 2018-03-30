<?php if(! defined('ABSPATH')){ return; }
global $zn_config;
	wp_enqueue_script( 'isotope');

	$classes[] = 'hg-portfolio-sortable kl-ptfsortable';

	// Check if PB Element has style selected, if not use Portfolio style option. If no blog style option, use Global site skin.
	$portfolio_scheme_global = zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) != '' ? zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
	$portfolio_scheme = isset($zn_config['portfolio_scheme']) && $zn_config['portfolio_scheme'] != '' ? $zn_config['portfolio_scheme'] : $portfolio_scheme_global;
	$classes[] = 'portfolio-sort--' . $portfolio_scheme;
	$classes[] = 'element-scheme--' . $portfolio_scheme;

	$classes[] = 'kl-ptfsortable-toolbar-' . ( isset( $zn_config['ptf_cats_align'] ) ? $zn_config['ptf_cats_align'] : 'left' );

	$load_more =  isset( $zn_config['ptf_sort_loadmore'] ) ? $zn_config['ptf_sort_loadmore'] : zget_option( 'ptf_sort_loadmore', 'portfolio_options', false, 'no' );

	// Show/hide Sort by toolbar
	$show_sortbar = isset($zn_config['ptf_show_sort']) && !empty($zn_config['ptf_show_sort']) ? $zn_config['ptf_show_sort'] : 'yes';

	// Default sort by - type
	$sort_type = ! empty($zn_config['ptf_sortby_type']) ? $zn_config['ptf_sortby_type'] : 'date';
	$sort_dir = 'desc';
	if( ! empty($zn_config['ptf_sort_dir']) ){
		$sort_dir = $zn_config['ptf_sort_dir'];
	}

?>
	<div class="<?php echo implode(' ', $classes); ?>" data-sortby="<?php echo $sort_type ?>" data-sortdir="<?php echo $sort_dir ?>">

	<?php if( $show_sortbar == 'yes' ){ ?>

		<div id="sorting" class="ptf-stb-sorting kl-ptfsortable-sorting kl-font-alt fixclear">

			<span class="sortTitle kl-ptfsortable-sorting-title"> <?php _e( "Sort By:", 'zn_framework' ); ?> </span>
			<ul id="sortBy" class="kl-ptfsortable-sorting-lists kl-ptfsortable-sorting-sortby ptf-stb-sortby option-set ">
				<li class="kl-ptfsortable-sorting-li"><a class="kl-ptfsortable-sorting-link" href="#sortBy=name" data-option-value="name"><?php _e( "Name", 'zn_framework' ); ?></a></li>
				<li class="kl-ptfsortable-sorting-li"><a class="kl-ptfsortable-sorting-link" href="#sortBy=date" data-option-value="date"><?php _e( "Date", 'zn_framework' ); ?></a></li>
			</ul>

			<span class="sortTitle kl-ptfsortable-sorting-title"> <?php _e( "Direction:", 'zn_framework' ); ?> </span>
			<ul id="sort-direction" class="kl-ptfsortable-sorting-lists kl-ptfsortable-sorting-dir ptf-stb-direction option-set">
				<li class="kl-ptfsortable-sorting-li"><a class="kl-ptfsortable-sorting-link" href="#sortAscending=true" data-option-value="true"><?php _e( "ASC", 'zn_framework' ); ?></a></li>
				<li class="kl-ptfsortable-sorting-li"><a class="kl-ptfsortable-sorting-link" href="#sortAscending=false" data-option-value="false"><?php _e( "DESC", 'zn_framework' ); ?></a></li>
			</ul>

		</div>
	<?php } ?>

		<!-- end sorting toolbar -->

		<?php if ( ! is_tax() || isset( $zn_config['portfolio_categories'] ) ) {

			$ptf_current = !empty( $zn_config['ptf_sort_activebutton'] ) ? $zn_config['ptf_sort_activebutton'] : zget_option('ptf_sort_activebutton', 'portfolio_options', false, '*');

			?>
			<ul id="portfolio-nav" class="ptf-stb-ptfnav kl-ptfsortable-nav kl-font-alt fixclear">
				<li class="<?php if($ptf_current == '*') echo 'current'; ?> kl-ptfsortable-nav-item"><a class="kl-ptfsortable-nav-link" href="#" data-filter="*"><?php _e( "All", 'zn_framework' ); ?></a></li>
				<?php

					$args = array ();

					if ( isset( $zn_config['portfolio_categories'] ) ) {
						$args = array (
							'include' => $zn_config['portfolio_categories'],
						);
					}

					$terms = get_terms( 'project_category', $args );
					foreach ( $terms as $term ) {
						$current = $term->term_id == $ptf_current ? 'current' : '';
						echo '<li class="'.$current.' kl-ptfsortable-nav-item"><a class="kl-ptfsortable-nav-link" href="#' . $term->slug . '" data-filter=".' . $term->slug . '_sort">' . $term->name . '</a></li>';
					}

				?>

			</ul><!-- end nav toolbar -->
		<?php } ?>

		<div class="clearfix"></div>

		<?php
		// Set num columns
		$numColumns = !empty( $zn_config['port_columns'] ) ? $zn_config['port_columns'] : zget_option('ports_num_columns', 'portfolio_options', false, 4);
		?>
		<ul id="thumbs" class="ptf-stb-thumbs kl-ptfsortable-items fixclear" data-columns="<?php echo $numColumns;?>" data-layout-mode="<?php echo apply_filters('zn_portfolio_sortable_layoutmode', 'masonry'); ?>">
			<?php
				if ( have_posts() ): while ( have_posts() ): the_post();

				get_template_part( 'inc/loop','portfolio_sortable_content' );

				endwhile; endif;
			?>
		</ul>
		<?php
			// Show load more
			if( $load_more === 'yes' ){
				$portfolio_per_page_show = ! empty( $zn_config['posts_per_page'] ) ? $zn_config['posts_per_page'] : zget_option( 'portfolio_per_page_show', 'portfolio_options', false, '4' );
				$category = array();
				if( isset( $zn_config['portfolio_categories'] ) && is_array( $zn_config['portfolio_categories'] ) ){
					$category = $zn_config['portfolio_categories'];
				}
				elseif( is_tax() ){
					$category = array( get_queried_object()->term_id );
				}

				// Check to see the total number of pages
				global $wp_query;
				$disabled_class = $wp_query->max_num_pages == 1 ? 'zn_loadmore_disabled' : '';

				$ptf_show_title = isset($zn_config['ptf_show_title']) && !empty($zn_config['ptf_show_title']) ? $zn_config['ptf_show_title'] : 'yes';
				$ptf_show_desc = isset($zn_config['ptf_show_desc']) && !empty($zn_config['ptf_show_desc']) ? $zn_config['ptf_show_desc'] : 'yes';

				$config = array(
					'show_item_title' => $ptf_show_title,
					'show_item_desc' => $ptf_show_desc,
				);

				echo '<div class="clearfix"></div>';
				echo '<a class="znprt_load_more_button kl-ptfsortable-loadmore btn btn-lined lined-custom '.$disabled_class.'" data-show_item_desc="'. $ptf_show_desc .'" data-show_item_title="'. $ptf_show_title .'" data-page="1" data-ppp="'.$portfolio_per_page_show.'" data-categories="'.implode( ',',$category ).'" href="#">'.__( 'Load more', 'zn_framework' ).'</a>';
			}

		?>



		<!-- end items list -->
	</div>
	<!-- end Portfolio page -->
