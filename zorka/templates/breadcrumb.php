<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/16/15
 * Time: 11:43 AM
 */
global $zorka_data;
$show_breadcrumb = '1';
if(array_key_exists('show-breadcrumb', $zorka_data))
    $show_breadcrumb = $zorka_data['show-breadcrumb'];
if(!isset($show_breadcrumb) || $show_breadcrumb=='1'){
?>
<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if (!is_front_page()) : ?>
                    <?php zorka_get_breadcrumb(); ?>
                <?php else: ?>
                    <ul class="breadcrumbs">
                        <li><a rel="v:url" href="<?php echo home_url( '/' )  ?>" class="home"><i class="fa fa-home"></i></a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>


