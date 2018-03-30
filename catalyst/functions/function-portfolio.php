<?php

function mPortfolioLarge($category,$mtheme_portfoliolink,$portfoliotype,$mtheme_portfoliolightbox) {
	$itemlimit = '-1';
	$PortfolioScroll=false;
	if ($portfoliotype=="Scroll") { $PortfolioScroll=true; $pagination = 'false'; } else { $pagination = 'true'; }
	$perpage='1';
	$query='';
	$content="";
	
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	
	if($pagination == 'true'){
		$query .= '&showposts='.$perpage.'&paged='.$paged.'&category_name='.$category;
	} else {
		$query .= '&showposts='.$itemlimit.'&category_name='.$category;
	}
	if(!empty($query)){
		$query .= $query;
	}
	$wp_query->query($query);
	ob_start();
	?>
	
	
	<?php
	$key="image";
	$vkey="video";
	$pwidth=450;
	$pheight=0;
	$quality=72;
	$percolumn=3;
	$pcount=0;
	$column=0;
	$portfoliofound=false;
	$lightbox_gallery="";
	if ($mtheme_portfoliolightbox=="Gallery") { $lightbox_gallery='[gallery]'; }
	?>
	
	<div class="clear"></div>
	<?php if ($PortfolioScroll) { ?>
	<div id="loopedSlider">	
		<div class="container">
			<div class="slides">
	<?php } ?>
	
		<?php while (have_posts()) : the_post(); ?>

		<?php //$image=get_post_meta($post->ID, $key, true); 
			$image_id = get_post_thumbnail_id(($post->ID), 'full'); 
			$image_url = wp_get_attachment_image_src($image_id,'full');  
			$image_url = $image_url[0]; 
		?>
		<?php $video=get_post_meta($post->ID, $vkey, true); ?>

		<?php if ( isset ( $image_url ) ) { ?>
					

					<div><ul class="portfolioBigGrid">

						
					<?php 
					$pcount++;
					$portfoliofound=true;
					
					if ($pcount==$percolumn) 
						{
						$pcount=0;
						
						if ($video<>"") { ?> 
								<li class="videoicon">
							<?php } else { ?> 
								<li class="imageicon">
						<?php } ?>
					<?php } else { //else its not the first row 
						if ($video<>"") { ?> 
							<li class="rightspace videoicon">
						<?php } else { ?> 
							<li class="rightspace imageicon">
						<?php } ?>
					<?php } ?>
					
						
									<?php if ($mtheme_portfoliolink=="Lightbox Pop-up") { ?>
										<?php if ($video<>"") { ?>
											<a rel="prettyPhoto<?php echo $lightbox_gallery; ?>" title="<?php the_title(); ?>" href="<?php echo $video; ?>">
										<?php } else { ?>
											<a rel="prettyPhoto<?php echo $lightbox_gallery; ?>" title="<?php the_title(); ?>" href="<?php echo $image_url; ?>">
										<?php } ?>
									<?php } else { ?>
										<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
									<?php } ?>
										<?php echo resizeimage ($image_url,$pheight,$pwidth,$quality, 1 , $post->post_title, $class="fadetoicon" ); ?>
									</a>
								<?php	
								if (!$PortfolioScroll)
								{
								?>									
								<div class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
								<div class="desc">
									<?php echo shortentext ( get_the_excerpt() , 220 ); ?>
								</div>
								<?php
								}
								?>	
							</li>
						
							</div></ul>
						
		<?php } ?>


		<?php endwhile; ?>
		<?php 
		if ($PortfolioScroll) { ?>
				</div>
			</div>
			<a href="#" class="previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loopslider/smallprevious.png" alt="Previous" /></a>
			<a href="#" class="next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loopslider/smallnext.png" alt="Next" /></a>
		</div>
		<?php
		}
		?>		
	<?php if($pagination == 'true'){ ?>
	<div class="clear"></div>
	<div class="topmargin35"></div>
	<!-- Navigation -->
	<?php include (TEMPLATEPATH . "/includes/navigation.php"); ?>	
	<?php } ?>
	
	<div class="clear"></div>
	<?php if($pagination == 'false'){ ?>
	<div class="pmarginbottom"></div>
	<?php } ?>
	
	
	<?php $wp_query = null; $wp_query = $temp;

	return $content;
}


