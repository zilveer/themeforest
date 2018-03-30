<?php 
/**
 * Search form - this is the template for the search form - can be used in the sidebar (with the Search widget)
 */
?>
<div class="search-wrapper">
  <form role="search" method="get" class="searchform" action="<?php echo home_url(); ?>" >
    <input type="text" name="s" class="search-input"  placeholder="<?php echo pex_text('_search_text');?>" />
<input type="submit" value="" class="search-button"/>
  </form>
</div>
