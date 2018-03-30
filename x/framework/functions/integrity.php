<?php

// =============================================================================
// FUNCTIONS/INTEGRITY.PHP
// -----------------------------------------------------------------------------
// Integrity specific functions.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Entry Meta
//   02. Portfolio Tags
//   03. Individual Comment
// =============================================================================

// Entry Meta
// =============================================================================

if ( ! function_exists( 'x_integrity_entry_meta' ) ) :
  function x_integrity_entry_meta() {

    //
    // Author.
    //

    $author = sprintf( '<span><i class="x-icon-pencil" data-x-icon="&#xf040;"></i> %s</span>',
      get_the_author()
    );


    //
    // Date.
    //

    $date = sprintf( '<span><time class="entry-date" datetime="%1$s"><i class="x-icon-calendar" data-x-icon="&#xf073;"></i> %2$s</time></span>',
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
                              . '"><i class="x-icon-bookmark" data-x-icon="&#xf02e;"></i> '
                              . $category->name
                              . '</a>'
                              . $separator;
        }

        $categories_list = sprintf( '<span>%s</span>',
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
                            . '"><i class="x-icon-bookmark" data-x-icon="&#xf02e;"></i> '
                            . $category->name
                            . '</a>'
                            . $separator;
      }

      $categories_list = sprintf( '<span>%s</span>',
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

$comments = sprintf( '<span><a href="%1$s" title="%2$s" class="meta-comments"><i class="x-icon-comments" data-x-icon="&#xf086;"></i> %3$s</a></span>',
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
        $author,
        $date,
        $categories_list,
        $comments
      );
    }

  }
endif;



// Portfolio Tags
// =============================================================================

if ( ! function_exists( 'x_integrity_portfolio_tags' ) ) :
  function x_integrity_portfolio_tags() {

    $terms = get_the_terms( get_the_ID(), 'portfolio-tag' );

    echo '<ul class="x-ul-icons">';
    foreach( $terms as $term ) {
      echo '<li class="x-li-icon"><a href="' . get_term_link( $term->slug, 'portfolio-tag' ) . '"><i class="x-icon-check" data-x-icon="&#xf00c;"></i>' . $term->name . '</a></li>';
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

if ( ! function_exists( 'x_integrity_comment' ) ) :
  function x_integrity_comment( $comment, $args, $depth ) {

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
      $avatar_variation = ( x_is_product() ) ? ' x-img-thumbnail' : '';
    ?>
    <li id="li-comment-<?php comment_ID(); ?>" itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?>>
      <?php
      printf( '<div class="x-comment-img">%1$s %2$s</div>',
        '<span class="avatar-wrap cf' . $avatar_variation . '">' . get_avatar( $comment, 120 ) . '</span>',
        ( $comment->user_id === $post->post_author ) ? '<span class="bypostauthor">' . __( 'Post<br>Author', '__x__' ) . '</span>' : ''
      );
      ?>
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <header class="x-comment-header">
          <?php
          printf( '<cite class="x-comment-author" itemprop="author">%1$s</cite>',
            get_comment_author_link()
          );
          printf( '<div><a href="%1$s" class="x-comment-time"><time itemprop="datePublished datetime="%2$s">%3$s</time></a></div>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            get_comment_time( 'c' ),
            sprintf( __( '%1$s at %2$s', '__x__' ),
              get_comment_date(),
              get_comment_time()
            )
          );
          edit_comment_link( __( '<i class="x-icon-edit" data-x-icon="&#xf044;"></i> Edit', '__x__' ) );
          ?>
          <?php if ( x_is_product() && get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>
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
        <?php if ( ! x_is_product() ) : ?>
        <div class="x-reply">
          <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span class="comment-reply-link-after"><i class="x-icon-reply" data-x-icon="&#xf112;"></i></span>', '__x__' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
        <?php endif; ?>
      </article>
    <?php
        break;
    endswitch;

  }
endif;