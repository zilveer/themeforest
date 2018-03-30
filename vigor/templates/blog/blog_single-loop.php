<?php
global $edgt_options;

$title_tag="h5";
if(isset($edgt_options['blog_single_title_tags'])){
    $title_tag = $edgt_options['blog_single_title_tags'];
}
$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
//get correct heading value
$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : 'h5';

$blog_author_info="no";
if (isset($edgt_options['blog_author_info'])) {
    $blog_author_info = $edgt_options['blog_author_info'];
}
$blog_single_loop = "blog_standard_type";
if (isset($edgt_options['blog_single_style'])&&($edgt_options['blog_single_style'] !== "")) {
    $blog_single_loop = $edgt_options['blog_single_style'];
}

$pagination_classes = '';
if( isset($edgt_options['pagination_type']) && $edgt_options['pagination_type'] == 'standard' ) {
	if( isset($edgt_options['pagination_standard_position']) && $edgt_options['pagination_standard_position'] !== '' ) {
		$pagination_classes .= "standard_".esc_attr($edgt_options['pagination_standard_position']);
	}
}
elseif ( isset($edgt_options['pagination_type']) && $edgt_options['pagination_type'] == 'arrows_on_sides' ) {
	$pagination_classes .= "arrows_on_sides";
}

?>
<?php
get_template_part('templates/blog/blog_single/'.$blog_single_loop.'_single', 'loop');
?>

<?php if( has_tag()) { ?>
    <div class="single_tags clearfix">
        <div class="tags_text">
            <<?php echo esc_attr($title_tag);?> class="single_tags_heading"><?php _e('Tags:', 'edgt'); ?></<?php echo esc_attr($title_tag);?>>
            <?php the_tags('', '', ''); ?>
        </div>
    </div>
<?php } ?>
<?php
$args_pages = array(
    'before'           => '<div class="single_links_pages ' .$pagination_classes. '"><div class="single_links_pages_inner">',
    'after'            => '</div></div>',
    'link_before'      => '<span>',
    'link_after'       => '</span>',
    'pagelink'         => '%'
);

wp_link_pages($args_pages);
get_template_part('templates/blog/blog_single/blog-navigation');
?>
<?php if($blog_author_info == "yes") {

    $disable_author_info_email = true;
    if (isset($edgt_options['disable_author_info_email']) && $edgt_options['disable_author_info_email'] == "yes") {
        $disable_author_info_email = false;
    }

    ?>
    <div class="author_description">
        <div class="author_description_inner">
            <div class="image">
                <?php echo edgt_kses_img(get_avatar(get_the_author_meta( 'ID' ), 102)); ?>
            </div>
            <div class="author_text_holder">
                <<?php echo esc_attr($title_tag); ?> class="author_name">
                    <?php
                    if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
                        echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
                    } else {
                        echo esc_attr(get_the_author_meta('display_name'));
                    }
                    ?>
                </<?php echo esc_attr($title_tag);?>>
                <?php if($disable_author_info_email && is_email(get_the_author_meta('email'))){ ?>
                    <span class="author_email"><?php echo sanitize_email(get_the_author_meta('email')); ?></span>
                <?php } ?>
                <?php if(get_the_author_meta('description') != "") { ?>
                    <div class="author_text">
                        <p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>