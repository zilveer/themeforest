<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if (!is_single()) { ?>
    <div class="row">
        <div class="col-sm-6">
        <?php  if ( rwmb_meta( 'thm_qoute' ) ) { ?>
        <div class="featured-wrap">
            <div class="entry-qoute">
                <blockquote>
                    <p><?php echo esc_html(rwmb_meta( 'thm_qoute' )); ?></p>
                    <small><?php echo esc_html(rwmb_meta( 'thm_qoute_author' )); ?></small>
                </blockquote>
            </div>        
        </div>
        <?php } ?>
        </div>
        <div class="col-sm-6">
        <span class="post-icon"><i class="fa fa-quote-left"></i></span>
        <?php get_template_part( 'post-format/entry-content' ); ?> 
        </div>
    </div>
<?php } else { ?>
    <?php  if ( rwmb_meta( 'thm_qoute' ) ) { ?>
    <div class="featured-wrap">
        <div class="entry-qoute">
            <blockquote>
                <p><?php echo esc_html(rwmb_meta( 'thm_qoute' )); ?></p>
                <small><?php echo esc_html(rwmb_meta( 'thm_qoute_author' )); ?></small>
            </blockquote>
        </div>        
    </div>
    <?php } ?>
    <?php if (!is_single()) { ?>
    <span class="post-icon"><i class="fa fa-quote-left"></i></span>
    <?php } ?>  
    <?php get_template_part( 'post-format/entry-content' ); ?> 
    <?php } ?>    
</article> <!--/#post -->