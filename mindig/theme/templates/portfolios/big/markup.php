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

$sidebar = yit_get_sidebars();
$layout_sidebar = $sidebar['layout'];
$thumbs = '';
?>

<div class="portfolio-<?php echo $layout ?>">

    <?php if ( $portfolio->get( 'config-activate_filters' ) ) : ?>
        <?php yit_get_template( 'portfolios/common/filters.php', array( 'portfolio' => $portfolio )); ?>
    <?php endif; ?>

    <ul id="portfolio_big" class="wrapper">

        <?php

        while ( $portfolio->have_posts() ) : $portfolio->the_post();

            $enable_thumbnail   = $portfolio->get( 'config-enable_thumbnail' );
            $enable_title       = $portfolio->get( 'config-enable_title' );
            $enable_categories  = $portfolio->get( 'config-enable_categories' );
            $enable_excerpt     = $portfolio->get( 'config-enable_excerpt' );
            $enable_extra_info  = $portfolio->get( 'config-enable_extra_info' );
            $show_thumbnail     = ( $enable_thumbnail && has_post_thumbnail() ) ? true : false;
            $terms              = $portfolio->terms_list( ', ' );
            $title              = $portfolio->get( 'title' );
            $excerpt            = $portfolio->get( 'excerpt' );
            $classes            = "filterable_item";

            //Retrive terms of the post
            if ( $portfolio->terms_array() !== FALSE && is_array( $portfolio->terms_array() ) ) {
                foreach ( $portfolio->terms_array() as $term ) {
                    $classes .= " " . $term->slug;
                }
            }

            $extra_info_variables = array(
                'year'          => $portfolio->get( 'year' ),
                'customer'      => $portfolio->get( 'customer' ),
                'project'       => $portfolio->get( 'project' ),
                'website_url'   => $portfolio->get( 'website-url' ),
                'website'       => $portfolio->get( 'website' ),
                'budget'        => $portfolio->get( 'budget' )
            );
            ?>
            <li <?php $portfolio->item_class( $classes )?> >
                <div class="row">
                    <?php if( $show_thumbnail ) : ?>
                        <div class="portfolio-thumb col-sm-6">
                            <?php
                            $image = $portfolio->get_image( 'portfolio_big', array( 'class' => 'img-responsive' ) );
                            if ( strcmp( $image, '' ) != 0 ) {
                                echo $image;
                            } ?>
                        </div>
                    <?php endif; ?>

                    <div class="info <?php echo $show_thumbnail ? 'col-sm-6' : 'col-sm-12 no-thumb';?>">
                        <?php if ( $enable_title ) : ?>
                            <h3 class="title">
                                <a class="title_link" href="<?php echo $portfolio->get( 'permalink' ); ?>"><?php echo $title; ?></a>
                            </h3>
                        <?php endif; ?>
                        <?php if ( $enable_categories ) : ?>
                            <div class="categories">
                                <?php echo $terms ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $enable_excerpt ) : ?>
                            <div class="excerpt">
                                <?php echo $excerpt ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $enable_extra_info ) : ?>
                            <div class="extra_info">
                                <?php yit_get_template( 'portfolios/common/extra_info.php', $extra_info_variables ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<div class="clearfix"></div>
<?php $portfolio->pagination() ?>

<?php if ( $portfolio->get( 'config-activate_filters' ) ):?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            "use strict";

            if ( $.fn.isotope && $.fn.imagesLoaded ) {

                //filterable
                var container = $('#portfolio_big'),
                    filters = $('ul.filters');

                container.imagesLoaded(function () {
                    container.isotope({
                        layoutMode             : 'fitRows',
                        itemSelector           : 'li.filterable_item',
                        itemPositionDataEnabled: true ,
                        isOriginLeft: true,
                        isOriginTop: true
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