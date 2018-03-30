<?php get_header(); ?>
<?php
    $class = 'full-width';
    $has_sidebar = false;
    if(
        ((is_shop() || is_product_category()) && plsh_gs('show_shop_sidebar') == 'on')
        ||
        (is_product() && plsh_gs('show_product_sidebar') == 'on')
    )
    {
        $class = '';
        $has_sidebar = true;
    }
?>

<!-- Homepage content -->
<div class="container homepage-content">

    <div class="main-content-column-1 <?php echo esc_attr($class); ?>">

        <!-- Post -->
        <div <?php post_class('post-1 plsh-woocommerce'); ?>>
            
            <?php woocommerce_content(); ?>

        </div>

    </div>
    
    <?php
    if($has_sidebar)
    {
        get_sidebar();
    }
    ?>   
</div>


<?php get_footer(); ?>