function mPortfolioMedium($category,$mtheme_portfoliolink,$portfoliotype,$mtheme_portfoliolightbox) {
	$itemlimit = '-1';
	$PortfolioScroll=false;
	if ($portfoliotype=="Scroll") { $PortfolioScroll=true; $pagination = 'false'; } else { $pagination = 'true'; }
	$perpage='9';
	$query='';
	$content="";
	
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	
	if($pagination == 'true'){
		$query .= '&showposts='.$perpage.'&paged='.$paged.'&category_name='.$category;
	} else {
		$query .= '&showposts='.$itemlimit.'&category_name='.$category;
	}
	if(!empty($query)){
		$query .= $query;
	}
	$wp_query->query($query);
	ob_start();
	?>
	
	
	<?php
	$key="image";
	$vkey="video";
	$pwidth=130;
	$pheight=130;
	$quality=72;
	$percolumn=3;
	$pcount=0;
	$column=0;
	$portfoliofound=false;
	$lightbox_gallery="";
	if ($mtheme_portfoliolightbox=="Gallery") { $lightbox_gallery='[gallery]'; }
	?>
	
	<div class="clear"></div>
	<?php if ($PortfolioScroll) { ?>
	<div id="loopedSlider">	
		<div class="container">
			<div class="slides">
				<div>
	<?php } ?>
	<ul class="portfolioMediumGrid">
	
		<?php while (have_posts()) : the_post(); ?>

		<?php //$image=get_post_meta($post->ID, $key, true); 
			$image_id = get_post_thumbnail_id(($post->ID), 'full'); 
			$image_url = wp_get_attachment_image_src($image_id,'full');  
			$image_url = $image_url[0]; 
		?>
		<?php $video=get_post_meta($post->ID, $vkey, true); ?>

		<?php if ( isset ( $image_url ) ) { ?>
					<?php 
						if ($PortfolioScroll) { 
							if ($column==3) {
								echo '</ul></div><div><ul class="portfolioMediumGrid">';
								$column=0;
							}
						}
					?>	
					<?php 
					$pcount++;
					$portfoliofound=true;
					
					if ($pcount==$percolumn) 
						{
						$pcount=0;
						$column++;
						if ($video<>"") { ?> 
								<li class="videoicon">
							<?php } else { ?> 
								<li class="imageicon">
						<?php } ?>
					<?php } else { //else its not the first row 
						if ($video<>"") { ?> 
							<li class="rightspace videoicon">
						<?php } else { ?> 
							<li class="rightspace imageicon">
						<?php } ?>
					<?php } ?>
					
						
									<?php if ($mtheme_portfoliolink=="Lightbox Pop-up") { ?>
										<?php if ($video<>"") { ?>
											<a class="loader" rel="prettyPhoto<?php echo $lightbox_gallery; ?>" title="<?php the_title(); ?>" href="<?php echo $video; ?>">
										<?php } else { ?>
											<a class="loader" rel="prettyPhoto<?php echo $lightbox_gallery; ?>" title="<?php the_title(); ?>" href="<?php echo $image_url; ?>">
										<?php } ?>
									<?php } else { ?>
										<a class="loader" title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
									<?php } ?>
										<?php echo resizeimage ($image_url,$pheight,$pwidth,$quality, 1 , $post->post_title, $class="fadetoicon preloader" ); ?>
									</a>
								<?php	
								if (!$PortfolioScroll)
								{
								?>
								<div class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
								<?php
								}
								?>

							</li>					

						
		<?php } ?>


		<?php endwhile; ?>
		
		<?php 
		if ($PortfolioScroll) { ?>
					</ul>
				</div>
		<?php
		} else {
		?>		
		</ul>
		<?php
		}
		?>
		<?php 
		if ($PortfolioScroll) { ?>
				</div>
			</div>
			<a href="#" class="previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loopslider/smallprevious.png" alt="Previous" /></a>
			<a href="#" class="next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loopslider/smallnext.png" alt="Next" /></a>
		</div>
		<?php
		}
		?>
		
	<?php if($pagination == 'true'){ ?>
	<div class="clear"></div>
	<div class="topmargin35"></div>
	<!-- Navigation -->
	<?php include (TEMPLATEPATH . "/includes/navigation.php"); ?>	
	<?php } ?>
	
	<div class="clear"></div>
	<?php if($pagination == 'false'){ ?>
	<div class="pmarginbottom"></div>
	<?php } ?>
	
	
	<?php $wp_query = null; $wp_query = $temp;

	return $content;
}

