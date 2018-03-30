<?php
	global $authordata;
	$authorlink = get_author_posts_url($authordata->ID);
?>

<div class="authorContainer">
	<?php if(!is_author()):?><a href="<?php echo $authorlink;?>"><?php endif;?>
        <div class="gravatar pull-left"><?php echo get_avatar(get_the_author_meta('user_email'), '60'); ?></div>
        <h3 class="infoBoxHeader "><?php echo get_the_author();?></h3>
	<?php if(!is_author()):?></a><?php endif;?>

    <p><?php the_author_meta('description'); ?></p>

	<?php if(get_the_author_meta('user_url')):?>
		<a target="_blank" href="<?php echo get_the_author_meta('user_url');?>"><?php echo get_the_author_meta('user_url');?></a>
	<?php endif;?>
</div>