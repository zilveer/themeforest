	<form method="get" action="<?php echo home_url(); ?>" name="searchform" >
		<div>
			<label class="screen-reader-text" for="s"><?php _e("Search for:",THEME_NAME);?></label>
			<input type="text" placeholder="<?php printf ( __( 'search here' , THEME_NAME ));?>" class="search" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="<?php _e("Search",THEME_NAME);?>" />
		</div>
	<!-- END .searchform -->
	</form>
