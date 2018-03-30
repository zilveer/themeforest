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

if( $layout_sidebar == 'sidebar-no' ){
    $default_classes = "col-sm-3 col-xs-6";
} elseif ( $layout_sidebar == 'sidebar-double' ) {
    $default_classes = "col-sm-6 col-xs-6";
}else{
    $default_classes = "col-sm-4 col-xs-6";
}
?>

<div class="portfolio-<?php echo $layout ?>">

    <?php if ( $portfolio->get( 'config-activate_filters' ) ) : ?>
        <?php yit_get_template( 'portfolios/common/filters.php', array( 'portfolio' => $portfolio )); ?>
    <?php endif; ?>

    <ul id="portfolio_small" class="wrapper row">

        <?php

        while ( $portfolio->have_posts() ) : $portfolio->the_post();

            $enable_thumbnail   = $portfolio->get( 'config-enable_thumbnail' );
            $enable_title       = $portfolio->get( 'config-enable_title' );
            $enable_categories  = $portfolio->get( 'config-enable_categories' );
            $terms              = $portfolio->terms_list( ', ' );
            $has_categories     = $enable_categories && ! empty( $terms ) ? true : false;
            $info_box_location  = $portfolio->get( 'config-info_box_location' );
            $info_box_template  = 'info_box.php';
            $title              = $portfolio->get( 'title' );
            $classes            = "filterable_item $default_classes";

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
                <div class="info">
                    <?php if( $info_box_location == 'top' ) : ?>
                        <?php include( $info_box_template ) ?>
                    <?php endif; ?>
                    <?php if( $enable_thumbnail ) : ?>
                        <div class="portfolio-thumb">
                            <?php
                            $image = $portfolio->get_image( 'portfolio_small', array( 'class' => 'img-responsive' ) );
                            if ( strcmp( $image, '' ) != 0 ) {
                                echo $image;
                            } else{
                                ?>
                                <img src="<?php echo $portfolio->get( 'baseurl' ) ?>images/no-image.jpg" class="img-responsive" />
                                <?php
                            }?>
                            <div class="portfolio-overlay">
                                <span class="details">
                                    <?php if( has_post_thumbnail() ) : ?>
                                        <?php $image_uri = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );?>
                                        <?php ! empty( $image_uri ) && is_array( $image_uri )? $image_uri[0] : '#'; ?>
                                        <a class="portfolio-icon yi-icon-lens" rel="prettyPhoto" href="<?php echo $image_uri[0] ?>"></a>
                                    <?php endif; ?>
                                    <a class="portfolio-icon yi-icon-details" href="<?php echo $portfolio->get( 'permalink' ); ?>"></a>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if( $info_box_location == 'bottom' ) : ?>
                        <?php include( $info_box_template ) ?>
                    <?php endif; ?>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

<div class="clearfix"></div>
<?php $portfolio->pagination() ?>

<?php if ( $portfolio->get( 'config-activate_filters' ) ) : ?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            "use strict";

            if ( $.fn.isotope && $.fn.imagesLoaded ) {

                //filterable
                var container = $('#portfolio_small'),
                    filters = $('ul.filters');

                container.imagesLoaded(function () {
                    container.isotope({
                        layoutMode             : 'fitRows',
                        itemSelector           : 'li.filterable_item',
                        itemPositionDataEnabled: true,
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

            $("a[rel^='prettyPhoto']").prettyPhoto();
        });
    </script>
<?php else : ?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            "use strict";

            $("a[rel^='prettyPhoto']").prettyPhoto();
        });
    </script>
<?php endif; ?>

<?php $portfolio->reset_query() ?>