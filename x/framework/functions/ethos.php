<?php

// =============================================================================
// FUNCTIONS/ETHOS.PHP
// -----------------------------------------------------------------------------
// Ethos specific functions.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Entry Meta
//   02. Entry Cover Background Image Style
//   03. Entry Cover
//   04. Entry Top Navigation
//   05. Featured Index Content
//   06. Post Categories
//   07. Category Accent Color
//   08. Portfolio Tags
//   09. Individual Comment
// =============================================================================

// Entry Meta
// =============================================================================

if ( ! function_exists( 'x_ethos_entry_meta' ) ) :
  function x_ethos_entry_meta() {

    //
    // Author.
    //

    $author = sprintf( ' %1$s %2$s</span>',
      __( 'by', '__x__' ),
      get_the_author()
    );


    //
    // Date.
    //

    $date = sprintf( '<span><time class="entry-date" datetime="%1$s">%2$s</time></span>',
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() )
    );


    //
    // Categories.
    //

    if ( get_post_type() == 'x-portfolio' ) {
      if ( has_term( '', 'portfolio-category', NULL ) ) {
        $categories        = get_the_terms( get_the_ID(), 'portfolio-category' );
        $separator         = ', ';
        $categories_output = '';
        foreach ( $categories as $category ) {
          $categories_output .= '<a href="'
                              . get_term_link( $category->slug, 'portfolio-category' )
                              . '" title="'
                              . esc_attr( sprintf( __( "View all posts in: &ldquo;%s&rdquo;", '__x__' ), $category->name ) )
                              . '"> '
                              . $category->name
                              . '</a>'
                              . $separator;
        }

        $categories_list = sprintf( '<span>%1$s %2$s',
          __( 'In', '__x__' ),
          trim( $categories_output, $separator )
        );
      } else {
        $categories_list = '';
      }
    } else {
      $categories        = get_the_category();
      $separator         = ', ';
      $categories_output = '';
      foreach ( $categories as $category ) {
        $categories_output .= '<a href="'
                            . get_category_link( $category->term_id )
                            . '" title="'
                            . esc_attr( sprintf( __( "View all posts in: &ldquo;%s&rdquo;", '__x__' ), $category->name ) )
                            . '"> '
                            . $category->name
                            . '</a>'
                            . $separator;
      }

      $categories_list = sprintf( '<span>%1$s %2$s',
        __( 'In', '__x__' ),
        trim( $categories_output, $separator )
      );
    }


    //
    // Comments link.
    //

    if ( comments_open() ) {

      $title  = apply_filters( 'x_entry_meta_comments_title', get_the_title() );
      $link   = apply_filters( 'x_entry_meta_comments_link', get_comments_link() );
      $number = apply_filters( 'x_entry_meta_comments_number', get_comments_number() );
      
      $text = ( 0 === $number ) ? 'Leave a Comment' : sprintf( _n( '%s Comment', '%s Comments', $number, '__x__' ), $number );

      $comments = sprintf( '<span><a href="%1$s" title="%2$s" class="meta-comments">%3$s</a></span>',
        esc_url( $link ),
        esc_attr( sprintf( __( 'Leave a comment on: &ldquo;%s&rdquo;', '__x__' ), $title ) ),
        $text
      );

    } else {

      $comments = '';

    }


    //
    // Output.
    //

    if ( x_does_not_need_entry_meta() ) {
      return;
    } else {
      printf( '<p class="p-meta">%1$s%2$s%3$s%4$s</p>',
        $categories_list,
        $author,
        $date,
        $comments
      );
    }

  }
endif;



// Entry Cover Background Image Style
// =============================================================================

if ( ! function_exists( 'x_ethos_entry_cover_background_image_style' ) ) :
  function x_ethos_entry_cover_background_image_style() {

    $featured_image   = x_make_protocol_relative( x_get_featured_image_url() );
    $background_image = ( $featured_image != '' ) ? 'background-image: url(' . $featured_image . ');' : 'background-image: none;';

    return $background_image;

  }
endif;



// Entry Cover
// =============================================================================

if ( ! function_exists( 'x_ethos_entry_cover' ) ) :
  function x_ethos_entry_cover( $location ) {

    if ( $location == 'main-content' ) { ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <a class="entry-cover" href="<?php the_permalink(); ?>" style="<?php echo x_ethos_entry_cover_background_image_style(); ?>">
          <h2 class="h-entry-cover"><span><?php x_the_alternate_title(); ?></span></h2>
        </a>
      </article>

    <?php } elseif ( $location == 'post-carousel' ) { ?>

      <?php GLOBAL $post_carousel_entry_id; ?>

      <article <?php post_class(); ?>>
        <a class="entry-cover" href="<?php the_permalink(); ?>" style="<?php echo x_ethos_entry_cover_background_image_style(); ?>">
          <h2 class="h-entry-cover"><span><?php ( $post_carousel_entry_id == get_the_ID() ) ? the_title() : x_the_alternate_title(); ?></span></h2>
          <div class="x-post-carousel-meta">
            <span class="entry-cover-author"><?php echo get_the_author(); ?></span>
            <span class="entry-cover-categories"><?php echo x_ethos_post_categories(); ?></span>
            <span class="entry-cover-date"><?php echo get_the_date( 'F j, Y' ); ?></span>
          </div>
        </a>
      </article>

    <?php }

  }
endif;



// Entry Top Navigation
// =============================================================================

if ( ! function_exists( 'x_ethos_entry_top_navigation' ) ) :
  function x_ethos_entry_top_navigation() {

    if ( x_is_portfolio_item() ) {
      $link = x_get_parent_portfolio_link();
    } elseif ( x_is_product() ) {
      $link = x_get_shop_link();
    }

    $title = esc_attr( __( 'See All Posts', '__x__' ) );

    ?>

      <div class="entry-top-navigation">
        <a href="<?php echo $link; ?>" class="entry-parent" title="<?php $title; ?>"><i class="x-icon-th" data-x-icon="&#xf00a;"></i></a>
        <?php x_entry_navigation(); ?>
      </div>

    <?php

  }
