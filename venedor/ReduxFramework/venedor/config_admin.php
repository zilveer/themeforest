/* Venedor Config Styles */
/* Created at <?php echo date("Y-m-d H:i:s") ?> */
<?php
global $venedor_design;
$c = $venedor_design;
?>

.ls-preview .price-box {
    <?php venedor_print_typo('product-price') ?>
}

.ls-preview .price-box {
    <?php venedor_print_bg('product-price') ?>
    color: <?php echo $c['product-price-color'] ?>;
}

.ls-preview .btn {
    <?php venedor_print_typo('btn') ?>
    <?php venedor_print_border('btn') ?>
    <?php venedor_print_bg('btn') ?>
    <?php venedor_print_border_radius('btn') ?>
    color: <?php echo $c['btn-text-color'] ?>;
}

.ls-preview .btn:hover,
.ls-preview .btn:focus {
    <?php venedor_print_hborder('btn') ?>
    <?php venedor_print_hbg('btn') ?>
    color: <?php echo $c['btn-hcolor'] ?>;
}
