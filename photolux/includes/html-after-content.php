</div> <!-- end main content holder (#content/#full-width) -->
<?php
global $pex_page;
if($pex_page->layout!='full'&&$pex_page->layout!='none'&&$pex_page->layout!='grid-full'){
	print_sidebar($pex_page->sidebar);
}

?>
<div class="clear"></div>
</div> <!-- end #content-container -->
