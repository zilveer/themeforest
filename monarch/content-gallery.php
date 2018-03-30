<?php
/**
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
?>

<!-- Post Wrapper -->
<div class="post-wrap elem">

  <div class="timeline"></div>

  <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'ShowOnScroll' ) ); ?> >

    <span class="post-date"><?php monarch_post_date(); ?></span>

    <header class="post-header <?php if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) : ?>without-post-thumbnail<?php endif; ?>">

      <?php monarch_post_thumbnail(); ?>

      <?php monarch_post_format_header(); ?>
      
      <?php if ( is_sticky() && ! is_paged() ) { printf( '<span class="sticky-post"><i class="ion-star"></i></span>' ); }; ?>

      <div class="titles">
        <?php the_category(''); ?>
        <?php
          if ( is_single() ) :
            the_title( '<h1 class="post-title">', '</h1>' );
          else :
            the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
          endif;
        ?>
      </div>

    </header>

    <div class="post-content clearfix">
      <?php
        the_content();
        wp_link_pages_monarch();
      ?>
    </div>

    <?php
      if ( is_single() ) :
        echo '<div class="post-tags clearfix">';
           the_tags( '', '', '' );
           edit_post_link( esc_html__( 'Edit', 'monarch' ), '', '' );
        echo '</div>';
      endif;
    ?>

    <footer class="post-footer">
      <ul>
        <li class="author"><?php the_author_posts_link(); ?></li>
        <?php monarch_attachments() ?>
        <?php monarch_post_format_footer(); ?>
        <li class="share"><a href="#" data-toggle="modal" data-target="#modal-like-<?php the_ID(); ?>"><?php esc_html_e('Share', 'monarch'); ?></a></li>
        <li class="comments pull-right"><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { comments_popup_link( esc_html__( '0', 'monarch' ), esc_html__( '1', 'monarch' ), esc_html__( '%', 'monarch' ) ); } ?></li>
      </ul>
    </footer>

  </article>
  
</div>

<!-- Modal Post Like -->
<div class="modal modal-vcenter fade modal-like" id="modal-like-<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="shareinit" data-url="<?php the_permalink() ?>" data-title="<?php the_title() ?>"></div>
      </div>
    </div>
  </div>
</div>

<?php
  if ( is_single() && get_the_author_meta( 'description' ) && !get_theme_mod('monarch_author_bio') ) :
    //  Author Bio
    get_template_part( 'author-bio' );
  endif;
?>

<?php 
  if( is_single() && !get_theme_mod('monarch_relatedposts') ) :
    //  Related Posts
    get_template_part('inc/widgets/relatedposts');
  endif; 
?>