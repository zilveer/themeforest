<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
?>

<div class="author-info clearfix ShowOnScroll">

  <div class="timeline-badge"><i class="ion-university"></i></div>

  <div class="row">

    <div class="author-avatar-wrapper col-xs-3 col-sm-3 col-md-2 col-lg-2 col-bg-2">
      <div class="author-avatar">
        <?php
          $author_bio_avatar_size = apply_filters( 'monarch_author_bio_avatar_size', 56 );
          echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
        ?>
      </div>
    </div>

    <div class="author-description col-xs-9 col-sm-9 col-md-10 col-lg-10 col-bg-10">
      <h5><?php printf( get_the_author() ); ?></h5>
      <p class="author-bio"><?php the_author_meta( 'description' ); ?></p>
      <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
      <?php printf( esc_html__( 'View all posts &raquo;', 'monarch' ) ); ?>
      </a>
    </div>
    
  </div>

</div>