<div class="blog-post">

<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<hr />
<hr />

<?php if(get_opt('_blog_info')!='off'){?>
<div class="post-info">
<ul>
	<li><?php the_time('M, d Y') ?></li>
	<li><span class="no-caps"> <?php echo(get_opt('_by_text')); ?></span> <?php the_author_posts_link(); ?>
	</li>
	<li class="post-info-categories"><?php the_category(', ');?></li>
	<li class="post-info-comments"><a
		href="<?php the_permalink();?>#comments"> <?php comments_number(get_opt('_no_comments_text'), get_opt('_one_comment_text'), '% '.get_opt('_comments_text'))?>
	</a></li>

</ul>
</div>
<?php }elseif(function_exists('has_post_thumbnail') && has_post_thumbnail()){?>
<br/>
<?php }
if(function_exists('has_post_thumbnail') && has_post_thumbnail()){ ?>
<div class="blog-post-img"><a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('post_box_img'); ?>
</a></div>
<?php } ?>


<?php
if(!$excerpt){
	the_content('');
	$ismore = @strpos( $post->post_content, '<!--more-->');
	if($ismore){?> <a href="<?php the_permalink(); ?>"><?php echo(get_opt('_read_more')); ?></a>
	<?php } 
}else{
	the_excerpt();
}?> 
</div>
