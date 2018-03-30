<?php 
/**
 * Search form - this is the template for the search form - can be used in the sidebar (with the Search widget)
 */
?>
<div id="sidebar_search">
  <form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>" >
    <input type="text" name="s" id="search_input"  />
    <a href="" class="button" id="search_button"><span> <?php echo pex_text('_search_text');?></span></a>
  </form>
  <div class="clear"></div>
</div>
