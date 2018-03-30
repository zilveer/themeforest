<?php global $houzez_local; ?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input value="" name="s" id="s" type="text" placeholder="<?php echo $houzez_local['blog_search']; ?>">
		<button type="submit"></button>
	</div>
</form>