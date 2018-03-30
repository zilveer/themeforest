<?php 

$author = get_post_meta(get_the_ID(), "si_quote", true);

$comments = of_get_option("show_comments");

?>

<li id="post_<?php the_ID(); ?>" <?php post_class(); ?>>

	<div>
	
		<?php if ($author != "") : ?>
		
			<h3 class="quote">"<?php echo $post->post_content; ?>"</h3>
			<h6 class="author">- <a href="<?php the_permalink(); ?>"><?php echo $author; ?></a></h6>
		
		<?php elseif ($author == "") : ?>
		
			<h3 class="quote">"<?php echo $post->post_content; ?>"</h3>
			<h6 class="author">- <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			
		<?php elseif (!empty($post->post_content)) : ?>
		
			<h3 class="quote">"<?php _e("No quote specified.", "shorti"); ?>"</h3>
			<h6 class="author">- <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
		
		<?php endif; ?>
	
	</div>
	
	<?php the_tags(''); ?>
	
	<?php if ($comments == "1") : ?>
		<?php //comment_form(); ?>
	<?php endif; ?>

</li>