function mFullwidthPortfolioMedium($category,$mtheme_portfoliolink,$portfoliotype,$mtheme_portfoliolightbox) {
	$itemlimit = '-1';
	$PortfolioScroll=false;
	if ($portfoliotype=="Scroll") { $PortfolioScroll=true; $pagination = 'false'; } else { $pagination = 'true'; }
	$perpage='15';
	$query='';
	$content="";
	
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	
	if($pagination == 'true'){
		$query .= '&showposts='.$perpage.'&paged='.$paged.'&category_name='.$category;
	} else {
		$query .= '&showposts='.$itemlimit.'&category_name='.$category;
	}
	if(!empty($query)){
		$query .= $query;
	}
	$wp_query->query($query);
	ob_start();
	?>
	
	
	<?php
	$key="image";
	$vkey="video";
	$pwidth=130;
	$pheight=130;
	$quality=72;
	$percolumn=5;
	$pcount=0;
	$column=0;
	$portfoliofound=false;
	$lightbox_gallery="";
	if ($mtheme_portfoliolightbox=="Gallery") { $lightbox_gallery='[gallery]'; }
	?>
	
	<div class="clear"></div>
	<?php if ($PortfolioScroll) { ?>
	<div id="loopedSlider">	
		<div class="container">
			<div class="slides">
				<div>
	<?php } ?>
	<ul class="portfolioFullMediumGrid">
	
		<?php while (have_posts()) : the_post(); ?>

		<?php //$image=get_post_meta($post->ID, $key, true); 
			$image_id = get_post_thumbnail_id(($post->ID), 'full'); 
			$image_url = wp_get_attachment_image_src($image_id,'full');  
			$image_url = $image_url[0]; 
		?>
		<?php $video=get_post_meta($post->ID, $vkey, true); ?>

		<?php if ( isset ( $image_url ) ) { ?>
					<?php 
						if ($PortfolioScroll) { 
							if ($column==5) {
								echo '</ul></div><div><ul class="portfolioFullMediumGrid">';
								$column=0;
							}
						}
					?>	
					<?php 
					$pcount++;
					$portfoliofound=true;
					
					if ($pcount==$percolumn) 
						{
						$pcount=0;
						$column++;
						if ($video<>"") { ?> 
								<li class="videoicon">
							<?php } else { ?> 
								<li class="imageicon">
						<?php } ?>
					<?php } else { //else its not the first row 
						if ($video<>"") { ?> 
							<li class="rightspace videoicon">
						<?php } else { ?> 
							<li class="rightspace imageicon">
						<?php } ?>
					<?php } ?>
					
						
									<?php if ($mtheme_portfoliolink=="Lightbox Pop-up") { ?>
										<?php if ($video<>"") { ?>
											<a class="loader" rel="prettyPhoto<?php echo $lightbox_gallery; ?>" title="<?php the_title(); ?>" href="<?php echo $video; ?>">
										<?php } else { ?>
											<a class="loader" rel="prettyPhoto<?php echo $lightbox_gallery; ?>" title="<?php the_title(); ?>" href="<?php echo $image_url; ?>">
										<?php } ?>
									<?php } else { ?>
										<a class="loader" title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
									<?php } ?>
										<?php echo resizeimage ($image_url,$pheight,$pwidth,$quality, 1 , $post->post_title, $class="fadetoicon preloader" ); ?>
									</a>
								<?php	
								if (!$PortfolioScroll)
								{
								?>
								<div class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
								<?php
								}
								?>

							</li>					

						
		<?php } ?>


		<?php endwhile; ?>
		
		<?php 
		if ($PortfolioScroll) { ?>
					</ul>
				</div>
		<?php
		} else {
		?>		
		</ul>
		<?php
		}
		?>
		<?php 
		if ($PortfolioScroll) { ?>
				</div>
			</div>
			<a href="#" class="previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loopslider/smallprevious.png" alt="Previous" /></a>
			<a href="#" class="next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loopslider/smallnext.png" alt="Next" /></a>
		</div>
		<?php
		}
		?>
		
	<?php if($pagination == 'true'){ ?>
	<div class="clear"></div>
	<div class="topmargin35"></div>
	<!-- Navigation -->
	<?php include (TEMPLATEPATH . "/includes/navigation.php"); ?>	
	<?php } ?>
	
	<div class="clear"></div>
	<?php if($pagination == 'false'){ ?>
	<div class="pmarginbottom"></div>
	<?php } ?>
	
	
	<?php $wp_query = null; $wp_query = $temp;

	return $content;
}

