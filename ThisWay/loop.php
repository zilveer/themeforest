<?php 
global $more, $blogparams, $paged, $pageTitle;
$dataformat ='dMY';
$metaformat = 'posted, comments, tag';
$useImage = true;

if(!empty($blogparams['dateformat']))
	$dataformat = $blogparams['dateformat'];
if(!empty($blogparams['metaformat']))
	$metaformat = $blogparams['metaformat'];

	$imageW = $imgW = 350;
	$imageH = $imgH = 225;
?>

<?php 
		echo '<h1 class="caption" >'.$pageTitle.' <a class="closebutton" href="#!/"></a></h1>';
		
		while(have_posts())
		{
		the_post();
		
		$sourceType = get_post_meta($post->ID, "sourceType", true);
		$sourceData = get_post_meta($post->ID, "sourceData", true);
		$sourceOpen = get_post_meta($post->ID, "sourceOpen", true);
		$sourceStr = getSource($sourceType, $sourceData, $sourceOpen, $imgW, $imgH);
		?>
			<div id="post-<?php the_ID(); ?>"  <?php post_class('blogitem'); ?>>
				<?php if( has_post_thumbnail() || (!empty($sourceStr) && $sourceOpen=='e')){ 
					$thumbnail_src = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); 
					$useImage = true;
					?>
				<div class="blogimage">
					<div class="image_frame">
					<?php if($dataformat!='none'){ ?>
						<div class="blogdate">
							<div class="blogdateLeft"><?php echo get_the_time('d');?><br/><?php echo get_the_time('m');?></div>
							<div class="blogdateRight"><?php echo substr(get_the_time('Y'),0,2);?><br/><?php echo substr(get_the_time('Y'),2,2);?></div>
						</div>
					<?php } ?>
					<?php if($sourceOpen=='m' || empty($sourceOpen) || empty($sourceType)){ ?>
					<a href="<?php echo empty($sourceStr)?$thumbnail_src:$sourceStr; ?>" class="nolink" title="<?php the_title();?>">
					<?php
						$thumbnail_path = $thumbnail_src;
						if(function_exists('wpthumb'))
							$thumbnail_path = wpthumb($thumbnail_src,'width='.$imageW.'&height='.$imageH.'&resize=true&crop=1&crop_from_position=center,center');
					?>
						<img src="<?php echo $thumbnail_path; ?>" width="<?php echo $imgW; ?>" height="<?php echo $imgH; ?>" alt="<?php the_title(); ?>" />
						
						<div class="hoverWrapperBg"></div>
						<div class="hoverWrapper">
							<span class="link clickable" data-link="#!<?php the_permalink(); ?>"></span>
							<?php
							$modalClass = 'modal';
							if($sourceType=='vimeo' || $sourceType=='youtube' || $sourceType=='videolink')
								$modalClass = 'modalVideo';						
							?>
							<span class="<?php echo $modalClass;?> nolink" href="javascript:void(0);"></span>
						</div>
					</a>
					
					<?php }elseif($sourceOpen=='e'){ ?>
					<div style="position: relative; width: <?php echo $imageW; ?>px; height: <?php echo $imageH; ?>px; background-image: none; opacity: 1;">
						<?php echo $sourceStr; ?>
					</div>
					<?php }?>
					</div>
				</div>
				<?php }else{ $useImage = false; } ?>
				<div class="blogcontent" <?php if(!$useImage){echo 'style="width:600px; margin-left:0"'; }?> >
					<h3><?php the_title();?></h3>
					<?php if($metaformat!='none'){ ?>
					<div class="meta-links">
						<?php if(strpos($metaformat, 'posted')!==false){ ?>
						<a class="meta-author nolink" href="javascript:void(0);" rel="<?php posted_on_template();?>"></a>
						<?php } ?>
						
						<?php if(strpos($metaformat, 'comments')!==false){ ?>
							<a class="meta-comments nolink" href="javascript:void(0);" rel="<?php comments_number(__('No Comment', 'ThisWay'),__('1 Comment', 'ThisWay'),__('% Comments', 'ThisWay'));?>"></a>
						<?php } ?>
												
						<?php if(strpos($metaformat, 'tag')!==false){ 
						
						$tags_list = wp_get_post_tags($post->ID, array( 'fields' => 'names' ));
						
						if ( $tags_list ){ ?>
						<a class="meta-tags nolink" href="javascript:void(0);" rel="<?php echo implode(' ,', $tags_list);?>"></a>
						<?php }
						} ?>
						
					</div>
					<?php } ?>
					<p  <?php if(!$useImage){echo 'style="width:560px; margin-left:0"'; }?>>
					<?php $more=0; the_content(''); ?>
					</p>
					<a class="morelink" href="#!<?php the_permalink(); ?>"><?php echo __('more', 'ThisWay');?></a>
				</div>
				<div class="blogTop" style="padding-top:8px;"><hr/><a class="nolink" href="javascript:void(0);">TOP</a></div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>

		<?php if(function_exists('wp_pagenavi')){
			$navHtml = wp_pagenavi( array( 'echo' => false) );
			$navHtml = str_replace(home_url(),'#!',$navHtml);
			$navHtml = str_replace('&#038;info=page','',$navHtml);
			$navHtml = str_replace('?info=page','',$navHtml);
			echo $navHtml;
		} ?>