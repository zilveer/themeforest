<?php
$searchtext = stripslashes( get_option( 'st_searchbartext' ) );
?>

<form method="get" id="searchform" action="<?php echo esc_url( trailingslashit( home_url() ) ); ?>" class="search-form">
    <fieldset>
        <span class="text">
            <input type="submit" class="submit" value="search" id="searchsubmit" />
            <input type="text" name="s" id="s" value="<?php echo esc_attr( $searchtext ); ?>" onfocus="this.value=(this.value=='<?php echo esc_attr( $searchtext ); ?>') ? '' : this.value;" onblur="this.value=(this.value=='') ? '<?php echo esc_attr( $searchtext ); ?>' : this.value;" />
        </span>
    </fieldset>
</form>