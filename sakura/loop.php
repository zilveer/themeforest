<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php
   global $query_string;
   
   //query_posts($query_string . EX_CATS);
   if (preg_match('/(cat=\d+)/', $query_string, $m))
   {
      $query_string=str_replace($m[1], $m[1].EX_CATS_SM, $query_string);
   }
   elseif( defined('EX_CATS') )
   {
      $query_string .= EX_CATS;
   }
   //echo $query_string;
   query_posts($query_string);
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php
   $options = get_option( 'sample_theme_options' );
   $b=$options['show_paginator'];
   //print_r($options);
   if ( $wp_query->max_num_pages > 1 && ($b==1 || $b==2) ) :
   ?>
	<div id="nav-above" class="navigation">
	   <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	</div>
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) :

//ob_get_clean();
//echo get_header();

?>
		<h1 class="page-title"><?php _e( 'Not Found', 'sakura' ); ?></h1>
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( in_category( _x('gallery', 'gallery category slug', 'sakura') ) ) : ?>
		<div id="post-<?php the_ID(); ?>" class="post">
			<h2 class="entry-title _cf"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sakura' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry_meta">
				<?php sakura_posted_on(); ?>
			</div><!-- .entry-meta -->
ddd
			<div class="entry-content">
			   <?php
			         ob_start();
			         the_permalink();
			         $link=ob_get_clean();
			         $src_small=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'small-post-thumbnail' );
                  //echo $src_small."!!!!!";
                  if (sakura_post_has_image()) echo '<a href="'.$link.'"><img alt="" src="'.sakura_postimage(150, 150).'" width="150" height="150"  class="alignleft" /></a>';
			   ?>
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>			
						<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-utility">
				<a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', 'sakura'), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'sakura' ); ?>"><?php _e( 'More Galleries', 'sakura' ); ?></a>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sakura' ), __( '1 Comment', 'sakura' ), __( '% Comments', 'sakura' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'sakura' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display posts in the asides category */ ?>

	<?php elseif ( in_category( _x('asides', 'asides category slug', 'sakura') ) ) : ?>
		<div id="post-<?php the_ID(); ?>" class="post">

		<?php if ( (is_archive() || is_search() )  && false) : // Display excerpts for archives and search. ?>
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
			   <?php
			         ob_start();
			         the_permalink();
			         $link=ob_get_clean();
                  //echo $src_small."!!!!!";
                  if (sakura_post_has_image()) echo '<a href="'.$link.'"><img alt="" src="'.sakura_postimage(150, 150).'" width="150" height="150"  class="alignleft" /></a>';
			   ?>
				<?php the_content( __( '', 'sakura' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php sakura_posted_on(); ?>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sakura' ), __( '1 Comment', 'sakura' ), __( '% Comments', 'sakura' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'sakura' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
	
  
      <?php echo sakura_posted_on_date2(); ?>
	
		<div id="post-<?php the_ID(); ?>" class="article">
			<h2 class="entry-title _cf"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sakura' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<?php if ( (is_archive() || is_search()) && false ) : // Only display excerpts for archives and search. ?>
			<div class="entry-content">
				<?php
				ob_start();
				//the_excerpt(  );
				the_content( __( '#LINK#', 'sakura' ) );
				$ret=ob_get_clean();
			   if (preg_match('/(<a[^>]+>#LINK#<\/a>)/', $ret, $m))
			   {
				   $ret=str_replace($m[1], '', $ret);
			   }
			   echo $ret;
				?>
			</div><!-- .entry-summary -->
			<?php
			   if ($m[1])
			   {
			      $m[1]=str_replace('#LINK#', '', $m[1]);
			      $m[1]=str_replace('more-link', 'go_details', $m[1]);
			      echo ''.$m[1].'';
			   }
			?>
	<?php else : ?>
			
			   <?php
			   
			      sakura_post_before();
			   
			   ?>
			
			   <?php
			         ob_start();
			         the_permalink();
			         $link=ob_get_clean();
			         $src_small = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'small-post-thumbnail' );
                  //echo $src_small."!!!!!";
                  $cl = sakura_post_type();
                  if (sakura_post_has_image() && ($cl != 'image')) echo '<a href="'.$link.'"><img alt="" src="'.sakura_postimage(150, 150).'" width="150" height="150" class="alignleft" /></a>';
			   ?>
				<?php
				   ob_start();
				   the_content( __( '#LINK#', 'sakura' ) );
				   $ret=ob_get_clean();
				   if (preg_match('/(<a[^>]+>#LINK#<\/a>)/', $ret, $m))
				   {
   				   $ret=str_replace($m[1], '', $ret);
				   }
				   echo $ret;
			   ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sakura' ), 'after' => '</div>' ) ); ?>
			<!-- .entry-content -->
			<?php
			   if (!empty($m[1]))
			   {
			      $m[1]=str_replace('more-link', 'go_details', $m[1]);
			      $m[1]=str_replace('#LINK#', '', $m[1]);
			      echo ''.$m[1].'';
			   }
			?>
	<?php endif; ?>
			<span class="comments-link"></span>

		</div><!-- #post-## -->
		
		<!--
			<div class="entry-meta">
				
				
				   <?php if ( count( get_the_category() ) ) : ?>
					   <span class="cat-links">
						   <?php printf( __( '<span class="%1$s">in</span> %2$s', 'sakura' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					   </span>
				   <?php endif; ?>
				   <?php
					   $tags_list = get_the_tag_list( '', ', ' );
					   if ( $tags_list ):
				   ?>
					   <span class="meta-sep">|</span>
					   <span class="tag-links">
						   <?php printf( __( '<span class="%1$s">tagged</span> %2$s', 'sakura' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					   </span>
				   <?php endif; ?>
				   
				   <?php edit_post_link( __( 'Edit', 'sakura' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>

			</div>
	 -->
		
		<?php echo sakura_posted_on_date3(); ?>

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php
   $options = get_option( 'sample_theme_options' );
   $b=$options['show_paginator'];
   //print_r($options);
   if ( $wp_query->max_num_pages > 1 && ($b==1 || $b==3) ) :
   ?>
	<div id="nav-above" class="navigation">
	   <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	</div>
	
<?php endif; ?>
