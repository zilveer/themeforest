<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

//get post thumbnail
$thumbnail_id = get_post_thumbnail_id();
if( !empty( $thumbnail_id ) ) {
    $thumbnail    = get_post( $thumbnail_id );
    $image        = wp_get_attachment_image_src($thumbnail->ID,array(1440,960));
    $thumbnail_title = $thumbnail->post_title;
} else {
    $image = '';
    $thumbnail_title = '';
}

$term_list = wp_get_post_terms($post->ID, 'fw-portfolio-category', array("fields" => "names"));
?>
<div class="portfolio-wrapper remove-radius">
    <div>
        <?php if(!empty($image)):?>
            <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($thumbnail_title); ?>">
        <?php endif; ?>
        <a class="w-inline-block portfolio-overlay-full" href="<?php the_permalink() ?>">
            <div class="portfolio-txt-full">
                <h6 class="title-full-portfolio" data-ix="move-tittle-full-portfolio"><?php the_title(); ?></h6>
                <?php if(!empty($term_list)):?>
                    <div class="portfolio-sub" data-ix="move-sub-full-portfolio">
                        <?php $names = '';
                        foreach($term_list as $term):
                            $names .= strtolower($term) . ', ';
                        endforeach;

                        echo substr($names, 0,  strlen($names)-2);
                        ?>
                    </div>
                <?php endif;?>
            </div>
        </a>
    </div>
</div>