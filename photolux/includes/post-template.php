<?php global $pex_page; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php 
$hide_thumbnail=(isset($pex_page->hide_thumbnail)&&$pex_page->hide_thumbnail)?true:false;
$thumb_class='';
if(!has_post_thumbnail() || $hide_thumbnail){ 
 $thumb_class=' no-thumbnail';
}
?>
<div class="post-content<?php echo($thumb_class); ?>">

<?php if(has_post_thumbnail() && !$hide_thumbnail){ ?>
<div class="blog-post-img">
<?php if(!is_single()){?>
<a href="<?php the_permalink(); ?>"> 
<?php }

$img_id=$pex_page->layout=='full'?'post_box_img_full':'post_box_img';
the_post_thumbnail($img_id);

 if(!is_single()){
 ?>
</a>
<?php } ?>
</div>
<?php 
}
	$hide_sections=explode(',',get_opt('_exclude_post_sections'));
	
 if(!in_array('date',$hide_sections)){?>
<div class="post-date"><span><?php echo get_the_date('M');?></span><h4><?php echo get_the_date('d');?></h4>
<?php if(is_single()){ ?>
<span class="year"><?php echo get_the_date('Y');?></span>
<?php } ?>
</div>

<?php } ?>
<div class="post-title-wrapper">
<h2 class="post-title">
<?php if(!is_single()){ ?>
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php }else{ 
 the_title();
 } ?>
</h2>
<div class="post-info">
<?php if(!in_array('category',$hide_sections) && get_the_category( $post->ID )){?>
	<span class="no-caps"> <?php echo(pex_text('_in_text')); ?> </span><?php the_category(' / ');?>
	<?php }?>
<?php if(!in_array('author',$hide_sections)){?>
 <span class="no-caps">&nbsp;<?php echo(pex_text('_by_text')); ?>  </span><?php the_author_posts_link(); ?>
 <?php } if(!in_array('comments',$hide_sections)){?>
 <span class="comments">
 / 
 <a href="<?php the_permalink();?>#comments">
 <?php comments_number('0', '1', '%'); ?>
 </a><span class="no-caps"><?php echo pex_text('_comments_text'); ?></span>
 </span>
 <?php } ?>
</div>
<div class="clear"></div>
</div> <div class="post-content-content">

<?php
$excerpt=(isset($pex_page->excerpt)&&$pex_page->excerpt)?true:false;
if(!$excerpt && get_opt('_post_summary')!='excerpt' || is_single()){
	the_content('');
	?>
	<div class="clear"></div>
	<?php 
	if(!is_single()){
		$ismore = @strpos( $post->post_content, '<!--more-->');
		if($ismore){?> <a href="<?php the_permalink(); ?>" class="read-more"><?php echo(pex_text('_read_more')); ?><span class="more-arrow">&raquo;</span></a>
	<?php 
		}
	} else {
		wp_link_pages();
		echo pexeto_get_share_btns_html($post->ID, 'post');	
	}
}else{
	the_excerpt(); ?>

	<a href="<?php the_permalink(); ?>" class="read-more"><?php echo(pex_text('_read_more')); ?><span class="more-arrow">&raquo;</span></a>
	<?php 
}?> 
 	<div class="clear"></div>
</div>
</div>
</div>
