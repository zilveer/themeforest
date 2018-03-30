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

<div class="row portfolio-container">

    <div class="portfolio">
        <ul id="portfolio" class="clearfix sidebar-no">
            <?php
            $index = 0;
            //Sets classes for the element
            $classes = '';

            while ( $portfolio->have_posts() ) :
                $portfolio->the_post();

                //Retrive terms of the post
                $terms = $portfolio->terms_array();

                if ( $terms !== FALSE && is_array( $terms ) ) {
                    foreach ( $terms as $term ) {
                        $classes .= " " . $term->slug;
                    }
                }

                $index ++;
                ?>
                <li <?php $portfolio->item_class( $classes )?> >
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
<?php $portfolio->reset_query() ?>