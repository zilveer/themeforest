<!--Search Starts-->
<?php global $s;?>
<form method="get" id="search" action="<?php echo home_url(); ?>/">
  <div class="row collapse searchinput">
    <div class="seven columns mobile-three">
      <input type="text" class="inputbox" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
    </div>
    <div class="five columns mobile-one" style="padding-left:4px; padding-top:0px;">
      <input type="submit" id="searchsubmit" class="search-button" value="<?php _e('Search', 'kslang'); ?>" />
    </div>
  </div>  
</form>
<!--Search Ends-->
