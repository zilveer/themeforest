<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>

<div class="filters-container">
    <ul class="filters">
        <li><a href="#" class="filter-category active all" data-option-value="*"><?php _e( 'All', 'yit' )?></a></li>
        <?php
        $terms_array = $portfolio->get_terms();
        if( $terms_array != '' && ! is_a( $terms_array, 'WP_Error' ) && is_array( $terms_array ) ) :
            foreach ( $terms_array as $term ) : ?>
                <li>
                    <a class="filter-category" href="#" data-option-value=".<?php echo $term->slug ?>">
                        <?php echo $term->name ?>
                    </a>
                </li>
            <?php
            endforeach;
        endif; ?>
    </ul>
</div>

