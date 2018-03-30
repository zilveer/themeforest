

<?php
/**
 * The default template for displaying post details
 */
?>
<?php
    $thumbnails = fw_ext_portfolio_get_gallery_images();
    $term_list = wp_get_post_terms($post->ID, 'fw-portfolio-category', array("fields" => "names"));
    $author = fw_get_db_post_option($post->ID,'post-author');
    $btn_title = fw_get_db_post_option($post->ID,'post-btn');
    $btn_link = fw_get_db_post_option($post->ID,'post-preview');

    $terms = wp_get_post_terms( $post->ID , 'fw-portfolio-category');
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="portfolio-pagination">
        <div class="w-row">
            <div class="w-col w-col-6">
                <h3><span class="blue"><?php the_title(); ?></span></h3>
            </div>
            <div class="w-col w-col-6 left-aglin-column cetner">

                <?php next_post_link('%link', '<div class="w-inline-block p-pagination"><div class="w-embed"><i class="fa fa-chevron-left"></i></div></div>', false); ?>

                <?php if(!empty($terms)):?>
                    <a class="w-inline-block p-pagination p-pag-all" href="<?php echo get_term_link( $terms[0], 'fw-portfolio-category' )?>">
                        <div class="w-embed"><i class="icon-thumbnails"></i>
                        </div>
                    </a>
                <?php endif; ?>

                <?php previous_post_link('%link', '<div class="w-inline-block p-pagination"><div class="w-embed"><i class="fa fa-chevron-right"></i></div></div>', false); ?>

            </div>
        </div>
    </div>
</div>
<div class="w-row">
    <div class="w-col w-col-9 w-col-stack">
        <div>
            <?php if(!empty($thumbnails)) : ?>
                <div class="w-slider carousel-project" data-animation="cross" data-duration="500" data-infinite="1" data-nav-spacing="5">
                    <div class="w-slider-mask">
                        <?php foreach($thumbnails as $thumbnail): ?>
                            <div class="w-slide"><img src="<?php echo esc_url($thumbnail['url']); ?>" alt="">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="w-slider-arrow-left ver-remove-spc">
                        <div class="w-icon-slider-left carousel-arrow"></div>
                    </div>
                    <div class="w-slider-arrow-right ver-remove-spc">
                        <div class="w-icon-slider-right carousel-arrow"></div>
                    </div>
                    <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="w-col w-col-3 w-col-stack res-space">
        <div class="tittle-line tittle-sml-mg">
            <h5><?php _e('Project Description','fw'); ?></h5>
            <div class="divider-1 small">
                <div class="divider-small"></div>
            </div>
        </div>
        <?php the_content();?>
        <div class="space x2">
            <div class="tittle-line tittle-sml-mg">
                <h5><?php _e('Project details','fw'); ?></h5>
                <div class="divider-1 small">
                    <div class="divider-small"></div>
                </div>
            </div>
            <ul class="w-list-unstyled ul">
                <li class="w-clearfix li-list">
                    <div class="li-ico li-blue">
                        <div class="w-embed"><i class="fa fa fa-calendar"></i>
                        </div>
                    </div>
                    <p><?php echo get_the_date(); ?></p>
                </li>
                <?php if(!empty($author)):?>
                    <li class="w-clearfix li-list">
                        <div class="li-ico li-blue">
                            <div class="w-embed"><i class="fa fa fa-user"></i>
                            </div>
                        </div>
                        <p><?php echo esc_html($author);?></p>
                    </li>
                <?php endif;?>
                <?php if(!empty($term_list)):?>
                    <li class="w-clearfix li-list">
                        <div class="li-ico li-blue">
                            <div class="w-embed"><i class="fa fa fa-tags"></i>
                            </div>
                        </div>
                        <?php $names = '';
                            foreach($term_list as $term):
                                $names .= $term . ', ';
                            endforeach;
                        ?>
                        <p><?php echo substr($names, 0,  strlen($names)-2); ?></p>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if(!empty($btn_title)):?>
                <div class="space">
                    <a class="w-clearfix w-inline-block button btn-small" target="_blank" href="<?php echo esc_url($btn_link);?>">
                        <div class="btn-ico">
                            <div class="w-embed"><i class="fa fa-external-link"></i>
                            </div>
                        </div>
                        <div class="btn-txt"><?php echo esc_html($btn_title); ?></div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>