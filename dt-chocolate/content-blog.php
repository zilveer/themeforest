	<div <?php
	  ob_start();
	  post_class( 'article_box col_'.the_post_size() );
	  $ret = ob_get_clean();
	  $ret = preg_replace('/(^| )post( |$)/', '\\1\\2', $ret);
	  echo $ret;
	  global $post;
	  setup_postdata($post);
   ?> id="post-<?php the_ID(); ?>">
	  <div class="article_t"></div>
	  <div class="article">

		<a href="<?php echo get_type_link( the_post_class() ); ?>" class="post_type <?php echo the_post_class(TRUE); ?>"<?php if (the_post_class() == "link") echo ' target="_blank"'; ?>></a>
		<h2 class="entry-title _cf"><a<?php if (the_post_class() == "link") echo ' target="_blank"'; ?> href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'dt' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( has_post_thumbnail() ) {?>
		  <a href="<?php the_permalink(); ?>"  title="<?php the_title_attribute(); ?>">
			<?php
			   //the_post_thumbnail( array( 'alignleft' ) );
			   $orig_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
			   if ( $orig_image[0] ) {				  
				  $tmp_src = dt_clean_thumb_url($orig_image[0]);

				  $small_image = get_template_directory_uri().'/thumb.php?src='.$tmp_src.'&amp;w=180&amp;h=180&amp;zc=1';
				  echo '<img src="'.$small_image.'" width="180" height="180" class="alignleft" alt="" />';
			   }
			?>
		  </a>
		<?php } ?>

	  <?php the_post_before(); ?>

	  <?php
		 global $more;
		 $more = 0;
	  ?>

		<?php if ( is_search() || is_archive() ) : // Only display Excerpts for archives & search ?>
			<?php
			   the_excerpt( __( '<span><i></i>read more</span>', 'dt' ) );
			?>
		<?php else : ?>
			<?php the_content( __( '<span><i></i>read more</span>', 'dt' ) );
			?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'dt' ), 'after' => '</div>' ) ); ?>
		<?php endif; ?>
		
		<?php
		   if ( the_post_class() == "link" )
		   {
			  ?>
				 <a href="<?php the_permalink(); ?>" class="go_more go_link"<?php if (the_post_class() == "link") echo ' target="_blank"'; ?>><span><i></i><?php _e("launch link", LANGUAGE_ZONE); ?></span></a>
			  <?php
		   }
		?>

	  </div>
	  <div class="article_s"></div>
	  <div class="article_footer">
		  <?php
			  printf( __( '<a class="ico_link date" href="%1$s" rel="bookmark">%3$s</a> <a class="ico_link author" href="%4$s" title="%5$s">%6$s</a>', 'dt' ),
			  get_permalink(),
			  get_the_date( 'c' ),
			  get_the_date(),
			  get_author_posts_url( get_the_author_meta( 'ID' ) ),
			  sprintf( esc_attr__( 'View all posts by %s', 'dt' ), get_the_author() ),
			  get_the_author()
			  );
		  ?>
		  <?php comments_popup_link( __( 'Leave a comment', 'dt' ), __( '1 Comment', 'dt' ), __( '% Comments', 'dt' ), 'ico_link comments' ); ?>
		  <span class="ico_link categories"><?php
			the_category( ', ' );
		  ?></span>
		  <?php the_tags( '<span class="ico_link tags">', ', ', '</span>' ); ?>
		  <?php edit_post_link( __( 'Edit', 'dt' ), '<span class="ico_link edit-link">', '</span>' ); ?> 
	  </div>
	  <div class="article_footer_b"></div>
	</div>
