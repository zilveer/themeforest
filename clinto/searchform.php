<!-- Searchform -->
<form method="get" class="navbar-search pull-left" action="<?php echo home_url(); ?>" >
	<input id="s" type="text" name="s" onfocus="if(this.value==''){this.value=''};" 
	onblur="if(this.value==''){this.value=''};" value="" class="search-query input-mini"  placeholder="<?php echo esc_attr( __( 'Search', 'spritz' ) ) ?>">
</form>
<!-- /Searchform -->