<?php
//currently this file has the same codes as default-content.php
//if there is no changes to codes in this file, we can remove this file and use default-content.php
//just need to add code in blog-layout-right-sidebar.php


global $ttso;
$ka_blogbutton            = $ttso->ka_blogbutton;
$ka_blogbutton_color      = $ttso->ka_blogbutton_color;
$ka_blogbutton_size       = $ttso->ka_blogbutton_size;
$ka_posted_by             = $ttso->ka_posted_by;
$ka_dragshare             = $ttso->ka_dragshare;
$content_default          = $ttso->ka_tt_content_default;


//pre-define values for backward compatibility
if ('' == $ka_blogbutton_color): 'black'  == $ka_blogbutton_color; endif;
if ('' == $ka_blogbutton_size):  'small'  == $ka_blogbutton_size;  endif;
if ('' == $content_default):     'false'  == $content_default;     endif;

//format "continue reading" button
$formatted_size    =  strtolower($ka_blogbutton_size);
$formatted_button  =  $formatted_size.'_button '.$formatted_size.'_'.$ka_blogbutton_color;
//retrieve all post meta of posts in the loop.
$linkpost           = get_post_meta($post->ID, "_jcycle_url_value", $single = true);
$external_image_url = get_post_meta($post->ID,'truethemes_external_image_url',true);
$video_url          = get_post_meta($post->ID,'truethemes_video_url',true);
$permalink          = get_permalink($post->ID);

//prepare to get image
$thumb              = get_post_thumbnail_id();
$image_width        = 538;
$image_height       = 218;

//use truethemes image croping script
$image_src = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);


//define post_class
//http://codex.wordpress.org/Template_Tags/post_class
//http://codex.wordpress.org/Function_Reference/get_post_class
$array_post_classes = get_post_class(); 
$post_classes = '';
foreach($array_post_classes as $post_class){
$post_classes .= " ".$post_class;
}
?>

<article class="blog_wrap <?php echo $post_classes;if ('' == ($video_url || $external_image_url || $thumb)):echo ' tt-blog-no-feature';endif;?>" id="post-<?php the_ID(); ?>">

<!-- assuming we don't need title and posted by, remove them -->


<div class="post_content">
<?php truethemes_begin_post_content_hook(); // action hook ?>


	<blockquote class="tt-post-quote">
		<span class="quote-entry-icon fa fa-quote-left"></span>
	 	<?php
	 	//setup our "continue reading" button setting from site option
	 	global $ttso;
	 	$ka_blogbutton            = $ttso->ka_blogbutton;
	 	$ka_blogbutton_color      = $ttso->ka_blogbutton_color;
	 	$ka_blogbutton_size       = $ttso->ka_blogbutton_size;
	 		 	
	 	//pre-define values for backward compatibility
	 	if ('' == $ka_blogbutton_color): 'black'  == $ka_blogbutton_color; endif;
	 	if ('' == $ka_blogbutton_size):  'small'  == $ka_blogbutton_size;  endif;
	 	
	 	//format "continue reading" button
	 	$formatted_size    =  strtolower($ka_blogbutton_size);
	 	$formatted_button  =  $formatted_size.'_button '.$formatted_size.'_'.$ka_blogbutton_color;
	 	
	 	//original codes from wp-includes post template function the_content(), omit the apply_filters to avoid Karma theme's auto p tags..
	 	//This code allows user to insert more tag in content, to force a read more "continue reading" button. Defaults to none..
	 	$content = get_the_content('<span class="ka_button '.$formatted_button.'"><span>'.$ka_blogbutton.'</span></span>');
	 	$content = str_replace( ']]>', ']]&gt;', $content );
	 	echo $content;
	 	?>
    	<span class="quote-entry-icon fa fa-quote-right"></span>
	</blockquote>
	
<?php
get_template_part('theme-template-part-inline-editing','childtheme');

//shareaholic plugin (display if installed)
if(function_exists('selfserv_shareaholic')) { selfserv_shareaholic(); } ?>

<div class="post_date">
    <span class="day date updated"><?php the_time('j'); ?></span>
    <br />
    <span class="month"><?php echo strtoupper(get_the_time('M')); ?></span>
    <br /> 
    <span class="year"><?php the_time('Y'); ?></span>
</div><!-- END post_date -->

<div class="post_comments">
	<a href="<?php echo the_permalink().'#post-comments'; ?>"><span><?php comments_number('0', '1', '%'); ?></span></a>
</div><!-- END post_comments -->

<?php
global $post; 
$post_title = get_the_title($post->ID);
$permalink = get_permalink($post->ID);
if ($ka_dragshare == "true"){ echo "<a class='post_share sharelink_small' href='$permalink' data-gal='prettySociable'>Share</a>"; }
?>

<?php truethemes_end_post_content_hook();// action hook ?>
</div><!-- END post_content -->

<div class="post_footer">
    <?php truethemes_begin_post_footer_hook();// action hook ?>
        <p class="post_cats"><?php the_category(', '); ?></p>
        
        <?php if (get_the_tags()) : ?>
        <p class="post_tags"><?php the_tags('', ', '); ?></p>
    
    <?php endif; truethemes_end_post_footer_hook();// action hook?>
    </div><!-- END post_footer -->
</article><!-- END blog_wrap -->