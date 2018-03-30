<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


wp_reset_query();

$faq_post_type = 'faq';
$category_faq_taxonomy = 'category-faq';


$ids = '';
if ( isset( $category ) && $category != '' ) {
    $ids = explode( ',', $category );
    $ids = array_map( 'trim', $ids );
    if ( in_array( '0', $ids ) ) {
        $ids = '';
    }
}

if ( is_array( $ids ) ) :
    $args = array(
        'post_type'      => $faq_post_type,
        'posts_per_page' => -1,
        'tax_query'      => array(
            array(
                'taxonomy' => $category_faq_taxonomy,
                'field'    => 'id',
                'terms'    => $ids
            )
        )
    );
else :
    $args = array(
        'post_type'      => $faq_post_type,
        'posts_per_page' => -1,
    );
endif;

$faq = new WP_Query( $args );

$args = array(
    'taxonomy' => $category_faq_taxonomy,
    'title_li' => '',
    'include'  => $ids
);

$cat = get_categories( $args );


if ( ! $faq->have_posts() ) {
    return false;
} ?>

<?php if ($cat && $filter == 'yes') : ?>

    <?php if( isset( $text_filterable ) && $text_filterable != '' ) : ?>
        <h2><?php echo $text_filterable ?></h2>
    <?php endif; ?>

    <ul class="filters faq">
         <li class="all"><a href="#all" data-option-value="*" class="all active"><div class="prepend"></div><?php _e('All Categories', 'yit') ?></a></li>
         <?php foreach ( $cat as $c ) :
              echo '<li><a href="#' . urldecode( sanitize_title( $c->slug ) ) . '" data-option-value=".' . urldecode( sanitize_title( $c->slug ) ) . '">' . $c->name . '</a></li>';
          endforeach ?>
    </ul>


    <div class="faq-filters-container">
        <div class="faq-filters group">
            <p><?php echo $text_filterable; ?></p>
            <select id="faq-filters-select">
                <option value="*"><?php _e('All Categories', 'yit') ?></option>
                <?php foreach ($cat as $c) : ?>
                    <option value=".<?php echo $c->slug ?>"><?php echo $c->name ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
<?php endif ?>


<div id="faqs-container">
    <?php
        while ( $faq->have_posts() ) : $faq->the_post();
            $filter_class = '';
            $title        = get_the_title();
            $content      = get_the_content();
            $filter       = get_the_terms( 0, $category_faq_taxonomy );
            if ( is_array( $filter ) ) :
                foreach ( $filter as $f ) {
                    $filter_class .= urldecode( sanitize_title( $f->slug ) ) . ' ';
                }
            endif;
    ?>

        <div class="faq-wrapper all <?php echo $filter_class ?>">
            <div class="faq-title">
                <div class="plus"></div>
                <h4><?php the_title() ?></h4>
            </div>
            <div class="faq-item">
                <div class="faq-item-content">
                    <?php echo wpautop($content); ?>
                </div>
            </div>
        </div>

    <?php
        endwhile;
        wp_reset_postdata();
    ?>
</div>