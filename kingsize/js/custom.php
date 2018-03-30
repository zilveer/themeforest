<script type="text/javascript">		
// Template Directory going here
var template_directory = '<?php echo get_template_directory_uri(); ?>';

//contact form
var contact_form_name = '<?php _e('Please enter your name', 'kslang'); ?>';
var contact_form_email = '<?php _e('Please enter your e-mail', 'kslang'); ?>';
var contact_form_valid_email = '<?php _e('Please provide a valid e-mail', 'kslang'); ?>';
var contact_form_message = '<?php _e('Please enter your message', 'kslang'); ?>';

//show/hide navigation language
var hideNav = '<?php _e('Hide the navigation', 'kslang'); ?>';
var showNav = '<?php _e('Show the navigation', 'kslang'); ?>';

//LazyLoader Option
var	lazyloader_status = false;
<?php
global $data;
if($data["wm_lazyloader_option"] == "Enable Lazyloader") :
?>
lazyloader_status = true;
<?php
endif;
?>
</script>