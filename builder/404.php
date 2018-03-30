<?php get_header() ?>
<div class="oi_vc_page_holder" style="padding:0px;">
	<div class="container">
        <div class="oi_page_holder_custom">
            <?php $content = get_post_field('post_content', get_page_by_title('404 Error')); echo do_shortcode($content);?>
        </div>
	</div>
</div>
<?php  get_footer(); ?>