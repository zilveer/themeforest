<article class="post-wrap <?php echo is_sticky()?'sticky':''; ?>" data-animation="fadeInUp" data-animation-delay="100">
    

    <div class="post-media">

        <?php if(has_post_format('video')){ ?>
            <?php if(!is_single()){ ?>
                <div class="post-type">
                    <i class="fa fa-video-camera"></i>
                </div>
            <?php } ?>
            <div class="js-video">
                <?php echo wp_oembed_get(get_post_meta(get_the_id(), "_cmb_embed_media", true)); ?>
            </div>

        <?php } elseif(has_post_format('audio')){ ?>
            <?php if(!is_single()){ ?>
                <div class="post-type">
                    <i class="fa fa-music"></i>
                </div>
            <?php } ?>
            <div class="js-video">
                <?php echo wp_oembed_get(get_post_meta(get_the_id(), "_cmb_embed_media", true)); ?>
            </div>

        <?php }else{ ?>

            <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
            <?php if($thumbnail_url){ ?>
                <?php if(!is_single()){ ?>
                    <div class="post-type">
                        <i class="fa fa-picture-o"></i>
                    </div>
                <?php } ?>
                <img  src="<?php  echo esc_url($thumbnail_url); ?>" alt="" class="img-responsive">
            <?php } ?>

        <?php } ?>
    </div>

    <div class="post-header">
        <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title( ); ?></a></h1>
        <div class="post-meta">
            <span class="post-date">
                <?php _e('Posted on', TEXT_DOMAIN); ?>                
                <span class="day"> <?php the_time( get_option( 'date_format' ));?></span>                
            </span>
            <span class="pull-right">
                <i class="fa fa-comment"></i> 
                <a href="<?php the_permalink();?>">
                    <?php comments_popup_link(__(' 0', TEXT_DOMAIN), __(' 1', TEXT_DOMAIN), ' %'.__('', TEXT_DOMAIN)); ?>
                </a>
            </span>
        </div>
    </div>
    <div class="post-body">
        <div class="post-excerpt">
            <?php if(is_single()){ /* Single */
                the_content();
                wp_link_pages();                
            }else{
                the_excerpt(); /* Category */
            } ?>
            
        </div>
    </div>
    <?php if(!is_single()){ ?> <!-- Category -->
        <div class="post-footer">
            <span class="post-readmore">
                <a href="<?php the_permalink(); ?>" class="btn btn-theme btn-theme-transparent"><?php  _e('Read more', TEXT_DOMAIN); ?></a>
            </span>
        </div>
    <?php }else{ ?> <!-- Single -->
        <footer class="post-meta">
            <?php if(has_tag()){ ?>
                <span class="post-tags"><i class="fa fa-tag"></i> 
                    <?php the_tags('',',',''); ?>
                </span> &nbsp;
            <?php } ?>
            <?php if(has_category( )){ ?>
                <span class="post-categories"><i class="fa fa-folder-open"></i> 
                    <?php the_category(','); ?>
                </span>
            <?php } ?>
        </footer>
    <?php } ?>
</article>