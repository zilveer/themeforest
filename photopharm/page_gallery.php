<?php
/*
Template Name: Gallery
*/

get_header(); 
?>

<div id="contentBox" class="boxStuff">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="entrytitle"><?php the_title(); ?></h2>
	<div class="entry">
		<?php the_content(); ?>				
		<br />						
		<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>
 	<?php edit_post_link(__('Edit Page','themolitor'),'<p id="metaStuff">','</p>'); ?>
 	
	<div class="clear"></div>
	<?php endwhile; endif; ?>
		
    <div id="commentsection">
		<?php comments_template(); ?>
    </div>
</div><!--end contentBox-->

<?php 
$args = array('post_type' => 'attachment','post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID ); $attachments = get_posts($args);
if ($attachments && !post_password_required()) { ?>
<div id="galleryBox" class="boxStuff">
	<ul class="attachmentGallery">
    	<?php attachment_toolbox(); ?>
    </ul>
</div><!--end galleryBox-->

<div id="bgControls">
	<a href="#" id="nextImg">&rarr;</a>
	<a href="#" id="prevImg">&larr;</a>
	<div id="imgInfo"></div>
</div><!--end bgControls-->

<?php } elseif($attachments && post_password_required()){ ?>
	<div class="noticeMessage">
	<?php echo '<form action="'.esc_url(site_url('wp-login.php?action=postpass','login_post')).'" method="post">
    <label for="passwordForm">'.__('Password Required:','themolitor').' </label>
    <input name="post_password" id="passwordForm" type="password" size="20" maxlength="20" />
    <input type="submit" name="Submit" value="'.esc_attr__('Submit','themolitor').'" />
    </form>';?>
	</div>
<?php } else { ?>
	<div class="noticeMessage"><?php _e('NOTICE: You need to upload images to this page to show a gallery here.','themolitor');?></div>
<?php }
	get_sidebar();
	get_footer(); 
?>