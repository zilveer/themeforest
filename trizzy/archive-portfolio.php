<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Trizzy
 */

get_header();

?>
<section class="titlebar">
<div class="container">
    <div class="sixteen columns">
        <h2><?php
            $pf_title = get_post_meta($post->ID, 'pp_portfolio_title', true);
            $pp_subtitle = get_post_meta($post->ID, 'pp_subtitle', true);
            if($pf_title) {
                echo $pf_title;
            } else {
                $pp_portfolio_page = ot_get_option('pp_portfolio_page');
                if (function_exists('icl_register_string')) {
                    icl_register_string('Portfolio page title','pp_portfolio_page', $pp_portfolio_page);
                    echo icl_t('Portfolio page title','pp_portfolio_page', $pp_portfolio_page); }
                else {
                    echo $pp_portfolio_page;
                }
            } ?></h2>

        <nav id="breadcrumbs">
            <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
        </nav>
    </div>
</div>
</section>
<?php
$layout = ot_get_option('pp_portfolio_layout');
if ($layout == '4') {
	get_template_part('pftpl4col');
} else {
	get_template_part('pftpl3col');
}

get_footer(); ?>
