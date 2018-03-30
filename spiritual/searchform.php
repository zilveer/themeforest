<?php 

$swm_search_field_keywords =  __('Search','swmtranslate');
?>

<div id="widget_search_form">
	<form method="get" action="<?php echo home_url(); ?>/" class="" id="searchform">	
		<div>
			<input type="submit" value="&#xf002;" id="searchsubmit" class="button" />			
			<input name="s" id="s" type="text" value="<?php echo $swm_search_field_keywords; ?>" onfocus="if (this.value == '<?php echo $swm_search_field_keywords; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $swm_search_field_keywords; ?>';}">		
		</div>
	</form>
</div>