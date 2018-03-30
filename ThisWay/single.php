<?php
get_header(); /* get the header */

	if(@$_GET['info']=='description'){
		echo $pageDescription;
		exit; 
	}elseif(@$_GET['info']=='title'){
		wp_title( '|', true, 'right' );
		exit;
	}elseif(@$_GET['info']=='page'){
		if(have_posts())
		{
			if(have_posts())
			{
				the_post();
				$postID	= get_the_ID();
				$content = get_the_content();
				$content = apply_filters('the_content', $content);
				$title = get_the_title();
				
				$sourceType = get_post_meta($postID, "sourceType", true);
				$sourceData = get_post_meta($postID, "sourceData", true);
				$sourceOpen = get_post_meta($postID, "sourceOpen", true);
				
				$imgW = $imageW = 600;
				$imgH = $imageH = 0;
				if(!empty($sourceData))
					if($sourceType=='vimeo' || $sourceType=='youtube' || $sourceType=='videolink' || $sourceType=='swf' || $sourceType=='flowplayer')
						$imgH = $imageH = 400;
				$sourceStr = getSource($sourceType, $sourceData, 'e', $imgW, $imgH);
			}
		}

?>
<h1 class="caption"><?php the_title(); ?> <a class="closebutton" href="#!/"></a></h1>
<div class="divider"></div>


<?php 
if(has_post_thumbnail() || (!empty($sourceStr) && $sourceOpen=='e'))
{
	$thumbnail_src = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>				
		<?php if(empty($sourceOpen) || empty($sourceType)){ ?>
			<?php 
			$thumbnail_path = $thumbnail_src;
			if(function_exists('wpthumb'))
				$thumbnail_path = wpthumb($thumbnail_src,'width='.$imageW.'&resize=true');
			?>
			<img width="<?php echo $imageW; ?>" class="<?php echo empty($sourceStr)?"":"videoLink"; ?>" src="<?php echo $thumbnail_path;?>" alt="<?php the_title(); ?>" />
		<?php }elseif($sourceOpen=='e' || $sourceOpen=='m'){ ?>
		<?php echo $sourceStr; ?>
		<?php }?>
<?php } ?>


<div class="divider"></div>
<div id="singleLeft">
	<ul>
		<li class="singleDate"><?php echo get_the_time('d.m.Y');?></li>
		<li class="singleAuthor"><?php posted_on_template();?></li>
		<li class="singleComments"><?php comments_number(__('No Comment', 'ThisWay'),__('1 Comment', 'ThisWay'),__('% Comments', 'ThisWay')); ?></li>
		<?php $tags_list = wp_get_post_tags($post->ID, array( 'fields' => 'names' ));				
		if ( $tags_list ){ ?>
			<li class="singleTags"><?php echo implode(' ,', $tags_list);?></li>
		<?php } ?>
	</ul>
</div>
<div id="singleRight">
<?php $more=1; the_content(''); ?>
</div>

<hr class="seperator" />
<div class="divider"></div>

<?php comments_template( '', true ); ?>
		
<div class="blogTop"><hr/><a class="nolink" href="javascript:void(0);">TOP</a></div>
<div class="clearfix"></div>

<?php }else{
		redirectWithEscapeFragment();
	}
?>