<?php get_header(); ?>


<!-- ============================================== -->


<?php if(get_option_tree('frontpage_featurerow') == 'off' ) { } else { ?>
<!-- Super Container - Three Column Row - Content comes from OptionTree -->
<div class="super-container full-width featurerow">

	<!-- 960 Container -->
	<div class="container">	
	
		<div class="sixteen columns">	
	
			<div class="feature">
			<?php if(get_option_tree('frontpage_featurerow_url')) { ?>
				<a class="button <?php echo get_option_tree('tags_color'); ?>" href="<?php echo get_option_tree('frontpage_featurerow_url'); ?>"><?php echo get_option_tree('frontpage_featurerow_buttontext'); ?></a>
			<?php } else { ?>			 
				<style type="text/css">.featurerow .feature{text-align: center;}</style>
			<?php } ?>
			
			<?php echo get_option_tree('frontpage_featurerow_text'); ?></div>
		
			<br class="clearfix" />
			<hr />
			
			
		</div>
		
	</div>
	<!-- /End 960 Container -->

</div>
<!-- /End Super Container -->
<?php } ?>	



<!-- ============================================== -->



<?php if(get_option_tree('frontpage_blurbrow') == 'No' ) { } else { ?>
<!-- Super Container - Three Column Row - Content comes from OptionTree -->
<div class="super-container full-width" id="section-thirds">

	<!-- 960 Container -->
	<div class="container">		
		
		
		<!-- 1/3 Columns -->
		<div class="one-third column">				
			<div class="module">						
				<?php if(get_option_tree('homepage_blurb_1_image')) { ?>	
				<div class="module-img">							
					<a href="<?php echo get_option_tree('homepage_blurb_1_url'); ?>" <?php if (get_option_tree('blurb_lightbox') == 'on') { ?>data-rel="prettyPhoto[Gallery]"<?php } ?>>
						<img src="<?php echo get_option_tree('homepage_blurb_1_image'); ?>" alt="image"/>
						<span></span>
					</a>							
					<div class="lightboxLink">
						<a class="popLink boxLink" href="<?php echo get_option_tree('homepage_blurb_1_image'); ?>" data-rel="prettyPhoto[Lightbox]" title="Lightbox" ></a>
				    </div>						    
					<div class="thumbLink">
					    <a class="popLink" href="<?php echo get_option_tree('homepage_blurb_1_url'); ?>" title="Full Post"></a>
				    </div>						    
				</div>
				<?php } else {} ?>				
				<div class="module-meta">
					<h5><a href="<?php echo get_option_tree('homepage_blurb_1_url'); ?>"><?php echo get_option_tree('homepage_blurb_1_title'); ?></a></h5>	
					<p><?php echo get_option_tree('homepage_blurb_1_text'); ?></p>
				</div>						
			</div>				
		</div>

		<div class="one-third column">				
			<div class="module">
				<?php if(get_option_tree('homepage_blurb_2_image')) { ?>
				<div class="module-img">							
					<a href="<?php echo get_option_tree('homepage_blurb_2_url'); ?>" <?php if (get_option_tree('blurb_lightbox') == 'on') { ?>data-rel="prettyPhoto[Gallery]"<?php } ?>>
						<img src="<?php echo get_option_tree('homepage_blurb_2_image'); ?>" alt="image"/>
						<span></span>
					</a>							
					<div class="lightboxLink">
						<a class="popLink boxLink" href="<?php echo get_option_tree('homepage_blurb_2_image'); ?>" data-rel="prettyPhoto[Lightbox]" title="Lightbox" ></a>
				    </div>						    
					<div class="thumbLink">
					    <a class="popLink" href="<?php echo get_option_tree('homepage_blurb_2_url'); ?>" title="Full Post"></a>
				    </div>						    
				</div>		
				<?php } else {} ?>
				<div class="module-meta">
					<h5><a href="<?php echo get_option_tree('homepage_blurb_2_url'); ?>"><?php echo get_option_tree('homepage_blurb_2_title'); ?></a></h5>	
					<p><?php echo get_option_tree('homepage_blurb_2_text'); ?></p>
				</div>						
			</div>				
		</div>

		<div class="one-third column">				
			<div class="module">	
				<?php if(get_option_tree('homepage_blurb_3_image')) { ?>
				<div class="module-img">							
					<a href="<?php echo get_option_tree('homepage_blurb_3_url'); ?>" <?php if (get_option_tree('blurb_lightbox') == 'on') { ?>data-rel="prettyPhoto[Gallery]"<?php } ?>>
						<img src="<?php echo get_option_tree('homepage_blurb_3_image'); ?>" alt="image"/>
						<span></span>
					</a>							
					<div class="lightboxLink">
						<a class="popLink boxLink" href="<?php echo get_option_tree('homepage_blurb_3_image'); ?>" data-rel="prettyPhoto[Lightbox]" title="Lightbox" ></a>
				    </div>						    
					<div class="thumbLink">
					    <a class="popLink" href="<?php echo get_option_tree('homepage_blurb_3_url'); ?>" title="Full Post"></a>
				    </div>						    
				</div>			
				<?php } else {} ?>
				<div class="module-meta">
					<h5><a href="<?php echo get_option_tree('homepage_blurb_3_url'); ?>"><?php echo get_option_tree('homepage_blurb_3_title'); ?></a></h5>	
					<p><?php echo get_option_tree('homepage_blurb_3_text'); ?></p>
				</div>						
			</div>				
		</div>		
		<!-- /End 1/3 Columns -->
		
	</div>
	<!-- /End 960 Container -->

</div>
<!-- /End Super Container -->
<?php } ?>	


<!-- ============================================== -->


<?php get_footer(); ?>