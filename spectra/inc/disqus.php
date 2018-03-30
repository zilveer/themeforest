<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			disqus.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

global $spectra_opts, $wp_query, $post;

// Get DISQUS shortname
$disqus_shortname = $spectra_opts->get_option( 'disqus_shortname' );

?>
<!-- ############################# DISQUS Comment section ############################# -->
<section id="discussion" class="comments-section">
    <div class="section-sign">
        <span class="icon icon-bubbles"></span>
    </div>
	
    <!-- container -->
    <div class="container">
	
	<div id="disqus_thread"></div>
	    <script type="text/javascript">
			/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
			var disqus_shortname = '<?php echo esc_js( $disqus_shortname ) ?>'; // required: replace example with your shortname
			var disqus_identifier = 'post_id_<?php echo esc_js( $wp_query->post->ID ) ?>';
			var disqus_title = '<?php echo esc_js( get_the_title( $wp_query->post->ID ) ) ?>';
			var disqus_url = window.location.href;

			/* * * DON'T EDIT BELOW THIS LINE * * */

			/* * * Disqus Reset Function * * */
			if ( typeof DISQUS != 'undefined' ) {
				DISQUS.reset({
		            reload: true,
		            config: function () {
		                this.page.identifier = disqus_identifier;
		                this.page.url = disqus_url;
		                this.page.title = disqus_title;
		            }
		        });
			} else {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        		dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			}
		
	    </script>
	    <noscript><?php _e( 'Please enable JavaScript to view the', SPECTRA_THEME ) ?> <a href="http://disqus.com/?ref_noscript"><?php _e( 'comments powered by Disqus.', SPECTRA_THEME ) ?></a></noscript>
	    <a href="http://disqus.com" class="dsq-brlink"><?php _e( 'Comments powered by', SPECTRA_THEME ) ?> <span class="logo-disqus">Disqus</span></a> 
    </div>
</section>