<?php
use \Handyman\Front as F;

$tl_key = '';
if((is_page() && !is_page_template('template-blog.php'))){
    $tl_key = 'cpage-';
}

if(!F\tl_copt('footer-' . $tl_key . 'form7-show')){
    return ;
}

$form_section_title   = F\tl_copt('footer-' . $tl_key . 'form7-title');
$form_section_excerpt = F\tl_copt('footer-' . $tl_key . 'form7-excerpt');

$form_id = (int) F\tl_copt('footer-' . $tl_key . 'form7-id');

?>
<section class="widget content-vertical-massive request-handyman prefooter-section">

    <?php if($form_section_title || $form_section_excerpt): ?>
    <div class="container clearfix">
        <div class="section-title clearfix medium text-center ">
            <h3 class="heading"><?php echo apply_filters('tl/tl_colorize_title', $form_section_title); ?></h3>
            <div class="excerpt">
                <?php echo apply_filters('the_content', $form_section_excerpt); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="container list-grid">
        <div class="grid">
            <div class="layers-masonry-column span-12 last column">
                <div class="media image-top medium">
                    <div class="media-body text-left">
                        <div class="excerpt">
                            <p>
                                <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($form_id) . '" html_name="request_handyman"]'); ?>
                            </p>
                            <p>
                                <?php echo do_shortcode('[su_tl_contactinfo info1="'. esc_attr(F\tl_copt('contact-txt1')).'" info2="'. esc_attr(F\tl_copt('contact-txt2')) .'" phone="' . esc_attr(F\tl_copt('contact-phone')) . '"][/su_tl_contactinfo]'); ?>
                            </p>
                        </div>
                        <p class="phantom-padding"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>