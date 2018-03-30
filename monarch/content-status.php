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

  <article id="post-<?php the_ID(); ?>" <?php post_class( array( 'post-front-block ShowOnScroll' ) ); ?> >

    <span class="post-date"><?php monarch_post_date(); ?></span>

    <header class="post-header <?php if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) : ?>without-post-thumbnail<?php endif; ?>">

      <?php if ( has_post_thumbnail() ) : ?>
        <a class="post-thumbnail" style="background-image: url(<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' ); echo $large_image_url[0]; ?>);"></a>
      <?php endif; ?>

      <?php monarch_post_format_header(); ?>
      
      <?php if ( is_sticky() && ! is_paged() ) { printf( '<span class="sticky-post"><i class="ion-star"></i></span>' ); }; ?>

      <div class="titles">

        <?php the_category(); ?>

        <?php if ( is_single() ) : ?>
          <h1 class="post-title"><?php the_content(); ?></h1>
        <?php else : ?>
          <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_content(); ?></a></h2>
        <?php endif; ?>

        <div class="post-front-content"><?php the_author_posts_link(); ?></div>

      </div>

    </header>
    
  </article>

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