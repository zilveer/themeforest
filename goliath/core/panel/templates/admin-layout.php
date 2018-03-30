<?php

    global $_SETTINGS;
    $head = $_SETTINGS->admin_head;
    $body = $_SETTINGS->admin_body;
    
    if(!empty($head) && !empty($body))
    {
        $view = plsh_get($_GET, 'view', $head[key($head)]['slug']);   //get view; defaults to first element of header
        $view_title = $head[$view]['name'];
        $section_title = '';
        
        if($view == 'ads_manager')
        {
            $section_key = plsh_get($_GET, 'section', 'ads_manager');
        }
        else
        {
            $section_key = plsh_get($_GET, 'section', false);
        }
        
        if($section_key)
        {
            $section_title = ' / ' . $head[$view]['children'][$section_key]['name'];
        }
        
        ?>
        <!-- BEGIN .main-control-panel-wrapper -->
		<div class="main-control-panel-wrapper">
			
			<?php plsh_sidebar(); ?>
			
			<!-- BEGIN .main-content -->
			<div class="main-content-wrapper">
                <div class="main-content view-<?php echo esc_attr($view); ?>">
				
					<!-- BEGIN .header -->
					<div class="header">
						<h2><?php echo plsh_gs('theme_name'); ?><span>/ <?php echo esc_html($view_title . $section_title); ?></span></h2>
					<!-- END .header -->
					</div>
                    
                    <!-- BEGIN .save-message-1 -->
					<div class="save-message-1 clearfix">
						<span>Your settings have been saved!</span>
						<a href="#" class="close"></a>
					<!-- END .save-message-1 -->
					</div>
					
					<!-- BEGIN .error-message-1 -->
					<div class="error-message-1 clearfix">
						<span>Your settings have not been saved!</span>
						<a href="#" class="close"></a>
					<!-- END .error-message-1 -->
					</div>
                    <?php
                        if(!empty($head[$view]['type']))
                        {
                            if(function_exists($head[$view]['type']))
                            {
                                $head[$view]['type']();
                            }
                        }
                    ?>
					
					<?php
					if(!get_option('plsh_hide_admin_newsletter', false))
					{
						?>
							<!-- BEGIN .newsletter -->
							<div class="newsletter clearfix">
								<a href="#" class="close"></a>
								<div class="col">
									<span><b>Planetshine Newsletter</b> *</span>
									<p>We'll show you how to get the most<br>
									out of your theme and give other cool tips</p>
								</div>
								<a href="http://eepurl.com/bxukK1" target="_blank" class="button">Subscribe here</a>
								<div class="notes">
									* 100% useful & relevant info. We never send more than one email a month, you can unsubscribe at any time and we will never share your email with third parties.
								</div>
							<!-- END .newsletter -->
							</div>
							<script type="text/javascript">
							jQuery(document).ready(function() {

								jQuery('.newsletter .close').click(function(){
									jQuery('.newsletter').hide();

									var admin_ajax = '<?php echo site_url().'/wp-admin/admin-ajax.php'; ?>';
									var nonce = '<?php echo wp_create_nonce('plsh_remove_newsletter_notification') ?>';
									var data = { action: 'plsh_remove_newsletter_notification', _ajax_nonce: nonce, data: data};

									jQuery.post(admin_ajax, data ,function(msg){
									}, 'json')

									return false;
								});
							});
							</script>
						<?php
					}
					?>
				</div>
			<!-- END .main-content -->
			</div>
		
		<!-- END .main-control-panel-wrapper -->
		</div>
        <?php
    }
    ?>