<?php
/**
 * The main template file.
 *
 */
$settings = get_option( "ntl_theme_settings" );
get_header(); ?>


	<div class="outer">
		<div class="frameset container clear">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="clear headtop">	
				<?php if ($settings['ntl_themetagline']) { ?>
					<div class="taglineout smallfont">
						<div class="taglinein">
							<?php echo stripslashes( $settings['ntl_themetagline']); ?>
						</div>
					</div>
				<?php } ?>
										
				<?php echo lets_get_albumselector(); ?>						
				<?php echo lets_get_musicplayer(); ?>
					
							
			<?php } else { ?>
			
			<div class="clear headtop" style="height: auto;">
				
				<?php if ($settings['ntl_themetagline']) { ?>
					<div class="taglineout smallfont" style="width: 860px; margin-bottom: 40px;">
						<div class="taglinein">
							<?php echo stripslashes( $settings['ntl_themetagline']); ?>
						</div>
					</div>
					<?php }  else { ?>
						<div class="taglineout smallfont" style="width: 860px; margin-bottom: 20px;"></div>
					<?php } ?>	
				<?php } ?>				
			</div>
			
		<?php if (!$settings['ntl_show_timer']) { ?>
		<div class="cdowntop">	
			<?php echo get_for_timer(''); ?>
		<?php } else { ?>
			<div class="cdownnone">
		<?php }	?>
		
		<div class="hfeed container">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="drawer">&nbsp;</div>
			<?php } ?>
			<!-- Getting the slideshow below the menu -->
			<?php if ($settings['ntl_slide_type'] == 'image') { ?>
				<?php lets_get_imgslide(); ?>
			<?php }  ?>
			
			
			
			<div id="main">			
				<div class="maincontent">
					<div class="maincontentinner clear">	
						<?php if ( is_active_sidebar( 'index-left' ) ) { ?>	
						<div id="primary" class="widget-area grid4 first" role="complementary" >				
							<ul class="xoxo">	
								<?php dynamic_sidebar( 'index-left' ); ?>
							</ul>
						</div>
						<?php } else {
							echo '<div id="primary" class="widget-area grid4 first" role="complementary" ><h3>Theme installed successfully</h3>
							      <p>You can view the theme help file in the theme folder to assist in the setup.</p>
							      <p><strong>The theme help file is in the help folder. Steps to access the help file below:</strong></p>
							      <ul>
							      <li>Unzip the "unzip_me_music.zip" file that you have purchased from Themeforest.</li>
							      <li>Search for the help folder, and open the index.html file in any browser.</li>
							      </ul>
							      <p>&nbsp;</p>
							      <p><strong>Drag widgets onto the index page left sidebar to remove this message.</strong></p>
							      </div>';
						} ?>
					
						<?php if ( is_active_sidebar( 'index-center' ) ) { ?>	
						<div id="primary" class="widget-area grid4" role="complementary" >					
							<ul class="xoxo">	
								<?php dynamic_sidebar( 'index-center' ); ?>
							</ul>
						</div>
						<?php } else {
							echo '<div id="primary" class="widget-area grid4" role="complementary" >
								<h3>Drag widgets to the sidebar center widget area to remove this message</h3>	<br/><br/>
								<p style="color:red;">Remember that your music is not secure  - that is why Itunes plays only part of the song if you preview it. To ensure that your music will not be copied, cut your song into a smaller section ad upload it.</p>						      
							</div>';
						} ?>
					
						<?php if ( is_active_sidebar( 'index-right' ) ) { ?>	
						<div id="primary" class="widget-area grid4" role="complementary" >					
							<ul class="xoxo">	
								<?php dynamic_sidebar( 'index-right' ); ?>
							</ul>
						</div>
						<?php } else {
							echo '<div id="primary" class="widget-area grid4" role="complementary" >
							<h3>Drag widgets to the sidebar right widget area to remove this message</h3>
							      </div>
							';
						} ?>
					</div>	
				</div>
			</div><!-- #main -->
			
		</div>
</div>

<?php 

	lets_make_carousel();

?>
				
<?php get_footer(); ?>
