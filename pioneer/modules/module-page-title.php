<?php 
global $post;

$subtitle = get_post_meta( $post->ID,'epic_titlemodule_subtitle',true);
$searchform = get_post_meta($post->ID,'epic_titlemodule_searchform',true);
$breadcrumb = get_post_meta($post->ID,'epic_titlemodule_breadcrumb',true);
$default_searchform = get_option('epic_titlemodule_searchform');
$default_breadcrumb = get_option('epic_titlemodule_breadcrumb');
?>

<div id="module-page-title" class="module module-page-title ">

<?php if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):	

	fee_handle('Pagetitle');
	
	
	
	?>
	

<div class="fee-options" id="page_title_options">

		<form method="post">
		
		<h5>Title</h5>
		<p><input type="text" name="epic_titlemodule_title" value="<?php echo get_the_title();?>"/></p>
		<h5>Sub-title</h5>
		<p><input type="text" name="epic_titlemodule_subtitle" value="<?php echo $subtitle;?>"/></p>
		
			
		<?php if ($default_breadcrumb == true):?>
		<p><input type="checkbox" name="epic_titlemodule_breadcrumb" <?php if($breadcrumb){ echo 'checked="checked"';} ?>/><label>Hide breadcrumbs</label></p>	
		<?php endif;?>
		
		
		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_titlemodule'); ?>	
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		<script>
			jQuery(function($) {
			jQuery( "#page_title_options" ).dialog({
				autoOpen: false,
				title:"Title settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});
			jQuery( "#pagetitle_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#page_title_options" ).dialog( "open" );
				return false;
			});
			});
		</script>
		</form>
		
	</div>
</div>
<?php endif; // End admin ?>

<div class="module-content clearfix">
		
			<?php if(!$breadcrumb && $default_breadcrumb == true){epic_breadcrumbs('bcContent');}?>
			<?php
			
			$pageIcon = get_post_meta($post->ID,'epic_page_icon',true);
			if($pageIcon){$divclass = "icon";} else {$divclass = '';}
			
		?>
		
			<?php if($pageIcon):?><div class="page-icon"><img src="<?php echo $pageIcon ?>" /></div><?php endif;?>		
   			<h1><?php the_title();?><span class="subtitle"><?php echo $subtitle;?></span></h1>
   			
   			
   			

   			
   			
   			<?php //if (is_singular('post')){ epic_post_meta(); } ?>
   			<?php //epic_sharing();?>
   			
   			<!-- Breadcrumbs -->
			
   			 <?php echo subMenu($post->ID);?>			
			
		
	</div><!-- /end .module-content -->
</div><!-- /end .module -->