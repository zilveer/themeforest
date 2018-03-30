<div class="white-block featured-stores">
    <div class="row">
        <div class="col-sm-4">
            <div class="featured-stores-title">
                <?php if( !empty( $title ) ): ?>
                    <h2><?php echo $title; ?></h2>
                <?php endif; ?>
                <?php if( !empty( $text ) ): ?>
                    <p><?php echo $text; ?></p>
                <?php endif; ?>
                <?php if( !empty( $btn_text ) ): ?>
                    <a href="<?php echo esc_url( $link ) ?>" class="btn">
                        <?php echo $btn_text; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-8">
            <?php
            $args = array(
                'post_type' => 'store',
                'post_status' => 'publish',
                'posts_per_page' => -1,

            );

            if( !empty( $items ) ){
                $args['post__in'] = $items;
            }
            else{
                $args['meta_query'] = array(
                    array(
                        'key' => 'store_featured',
                        'value' => 'yes',
                        'compare' => '='
                    ),
                );
            }
            $stores = new WP_Query( $args );
            $counter = 0;
            if( $stores->have_posts() ){
                ?>
                <ul class="list-unstyled list-inline">
                    <?php                    
                    while( $stores->have_posts() ){
                        $stores->the_post();
                        ?>
                        <li>
                            <div class="store-logo">
                                <a href="<?php the_permalink() ?>">
                                    <?php couponxl_store_logo(); ?>
                                </a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                wp_reset_query();
            }
            ?>
        </div>
    </div>
</div>