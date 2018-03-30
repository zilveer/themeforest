<?php get_header(); ?>

<div id="contentBox" class="boxStuff activeBox">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div  <?php post_class(); ?>>
		<h2 class="posttitle"><?php the_title(); ?></h2>
		<p id="metaStuff"><?php the_date(); echo ' by '; the_author(); echo ' in '; the_category(', '); edit_post_link(' - Edit Post'); ?></p>		
		<div class="entry">
			<?php 
			the_content();
            the_tags('<div id="tagInfo">'.__('Tags','themolitor').': ',', ','</div>');
            ?>							
		<div class="clear"></div>
        </div><!--end entry-->
        
        <div id="commentsection">
			<?php comments_template(); ?>
        </div>
	</div><!--end post-->

<?php endwhile; endif; ?>
        		
</div><!--end contentBox-->

<?php 
$args = array('post_type' => 'attachment','post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID ); $attachments = get_posts($args);
if ($attachments) { 
?>
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
<?php }

get_sidebar();
get_footer(); 
?>