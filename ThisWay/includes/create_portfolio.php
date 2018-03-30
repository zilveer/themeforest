<?php

function createPortfolio($prm)
{

global $post, $paged, $more, $wpdb, $wp_query, $pageTitle;
if(!isset($prm['category']))
	$cat = '';
else
	$cat = $prm['category'];
	
if(!isset($prm['type']))
	$type = 'pagination';
	
else
	$type = $prm['type'];
if(!isset($prm['image']))
	$imageType = 'portrait';
else
	$imageType = $prm['image'];
if(!isset($prm['count']))
	$count = 4;
else
	$count = (int) $prm['count'];
if(!isset($prm['text']))
	$textType = 'true';
else
	$textType = $prm['text'];
	
if(!isset($prm['sidebar']))
	$sidebarType = 'none';
else
	$sidebarType = $prm['sidebar'];

$postperpage = 10;
if(!empty($prm['postperpage']))
	$postperpage = (int) $prm['postperpage'];
	
	
$pageWidth = 600;
$spaceH = 20;
$columnW = (int) (($pageWidth-($spaceH*($count-1)))/$count);

$imageW = (int) ($columnW);
$imageH = (int) ($imageW/1.5);

if($postperpage<=0)
	$postperpage = 10;

echo '<h1 class="caption" >'.$pageTitle.' <a class="closebutton" href="#!/"></a></h1>';
?> 

	<?php if($type=='filter'){ ?>
	<ul class="portfolioFilter">
		<?php
		$cat_query = "SELECT wterms.name, wterms.term_id
					FROM $wpdb->terms wterms
					WHERE wterms.term_id in(".$cat.")
					ORDER BY wterms.name ASC";	
		$catResults = $wpdb->get_results($cat_query);
		echo '<li data-value="all"><a class="nolink" href="javascript:void(0);" class="selected">'.__('All', 'ThisWay').'</a></li>'."\n";
		foreach($catResults as $catRow)
			echo '<li data-value="'.$catRow->term_id.'"><a class="nolink" href="javascript:void(0);">'.$catRow->name.'</a></li>'."\n";
		?>
	</ul>
	<?php } ?>
	
	
			<ul class="portfolioitems portfolio<?php echo $count;?>columns">
			<?php 
			if($type=='pagination')
				$wp_query = new WP_Query('post_type=post&posts_per_page='.$postperpage.'&cat='.$cat.'&paged='.$paged);
			else
				$wp_query = new WP_Query('post_type=post&cat='.$cat.'&posts_per_page=-1');
			
			if($wp_query->have_posts()){
				$i=0;
				while($wp_query->have_posts()){
				$i++;
					$wp_query->the_post();
					$sourceType = get_post_meta($post->ID, "sourceType", true);
					$sourceData = get_post_meta($post->ID, "sourceData", true);
					$sourceOpen = get_post_meta($post->ID, "sourceOpen", true);
					$sourceStr = getSource($sourceType, $sourceData, $sourceOpen, $imageW, $imageH);
					
			
			?>
			<?php
			$dataID = '';
			$dataCalss='';
			if($type=='filter')
			{
				$dataID = 'data-id="id-'.$post->ID.'"';
				$catIDs = '';
				foreach((get_the_category($post->ID)) as $category)
						$catIDs .= 'cat'.$category->cat_ID.' ';
				if(!empty($catIDs))
					$dataCalss .= ' data-type="'.$catIDs.'" ';
			}		
			
			//$re .= '<li '.$dataID.' '.$dataCalss.' style="height:'.$imageH.'px">';
				
			
			/*$dataID = '';
			$dataCalss='';
			if($type=='filter')
			{
				$dataID = 'data-id="id-'.$post->ID.'"';
				foreach((get_the_category($post->ID)) as $category)
					$dataCalss .= ' data-type="'.$category->cat_ID.'" ';
			}	*/	
			?>
			<li <?php echo $dataID; ?> <?php echo $dataCalss;?> style="height:<?php echo $imageH; ?>px">
				<?php if(has_post_thumbnail() || (!empty($sourceStr) && $sourceOpen=='e')){
					$thumbnail_src = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
					<?php if($sourceOpen=='m' || empty($sourceOpen) || empty($sourceStr)){ ?>
				<div class="image_frame">
					<a href="<?php echo empty($sourceStr)?$thumbnail_src:$sourceStr; ?>" class="nolink" title="<?php the_title();?>">
						<?php 
						$thumbnail_path = $thumbnail_src;
						if(function_exists('wpthumb'))
							$thumbnail_path = wpthumb($thumbnail_src,'width='.$imageW.'&height='. $imageH .'&resize=true&crop=1&crop_from_position=center,center');
						?>
						<img src="<?php echo $thumbnail_path; ?>" width="<?php echo $imageW; ?>" height="<?php echo $imageH; ?>" alt="<?php the_title(); ?>" />
						
						<div class="hoverWrapperBg"></div>
						<div class="hoverWrapper">
							<?php if($textType!='none'){?>
							<h3><?php the_title(); ?></h3>
							<div class="enter-text"><?php $more = 0; the_content(''); ?> </div>
							<?php } ?>
							<span class="link clickable" data-link="#!<?php the_permalink(); ?>"></span>
							<?php
							$modalClass = 'modal';
							if($sourceType=='vimeo' || $sourceType=='youtube' || $sourceType=='videolink')
								$modalClass = 'modalVideo';						
							?>
							<span class="<?php echo $modalClass;?> nolink" href="javascript:void(0);"></span>
						</div>
					</a>
				</div>
				<?php }elseif($sourceOpen=='e'){ ?>
					<?php echo $sourceStr; ?>
				<?php }?>
			<?php }?>
			</li>
	<?php }
	}?>
	</ul>
	<div class="clearfix"></div>
	<?php if($type=='pagination' && function_exists('wp_pagenavi')){
				$navHtml = wp_pagenavi( array( 'echo' => false, ));
				$navHtml = str_replace(home_url(),'#!',$navHtml);
				$navHtml = str_replace('&#038;info=page','',$navHtml);
				$navHtml = str_replace('?info=page','',$navHtml);
				echo $navHtml;
			}
}	
		?>