<?php
/**
 * The template for displaying single menu entries
 *
 *
 */

 $settings = get_option( "ntl_theme_settings" );

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	

	<div class="outer">
		<div class="frameset container clear">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="clear headtop">	
				<div class="page-title" >
					<h1 class="vfont"><?php the_title(); ?></h1>
				</div>
										
				<?php echo lets_get_albumselector(); ?>						
				<?php echo lets_get_musicplayer(); ?>
					
			</div>				
			<?php } else { ?>
			
			<div class="clear headtop" style="height: auto;">					
				<div class="page-title" style="width: 100%; margin-bottom: 40px;">
					<h1 class="vfont"><?php the_title(); ?></h1>
				</div>			
			</div>
			
			<?php } ?>
			
			<?php if (!$settings['ntl_show_timer']) { ?>
				<div class="cdowntop">	
				<?php echo get_for_timer(''); ?>
			<?php } else { ?>
				<div class="cdownnone">
			<?php }	?>

<div class="bodymid hfeed hpage">
	<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
		<div class="drawer">&nbsp;</div>
	<?php } ?>
	<div id="main" style="margin-bottom: 0px;">
		<div id="content" role="main">
			<div class="container clear">
				<div class="grid8 first">	
					<div id="content" role="main">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content">
								<div class="themusic" style="z-index: 40;">
								<?php
									$name_meta = get_post_meta(get_the_ID(), 'netlabs_artname' , true);
									$output = '';

															
									$arrImages =& get_children('post_type=attachment&orderby=menu_order&order=DESC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID() );
									if ($arrImages){
										$countr = 1;
										$mcounter = 1;
										foreach ( $arrImages as $attachment ) {
											if ($countr %2 == 0)	{$alter = 'salt';} else {$alter ='';}
											$image_attributes = wp_get_attachment_url( $attachment->ID );
											$p1 = get_post_meta($attachment->ID, '_nets_musname' , true);
											$p2 = get_post_meta($attachment->ID, '_nets_muslink' , true); 
											$p3 = get_post_meta($attachment->ID, '_nets_musdownl' , true); 
											$p4 = get_post_meta($attachment->ID, '_nets_lyrlist' , true); 
											$p5 = get_post_meta($attachment->ID, '_nets_altlink' , true);
											$upload_dir = wp_upload_dir();
											
										
											if ($p5 && $p5 != 'No Link') {
												$a_link = $upload_dir['baseurl'] . '/audio/' . $p5;
											} else {
												$a_link = wp_get_attachment_url( $attachment->ID );
											}
																					
											
											if ($p1) {
												$names_meta = $p1;
											}  else {
												$names_meta = $name_meta;
											}
											
											$cont = '';
											
											if ($p4  && $p4 != 0){
												
												$postkey = get_post($p4);
												$con = $postkey->post_content;
												$tcon = $postkey->post_title;
												$cont = apply_filters('the_content', $con);
												$cont = str_replace(']]>', ']]>', $cont);
												
											}
											
											$output .= '
											<div class="singletitle ' . $alter . ' clear test">';
											
											if ($cont) {
												$output .= '<div id="lyr' . $countr . '" class="lyricspost"><h4 class="vfont">' .  $tcon  . '</h4>' . $cont   .  '</div>';
											}
											
											if ($settings['ntl_disable_audio'] != 'off'){
											
											$output .= '<div class="singleout"><div class="ui-singlename uisinglecount-' . $countr  . '" rel="' . $a_link  . '" >&nbsp;</div></div>';											
											}
											
											if ($cont) {
												$output .= '<span class="dwnl dwnlmore lyrics smallfont"><a href="#" class="viewlyrics" style="color: #313131; padding-top: 0px;margin-top: -5px;" title="view lyrics" rel="#lyr' . $countr . '">' . __('Lyrics', 'localize')  .  '</a></span>';
											}
											
											if ($p2) {
											$output .= '<span class="dwnl dwnlmore"><a href="' . $p2  . '" title="' . __('Buy this track', 'localize')  .  '" target="_blank"><img src="' . get_template_directory_uri() . '/images/shop.png"></a></span>';
											}
											if ($p3 && $p3 != 'No Link') {
											$output .= '<span class="dwnl dwnlmore"><a href="' . lets_get_dwnl($p3)  . '" title="' . __('Download this track', 'localize')  .  '"><img src="' . get_template_directory_uri() . '/images/download.png"></a></span>';
											}
											
											$output .= '<p class="smallfont">' . $countr . '. ' . $attachment->post_title . '<br/><span class="albumartist">' . $names_meta  . ' &nbsp;</span></p></div>';
$countr++;
											$mcounter++;
										}
									}
									if ($settings['ntl_disable_audio'] != 'off'){
											
										$output .= '<div class="mplayhold" style="top: -50000px;"><div class="ui-single" rel="0">
														<div id="cromaplay-s-0" class="croma-jplayer-s"></div>
															<div id="cromaplay_single-0" class="croma-audio-s">
																<div class="cromaplay_playlist-s-0">
																	<div class="croma-playerinterface-s-0">
																		<ul class="croma-controls-s">
																			<li><a href="javascript:;" class="croma-play-s-0 singplay" tabindex="1">play</a></li>
																			<li><a href="javascript:;" class="croma-pause-s-0 singpause" tabindex="1">pause</a></li>
																		</ul>
																		<div class="psholder">
																			<div class="croma-progress-s-0 cprog">
																				<div class="croma-seek-s-0 cseek">
																					<div class="croma-playbar-s-0 cbar"></div>
																				</div>
																			</div>
																			<div class="croma-time-holder-s-0 tholderc">
																				<div class="croma-current-time-s-0"></div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>';											
									}											
									echo $output;
								?>
								</div>
								
								<?php the_content(); ?>
							</div><!-- .entry-content -->
						</div><!-- #post-## -->
					</div><!-- #content -->
				</div><!-- #container -->
				<div class="grid4">
					<?php 
					$a_lnk = get_post_meta(get_the_ID(), 'netlabs_ltb1label' , true); 
					$b_lnk = get_post_meta(get_the_ID(), 'netlabs_ltb1address' , true); 
					$c_lnk = get_post_meta(get_the_ID(), 'netlabs_ltb2label' , true); 
					$d_lnk = get_post_meta(get_the_ID(), 'netlabs_ltb2address' , true); 
					if ($a_lnk || $c_lnk) {
						if (!$c_lnk) {
							echo '<p class="menu-download darkbox clear" style="margin-top: 20px;"><a class="mfull" href="' . $b_lnk .'" title="' . __('buy from', 'localize')  .  ' ' . $a_lnk . '">' . $a_lnk .'</a></p>';
						} elseif (!$a_lnk) {
							echo '<p class="menu-download darkbox clear" style="margin-top: 20px;"><a class="mfull" href="' . $d_lnk .'" title="' . __('buy from', 'localize')  .  ' ' . $c_lnk . '">' . $c_lnk .'</a></p>';
						} else {
							echo '<p class="menu-download darkbox clear" style="margin-top: 20px;"><a href="' . $b_lnk .'" title="' . __('buy from', 'localize')  .  ' ' . $a_lnk . '">' . $a_lnk .'</a><a href="' . $d_lnk .'" title="' . __('buy from', 'localize')  .  ' ' . $c_lnk . '">' . $c_lnk .'</a></p>';
						}
					}
					?>
					<div class="menu-content">
						<div class="mencontent">
							<div class="imgblock">
								<div class="imlk menimg" >
									<?php the_post_thumbnail('albmlink'); ?> 
								</div> 
							</div>							
						</div>
					</div> 
				
				</div>
			</div>
		</div>
	</div>


<?php endwhile; ?>

</div>
</div>
<?php lets_make_carousel(); ?>


								
<?php get_footer(); ?>
