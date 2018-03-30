<?php
$block = $block_data[0];
$settings = $block_data[1];

?>
<?php if($block === 'title'){ ?>
<h2 class="post-title">
    <?php echo !empty($settings[0]) && $settings[0]!='no_link' ? $this->getLinked($post, $post->title, $settings[0], 'link_title') : $post->title ?>
</h2>
<?php } ?>
<div class="teaser-metadata">
<?php  if( $block === 'meta_author' ){ ?>
<span class="author">by <strong><?php echo $post->author ?></strong></span>
<?php } ?>
<?php  if( $block === 'meta_date' ){ ?>
<span class="date"> at <strong><?php echo $post->date ?></strong></span>
<?php } ?>
<?php  if( $block === 'meta_category' ){ ?>
<span class="category">in <strong><?php echo $post->category; ?></strong></span>
<?php } ?>
<?php  if( $block === 'meta_comments' ){ ?>
<span class="comments"> - <strong><?php 
if( 0 == $post->comments )
	_e('No Comments','WEBNUS_TEXT_DOMAIN');
elseif( 1 == $post->comments )
	_e('1 Comment','WEBNUS_TEXT_DOMAIN');
else
	_e('% Comments','WEBNUS_TEXT_DOMAIN');

 ?></strong></span>
 <?php } ?>
</div>
<?php if($block === 'image' && !empty($post->thumbnail)){ ?>
<div class="post-thumb">
    <?php echo !empty($settings[0]) && $settings[0]!='no_link' ? $this->getLinked($post, $post->thumbnail, $settings[0], 'link_image') : $post->thumbnail ?>
</div>
<?php } ?>
<?php if($block === 'text'){ ?>
<div class="entry-content">
    <?php echo !empty($settings[0]) && $settings[0]==='text' ?  $post->content : $post->excerpt; ?>
</div>
<?php } ?>
<?php if($block === 'link'){ ?>
<a href="<?php echo $post->link ?>" class="vc_read_more" title="<?php echo esc_attr(sprintf(__( 'Permalink to', "js_composer" ).' %s', $post->title_attribute)); ?>"<?php echo $this->link_target ?>><?php _e('Read more', "js_composer") ?></a>
<?php } ?>
