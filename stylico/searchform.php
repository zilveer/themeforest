<?php

/**
 * 
 * The search form template
 *
 */

?>

<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" />
    <div>
        <input type="text" class="rounded" id="search-bar" value="Search..." name="s" onblur="if(this.value.length == 0) this.value='Search...';" onclick="if(this.value == 'Search...') this.value='';" />
    </div>
</form>
