<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

   <?php if (false) { ?>
				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'sakura' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'sakura' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->
   <?php } ?>


            <?php echo sakura_posted_on_date2(); ?>
            
				<div id="post-<?php the_ID(); ?>" class="article">
					<h1 class="entry-title _cf"><?php the_title(); ?></h1>

               <div class="entry_meta">
                  <?php sakura_meta(); ?>
                  
                  <?php //edit_post_link( __( 'Edit', 'sakura' ), '<span class="edit-link">', '</span>' ); ?>
                  
                  <br style="clear: both;" />
               </div>

					<div class="entry-content">
			   <?php
			         
			         sakura_post_before();
			         
                  $src_big   = sakura_postimage(800, 0);
                  $src_small = sakura_postimage(150, 150);
			         
			         /*
			         $big_size=$thumb->get_the_post_thumbnail_size('post', 'post-big-image', NULL, 'post-verybig-thumbnail');
			         if ($big_size[0]<617) $src_big=0;
			         */
	
         $show = 0;

         global $post;
         $cats = wp_get_post_categories($post->ID);

         foreach (get_pages() as $p)
         {
            $pp = new Portfolio(array("post" => $p->ID));
            $c = $pp->get_cat();
            if (in_array($c, $cats)) $show = 1;
         }


                  //echo $src_small."!!!!!";
                  ob_start();
                  the_title();
                  $t=ob_get_clean();
                  $t=htmlspecialchars($t);
                  $c = sakura_post_type();
                  if ($c != 'image' || $show)
{

   if ($show)
   {

     $src_small = sakura_postimage(590, 250);

   }
global $posthide;

//echo (int)$posthide->get_hide_f();

   if (!$posthide->get_hide_f())
   {
                  if ($src_big) echo '<a href="'.$src_big.'" class="lb" title="'.$t.'"><img src="'.$src_small.'" class="alignleft" /></a>';
                  elseif ($src_small)
                  {
                     echo '<a><img src="'.$src_small.'" class="small_img alignleft" /></a>';
                  }
   }
}
			   ?>
						<?php
                     ob_start();
                     the_content();
                     $cnt = ob_get_clean();
                     $cnt = preg_replace('/<span id="more-\d+"><\/span>/', '', $cnt);
                     echo $cnt;
                  ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sakura' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

<!--
<div class="in_entry-meta">
    <?php sakura_posted_on(); ?>
   <?php if ( count( get_the_category() ) ) : ?>
      <span class="cat-links">
	      <?php printf( __( '<span class="%1$s">Categories:</span> %2$s', 'sakura' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
      </span>
   <?php endif; ?>
   <?php
      $tags_list = get_the_tag_list( '', ', ' );
      if ( $tags_list ):
   ?>
      <span class="tag-links">
	      <?php printf( __( '<span class="%1$s">Tags:</span> %2$s', 'sakura' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
      </span>
   <?php endif; ?>
  </div>
  -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'sakura_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'sakura' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'sakura' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>

				</div><!-- #post-## -->

            <!--
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'sakura' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'sakura' ) . '</span>' ); ?></div>
				</div>
				-->
				<!-- #nav-below -->

				<?php
comments_template( '', true );
			   ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
