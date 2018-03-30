<div class="blog-post">

<h1><?php the_title(); ?></h1>
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

<?php the_content('');?> 
</div>

<div id="comments">
	<?php comments_template(); ?>
</div>

</div>
