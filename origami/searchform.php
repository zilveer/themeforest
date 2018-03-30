<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
?>

<form method="get" id="searchform" action="<?php bloginfo('url') ?>/">
	<div>
	<p><input type="text" value="<?php the_search_query() ?>" name="s" id="s" /></p>                
        <button id="searchsubmit" class="button small <?php echo $GLOBALS['button_css'];?>" type="submit"><span><span>Search</span></span></button>
	</div>
</form>