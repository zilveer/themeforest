<?php $query_s = get_search_query()?get_search_query():"To seach type and hit enter"; ?>
<form action="<?php echo home_url( '/' ); ?>" method="get">
    <input type="text" name="s" id="se" onfocus="if(this.value == 'To seach type and hit enter') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'To seach type and hit enter'; }" value="<?php echo $query_s;?>"/>
</form>

