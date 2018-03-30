<?php $all_social_links = get_social_links(); ?>
<?php 
global $NHP_Options; 
$options_morphis = $NHP_Options; 
?>

<?php if(!empty($all_social_links)) : ?>

<div id="top-section">
		<!-- TOP SECTION CONTAINER -->
		<div class="container">
			<!-- TOP SECTION COLUMNS -->
			<div class="social-container sixteen columns">		
				<!-- SOCIAL MEDIA ICONS -->
				<ul class="social-icons">									
				<?php 

					// strip all unnecessary strings
					foreach($all_social_links as $strippingLinks) {
					
						if($strippingLinks == 'twitter_username'):			
							$theSocialLink = str_replace('_username', '', $strippingLinks);
							$theSocialURL = $options_morphis[$strippingLinks];
							if($theSocialURL != ''):
								echo '<li><a href="http://twitter.com/'. $theSocialURL .'" class="social-icon '. $theSocialLink .'" title="' . $theSocialLink . '" target="_blank"></a></li>';
							endif;
						else:
							$theSocialLink = str_replace('arr_social_', '', $strippingLinks);
							$theSocialLink = str_replace('_social_link', '', $theSocialLink);			
							$theSocialURL = $options_morphis[$strippingLinks];
							if($theSocialURL != ''):
								echo '<li><a href="'. $theSocialURL .'" class="social-icon '. $theSocialLink .'" title="' . $theSocialLink . '" target="_blank"></a></li>';
							endif;
						endif;
						
					}	
					
				?>				
				</ul>
				<!-- END SOCIAL MEDIA ICONS -->
				<div class="clear"></div>
			</div>
			<!-- END TOP SECTION COLUMNS -->
		</div>
		<!-- END TOP SECTION CONTAINER -->
  </div>
  
 <?php endif; ?>