function mPortfolioSmall($category,$mtheme_portfoliolink,$portfoliotype,$mtheme_portfoliolightbox) {
	$itemlimit = '-1';
	$PortfolioScroll=false;
	if ($portfoliotype=="Scroll") { $PortfolioScroll=true; $pagination = 'false'; } else { $pagination = 'true'; }
	$perpage='12';
	$query='';
	$content="";
	
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	
	if($pagination == 'true'){
		$query .= '&showposts='.$perpage.'&paged='.$paged.'&category_name='.$category;
	} else {
		$query .= '&showposts='.$itemlimit.'&category_name='.$category;
	}
	if(!empty($query)){
		$query .= $query;
	}
	$wp_query->query($query);
	ob_start();
	?>
	
	
	<?php
	$key="image";
	$vkey="video";
	$pwidth=100;
	$pheight=100;
	$quality=72;
	$percolumn=4;
	$pcount=0;
	$column=0;
	$portfoliofound=false;
	$lightbox_gallery="";
	if ($mtheme_portfoliolightbox=="Gallery") { $lightbox_gallery='[gallery]'; }
	?>
	
	<div class="clear"></div>
	<?php if ($PortfolioScroll) { ?>
	<div id="loopedSlider">	
		<div class="container">
			<div class="slides">
				<div>
	<?php } ?>
		<ul class="portfolioSmallGrid">
	
		<?php while (have_posts()) : the_post(); ?>

		<?php //$image=get_post_meta($post->ID, $key, true); 
			$image_id = get_post_thumbnail_id(($post->ID), 'full'); 
			$image_url = wp_get_attachment_image_src($image_id,'full');  
			$image_url = $image_url[0]; 
		?>
		<?php $video=get_post_meta($post->ID, $vkey, true); ?>

		<?php if ( isset ( $image_url ) ) { ?>
					<?php 
					if ($PortfolioScroll) { 
						if ($column==3) {
							echo '</ul></div><div><ul class="portfolioSmallGrid">';
							$column=0;
						}
					}
					?>		
					<?php 
					$pcount++;
					$portfoliofound=true;
					
					if ($pcount==4) 
						{
						$pcount=0;
						$column++;
						
						if ($video<>"") { ?> 
								<li class="videoicon">
							<?php } else { ?> 
								<li class="imageicon">
						<?php } ?>
					<?php } else { //else its not the first row 
						if ($video<>"") { ?> 
							<li class="rightspace videoicon">
						<?php } else { ?> 
							<li class="rightspace imageicon">
						<?php } ?>
					<?php } ?>
					
						
									<?php if ($mtheme_portfoliolink=="Lightbox Pop-up") { ?>
										<?php if ($video<>"") { ?>
											<a class="loader" rel="prettyPhoto<?php echo $lightbox_gallery; ?>" title="<?php the_title(); ?>" href="<?php echo $video; ?>">
										<?php } else { ?>
											<a class="loader" rel="prettyPhoto<?php echo $lightbox_gallery; ?>" title="<?php the_title(); ?>" href="<?php echo $image_url; ?>">
										<?php } ?>
									<?php } else { ?>
										<a class="loader" title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
									<?php } ?>
										<?php echo resizeimage ($image_url,$pheight,$pwidth,$quality, 1 , $post->post_title, $class="fadetoicon preloader" ); ?>
									</a>
								<?php
								if (!$PortfolioScroll)
								{
								?>
								<div class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
								<?php
								}
								?>

							</li>					

						
		<?php } ?>


		<?php endwhile; ?>
		<?php 
		if ($PortfolioScroll) { ?>
					</ul>
				</div>
		<?php
		} else {
		?>		
		</ul>
		<?php
		}
		?>
		<?php 
		if ($PortfolioScroll) { ?>
				</div>
			</div>
			<a href="#" class="previous"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loopslider/smallprevious.png" alt="Previous" /></a>
			<a href="#" class="next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loopslider/smallnext.png" alt="Next" /></a>
		</div>
		<?php
		}
		?>
		
	<?php if($pagination == 'true'){ ?>
	<div class="clear"></div>
	<div class="topmargin35"></div>
	<!-- Navigation -->
	<?php include (TEMPLATEPATH . "/includes/navigation.php"); ?>	
	<?php } ?>
	
	<div class="clear"></div>
	<?php if($pagination == 'false'){ ?>
	<div class="pmarginbottom"></div>
	<?php } ?>
	
	
	<?php $wp_query = null; $wp_query = $temp;

	return $content;
}

