<?php
/*
Template Name: Page full width
*/
?>


<?php get_header(); ?>

<div id="main_content"> 

<?php if (get_option('op_crumbs_page') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<div id="content_bread_panel">	
<div class="inner">
<?php if (function_exists('wp_breadcrumbs')) wp_breadcrumbs(); ?>
</div>
</div>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>

<div class="inner">	
<div id="content" class="full_width">	

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
    <div class="single_post">

	<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	

	<?php if(has_post_thumbnail()) { ?>
	   
        <div class="single_thumbnail">
		<a href="<?php echo $thumbnailSrc ?>" title="<?php the_title(); ?>" rel="prettyphoto">
	    <?php $image = aq_resize( $thumbnailSrc, 300, 200, true); ?>
		<?php the_post_thumbnail() ?>
        </a>
		</div>
	   
	<?php } else {} ?>	
	
	<div class="single_title">	  
	   <h1><?php the_title(); ?></h1>	  
    </div>
	
	<?php if (get_option('op_page_meta_line') == 'on') { ?>	
	<div class="post_meta_line">
		<span class="single_post_time"><?php the_time('F d, Y'); ?></span>
	</div> 
	<?php } else { ?> <div class="space_10"></div> <?php } ?>
	
    <div class="single_text">
	    <?php the_content(''); ?>
		<?php custom_wp_link_pages(); ?>
    </div>
	
    <div class="clear"></div>

	<?php if (get_option('op_single_page_comments') == 'on') { ?>
	
	<?php if (get_option('op_comments_variant') == 'Simple comments') { 
	comments_template('', true); } else { ?>
	
	<?php $discus = get_option('op_discus'); ?>
	
	<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = '<?php echo $discus ?>'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<?php } ?>
	
	<?php } ?>	

	<?php endwhile; ?>
	<?php else : ?>

</div>
	
	<?php endif; ?>
 	 
</div>
</div>

</div>

<div class="clear"></div>
	
<?php get_footer(); ?>
	