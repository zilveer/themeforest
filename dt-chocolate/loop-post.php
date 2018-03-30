<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */
?>

  <div id="content">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
<?php if(! post_password_required()): ?>
	
    <div class="article_box">
      <div class="article_t"></div>
      <div class="article">

        <?php
         
         if ( !isset($wp_query->query_vars['dt_portfolio']) ):
        ?>
        <span class="post_type <?php echo the_post_class(); ?>"></span>
        <?php endif; ?>
        
        <h1 class="entry-title _cf"><?php the_title(); ?></h1>
        
        <?php if (!$GLOBALS['dt_is_contacts'] && !$GLOBALS['nostrip']) { ?>
        
        <div class="hd entry_meta"<?php
        
           ob_start();
           the_post_before();
           $data = ob_get_clean();
        
           $large = $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
           //print_r($large); exit;
           if ( (the_post_class() == "photo" && preg_match('/\&amp\;w=700/', $data)) || ( $large[1] >= 700 ) || in_array(the_post_class(), explode(" ", "video audio")))
            echo ' style="border-bottom: 0; margin-bottom: 0;"';
        
        ?>>
          <?php
			  printf( '<a class="ico_link date" href="%1$s" rel="bookmark">%3$s</a> <a class="ico_link author" href="%4$s" title="%5$s">%6$s</a>',
			  get_permalink(),
			  get_the_date( 'c' ),
			  get_the_date(),
			  get_author_posts_url( get_the_author_meta( 'ID' ) ),
			  sprintf( esc_attr__( 'View all posts by %s', LANGUAGE_ZONE ), get_the_author() ),
			  get_the_author()
			  );
          ?>
          <?php 
            global $post;
            if ($post->comment_status!='closed')
               comments_popup_link( __( 'Leave a comment', LANGUAGE_ZONE ), __( '1 Comment', LANGUAGE_ZONE ), __( '% Comments', LANGUAGE_ZONE ), 'ico_link comments' );
          ?>
          <span class="ico_link categories"><?php
            ob_start();
            the_category( ', ' );
            $ret = ob_get_clean();
            $ret = str_replace(' rel="category tag"', '', $ret);
            echo $ret;
          ?></span>
          <?php the_tags( '<span class="ico_link tags">', ', ', '</span>' ); ?>
          <?php edit_post_link( __( 'Edit', LANGUAGE_ZONE ), '<span class="ico_link edit-link">', '</span>' ); ?> 
        </div>
        
        <?php } ?>

        <?php
			$flag = true;
			if( isset($wp_query->query_vars['dt_portfolio']) ) {
				$data = get_post_meta($post->ID, 'dt_portfolio_ct_options', true);
				if( !empty($data['dt_hide_img']) ) {
					$flag = false;
				}
			}
          if ( has_post_thumbnail() && $flag ) {
          $large = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');

          $tmp_src = dt_clean_thumb_url($large[0]);

          $large_image_url = $large[0];
          
          $is_large = 0;
          $w = 0;
          $h = 0;
          
          if ($large[1] >= 700)
          {
             $w = 700;
             $h = $large[2] * ($w / $large[1]);
             $is_large = 1;
          }
          elseif ($large[1] < 700 && $large[1] >= 350)
          {
             $w = 350;
             $h = $large[2] * ($w / $large[1]);
          }
          else
          {
             $w = $large[1];
             $h = $large[2];
          }
          
          $h = intval($h); $w = intval($w);
          
          $thumb = get_template_directory_uri().'/thumb.php?src='.$tmp_src.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1';       
          
        ?>
        <?php if ($is_large) { ?>
          <a href="<?php echo $large_image_url; ?>" title="<?php echo the_title_attribute('echo=0') ?>" class="prettyPhoto">
             <img src="<?php echo $thumb; ?>" width="<?php echo $w; ?>" height="<?php echo $h; ?>" alt="<?php the_title(); ?>" class="hd" /> 
          </a>
          <div class="hr_w bot"><i></i></div>
        <?php } else { ?>
          <a href="<?php echo $large_image_url; ?>" title="<?php echo the_title_attribute('echo=0') ?>" class="prettyPhoto">
             <img src="<?php echo $thumb; ?>" width="<?php echo $w; ?>" height="<?php echo $h; ?>" alt="<?php the_title(); ?>" class="alignleft" /> 
          </a>
        <?php } ?>
        <?php } ?>
       
   
   <?php the_post_before(); ?>    
	<?php
	the_content();
	if( is_single() && is_lb_enabled() ) {
		if( ('post' == get_post_type() && dt_get_theme_options('enable_in_blog')) ||
			('dt_portfolio' == get_post_type() && dt_get_theme_options('enable_in_portfolio')) )
			dt_get_like_buttons( get_the_ID() );
	}
	?>
	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', LANGUAGE_ZONE ), 'after' => '</div>' ) ); ?>
      </div>
      <div class="article_b"></div>
	  <?php comments_template(); ?>
	  
	  <?php if ($GLOBALS['dt_is_contacts']) get_template_part( 'contact' , 'form' ); ?>
    </div>
	
<?php else: // pass protection. ?>

<div class="article_box">
	<div class="article_t"></div>
	<div class="article">
<?php echo get_the_password_form(); ?>
	</div>
	<div class="article_b"></div> 
</div>

<?php endif; //end of password protection. ?>

	<?php endwhile; // end of the loop. ?>
    
  </div>
