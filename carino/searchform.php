<?php 
/**
* 
* The template for displaying Search Form.
* 
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
?>
 <div class="main-search">
	<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
		<input type="text" class="s" name="s" placeholder="<?php _e('Search...','van') ?>">
		<input type="submit" id="submit" value="<?php _e('search','van') ?>">
	</form>	
</div>