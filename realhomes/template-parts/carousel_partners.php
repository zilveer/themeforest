<?php
$show_partners = get_option('theme_show_partners');

if($show_partners == 'true'){
    ?>
    <div class="container page-carousel">
        <div class="row">
            <div class="span12">
                <section class="brands-carousel  clearfix">
                    <h3><span><?php echo $partners_title = get_option('theme_partners_title'); ?></span></h3>
                            <ul class="brands-carousel-list clearfix">
                                <?php
                                $partners_query_args = array(
                                    'post_type' => 'partners',
                                    'posts_per_page' => -1
                                );

                                $partners_query = new WP_Query( $partners_query_args );

                                if ( $partners_query->have_posts() ) :
                                    while ( $partners_query->have_posts() ) :
                                        $partners_query->the_post();
                                        $post_meta_data = get_post_custom($post->ID);
                                        $partner_url = '';
                                        if( !empty($post_meta_data['REAL_HOMES_partner_url'][0]) ) {
                                            $partner_url = $post_meta_data['REAL_HOMES_partner_url'][0];
                                        }
                                        ?>
                                        <li>
                                            <a target="_blank" href="<?php echo $partner_url; ?>" title="<?php the_title();?>">
                                                <?php
                                                $thumb_title = trim(strip_tags( get_the_title($post->ID)));
                                                the_post_thumbnail('partners-logo',array(
                                                    'alt'	=> $thumb_title,
                                                    'title'	=> $thumb_title
                                                ));
                                                ?>
                                            </a>
                                        </li>
                                        <?php
                                    endwhile;
                                    wp_reset_query();
                                endif;
                                ?>
                            </ul>
                </section>
            </div>
        </div>
    </div>
    <?php
}
?>