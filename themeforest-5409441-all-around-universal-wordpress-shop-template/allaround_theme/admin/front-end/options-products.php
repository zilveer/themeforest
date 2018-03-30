<div class="wrap" id="of_container">
	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save">Options Updated</div>
	</div>
	<div id="of-popup-reset" class="of-save-popup">
		<div class="of-save-reset">Options Reset</div>
	</div>
	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail">Error!</div>
	</div>
	<span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce_post'); ?>" />
		<div id="header">
			<div class="logo">
				<h2><?php _e( 'AllAround Products Evaluation', 'allaround'); ?></h2>
				<span><?php echo ('v'. THEMEVERSION); ?></span>
			</div><!--.logo--> 	
			<div id="js-warning">Warning- This options panel will not work properly without javascript!</div>
			<div class="clear"></div>
    	</div><!--header--> 	
		<div id="info_bar">
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
		</div><!--.info_bar--> 	
		<div id="main">
			<div id="of-nav" style="display:none">
				<ul>
					<?php echo $products_options_machine->Menu ?>
				</ul>
			</div>
			<div id="content" style="width:755px !important;border-right:1px solid #d8d8d8;">
				<?php echo $products_options_machine->Inputs /* Settings */ ?>
		  	</div>
			<div class="clear"></div>
		</div><!--main-->
		<div class="save_bar"> 
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
		</div><!--.save_bar--> 
	<div style="clear:both;"></div>
<!--</div>wrap-->
