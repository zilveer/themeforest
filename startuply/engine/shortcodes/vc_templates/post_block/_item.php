<?php
$block = $block_data[0];
$settings = $block_data[1];
$link_setting = empty($settings[0]) ? '' : $settings[0];
?>
<?php if($block === 'title'): ?>
<h2 class="post-title">
    <?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->title, $link_setting, 'link_title') : $post->title ?>
</h2>
<div class="post-meta post-meta-sticky">
	<span class="post-date"><?php echo $post->meta_data; ?></span>
	<span class="post-comments"><i class="fa fa-comment-o"></i><a href="<?php echo $post->meta_comments_link; ?>"><?php echo $post->meta_comments_count; ?></a></span>
	<span class="post-author"><i class="fa fa-user"></i><?php echo $post->meta_author; ?></span>
	<span class="post-cat"><i class="fa fa-folder-o"></i><?php echo $post->meta_cat; ?></span>
</div><!--end post-meta-->
<?php elseif($block === 'image' && !empty($post->thumbnail)): ?>
<div class="post-thumb">
    <?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->thumbnail, $link_setting, 'link_image') : $post->thumbnail ?>
</div>
<?php elseif($block === 'text'): ?>
<div class="entry-content">
    <?php echo empty($link_setting) || $link_setting==='text' ?  $post->content : $post->excerpt; ?>
</div>
<?php elseif($block === 'link'): ?>
<a href="<?php echo $post->link ?>" class="vc_read_more more-link"
   title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', "js_composer" ), $post->title_attribute ) ); ?>"<?php echo $this->link_target ?>><?php _e( 'Read more', "js_composer" ) ?></a>
<?php endif; ?>
