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

<div class="row portfolio-<?php echo $layout ?>">
    <div id="portfolio_pinterest" class="wrapper <?php echo $layout_sidebar?> <?php echo ( $portfolio->get( 'config-items_per_row' ) == '4' ) ? 'four-for-row' : 'three-for-row'?>">
        <?php
        //Sets classes for the element
        if( $portfolio->get( 'config-items_per_row' ) == '4' ){
            if( $layout_sidebar == 'sidebar-no' ){
                $default_classes = "work masonry_item col-sm-3 col-xs-6";
            }
            else {
                $default_classes = "work masonry_item col-lg-3 col-sm-6 col-xs-6";
            }
        }
        else{
            if ( $layout_sidebar == 'sidebar-double' ) {
                $default_classes = "work masonry_item col-lg-4 col-sm-6 col-xs-6";
            }
            else {
                $default_classes = "work masonry_item col-sm-4 col-xs-6";
            }
        }

        while ( $portfolio->have_posts() ) :
            $portfolio->the_post();

            $enable_title = $portfolio->get( 'config-enable_title' );
            $enable_categories = $portfolio->get( 'config-enable_categories' );
            $enable_hover = $portfolio->get( 'config-enable_hover' ) && ( $enable_title || $enable_categories);

            $classes = $default_classes;

            $terms = $portfolio->terms_list( ', ' );
            $title = $portfolio->get( 'title' )
            ?>
            <div <?php $portfolio->item_class( $classes )?> >
                <div class="portfolio-thumb">
                    <?php
                    $image = $portfolio->get_image( 'portfolio_pinterest', array( 'class' => 'img-responsive' ) );
                    if ( strcmp( $image, '' ) != 0 ) {
                        echo $image;
                    }
                    else {
                        ?>
                        <img src="<?php echo $portfolio->get( 'baseurl' ) ?>images/no-image.jpg" class="img-responsive" />
                    <?php
                    }
                    ?>
                    <?php if ( $enable_hover &&( $terms != '' || $title != '' ) ):?>
                        <div class="portfolio-overlay">
                            <div class="portfolio-overlay-info">
                                <?php if ( $enable_title ):?>
                                    <div class="portfolio-overlay-title">
                                        <a href="<?php echo $portfolio->get( 'permalink' ); ?>"><?php echo $title; ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $enable_categories ):?>
                                    <div class="portfolio-overlay-categories">
                                        <?php echo $terms ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="clearfix"></div>
<?php $portfolio->pagination() ?>


<script type="text/javascript">
    jQuery(document).ready(function($){
		"use strict";

		if ( $.fn.imagesLoaded && $.fn.masonry )
			var container = $('#portfolio_pinterest');
			container.imagesLoaded( function(){
				container.masonry({
					itemSelector: '.masonry_item',
					isAnimated: true,
					isRTL: yit.isRtl
				});
			});

		if ( $.fn.masonry ) {
			_onresize( function(){
				container.masonry({
					itemSelector: '.masonry_item',
					isRTL: yit.isRtl
				});
			});
		}
    });
</script>

<?php $portfolio->reset_query() ?>