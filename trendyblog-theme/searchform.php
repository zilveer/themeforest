<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
	<div class="tb_widget_search">
		<form method="get" action="<?php echo home_url(); ?>" name="searchform" >
			<div>
				<label class="screen-reader-text" for="s"><?php esc_html_e("Search for:",THEME_NAME);?></label>
				<input type="text" placeholder="<?php esc_attr_e( 'search here' , THEME_NAME );?>" class="search" name="s" />
				<input type="submit" id="searchsubmit" value="<?php esc_attr_e("Search",THEME_NAME);?>" />
			</div>
		<!-- END .searchform -->
		</form>
	</div>
