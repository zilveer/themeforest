<?php
    global $ttso;
    $searchbartext = stripslashes( $ttso->st_searchbartext );
?>
<form method="get" class="searchform" action="<?php echo esc_url( trailingslashit( home_url() ) ); ?>">
    <fieldset>
        <input type="text" name="s" class="s" value="<?php echo esc_attr( $searchbartext ); ?>" onfocus="if(this.value=='<?php echo esc_attr( $searchbartext ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo esc_attr( $searchbartext ); ?>';" />
    </fieldset>
</form>