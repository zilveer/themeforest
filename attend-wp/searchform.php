<!-- Start of search -->
<div class="search">

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    
    <?php $searchresults = get_search_query(); ?>
    <?php if ($searchresults != ('')){ ?>
    <input type="text" value="<?php echo $searchresults; ?>" name="s" id="s" />
    <?php } else { ?>
    
    <input type="text" value="" name="s" id="s" />
    
    <?php } ?>
    <input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'cr3_attend_theme' ); ?>" />
      
</form>

</div>
<!-- End of search -->
        