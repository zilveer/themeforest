<?php
/** Footer
  *
  * Loads the footer of the website.
  *
  * @package The Beauty Salon
  *
  */
  global $framework, $blueprint, $post;

  if( ! is_object( $blueprint ) ) {
  	$blueprint = new EB_Blueprint( $framework );
  }


?>


</div> <!-- Site Content -->
</div> <!-- row -->
</div> <!-- Container -->
<div class='container site-footer-container'>
	<div class='row'>
		<div class='twelvecol'>
			<div id='site-footer'>
				<div class='row'>
				<div class='eightcol'>
					<?php echo $framework->options['site_footer_copyright_text'] ?>
				</div>
				<div class='fourcol last'>
					<div class='footer-social'>
						<?php if( !empty( $framework->options['footer_facebook_icon'] ) AND !empty( $framework->options['footer_facebook_url'] ) ) :
							$icon = $framework->options['footer_facebook_icon'];
							if( is_numeric( $icon ) ) {
								$icon = wp_get_attachment_image_src( $icon );
								$icon = $icon[0];
							}

						?>
							<a href='<?php echo $framework->options['footer_facebook_url'] ?>'><img src="<?php echo $icon ?>"></a>
						<?php endif ?>
						<?php if( !empty( $framework->options['footer_twitter_icon'] ) AND !empty( $framework->options['footer_twitter_url'] ) ) :
							$icon = $framework->options['footer_twitter_icon'];
							if( is_numeric( $icon ) ) {
								$icon = wp_get_attachment_image_src( $icon );
								$icon = $icon[0];
							}


						?>
							<a href='<?php echo $framework->options['footer_twitter_url'] ?>'><img src="<?php echo $icon ?>"></a>
						<?php endif ?>
						<?php if( !empty( $framework->options['footer_rss_icon'] ) AND !empty( $framework->options['footer_rss_url'] ) ) :
							$icon = $framework->options['footer_rss_icon'];
							if( is_numeric( $icon ) ) {
								$icon = wp_get_attachment_image_src( $icon );
								$icon = $icon[0];
							}

						?>
							<a href='<?php echo $framework->options['footer_rss_url'] ?>'><img src="<?php echo $icon ?>"></a>
						<?php endif ?>

					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php wp_footer(); ?>
</body>
</html>