<?php            
    if(class_exists('Attachments'))
    {
        $attachments = new Attachments( 'plsh_galleries' );
        if( $attachments->exist() )
        {
        ?>
        <div class="gallery-item">
            <div class="overlay touch-click">
                <div class="title">
                    <h2>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php if(plsh_is_post_hot(get_the_ID())) : ?>
                            <span class="hotness"><?php _e('Hot', 'goliath'); ?></span>
                        <?php endif; ?>
                    </h2>
                    <p>
                        <span class="legend-default">
                            <?php 
                                $date = get_the_date();
                                if($date)
                                {
                                    echo '<i class="fa fa-clock-o"></i>' . $date;
                                }
                            ?>
                            <i class="fa fa-camera"></i>
                            <?php echo esc_html($attachments->total()); ?>
                        </span>
                    </p>
                    <div class="intro">
                        <a href="<?php the_permalink(); ?>" class="more-link"><?php _e('View all photos', 'goliath'); ?></a>
                    </div>
                </div>
            </div>
            <div class="background">
                <?php
                    for( $i = 1; $i <= 4; $i++ )
                    {
                        $attachment = $attachments->get();
                        if($attachment)
                        {
                            echo $attachments->image( 'gallery-thumb-one-fourth' );
                        }
                    }
                ?>
            </div>
        </div>
        <?php
        }
    }
?>