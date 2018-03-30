<div class="blog-post <?php if(is_single()) echo 'single';?>">

<h1 class="post-title">
<?php if(!is_single()){ ?>
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php }else{ 
 the_title();
 } ?>
</h1>

<?php if(get_opt('_blog_info')!='off'){
	$show_sections=explode(',',get_opt('_show_post_sections'));
	?>

<?php if(in_array('comments',$show_sections)){?>
<div class="comments_number"><?php comments_number('0', '1', '%'); ?></div>
<?php } ?>
<div class="post-info">
<ul>
<?php if(in_array('date',$show_sections)){?>
	<li><span class="no-caps"> <?php echo(pex_text('_at_text')); ?></span> <a><?php echo get_the_date(get_option('date_format'));?></a></li>
	<?php } if(in_array('author',$show_sections)){?>
	<li><span class="no-caps"> <?php echo(pex_text('_by_text')); ?></span> <?php the_author_posts_link(); ?>
	</li>
	<?php } if(in_array('category',$show_sections)){?>
	<li><span class="no-caps"> <?php echo(pex_text('_in_text')); ?> </span><?php the_category(' / ');?></li>
	<?php }?>
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
global $excerpt;
if(!$excerpt && get_opt('_post_summary')!='excerpt' || is_single()){
	the_content('');
	if(!is_single()){
		$ismore = @strpos( $post->post_content, '<!--more-->');
		if($ismore){?> <a href="<?php the_permalink(); ?>"><?php echo(pex_text('_read_more')); ?><span class="more-arrow">&raquo;</span></a>
	<?php 
		}
	} 
}else{
	the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>"><?php echo(pex_text('_read_more')); ?><span class="more-arrow">&raquo;</span></a>
	<?php 
}?> 
</div>
