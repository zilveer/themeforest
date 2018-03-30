<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', LANGUAGE_ZONE ); ?></p>
			</div><!-- #comments -->
<?php
		return;
	endif;
?>

<?php

   //comments_template( '', true );
   
   global $post;
   if (!$post) $post = $wp_query->post;
   
   if ($post->comment_status!='closed')
   {   
   ?>
   
      <?php if ( have_comments() ) : ?>
      
      <div class="article_footer_t"></div>
      <div class="article_footer">
      
	   <div class="header h_com"><?php
	   
	   ob_start();
	   get_template_part('comments-print');
	   ob_get_clean();
	   
	   global $dt_my_comments_count;
	   
	   printf( _n( 'One comment:', '%1$s comments:', $dt_my_comments_count, LANGUAGE_ZONE ),
	   number_format_i18n( get_comments_number() ) );
	   ?></div>
	   
	   <?php
	      get_template_part('comments-print');
	   ?>
	   
	   </div>
	   <div class="article_footer_b"></div>
	   
	   <?php endif; ?>

   <?php   
      global $post;
      if (!$post) $post = $wp_query->post;
      //print_r($post);
	   if ($post->comment_status!='closed')
	   {
	      get_template_part('comments-form');
      }
   ?>

   
   <?php
   } else {
   		do_action( 'comment_form_comments_closed' );
   }
?>
