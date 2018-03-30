<div style="height:25px;">&nbsp;</div>
<div id="tfuse_header">

    <div id="tfuse_header_theme_info">

        <div id="tfuse_header_icon_bg">
            <a href="http://www.themefuse.com" target="_blank" title="<?php _e("Go to ThemeFuse", 'tfuse'); ?>"><img class="header_icon" src="<?php echo tfuse_get_file_uri('images/thumb.png'); ?>" width="70%" height="70%" /></a>
        </div>

        <div id="tfuse_header_text">
            <h3><?php echo $this->theme->theme_name; ?></h3>
            <a href="http://www.themefuse.com" target="_blank" title="<?php _e("Go to ThemeFuse", 'tfuse'); ?>"><img src="<?php echo TFUSE_ADMIN_IMAGES . '/by_tfuse.png'; ?>" /></a>
            <div class="tfclear"></div>
            <div id="tfuse_header_theme_links">
                <a target="_blank" href="<?php echo $this->theme->manual_url; ?>"><?php _e('Online documentation', 'tfuse'); ?></a>&nbsp;&nbsp;<span>
                    |</span>&nbsp;&nbsp;<a target="_blank" href="<?php echo $this->theme->forum_url; ?>"><?php _e('Support Forums', 'tfuse'); ?></a>
            </div>
        </div>

    </div>

    <div id="tfuse_framework_version">
        <table>
            <tr>
                <td><span><?php _e('Framework', 'tfuse'); ?></span></td>
                <td>&nbsp&nbsp<span><?php echo $this->theme->framework_version; ?></span></td>
            </tr>
            <tr>
                <td><span><?php _e('ThemeMods', 'tfuse'); ?></span></td>
                <td>&nbsp&nbsp<span><?php echo $this->theme->mods_version; ?></span></td>
            </tr>
            <tr>
                <td><span><?php _e('Templates', 'tfuse'); ?></span></td>
                <td>&nbsp&nbsp<span><?php echo $this->theme->theme_version; ?></span></td>
            </tr>
        </table>
    </div>

    <div class="tfclear"></div>
</div>
<div class="tfclear"></div>