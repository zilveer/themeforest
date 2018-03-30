<?php
global $post, $jaw_data;
$terms = get_the_terms(get_the_ID(), 'jaw-portfolio-category');
$categories = '';
foreach ((array) $terms as $cat) {
    if ($cat != null) {
        $categories .= $cat->slug . ' ';
    }
}
?>

<article id="portfolio-<?php the_ID(); ?>"  <?php post_class(array('element', 'portfolio', 'col-lg-4', 'content-middle',$categories)); ?>   >
    <div class="box ">

        <div class="featured">
            <?php
            $img = json_decode(get_post_meta($post->ID, '_portfolio_image', true));
            if (isset($img[0]->id)) {
                $url = wp_get_attachment_image_src($img[0]->id, 'post-size-middle');
                $img = $url[0];
            }
            
            ?>
            
            <span class="wrapper" style="background: <?php echo jaw_template_get_var('color_rgb');?>; background: <?php echo jaw_template_get_var('color_rgba');?>;filter: alpha(opacity=<?php echo jaw_template_get_var('info_opacity'); ?>);">
                <a href="<?php echo get_post_meta($post->ID, '_portfolio_link', true); ?>" target="<?php echo get_post_meta($post->ID, '_portfolio_link_target', true); ?>" title="<?php echo get_the_title(); ?>">
                    <span class="wrapper_icon" style="color: <?php echo jaw_template_get_var('info_text_color');?>"><i class="icon-link"></i></span>
                </a>
                 <h2><a href="<?php the_permalink(); ?>" class="post_name" style="color: <?php echo jaw_template_get_var('info_text_color');?>"><?php the_title(); ?></a></h2>
                
            </span>
            <?php
            if (isset($img)) {
                echo '<img src="' . $img . '"  width = "307" alt="' . get_the_title() . '"/ >';
            }
            ?>
        </div>
    </div>
</article>

