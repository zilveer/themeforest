<?php get_header(); ?>
			
<?php 
$blog_single_page_style = of_get_option(BRANKIC_VAR_PREFIX."blog_single_page_style", of_get_default(BRANKIC_VAR_PREFIX."blog_single_page_style"));
if (of_get_option(BRANKIC_VAR_PREFIX."blog_single_page_style_fullwidth", of_get_default(BRANKIC_VAR_PREFIX."blog_single_page_style_fullwidth")) != "no") $full_width = 1; else $full_width = 0;
if (have_posts()) : while(have_posts()) : the_post(); 
$comments = comments_open() && get_option("default_comment_status ") == "open"; 
$format = get_post_format();

$sidebar = get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."select_sidebar", true);
if ( false === $format ) {
	if ($blog_single_page_style == "1") $format = 'aside';
	if ($blog_single_page_style == "2") $format = 'gallery';
	if ($blog_single_page_style == "3") $format = 'quote';
	if ($blog_single_page_style == "4") $format = 'status';
	if ($blog_single_page_style == "5") $format = 'video';
	if ($blog_single_page_style == "6") $format = 'audio';
}

?>
<div class="divider" style="height:40px"></div>
<?php
if ($format == 'aside') $inner_content_class = "blog1";
if ($format == 'gallery') $inner_content_class = "blog1"; 
if ($format == 'quote') $inner_content_class = "blog3"; 
if ($format == 'status') $inner_content_class = "blog1"; 
if ($format == 'video') $inner_content_class = "blog5"; 
if ($format == 'audio') $inner_content_class = "blog6"; 
?>
<?php
if ($format != "chat") 
	{
	if ($full_width && $sidebar == "")
	{
	?> 
		<div class="one <?php echo $inner_content_class; ?>"> 
	<?php
	}
	else
	{
	?>
		<div id="inner-content" class="<?php echo $inner_content_class; ?>">  
	<?php
	}
	?>
	
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
}
	get_template_part( 'content', $format );

if ($format != "chat") {
    wp_link_pages();
	if (of_get_option(BRANKIC_VAR_PREFIX."show_share", of_get_default(BRANKIC_VAR_PREFIX."blog_single_page_style_fullwidth")) == "yes") include("share.inc.php") ; ?>
	
					</div><!--END POST-CONTENT -->
					
				</div><!--END POST-->
	
	
	
	
			  
				<?php if ($comments) 
				{  
					comments_template(); 
				}?>
			  
		 </div><!--END INNER-CONTENT-->
			  
			  <?php 
	if (!($full_width && $sidebar == "")) get_sidebar($sidebar); 
	//get_sidebar($sidebar);

}

endwhile; ?>


<?php else: //If no posts are present ?>
	
				<div class="entry">						
					<p><?php _e('No posts were found.', BRANKIC_THEME_SHORT); ?></p>	
				</div>
				
<?php endif; ?>
	
<?php get_footer(); ?>
			