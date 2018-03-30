	<!-- FOOTER -->
        <div id="footer">
        	<p><?php echo get_option('launch_copyright_text'); ?></p>
        </div>
		
    </div>
	<!-- END OF CONTENT AREA -->

    </div>
	
	
	<?php get_template_part( 'inc/news-data' ); ?>
    

	<?php wp_footer(); ?>
	
	<script type="text/javascript">	
		// This JavaScript is Used in Footer to Provide Translation Support to Values used in form fields
		jQuery(document).ready(function(){
				//this function attaches focus and blur events with input elements
				var addFocusAndBlur = function($input, $val){
					
					$input.focus(function(){
						if (this.value == $val) {this.value = '';}
					});
					
					$input.blur(function(){
						if (this.value == '') {this.value = $val;}
					});
				}
				
				// example code to attach the events
				addFocusAndBlur(jQuery('#email'),'<?php _e('Enter your email address','framework'); ?>');
				addFocusAndBlur(jQuery('#name'),'<?php _e('Name','framework'); ?>');
				addFocusAndBlur(jQuery('#user-email'),'<?php _e('E-mail Address','framework'); ?>');
				addFocusAndBlur(jQuery('#message'),'<?php _e('Message','framework'); ?>');
				addFocusAndBlur(jQuery('#name-comments'),'<?php _e('Name','framework'); ?>');
				addFocusAndBlur(jQuery('#email-comments'),'<?php _e('E-mail Address','framework'); ?>');
				addFocusAndBlur(jQuery('#message-comments'),'<?php _e('Message','framework'); ?>');	
			});
	</script>	
	
</body>
</html>