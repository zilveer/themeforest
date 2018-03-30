<?php 
global $avia_config, $slider; 

$layout = avia_post_meta('layout');
if(!$layout) $layout = 'Landscape';

$post_class 	= "post-entry-".get_the_ID();
$slider 		= new avia_slideshow(get_the_ID());


if($slider->slidecount) 
{
	$slider->setImageSize('portfolio');
	$post_class .= " with_slideshow";
	
	if($layout == 'Landscape')
	{	
		$slider->customClass('big-slideshow');
		$post_class .= " big-slideshow-post";
	}
}
		
	
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }


// check if we got posts to display:
if (have_posts()) :

	while (have_posts()) : the_post();	
	if(empty($avia_config['layout'])) $avia_config['layout'] = "sidebar_right";
	
		?>
		<div class='post-entry post-entry-type-portfolio <?php echo $post_class." ".$layout."-portfolio"; ?>'>
		
			<span class='entry-border-overflow extralight-border'></span>
			
			<?php 
				get_template_part('includes/portfolio', strtolower( $layout )); // includes portfolio-landscape.php or portfolio-portrait.php
			?>


		</div><!--end post-entry-->
		<?php
			
	endwhile;		
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
	
<?php

	endif;
	
	if(!isset($avia_config['remove_pagination'] )) echo avia_pagination();	
?>