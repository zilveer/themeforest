<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Markup of frontend
 *
 * @use $portfolio \YIT_Portfolio_Object The object of portfolio
 */
?>

<div class="row portfolio-filterable-container">
    <?php
    $sidebar = yit_get_sidebars();
    $layout_sidebar = $sidebar['layout'];
    if ( $portfolio->get( 'config-activate_filters' ) ):
    ?>

        <div class="filters-container">
            <ul class="filters">
                <li><a href="#" class="active all" data-option-value="*"><?php _e( 'All', 'yit' )?></a></li>
                <?php
                $terms_array = $portfolio->get_terms();
                if( $terms_array != '' && ! is_a( $terms_array, 'WP_Error' ) && is_array( $terms_array ) ) :
                    foreach ( $terms_array as $term ) :
                    ?>
                        <li><a href="#" data-option-value=".<?php echo $term->slug ?>"><?php echo $term->name ?></a></li>
                    <?php
                    endforeach;
                endif;
                ?>
            </ul>
        </div>

    <?php endif; ?>

    <div class="portfolio-<?php echo $layout ?>">
        <ul id="portfolio_filterable" class="clearfix <?php echo $layout_sidebar?> <?php echo ( $portfolio->get( 'config-items_per_row' ) == '4' ) ? 'four-for-row' : 'three-for-row'?>">
            <?php
            $index = 0;
            //Sets classes for the element
            if( $portfolio->get( 'config-items_per_row' ) == '4' ){
                if( $layout_sidebar == 'sidebar-no' ){
                    $default_classes = "filterable_item col-sm-3 col-xs-6";
                }
                else {
                    $default_classes = "filterable_item col-lg-3 col-sm-6 col-xs-6";
                }
            }
            else{
                if ( $layout_sidebar == 'sidebar-double' ) {
                    $default_classes = "filterable_item col-lg-4 col-sm-6 col-xs-6";
                }
                else {
                    $default_classes = "filterable_item col-sm-4 col-xs-6";
                }
            }

            while ( $portfolio->have_posts() ) :
                $portfolio->the_post();

                $enable_title = $portfolio->get( 'config-enable_title' );
                $enable_categories = $portfolio->get( 'config-enable_categories' );
                $enable_hover = $portfolio->get( 'config-enable_hover' ) && ( $enable_title || $enable_categories);

                $classes = $default_classes;

                //Retrive terms of the post
                $terms = $portfolio->terms_array();
                if ( $terms !== FALSE && is_array( $terms ) ) {
                    foreach ( $terms as $term ) {
                        $classes .= " " . $term->slug;
                    }
                }

				if ( ( $index % $portfolio->get( 'config-items_per_row' ) ) == 0 ) {
					$classes .= " first";
				}

				if ( $portfolio->get( 'config-enable_quick_view' ) ) {
					$classes .= " quick-view";
				}

                $index ++;
                ?>
                <li <?php $portfolio->item_class( $classes )?>>
                    <div class="portfolio-thumb">
                        <?php
                        $image = $portfolio->get_image( 'portfolio_filterable', array( 'class' => 'img-responsive' ) );
                        if ( strcmp( $image, '' ) != 0 ) {
                            echo $image;
                        }
                        else {
                            ?>
                            <img src="<?php echo $portfolio->get( 'baseurl' ) ?>images/no-image.jpg" class="img-responsive" />
                            <?php
                        }
                        ?>
                        <?php if ( $enable_hover ):?>
                        <div class="portfolio-overlay">
                            <div class="portfolio-overlay-info">
                                <?php if ( $enable_title ):?>
                                <div class="portfolio-overlay-title">
                                    <a href="<?php echo $portfolio->get( 'permalink' ); ?>"><?php echo $portfolio->get( 'title' ); ?></a>
                                </div>
                                <?php endif; ?>
                                <?php if ( $enable_categories ):?>
                                <div class="portfolio-overlay-categories">
                                    <?php echo $portfolio->terms_list( ', ' ); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
						<a href="<?php echo $portfolio->get( 'permalink' ); ?>"
						   class="trigger-item<?php echo $portfolio->get('config-enable_quick_view') ? ' quick-view' : '' ?>"
						   id="item-<?php echo $portfolio->get('ID') ?>-<?php echo $this->index ?>"
						   data-item_id="<?php echo $portfolio->get('ID') ?>"></a>
                    </div>
                    <div class="portfolio-title">
                        <a href="<?php echo $portfolio->get( 'permalink' ); ?>"><?php echo $portfolio->get( 'title' ); ?></a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>

<div class="clearfix"></div>
<?php $portfolio->pagination(); ?>

<?php if ( $portfolio->get( 'config-activate_filters' ) ):?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
		"use strict";

		if ( $.fn.isotope && $.fn.imagesLoaded ) {

			//filterable
			var container = $('#portfolio_filterable'),
				filters = $('ul.filters');

			container.imagesLoaded(function () {
				container.isotope({
					layoutMode             : 'fitRows',
					itemSelector           : 'li.filterable_item',
					itemPositionDataEnabled: true
				});
			});

			filters.on( 'click', 'li a', function(e) {
				e.preventDefault();

				var trigger = $(this),
					selector = trigger.data('option-value');

				trigger.closest('ul').find('a').removeClass('active');
				trigger.addClass('active');

				container.isotope({ filter: selector });
			});

			filters.find('li a').filter(':first').click();

			_onresize( function () {
				filters.find('li a.active').trigger('click');
			} );

		}
    });
</script>
<?php endif; ?>

<?php $portfolio->reset_query() ?>