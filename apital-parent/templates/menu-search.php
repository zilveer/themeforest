<?php
    $menu_bar = fw_get_db_settings_option('menubar');
?>

<?php if($menu_bar['enable-menubar'] == 'search'):?>
    <div class="w-hidden-medium w-hidden-small w-hidden-tiny search-wrapper" data-ix="show-search">
        <i class="fa fa-search"></i>
        <div class="search-result" data-ix="hide-search">
            <div>
                <form class="w-clearfix" name="email-form" data-name="Email Form" action="<?php echo home_url( '/' ) ?>">
                    <input class="w-input search-field" id="Search-4" type="text" name="s" data-name="Search 4" value="<?php echo get_search_query(); ?>">
                    <button class="w-inline-block search-form" href="#"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
<?php endif;?>