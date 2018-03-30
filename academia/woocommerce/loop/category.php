<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/9/2015
 * Time: 8:27 AM
 */
$cat_name = '';
$terms = wc_get_product_terms( get_the_ID(), 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
if ($terms) {
    $cat_link = get_term_link( $terms[0], 'product_cat' );
    $cat_name = $terms[0]->name;
}
?>
<?php if (!empty($cat_name)) : ?>
    <div class="product-cat">
        <a href="<?php echo esc_url($cat_link) ?>" ><?php echo esc_html($cat_name);?></a>
    </div>
<?php endif; ?>