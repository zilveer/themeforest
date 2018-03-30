<div class="author well gap">
    <div class="media">
        <div class="pull-left">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentythirteen_author_bio_avatar_size', 80 ) ); ?>
        </div>
        <div class="media-body">
            <div class="media-heading">
                <strong><?php printf( __( 'About %s', DISTINCTIVETHEMESTEXTDOMAIN ), get_the_author() ); ?></strong>
            </div>
            <p><?php the_author_meta( 'description' ); ?></p>
        </div>
    </div>
</div>