function SlideshowPortfolio() {
?>



	<?php
	$images =& get_children( array( 
						'post_parent' => get_the_id(),
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order' )
						);
	
	if ( $images ) 
	{
	ob_start();
	?>
	
	<!-- Featured Slider -->
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/nivo/jquery.nivo.slider.js"></script>
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/nivo.full.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript">
/* <![CDATA[ */
jQuery(function () {
	jQuery('#slider').hide();
});

jQuery(window).bind("load", function() {

	jQuery('.container').css('background', 'none');
	jQuery('.container').css('width', '100%').css('height', '100%');

	jQuery('#slider:hidden').fadeIn(800);
	
	jQuery('#slider').nivoSlider({
		effect:'random', //Specify sets like: 'fold,fade,sliceDown'
		slices:12,
		animSpeed:1000, //Slide transition speed
		pauseTime:3000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:true, //Next & Prev
		directionNavHide:true, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		controlNavThumbsFromRel:false, //Use image rel for thumbs
		controlNavThumbsSearch: '.jpg', //Replace this with...
		controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
		keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});

});
/* ]]> */
</script>

	<div class="clear"></div>
	
	<!-- Slide Gallery Block -->
	<div class="container">
		<div id="slider">
	
		<?php
		foreach ( $images as $id => $image ) {

		$attatchmentID = $image->ID; 
		$imagearray = wp_get_attachment_image_src( $attatchmentID , 'full', false);
		$imageURI = $imagearray[0];
		$imageID = get_post($attatchmentID);
		$imageTitle = $imageID->post_title;
		
		?>
			<?php //echo resizeimage ($imageURI,$height,$width,$quality, 1 , $imageTitle, $class="" ); ?>
			
			<img src="<?php echo $imageURI; ?>" alt="<?php echo $imageTitle; ?>" />		
			
				<?php
		}
		?>
		</div>
	</div>


<?php
	$wp_query = null; $wp_query = $temp;
	return $content;
	}
}

?>