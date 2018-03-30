<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
 <?php 
   global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =get_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    } 
 ?>
<?php
echo "comment-source:";
if ( have_comments() ) : ?>
                            
<?php foreach ($comments as $comment) : ?>
<div class="comment_wrapper">
 <div class="comment_author_avatar_wrapper">
   <?php echo get_avatar( $comment,  54, get_bloginfo("template_url")."/gfx/gravatar.png" ); ?>
   <div class="comment_author_avatar_border"></div><!-- END "comment_author_avatar_border" -->
   <div class="comment_author_avatar_shine"></div><!-- END "comment_author_avatar_shine" -->
 </div><!-- END "comment_author_avatar_wrapper" -->
  <div class="comment_bubble_wrapper">
 <div class="comment_bubble_top">
 <div class="comment_content_wrapper">
 <p class="comment_meta"><span class="comment_author_name"><?php comment_author_link() ?></span><span class="comment_date"><?php if(get_post_meta($post->ID, 'blog_display_commentdates', true) == "true") comment_date($cz_blogcom_dateformat) ?></span></p>
 <?php comment_text() ?>
  </div><!-- END "comment_content_wrapper" -->
  </div><!-- END "comment_bubble_top" -->
 <div class="comment_bubble_bottom"></div><!-- END "comment_bubble_bottom" -->
 </div><!-- END "comment_bubble_wrapper" -->
 <div class="clear_both"></div>
 <div class="comment_divider"></div>
</div><!-- END "comment_wrapper" -->
<?php endforeach; ?>

<?php
else:
if ( comments_open() ) 
echo "<h1>".$cz_blogcom_nocommentsyet."</h1>";
else 
echo "<h1>".$cz_blogcom_nocomments."</h1>";
endif; 

?>
     
  






