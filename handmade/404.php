<?php
get_header();
global $g5plus_options;

do_action('g5plus_before_page');


?>

<div class="page404 ">
    <div class="container">
        <div class=" content-wrap p-color-bg">
            <h2 class="p-font"><?php echo wp_kses_post($g5plus_options['title_404']); ?></h2>
            <h4  class="description p-font"><?php echo wp_kses_post($g5plus_options['subtitle_404']); ?></h4>
            <div class="return">
                <?php
                $go_back_link = $g5plus_options['go_back_url_404'];
                if($go_back_link ==='')
                    $go_back_link = get_home_url();
                ?>
                <?php echo __('Return to the ','g5plus-handmade')?>
                <a href="<?php echo esc_url($go_back_link) ?>"><?php echo wp_kses_post($g5plus_options['go_back_404']); ?></a>
            </div>
        </div>

    </div>
</div>
<?php get_footer(); ?>


