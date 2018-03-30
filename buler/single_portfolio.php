<?php global $pmc_data, $sitepress;
wp_enqueue_script('pmc_any');
wp_enqueue_script('pmc_any_fx');
wp_enqueue_script('pmc_any_video');		

?>
<script type="text/javascript">
jQuery(document).ready(function($){
	    $('#slider').anythingSlider({
		hashTags : false,
		expand		: true,
		autoPlay	: true,
		resizeContents  : false,
		pauseOnHover    : true,
		buildArrows     : false,
		buildNavigation : false,
		delay		: 5000,
		resumeDelay	: 0,
		animationTime	: 500,
		delayBeforeAnimate:0,	
		easing : 'easeInOutQuint',
		onSlideBegin    : function(e, slider) {
				$('.nextbutton').fadeOut();
				$('.prevbutton').fadeOut();
		
		},
		onSlideComplete    : function(slider) {
			$('.nextbutton').fadeIn();
			$('.prevbutton').fadeIn();
		
		}		
	    })

	    
	    $('.blogsingleimage').hover(function() {
		$(".slideforward").stop(true, true).fadeIn();
		$(".slidebackward").stop(true, true).fadeIn();
	    }, function() {
		$(".slideforward").fadeOut();
		$(".slidebackward").fadeOut();
	    });
	    $(".pauseButton").toggle(function(){
		$(this).attr("class", "playButton");
		$('#slider').data('AnythingSlider').startStop(false); // stops the slideshow
	    },function(){
		$(this).attr("class", "pauseButton");
		$('#slider').data('AnythingSlider').startStop(true);  // start the slideshow
	    });
	    $(".slideforward").click(function(){
		$('#slider').data('AnythingSlider').goForward();
	    });
	    $(".slidebackward").click(function(){
		$('#slider').data('AnythingSlider').goBack();
	    });  
	});
	
</script>	

<!-- top bar with breadcrumb with portfolio navigation--> 

<div class = "outerpagewrap">
	<div class="pagewrap">
		<div class="pagecontent">
			<div class="pagecontentContent">
				<p><?php echo pmc_breadcrumb(); ?></p>
			</div>
			<div class = "portnavigation">
					<span><?php previous_post_link('%link', '<div class="portprev"><i class="fa fa-angle-right"></i><div class="link-title-previous">%title</div></div>' ,false,''); ?> </span>				
					<span><?php next_post_link('%link','<div class="portnext"><i class="fa fa-angle-left"></i><div class="link-title-next">%title</div></div>',false,''); ?> </span>

			</div>
		</div>

	</div>
</div>
<!-- main content start -->
<div class="mainwrap">
	<div class="main clearfix portsingle">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php  $portfolio = get_post_custom($post->ID); ?>

	<div class="pad"></div>
	<div class="content fullwidth">

		<div class="blogpost postcontent port" >
			<div class="projectdetails">	
					<div class = "imageFrame"></div>
						<div class="blogsingleimage">	
						<?php 
							$args = array(
								'post_type' => 'attachment',
								'numberposts' => null,
								'post_status' => null,
								'post_parent' => $post->ID,
								'orderby' => 'menu_order ID',
							);
							$attachments = get_posts($args);
							if ($attachments) {?>
								<div id="slider" class="slider">
										<?php
											$i = 0;
											foreach ($attachments as $attachment) {
												//echo apply_filters('the_title', $attachment->post_title);
												$image =  wp_get_attachment_image_src( $attachment->ID, 'sinbgleport' ); ?>	
													<div>
														<img class="check" src="<?php echo $image[0] ?>" />				
																
													</div>
													
													<?php 
													$i++;
													} ?>
							
									
								</div>
								<?php if($i > 1){ ?>
								<div class="prevbutton slidebackward port"><i class="fa fa-angle-left"></i></div>
								<div class="nextbutton slideforward port"><i class="fa fa-angle-right"></i></div>
								<?php } ?>
							  <?php } else { ?>
								<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id() )) ?>" rel="lightbox[port]" title="<?php the_title() ?>"><?php pmc_getImage('sinbgleport'); ?></a>
							  <?php } ?>
						
						</div>	
						
					<div class="bottomborder"></div>
			</div>
			<div class="projectdescription">
				<h1><?php the_title();?></h1>
				<div class="datecomment">
					<p>
						<?php if($portfolio['detail_active'][0]) {
							if($portfolio['detail_active'][0]) { ?>
							  <i class="fa fa-fa fa- icon-link"></i><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['port_project_url']); } else {  _e('Project URL:','buler'); } ?> <span class="link"><a target="_blank" href="http://<?php echo $portfolio['website_url'][0] ?>" title="project url"><?php echo $portfolio['website_url'][0] ?></a></span>  </br>
						<?php } else { ?>
							   <i class="fa fa-fa fa- icon-link"></i><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['port_project_url']); } else {  _e('Project URL:','buler'); } ?> <span class="link"><a title="project url"><?php echo $portfolio['website_url'][0] ?></a></span> 
						<?php }  ?>	
						<?php } ?>
						<?php if($portfolio['author'][0] !='') {?>
							<i class="fa fa-user"></i><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['port_project_designer']); } else {  _e('Project designer:','buler'); } ?> <span class="authorp port"><?php echo $portfolio['author'][0] ?></span><br>
						<?php } ?>
						<?php if($portfolio['date'][0] !='') {?>
							<i class="fa fa-calendar"></i><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['port_project_date']); } else {  _e('Date of completion:','buler'); } ?> <span class="posted-date port"><?php echo $portfolio['date'][0] ?></span><br>
						<?php } ?>
						<?php if($portfolio['customer'][0] !='') {?>
							<i class="fa fa-user"></i><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['port_project_client']); } else {  _e('Client:','buler'); } ?> <span class="author port"><?php echo $portfolio['customer'][0] ?></span><br>
						<?php } ?>								
					</p>
						
				</div>	
						
				<div class="posttext"> 
						
						<div> <?php  the_content(); ?> </div>	
						
				</div>	
				
				<div class="socialsingle"><?php pmc_socialLinkSingle() ?></div>	
				
				<div class="single-portfolio-skils">
					<?php
					if(isset($portfolio['skils'][0])){
					echo '<ul>';
					foreach(explode("\n", $portfolio['skils'][0]) as $line) {
						echo '<li><i class="fa fa-ok-sign"></i>'.$line.'</li>';
					} 
					echo '</ul>';
					}?>
				</div>				
			</div>
				
			</div>						
	</div>	

	
					
	<?php endwhile; else: ?>
	
	<?php endif; ?>
		<div class="portfolio">		
			<h3><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo pmc_stripText($pmc_data['port_project_related']); } else {  _e('Related <span>project</span>','buler'); } ?></h3>	
			<div class="titleborder"></div>		
			<div id="portitems4">
				<?php pmc_portfolio('port3',3,'port',3,'') ?>	
				
			</div>

		</div>	
	</div>
	<!-- bottom quote -->
	<div class="infotextwrap">
		<div class="infotext">
			<div class="infotext-title">
				<h2><?php echo pmc_translation('quote_big','CHECK OUR LATEST WORDPRESS THEME THAT IMPLEMENTS PAGE BUILDER') ?></h2>
				<div class="infotext-title-small"><?php echo pmc_translation('quote_small','- learn how to build Wordpress Themes with ease with a premium Page Builder which allows you to add new Pages in seconds.') ?></div>
			</div>
		</div>
	</div>
</div>