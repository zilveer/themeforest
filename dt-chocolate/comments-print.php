<?php

global $dt_first_com, $dt_my_comments_count;
$dt_first_com = 1;
$dt_my_comments_count = 0;
if (!function_exists("print_comments")) 
{
   function print_comments($comment, $args, $depth)
   {
	  global $dt_my_comments_count;
	  $dt_my_comments_count++;
	  
	  global $dt_first_com;
	  
	   $GLOBALS['comment'] = $comment;
	
	   if ($depth==1)
	   {
		  $av_size=80;
	   }
	   else
	   {
		  $av_size=40;
	   }
	
	  $u=get_template_directory_uri();
	
	   switch ( $comment->comment_type ) :
			case 'pingback'  :
			case 'trackback' :
	   ?>
		<div class="comment_bg level_<?php echo $depth; if ($dt_first_com) echo ' first'; ?>" id="comment-<?php comment_ID(); ?>"> 
			<div class="comment">
				<?php comment_text(); ?>
				<div class="comment_meta">
					<?php _e( 'Pingback:', LANGUAGE_ZONE ); ?>
					<?php comment_author_link(); ?>
					<?php edit_comment_link( __('(Edit)', LANGUAGE_ZONE), ' ' ); ?>
				</div>
			</div> 
		</div>
	   <?php
			   break;
		   default:
	   ?>

		<div class="comment_bg level_<?php echo $depth; if ($dt_first_com) echo ' first'; ?>" id="comment-<?php comment_ID(); ?>"> 
		   <div class="comment"> 
			 
			   <?php
				  // <a href="#"><img src="usr/featured-posts/3.jpg" width="60" height="60" class="shadow_dark" /></a> 
				  echo '<a>';
				  ob_start();
				echo get_avatar( $comment, $av_size, $u.'/images/ava_'.($av_size==40 ? 'small' : 'big').'.png' );
				$av = ob_get_clean();
			   $av = str_replace("1.gra", "gra", $av);
				echo str_replace('class=\'', 'class=\'shadow_dark ', $av);
				echo '</a>';
		   ?>          
			 <?php comment_text(); ?>
			 <div class="comment_meta"> 
			   <a href="#" class="ico_link date"><?php printf( __( '%1$s at %2$s', LANGUAGE_ZONE ), get_comment_date(),  get_comment_time() ); ?></a> 
			   <?php
				  ob_start();
				  echo get_comment_author_link();
				  $l = ob_get_clean();
				  $l = str_replace("'url", "'url ico_link author", $l);
				  if (!preg_match('/ico_link author/', $l))
				  {
					 $l = '<a class="ico_link author nofollow">'.$l.'</a>';
				  }
				  echo $l;
			   ?>
			   <?php
			   
			   global $post;
			   if ($post->comment_status!='closed')
				  echo '<a href="#" class="ico_link comments">reply</a>';
			   ?>
			 </div> 
		   </div> 
		 </div> 

	   <?php
	   endswitch;
	
	   $dt_first_com = 0;
   }
}

?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', LANGUAGE_ZONE ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', LANGUAGE_ZONE ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php
//wp_list_comments( array( 'callback' => 'print_comments' ) );
ob_start();
wp_list_comments( array( 'callback' => 'print_comments' ) );
$ret = ob_get_clean();
$ret = preg_replace('/(<\/div>[\n\r\t ]+)<\/li>/', '\\1', $ret);
echo $ret;
?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', LANGUAGE_ZONE ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', LANGUAGE_ZONE ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

