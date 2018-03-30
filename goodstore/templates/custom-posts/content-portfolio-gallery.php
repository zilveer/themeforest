<?php
global $post, $jaw_data;
$gallery = json_decode(get_post_meta($post->ID, '_portfolio_gallery', true));
$random = rand(0, 1000);
$terms = get_the_terms(get_the_ID(), 'jaw-portfolio-category');
$categories = '';
foreach ((array) $terms as $cat) {
    if ($cat != null) {
        $categories .= $cat->slug . ' ';
    }
}
?>

<article id="portfolio-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-4', 'content-middle', 'portfolio', $categories)); ?>   >
    <div class="box ">

        <div class="featured">
            <?php if (isset($gallery[0]->url)) { ?>
                <span class="wrapper" style="background: <?php echo jaw_template_get_var('color_rgb'); ?>; background: <?php echo jaw_template_get_var('color_rgba'); ?>;filter: alpha(opacity=<?php echo jaw_template_get_var('info_opacity'); ?>);">
                    <a href="<?php echo $gallery[0]->url; ?>" title="<?php echo get_the_title(); ?>" rel="prettyPhoto[<?php echo $random ?>]">
                        <span class="wrapper_icon" style="color: <?php echo jaw_template_get_var('info_text_color'); ?>"><i class="icon-search3"></i></span>
                    </a>
                    <h2><a href="<?php the_permalink(); ?>" class="post_name" style="color: <?php echo jaw_template_get_var('info_text_color'); ?>"><?php the_title(); ?></a></h2>

                </span>
                <?php
                $image = wp_get_attachment_image_src($gallery[0]->id, 'post-size-middle');
                echo '<img src="' . $image[0] . '"  width = "307" alt="' . get_the_title() . '"/ >';
                unset($gallery[0]);
                ?>
                <span class="hide">
                    <?php foreach ($gallery as $key => $value) { ?>      
                        <a href="<?php echo $value->url; ?>" rel="prettyPhoto[<?php echo $random ?>]">
                        </a>
                        <?php
                        $first = '';
                    }
                    ?>
                </span>
            <?php } ?> 
        </div>


    </div>
</article>

