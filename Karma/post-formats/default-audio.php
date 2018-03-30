<?php
/**
 * The template for displaying posts in the Audio post format
 *
 */
?>
<?php
global $ttso;
$ka_blogbutton            = $ttso->ka_blogbutton;
$ka_blogbutton_color      = $ttso->ka_blogbutton_color;
$ka_blogbutton_size       = $ttso->ka_blogbutton_size;
$ka_posted_by             = $ttso->ka_posted_by;
$ka_dragshare             = $ttso->ka_dragshare;
$htag = $ttso->ka_heading_type;
if(empty($htag)){
$htag = 'h2';
}

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
<div class="post_title">
<?php truethemes_begin_post_title_hook(); // action hook ?>

<?php if ('' == $linkpost): ?>
<<?php echo $htag; ?> class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $htag; ?>> <?php else: ?>

<<?php echo $htag; ?> class="entry-title"><a href="<?php echo $linkpost; ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $htag; ?>> <?php endif; ?>

<?php if ('true' != $ka_posted_by): ?>
<p class="posted-by-text"><span><?php _e('Posted by:', 'truethemes_localize') ?></span> <span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span></p> <?php endif; ?>

<?php truethemes_end_post_title_hook(); // action hook ?>
</div><!-- END post_title -->

<div class="post_content">
<?php truethemes_begin_post_content_hook(); // action hook

/*
*this is audio post format, we do not use our own limit_content(), 
*use default the_content so that inserted audio player which is a shortcode can show up.
*this code allows user to insert more tag in content, to force a read more "continue reading" button. Defaults to none..
*/
the_content('<span class="ka_button '.$formatted_button.'"><span>'.$ka_blogbutton.'</span></span>');


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