endif;



// Featured Index Content
// =============================================================================

if ( ! function_exists( 'x_ethos_featured_index' ) ) :
  function x_ethos_featured_index() {

    $entry_id                    = get_the_ID();
    $index_featured_layout       = get_post_meta( $entry_id, '_x_ethos_index_featured_post_layout', true );
    $index_featured_size         = get_post_meta( $entry_id, '_x_ethos_index_featured_post_size', true );
    $index_featured_layout_class = ( $index_featured_layout == 'on' ) ? ' featured' : '';
    $index_featured_size_class   = ( $index_featured_layout == 'on' ) ? ' ' . strtolower( $index_featured_size ) : '';
    $is_index_featured_layout    = $index_featured_layout == 'on' && ! is_single();

    ?>

      <a href="<?php the_permalink(); ?>" class="entry-thumb<?php echo $index_featured_layout_class; echo $index_featured_size_class; ?>" style="<?php echo x_ethos_entry_cover_background_image_style(); ?>">
        <?php if ( $is_index_featured_layout ) : ?>
          <span class="featured-meta"><?php echo x_ethos_post_categories(); ?> / <?php echo get_the_date( 'F j, Y' ); ?></span>
          <h2 class="h-featured"><span><?php x_the_alternate_title(); ?></span></h2>
          <span class="featured-view"><?php _e( 'View Post', '__x__' ); ?></span>
        <?php else : ?>
          <span class="view"><?php _e( 'View Post', '__x__' ); ?></span>
        <?php endif; ?>
      </a>

    <?php

  }
endif;



// Post Categories
// =============================================================================

if ( ! function_exists( 'x_ethos_post_categories' ) ) :
  function x_ethos_post_categories() {

    $categories      = get_the_terms( get_the_ID(), 'category' );
    $categories_list = array();


    if ( ! is_array( $categories ) ) {
      return '';
    }

    foreach ( $categories as $category ) {
      $categories_list[] = $category->name;
    }

    return implode( ', ', $categories_list );

  }
endif;



// Category Accent Color
// =============================================================================

if ( ! function_exists( 'x_ethos_category_accent_color' ) ) :
  function x_ethos_category_accent_color( $category_id, $fallback_color = '#ffffff' ) {

    $t_id      = $category_id;
    $term_meta = get_option( 'taxonomy_' . $t_id );
    $accent    = ( $term_meta['accent'] != '' ) ? $term_meta['accent'] : $fallback_color;

    return $accent;

  }
endif;



// Portfolio Tags
// =============================================================================

if ( ! function_exists( 'x_ethos_portfolio_tags' ) ) :
  function x_ethos_portfolio_tags() {

    $terms = get_the_terms( get_the_ID(), 'portfolio-tag' );

    echo '<ul class="x-ul-tags">';
    foreach( $terms as $term ) {
      echo '<li><a href="' . get_term_link( $term->slug, 'portfolio-tag' ) . '">' . $term->name . '</a></li>';
    };
    echo '</ul>';

  }
endif;



// Individual Comment
// =============================================================================

//
// 1. Pingbacks and trackbacks.
// 2. Normal Comments.
//

if ( ! function_exists( 'x_ethos_comment' ) ) :
  function x_ethos_comment( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback' :  // 1
      case 'trackback' : // 1
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
      <p><?php _e( 'Pingback:', '__x__' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', '__x__' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
        break;
      default : // 2
      GLOBAL $post;
      if ( X_WOOCOMMERCE_IS_ACTIVE ) :
        $rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
      endif;
    ?>
    <li id="li-comment-<?php comment_ID(); ?>" itemprop="review" itemscope itemtype="http//schema.org/Review" <?php comment_class(); ?>>
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <?php
        printf( '<div class="x-comment-img">%1$s %2$s</div>',
          '<span class="avatar-wrap cf">' . get_avatar( $comment, 120 ) . '</span>',
          ( $comment->user_id === $post->post_author ) ? '<span class="bypostauthor">' . __( 'Author', '__x__' ) . '</span>' : ''
        );
        ?>
        <div class="x-comment-content-wrap">
          <header class="x-comment-header">
            <div class="x-comment-meta">
              <?php
              printf( '<a href="%1$s" class="x-comment-time"><time itemprop="datePublished datetime="%2$s">%3$s</time></a>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                sprintf( __( '%1$s', '__x__' ),
                  get_comment_date()
                )
              );
              ?>
              <?php if ( ! x_is_product() ) : ?>
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span class="comment-reply-link-after"><i class="x-icon-reply" data-x-icon="&#xf112;"></i></span>', '__x__' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
              <?php endif; ?>
              <?php edit_comment_link( __( 'Edit <i class="x-icon-edit" data-x-icon="&#xf044;"></i>', '__x__' ) ); ?>
            </div>
            <?php
            printf( '<cite class="x-comment-author" itemprop="author">%1$s</cite>',
              get_comment_author_link()
            );
            ?>
            <?php if ( x_is_product() && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
              <div class="star-rating-container">
                <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', '__x__' ), $rating ) ?>">
                  <span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', '__x__' ); ?></span>
                </div>
              </div>
            <?php endif; ?>
          </header>
          <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="x-comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', '__x__' ); ?></p>
          <?php endif; ?>
          <section class="x-comment-content" itemprop="description">
            <?php comment_text(); ?>
          </section>
        </div>
      </article>
    <?php
        break;
    endswitch;

  }
endif;