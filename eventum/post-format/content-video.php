<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if (!is_single()) { ?>
    <div class="row">
        <div class="col-sm-6">
            <?php  if ( rwmb_meta( 'thm_video' ) ) { ?>
            <div class="featured-wrap">
                <div class="entry-video embed-responsive embed-responsive-16by9">
                    <?php $video_source = esc_attr(rwmb_meta( 'thm_video_source' )); ?>
                    <?php $video = rwmb_meta( 'thm_video' ); ?>
                    <?php if($video_source == 1): ?>
                        <?php echo rwmb_meta( 'thm_video' ); ?>
                    <?php elseif ($video_source == 2): ?>
                        <?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
                    <?php elseif ($video_source == 3): ?>
                        <?php echo '<iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="350" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php } ?>
        </div>   
        <div class="col-sm-6"> 
            <span class="post-icon"><i class="fa fa-video-camera"></i></span>
            <?php get_template_part( 'post-format/entry-content' ); ?> 
        </div>
    </div>
<?php } else { ?>
    <?php  if ( rwmb_meta( 'thm_video' ) ) { ?>
    <div class="featured-wrap">
        <div class="entry-video embed-responsive embed-responsive-16by9">
            <?php $video_source = esc_attr(rwmb_meta( 'thm_video_source' )); ?>
            <?php $video = rwmb_meta( 'thm_video' ); ?>
            <?php if($video_source == 1): ?>
                <?php echo rwmb_meta( 'thm_video' ); ?>
            <?php elseif ($video_source == 2): ?>
                <?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
            <?php elseif ($video_source == 3): ?>
                <?php echo '<iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="350" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php } ?>
    <?php if (!is_single()) { ?>
    <span class="post-icon"><i class="fa fa-video-camera"></i></span>
    <?php } ?>
    <?php get_template_part( 'post-format/entry-content' ); ?>     
   <?php } ?>    
</article> <!--/#post -->