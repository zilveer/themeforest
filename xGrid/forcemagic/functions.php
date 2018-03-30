<?php
/**
 *  theme_colors
 */
function pattrens_bg($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    $class_name = (isset($input['class'])) ? $input['class'] : "";
    echo "\n".'<div id="'.$input['id'].'" class="bd_option_item '. $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>

    <ul class="box_layout_list bd_box_layout">

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat">NO</span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat'){ echo 'checked="checked"'; } ?> type="radio" value="none" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat1'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-1"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat1'){ echo 'checked="checked"'; } ?> type="radio" value="pat1" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat2'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-2"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat2'){ echo 'checked="checked"'; } ?> type="radio" value="pat2" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat3'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-3"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat3'){ echo 'checked="checked"'; } ?> type="radio" value="pat3" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat4'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-4"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat4'){ echo 'checked="checked"'; } ?> type="radio" value="pat4" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat5'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-5"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat5'){ echo 'checked="checked"'; } ?> type="radio" value="pat5" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat6'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-6"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat6'){ echo 'checked="checked"'; } ?> type="radio" value="pat6" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat7'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-7"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat7'){ echo 'checked="checked"'; } ?> type="radio" value="pat7" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat8'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-8"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat8'){ echo 'checked="checked"'; } ?> type="radio" value="pat8" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat9'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-9"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat9'){ echo 'checked="checked"'; } ?> type="radio" value="pat9" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat10'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-10"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat10'){ echo 'checked="checked"'; } ?> type="radio" value="pat10" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat11'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-11"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat11'){ echo 'checked="checked"'; } ?> type="radio" value="pat11" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat12'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-12"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat12'){ echo 'checked="checked"'; } ?> type="radio" value="pat12" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat13'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-13"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat13'){ echo 'checked="checked"'; } ?> type="radio" value="pat13" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat14'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-14"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat14'){ echo 'checked="checked"'; } ?> type="radio" value="pat14" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat15'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-15"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat15'){ echo 'checked="checked"'; } ?> type="radio" value="pat15" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat16'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-16"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat16'){ echo 'checked="checked"'; } ?> type="radio" value="pat16" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat17'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-17"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat17'){ echo 'checked="checked"'; } ?> type="radio" value="pat17" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat18'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-18"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat18'){ echo 'checked="checked"'; } ?> type="radio" value="pat18" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat19'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-19"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat19'){ echo 'checked="checked"'; } ?> type="radio" value="pat19" />
        </li>

        <li <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat20'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans pat-20"></span>
            <input name="pattrens_bg" <?php if($bd_option['bd_setting']['pattrens_bg'] == 'pat20'){ echo 'checked="checked"'; } ?> type="radio" value="pat20" />
        </li>

    </ul>
    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  theme_colors
 */
function theme_colors($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>

    <ul class="box_layout_list bd_box_layout">

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'colord'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-d ttip" title="Default Light"> D </span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'colord'){ echo 'checked="checked"'; } ?> type="radio" value="none" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color11'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-11 ttip" title="Dark"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color11'){ echo 'checked="checked"'; } ?> type="radio" value="color11" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color2'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-2"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color2'){ echo 'checked="checked"'; } ?> type="radio" value="color2" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color3'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-3"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color3'){ echo 'checked="checked"'; } ?> type="radio" value="color3" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color4'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-4"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color4'){ echo 'checked="checked"'; } ?> type="radio" value="color4" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color5'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-5"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color5'){ echo 'checked="checked"'; } ?> type="radio" value="color5" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color6'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-6"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color6'){ echo 'checked="checked"'; } ?> type="radio" value="color6" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color7'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-7"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color7'){ echo 'checked="checked"'; } ?> type="radio" value="color7" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color8'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-8"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color8'){ echo 'checked="checked"'; } ?> type="radio" value="color8" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color9'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-9"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color9'){ echo 'checked="checked"'; } ?> type="radio" value="color9" />
        </li>

        <li <?php if($bd_option['bd_setting']['theme_colors'] == 'color10'){ echo 'class="selectd"'; } ?>>
            <span class="theme_colors_spans color-10"></span>
            <input name="theme_colors" <?php if($bd_option['bd_setting']['theme_colors'] == 'color10'){ echo 'checked="checked"'; } ?> type="radio" value="color10" />
        </li>

    </ul>
    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Footer Layout
 */
function footer_layout($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>
    <ul class="box_layout_list bd_box_layout">

        <li <?php if($bd_option['bd_setting']['footer_layout'] == 'col1'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="col1">
                <img alt="" src="<?php echo BD_ADMIN_IMG; ?>/footer-col1.png" /></a>
            <input name="footer_layout" <?php if($bd_option['bd_setting']['footer_layout'] == 'col1'){ echo 'checked="checked"'; } ?> type="radio" value="col1" />
        </li>

        <li <?php if($bd_option['bd_setting']['footer_layout'] == 'col2'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="col2">
                <img alt="" src="<?php echo BD_ADMIN_IMG; ?>/footer-col2.png" /></a>
            <input name="footer_layout" <?php if($bd_option['bd_setting']['footer_layout'] == 'col2'){ echo 'checked="checked"'; } ?> type="radio" value="col2" />
        </li>

        <li <?php if($bd_option['bd_setting']['footer_layout'] == 'col3'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="col3">
                <img alt="" src="<?php echo BD_ADMIN_IMG; ?>/footer-col3.png" /></a>
            <input name="footer_layout" <?php if($bd_option['bd_setting']['footer_layout'] == 'col3'){ echo 'checked="checked"'; } ?> type="radio" value="col3" />
        </li>

        <li <?php if($bd_option['bd_setting']['footer_layout'] == 'col4'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="col4">
                <img alt="" src="<?php echo BD_ADMIN_IMG; ?>/footer-col4.png" /></a>
            <input name="footer_layout" <?php if($bd_option['bd_setting']['footer_layout'] == 'col4'){ echo 'checked="checked"'; } ?> type="radio" value="col4" />
        </li>
    </ul>
    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Header style
 */
function header_style($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    ?>
    <ul class="box_layout_list bd_box_layout ttip">
        <li <?php if($bd_option['bd_setting']['header_style'] == 'v1'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Header Layout">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/header-5.png" /></a>
            <input name="header_style" <?php if($bd_option['bd_setting']['header_style'] == 'v1'){ echo 'checked="checked"'; } ?> type="radio" value="v1" />
        </li>

        <li <?php if($bd_option['bd_setting']['header_style'] == 'v6'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Header Layout">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/header-6.png" /></a>
            <input name="header_style" <?php if($bd_option['bd_setting']['header_style'] == 'v6'){ echo 'checked="checked"'; } ?> type="radio" value="v6" />
        </li>

        <li <?php if($bd_option['bd_setting']['header_style'] == 'v2'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Header Layout">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/header-2.png" /></a>
            <input name="header_style" <?php if($bd_option['bd_setting']['header_style'] == 'v2'){ echo 'checked="checked"'; } ?> type="radio" value="v2" />
        </li>

        <li <?php if($bd_option['bd_setting']['header_style'] == 'v3'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Header Layout">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/header-3.png" /></a>
            <input name="header_style" <?php if($bd_option['bd_setting']['header_style'] == 'v3'){ echo 'checked="checked"'; } ?> type="radio" value="v3" />
        </li>

        <li <?php if($bd_option['bd_setting']['header_style'] == 'v4'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Header Layout">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/header-4.png" /></a>
            <input name="header_style" <?php if($bd_option['bd_setting']['header_style'] == 'v4'){ echo 'checked="checked"'; } ?> type="radio" value="v4" />
        </li>

        <li <?php if($bd_option['bd_setting']['header_style'] == 'v5'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Header Layout">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/header-1.png" /></a>
            <input name="header_style" <?php if($bd_option['bd_setting']['header_style'] == 'v5'){ echo 'checked="checked"'; } ?> type="radio" value="v5" />
        </li>
    </ul>
    <br class="clear" />
    <?php
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  sidebarpo_type
 */
function sidebarpo_type($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>
    <ul class="box_layout_list bd_box_layout">

        <li <?php if($bd_option['bd_setting']['site_sidebar_position_type'] == 'site_sidebar_position_left'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Site Sidebar Position Left">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/sidebar-left.png" /></a>
            <input name="site_sidebar_position_type" <?php if($bd_option['bd_setting']['site_sidebar_position_type'] == 'site_sidebar_position_left'){ echo 'checked="checked"'; } ?> type="radio" value="site_sidebar_position_left" />
        </li>

        <li <?php if($bd_option['bd_setting']['site_sidebar_position_type'] == 'site_sidebar_position_right'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Site Sidebar Position Right">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/sidebar-right.png" /></a>
            <input name="site_sidebar_position_type" <?php if($bd_option['bd_setting']['site_sidebar_position_type'] == 'site_sidebar_position_right'){ echo 'checked="checked"'; } ?> type="radio" value="site_sidebar_position_right" />
        </li>


        <li <?php if($bd_option['bd_setting']['site_sidebar_position_type'] == 'site_sidebar_position_no'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Layout Full Width ( No sidebar )">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/sidebar-no.png" /></a>
            <input name="site_sidebar_position_type" <?php if($bd_option['bd_setting']['site_sidebar_position_type'] == 'site_sidebar_position_no'){ echo 'checked="checked"'; } ?> type="radio" value="site_sidebar_position_no" />
        </li>

    </ul>
    <?php
    echo '</div>'."\n";
}

/**
 *  layout_type
 */
function layout_type($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>
    <ul class="box_layout_list bd_box_layout">
        <li <?php if($bd_option['bd_setting']['layout_type'] == 'layout_boxed'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Boxed">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/fixed.png" /></a>
            <input name="layout_type" <?php if($bd_option['bd_setting']['layout_type'] == 'layout_boxed'){ echo 'checked="checked"'; } ?> type="radio" value="layout_boxed" />
        </li>
        <li <?php if($bd_option['bd_setting']['layout_type'] == 'layout_full'){ echo 'class="selectd"'; } ?>>
            <a href="#" title="Full Width">
                <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>//full.png" /></a>
            <input name="layout_type" <?php if($bd_option['bd_setting']['layout_type'] == 'layout_full'){ echo 'checked="checked"'; } ?> type="radio" value="layout_full" />
        </li>
    </ul>
    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  bg up
 */
function bgop($input,$head = true)
{
    $current_value = bdayh_get_option($input['id']);
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    $class_name = (isset($input['class'])) ? $input['class'] : "";
    echo "\n".'<div id="'. $input['id'] .'_conent" class="bd_option_item '. $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>
    <div class="clear"></div>
    <div class="color-area">
        <div id="<?php echo $input['id']; ?>colorselect" class="colorSelector">
            <div class="color-see" style="background-color:<?php echo $current_value['color'] ; ?>;"></div>
        </div>
        <input id="<?php echo $input['id']; ?>_color" class="input_numb color_input " type="text" name="<?php echo $input['id']; ?>[color]" value="<?php echo $current_value['color'] ; ?>" />
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function()
        {
            jQuery('#<?php echo $input['id']; ?>colorselect').ColorPicker
            ({
                color: '#FFFFFF',
                onShow: function (colpkr)
                {
                    jQuery(colpkr).stop().fadeIn();
                    return false;
                },
                onHide: function (colpkr)
                {
                    jQuery(colpkr).hide();
                    return false;
                },
                onChange: function (hsb, hex, rgb)
                {
                    jQuery('#<?php echo $input['id']; ?>colorselect .color-see').css('backgroundColor', '#' + hex);
                    jQuery('#<?php echo $input['id']; ?>'+'_color').val('#' + hex);
                }
            });
        });
    </script>
    <select class="tybo-style" name="<?php echo $input['id']; ?>[repeat]" id="<?php echo $input['id']; ?>[repeat]">
        <option value="" <?php if ( !$current_value['repeat'] ) { echo ' selected="selected"' ; } ?>></option>
        <option value="repeat" <?php if ( $current_value['repeat']  == 'repeat' ) { echo ' selected="selected"' ; } ?>>repeat</option>
        <option value="no-repeat" <?php if ( $current_value['repeat']  == 'no-repeat') { echo ' selected="selected"' ; } ?>>no-repeat</option>
        <option value="repeat-x" <?php if ( $current_value['repeat'] == 'repeat-x') { echo ' selected="selected"' ; } ?>>repeat-x</option>
        <option value="repeat-y" <?php if ( $current_value['repeat'] == 'repeat-y') { echo ' selected="selected"' ; } ?>>repeat-y</option>
    </select>
    <select class="tybo-style" name="<?php echo $input['id']; ?>[attachment]" id="<?php echo $input['id']; ?>[attachment]">
        <option value="" <?php if ( !$current_value['attachment'] ) { echo ' selected="selected"' ; } ?>></option>
        <option value="fixed" <?php if ( $current_value['attachment']  == 'fixed' ) { echo ' selected="selected"' ; } ?>>Fixed</option>
        <option value="scroll" <?php if ( $current_value['attachment']  == 'scroll') { echo ' selected="selected"' ; } ?>>scroll</option>
    </select>
    <select class="tybo-style" name="<?php echo $input['id']; ?>[hor]" id="<?php echo $input['id']; ?>[hor]">
        <option value="" <?php if ( !$current_value['hor'] ) { echo ' selected="selected"' ; } ?>></option>
        <option value="left" <?php if ( $current_value['hor']  == 'left' ) { echo ' selected="selected"' ; } ?>>Left</option>
        <option value="right" <?php if ( $current_value['hor']  == 'right') { echo ' selected="selected"' ; } ?>>Right</option>
        <option value="center" <?php if ( $current_value['hor'] == 'center') { echo ' selected="selected"' ; } ?>>Center</option>
    </select>
    <select class="tybo-style" name="<?php echo $input['id']; ?>[ver]" id="<?php echo $input['id']; ?>[ver]" >
        <option value="" <?php if ( !$current_value['ver'] ) { echo ' selected="selected"' ; } ?>></option>
        <option value="top" <?php if ( $current_value['ver']  == 'top' ) { echo ' selected="selected"' ; } ?>>Top</option>
        <option value="center" <?php if ( $current_value['ver'] == 'center') { echo ' selected="selected"' ; } ?>>Center</option>
        <option value="bottom" <?php if ( $current_value['ver']  == 'bottom') { echo ' selected="selected"' ; } ?>>Bottom</option>
    </select>
    <div class="clear"></div>
    <input id="<?php echo $input['id']; ?>" class="<?php $class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name; ?> img-path upload-url bd-upload-url" type="text" name="<?php echo $input['id']; ?>[img]" value="<?php echo $current_value['img']; ?>">
    <input id="upload_<?php echo $input['id']; ?>_button" type="button" class="btn st_upload_button" value="Upload">
    <div class="upload_img" id="<?php echo $input['id']; ?>_img" <?php if( !$current_value['img']  ) echo 'style="display:none;"' ?> >
        <img src="<?php if( $current_value['img'] ) echo $current_value['img']; else echo get_template_directory_uri().'/forcemagic/images/spacer.png'; ?>" alt="" />
        <a href="#" class="btn remove_img" id="<?php echo $input['id']; ?>_remove"><?php _e('Remove','bd') ?></a>
    </div>
    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  tybo
 */
function tybo($input,$head = true)
{
    global $options_fonts;
    $bd_option = unserialize(get_option('bdayh_setting'));
    $current_value = bdayh_get_option($input['id']);
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div id="'. $input['id'].'" class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>

    <div class="tybo-field">
        <label>Font Color</label>
        <div class="color-area">
            <div id="<?php echo $input['id']; ?>colorselect" class="colorSelector">
                <div class="color-see" style="background-color:<?php echo $current_value['color'] ; ?>;"></div>
            </div>
            <input id="<?php echo $input['id']; ?>_color" class="input_numb color_input " type="text" name="<?php echo $input['id']; ?>[color]" value="<?php echo $current_value['color'] ; ?>" />
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function()
            {
                jQuery('#<?php echo $input['id']; ?>colorselect').ColorPicker
                ({
                    color: '#FFFFFF',
                    onShow: function (colpkr)
                    {
                        jQuery(colpkr).stop().fadeIn();
                        return false;
                    },
                    onHide: function (colpkr)
                    {
                        jQuery(colpkr).hide();
                        return false;
                    },
                    onChange: function (hsb, hex, rgb)
                    {
                        jQuery('#<?php echo $input['id']; ?>colorselect .color-see').css('backgroundColor', '#' + hex);
                        jQuery('.gfont_preview').css('color', '#' + hex);
                        jQuery('#<?php echo $input['id']; ?>'+'_color').val('#' + hex);
                    }
                });
            });
        </script>
    </div><!-- tybo-field -->

    <div class="tybo-field">
        <label>Font Size</label>
        <select class="tybo-size" name="<?php echo $input['id']; ?>[size]" id="<?php echo $input['id']; ?>[size]">
            <option value="" <?php if (!$current_value['size'] ) { echo ' selected="selected"' ; } ?>></option>
            <?php for( $i=1 ; $i<101 ; $i++){ ?>
                <option value="<?php echo $i ?>" <?php if (( $current_value['size']  == $i ) ) { echo ' selected="selected"' ; } ?>><?php echo $i ?></option>
            <?php } ?>
        </select>
    </div><!-- tybo-field -->

    <div class="tybo-field">
        <label>Lineheight</label>
        <select class="tybo-size" name="<?php echo $input['id']; ?>[lineheight]" id="<?php echo $input['id']; ?>[lineheight]">
            <option value="" <?php if (!$current_value['lineheight'] ) { echo ' selected="selected"' ; } ?>></option>
            <?php for( $i=1 ; $i<101 ; $i++){ ?>
                <option value="<?php echo $i ?>" <?php if (( $current_value['lineheight']  == $i ) ) { echo ' selected="selected"' ; } ?>><?php echo $i ?></option>
            <?php } ?>
        </select>
    </div><!-- tybo-field -->

    <div class="tybo-field">
        <label>Font weight</label>
        <select class="tybo-weight" name="<?php echo $input['id']; ?>[weight]" id="<?php echo $input['id']; ?>[weight]">
            <option value="" <?php if ( !$current_value['weight'] ) { echo ' selected="selected"' ; } ?>></option>
            <option value="normal" <?php if ( $current_value['weight']  == 'normal' ) { echo ' selected="selected"' ; } ?>>Normal</option>
            <option value="bold" <?php if ( $current_value['weight']  == 'bold') { echo ' selected="selected"' ; } ?>>Bold</option>
            <option value="lighter" <?php if ( $current_value['weight'] == 'lighter') { echo ' selected="selected"' ; } ?>>Lighter</option>
            <option value="bolder" <?php if ( $current_value['weight'] == 'bolder') { echo ' selected="selected"' ; } ?>>Bolder</option>
            <option value="100" <?php if ( $current_value['weight'] == '100') { echo ' selected="selected"' ; } ?>>100</option>
            <option value="200" <?php if ( $current_value['weight'] == '200') { echo ' selected="selected"' ; } ?>>200</option>
            <option value="300" <?php if ( $current_value['weight'] == '300') { echo ' selected="selected"' ; } ?>>300</option>
            <option value="400" <?php if ( $current_value['weight'] == '400') { echo ' selected="selected"' ; } ?>>400</option>
            <option value="500" <?php if ( $current_value['weight'] == '500') { echo ' selected="selected"' ; } ?>>500</option>
            <option value="600" <?php if ( $current_value['weight'] == '600') { echo ' selected="selected"' ; } ?>>600</option>
            <option value="700" <?php if ( $current_value['weight'] == '700') { echo ' selected="selected"' ; } ?>>700</option>
            <option value="800" <?php if ( $current_value['weight'] == '800') { echo ' selected="selected"' ; } ?>>800</option>
            <option value="900" <?php if ( $current_value['weight'] == '900') { echo ' selected="selected"' ; } ?>>900</option>
        </select>
    </div><!-- tybo-field -->

    <div class="tybo-field">
        <label>Font style</label>
        <select class="tybo-style" name="<?php echo $input['id']; ?>[style]" id="<?php echo $input['id']; ?>[style]" >
            <option value="" <?php if ( !$current_value['style'] ) { echo ' selected="selected"' ; } ?>></option>
            <option value="normal" <?php if ( $current_value['style']  == 'normal' ) { echo ' selected="selected"' ; } ?>>Normal</option>
            <option value="italic" <?php if ( $current_value['style'] == 'italic') { echo ' selected="selected"' ; } ?>>Italic</option>
            <option value="oblique" <?php if ( $current_value['style']  == 'oblique') { echo ' selected="selected"' ; } ?>>oblique</option>
        </select>
    </div><!-- tybo-field -->

    <div class="tybo-field">
        <label>Text Transform</label>
        <select class="tybo-weight" name="<?php echo $input['id']; ?>[texttransform]" id="<?php echo $input['id']; ?>[texttransform]" >
            <option value="" <?php if ( !$current_value['texttransform'] ) { echo ' selected="selected"' ; } ?>></option>
            <option value="none" <?php if ( $current_value['texttransform']  == 'none' ) { echo ' selected="selected"' ; } ?>>None</option>
            <option value="inherit" <?php if ( $current_value['texttransform'] == 'inherit') { echo ' selected="selected"' ; } ?>>Inherit</option>
            <option value="uppercase" <?php if ( $current_value['texttransform']  == 'uppercase') { echo ' selected="selected"' ; } ?>>Uppercase</option>
            <option value="lowercase" <?php if ( $current_value['texttransform']  == 'lowercase' ) { echo ' selected="selected"' ; } ?>>Lowercase</option>
            <option value="capitalize" <?php if ( $current_value['texttransform']  == 'capitalize' ) { echo ' selected="selected"' ; } ?>>Capitalize</option>
            <option value="full-size-kana" <?php if ( $current_value['texttransform']  == 'full-size-kana' ) { echo ' selected="selected"' ; } ?>>Full-size-kana</option>
            <option value="full-width" <?php if ( $current_value['texttransform']  == 'full-width' ) { echo ' selected="selected"' ; } ?>>Full-width</option>
        </select>
    </div><!-- tybo-field -->

    <div class="tybo-field">
        <label>Font Face</label>
        <select class="tybo-font" name="<?php echo $input['id']; ?>[font]" id="<?php echo $input['id']; ?>[font]">
            <?php foreach( $options_fonts as $font => $font_name ){ ?>
                <option value="<?php echo $font ?>" <?php if ( $current_value['font']  == $font ) { echo ' selected="selected"' ; } ?>><?php echo $font_name ?></option>
            <?php } ?>
        </select>
    </div><!-- tybo-field -->

    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Select Lists
 */
function sellist($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div id="'. $input['id'].'" class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>
    <select name="<?php echo $input['id']; ?>" id="<?php echo $input['id']; ?>">
        <?php foreach ($input['options'] as $key => $option) { ?>
            <option value="<?php echo $key ?>" <?php if ( bdayh_get_option( $input['id'] ) == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
        <?php } ?>
    </select>
    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Color
 */
function color($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div id="'. $input['id'].'" class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }

    ?>
    <div class="color-area">
    <div class="colorSelector">
        <div class="color-see" style="background-color:<?php echo $bd_option['bd_setting'][$input['id']];?>;"></div>
    </div>
    <input id="<?php echo $input['id']; ?>_input" class="input_numb color_input " type="text" name="<?php echo $input['id']; ?>" value="<?php echo $bd_option['bd_setting'][$input['id']]; ?>" />
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function()
        {
            jQuery('#<?php echo $input['id']; ?> .color-area').ColorPicker
            ({
                color: '#FFFFFF',
                onShow: function (colpkr)
                {
                    jQuery(colpkr).stop().fadeIn();
                    return false;
                },
                onHide: function (colpkr)
                {
                    jQuery(colpkr).hide();
                    return false;
                },
                onChange: function (hsb, hex, rgb)
                {
                    jQuery('#<?php echo $input['id']; ?> .color-see').css('backgroundColor', '#' + hex);
                    jQuery('#<?php echo $input['id']; ?>'+'_input').val('#' + hex);
                }
            });
        });
    </script>
    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Radio Images
 */
function images($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    $current_value = bdayh_get_option($input['id']);
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }

    echo '<input name="'. $input['id'] .']['. $input['key'] .'" id="'. $input['id'] .'['. $input['key'] .']" type="radio" value="'. $currentValue[$input['key']] .'" /> '."\n";
    echo '<img src="'. get_template_directory_uri() .'/forcemagic/images/header-1.png" />';

    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Tags
 */
function tags_input($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    $class_name = (isset($input['class'])) ? $input['class'] : "";
    echo '<input id="'. $input['id'].'" class="'.$class_name .'" type="text" name="'. $input['id'].'" value="'. $bd_option['bd_setting'][$input['id']] .'">';
    $list_tags = get_tags('orderby=count&order=desc&number=50');
    echo '<div class="list_tags"">';
    foreach ($list_tags as $tag)
    {
    ?>
        <span onclick="add_tag('<?php echo $input['id']; ?>','<?php echo $tag->name; ?>');"><?php echo $tag->name ?></span>
    <?php
    }
    echo '</div></div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Radio
 */
function radio_input($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    echo '<div class="check_radio_content">';

    foreach ($input['options'] as $key => $option)
    {
    ?>
        <div class="clear"></div>
        <label class="check_radio">
            <input class="on-of r_<?php echo $input['id'];?> <?php $class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name; ?>" name="<?php echo $input['id']; ?>" id="<?php echo $input['id']; ?>" type="radio" value="<?php echo $key ?>" <?php if($bd_option['bd_setting'][$input['id']] == $key){echo 'checked="checked"';}?>>
            <div class="lab"><?php echo $option; ?></div>
        </label>

    <?php
    }

    if(isset($input['js']))
    {
        echo $input['js'];
    }

    echo '</div> </div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Select
 */
function select($input,$head = true)
{
    global $wp_cats;
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    $class_name = (isset($input['class'])) ? $input['class'] : "";


    if(is_array($input['list']))
    {
        echo '<select  class="'. $class_name .'" name="'. $input['id'] .'" >';
        foreach($input['list'] as $r)
        {
        ?>
            <option value="<?php echo $r;?>" <?php if($bd_option['bd_setting'][$input['id']] == $r){echo 'selected="selected"';}?> ><?php echo $r;?></option>
        <?php
        }
        echo '</select> </div>'."\n";
    }
    elseif($input['list'] == 'cats' and is_array($wp_cats))
    {
        echo '<select  class="'. $class_name .'" name="'. $input['id'] .'" >';
        ?>
            <option value="" <?php if($bd_option['bd_setting'][$input['id']] == ''){echo 'selected="selected"';}?> >Select Category ..</option>
        <?php
        foreach($wp_cats as $c_id => $c_name )
        {
        ?>
            <option value="<?php echo $c_id;?>" <?php if($bd_option['bd_setting'][$input['id']] == $c_id){echo 'selected="selected"';}?> ><?php echo $c_name;?></option>
        <?php
        }
        echo '</select> </div>'."\n";
    }
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Upload
 */
function upload_input($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    ?>
    <input id="<?php echo $input['id']; ?>" class="<?php $class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name; ?> img-path upload-url bd-upload-url" type="text" name="<?php echo $input['id']; ?>" value="<?php echo $bd_option['bd_setting'][$input['id']]; ?>">
    <input id="<?php echo $input['id']; ?>_button" type="button" class="btn st_upload_button" value="Upload">
    <div class="upload_img" id="<?php echo $input['id']; ?>_img" <?php if($bd_option['bd_setting'][$input['id']] == ''){?> style="display:none;"<?php }?>>
        <img src="<?php echo $bd_option['bd_setting'][$input['id']];?>" alt="" />
        <a href="#" class="btn remove_img" id="<?php echo $input['id']; ?>_remove"><?php _e('Remove','bd') ?></a>
    </div>
    <?php
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  UI Slider
 */
function ui_slider($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>'."\n";
    }
    echo '<div class="bd-uislider"><div class="slider_num slide_num_f" id="'. $input['id'] .'" ></div>' ."\n";
    echo '<input id="'. $input['id'].'_input" class="input_num_f" type="text" name="'. $input['id'].'" value="'. (int)$bd_option['bd_setting'][$input['id']].'">' ."\n";
    echo '<span class="unitf">'. $input['unit'].'<span> </div>'."\n";
    echo '</div>'."\n";
    ?>
    <script>
        jQuery(document).ready(function() {
            jQuery("#<?php echo $input['id']; ?>").slider({
                range: "min",
                min: <?php echo $input['min']; ?>,
                max: <?php echo $input['max']; ?>,
                value: <?php if($bd_option['bd_setting'][$input['id']] != '') { echo $bd_option['bd_setting'][$input['id']]; }else{ echo 0;} ?>,
                slide: function(event, ui) {
                    jQuery('#'+jQuery(this).attr('id')+'_input').val(ui.value);

                }
            });
        });
    </script>
    <?php
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  textarea
 */
function textarea($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>' ."\n";
    }
    $class_name = (isset($input['class'])) ? $input['class'] : "";
    if($input['id'] != 'advanced_export')
    {
        $text_code = stripslashes($bd_option['bd_setting'][$input['id']]);
    }
    else
    {
        ##base64_encode
    	//$functionbase_encode = strrev('edocne_46esab');
        $text_code = base64_encode(get_option('bdayh_setting'));
    }

    if($input['id'] == 'advanced_export')
    {
	    echo '<div id="'.$input['id'].'" class="'.$class_name.'"  style="border-radius: 2px;background: #FFF;border: 1px solid #ebecf2;min-width: 220px;width: 90%;padding: 10px;color: #757575;font-family: tahoma;font-size: 12px;box-shadow: none !important;resize: none;overflow-y: scroll;width: 444px;">'.$text_code.'</div>' ."\n";
    }
    else
    {
      echo '<textarea id="'.$input['id'].'" class="'.$class_name.'" name="'.$input['id'].'" rows="7">'.$text_code.'</textarea>' ."\n";
    }

    if($input['id'] != 'advanced_export')
    {

    }
    else
    {
        ?><div class="clear"></div><button type="button" class="go btn" onclick="window.location='admin.php?page=options.php&do=download';">Download</button><?php
    }
    echo '</div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Sub title
 */
function subtitle($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true){}
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h2 class="bd-subtitle">'. $input['name'] .'</h2>' ."\n";
    }
    if($head == true){}
}

/**
 *  Msg Info
 */
function msg_info( $input, $head = true ){
    $bd_option = unserialize( get_option( 'bdayh_setting' ) );
    if( $head == true ){}
    if ( !empty( $input['name'] ) && $input['name'] != ' ' ){
        echo '<p class="msg-info">'. $input['name'] .'</p>' ."\n";
    }
    if( $head == true ){}
}

/**
 *  checkbox
 */
function checkbox_input($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    $class_name = (isset($input['class'])) ? $input['class'] : "";
    echo "\n".'<div id="item-'. $input['id'] .'" class="bd_option_item '. $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>'."\n";
    }
    ?>
        <input class="on-of" type="checkbox" id="<?php echo $input['id']; ?>" <?php if(isset($bd_option['bd_setting'][$input['id']]) and $bd_option['bd_setting'][$input['id']] == 1){echo ' checked="checked"';}?> class="<?php $class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name; ?>" name="<?php echo $input['id']; ?>"  value="1" /></div>
    <?php
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *  Text
 */
function txt($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    $currentValue = bdayh_get_option( $input['id'] );
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>'."\n";
    }
    echo '<input name="'. $input['id'] .']['. $input['key'] .'" id="'. $input['id'] .'['. $input['key'] .']" type="text" value="'. $currentValue[$input['key']] .'" /> </div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}
function text_input($input,$head = true)
{
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
        //echo '<div class="bd_item postbox"><h3 class="hndle">'. $input['name'] .'</h3>' ."\n";
    }
    echo "\n".'<div class="bd_option_item '.$class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'">' ."\n";
    if ( !empty($input['tip']) && $input['tip'] != ' ' )
    {
        echo '<a class="bd_help" title="'. $input['tip'] .'"></a>'."\n";
    }
    if ( !empty($input['name']) && $input['name'] != ' ' )
    {
        echo '<h3>'. $input['name'] .'</h3>'."\n";
    }
    if ( !empty($input['exp']) && $input['exp'] != ' ' )
    {
        echo '<p class="bd-exp">'. $input['exp'] .'</p>'."\n";
    }
    echo '<input id="'.$input['id'].'" class="'. $class_name = (isset($input['class'])) ? $input['class'] : ""; echo $class_name .'" type="text" value="'. stripslashes($bd_option['bd_setting'][$input['id']]) .'" name="'. $input['id'].'" /> </div>'."\n";
    if($head == true)
    {
        //echo '</div>'."\n";
    }
}

/**
 *
 * GET categories
 *
 */
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list )
{
    $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

/**
 * Home Builder
 */

function bd_home_builder($input,$head = true)
{
    global $wp_cats;
    $bd_option = unserialize(get_option('bdayh_setting'));
    if($head == true)
    {
    }
    ?>
    <div class="tab_content meta-box-sortables">
    <div class="bd_item">
        <div class="bd_option_item">
            <div class="check_radio_content">
                <label class="check_radio"><input id="home_type_blog" name="home_type" class="on-of home_type" type="radio" <?php if($bd_option['bd_setting']['home_type'] == 'blog'){ ?>checked="checked" <?php } ?> value="blog" /><div><?php _e(' Blog Layout - Latest Posts Formats','bd') ?></div> </label>
                <label class="check_radio"><input id="home_type_box" name="home_type" class="on-of home_type" <?php if($bd_option['bd_setting']['home_type'] == 'box'){ ?>checked="checked" <?php }?> type="radio" value="box" /><div><?php _e('News, Magazin Boxes','bd') ?></div></label>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="box_type_content" id="box_type_content" <?php if($bd_option['bd_setting']['home_type'] == 'blog'){ ?> style="display:none;" <?php } ?>>
        <ul class="navbuilder">
            <li class="link1"><a href="#" id="add_news"><?php _e('+ News Box','bd') ?></a></li>
            <li class="link5"><a href="#" id="add_videos"><?php _e('+ Videos','bd') ?></a></li>
            <li class="link6"><a href="#" id="add_gallery"><?php _e('+ Gallery','bd') ?></a></li>
            <li class="link2"><a href="#" id="add_recent_box"><?php _e('+ Recent Posts','bd') ?></a></li>
            <li class="link3"><a href="#" id="add_scrolling_box"><?php _e('+ Scrolling Box','bd') ?></a></li>
            <li class="link4"><a href="#" id="add_ads_box"><?php _e('+ Ads','bd') ?></a></li>
        </ul>
        <select id="bd_cats" style="display:none;">
            <?php foreach($wp_cats as $c_id => $c_name ) { ?>
                <option value="<?php echo $c_id; ?>"><?php echo $c_name; ?></option>
            <?php } ?>
        </select>
        <div class="bdayh_list_boxes" id="bdayh_list_boxes">
            <?php
            if(isset($bd_option['bd_setting']['home']) and count($bd_option['bd_setting']['home']) > 0)
            {
                foreach($bd_option['bd_setting']['home'] as $k => $v)
                {
                    switch($v['type'])
                    {
                        case"news_box":
                            home_news_box($k,$v);
                        break;

                        case"scrolling_box":
                            home_scrolling_box($k,$v);
                        break;

                        case"ads_box":
                            home_ads_box($k,$v);
                        break;

                        case"recent_box":
                            home_recent_box($k,$v);
                        break;

                        case"videos_box":
                            home_videos_box($k,$v);
                        break;

                        case"gallery_box":
                            home_gallery_box($k,$v);
                        break;
                    }
                }
            }
            ?>
        </div>
    </div>

    <?php
    /**
     * Gallery Box
     */
    ?>
    <script id="bd_add_gallery" type="text/x-tmpl">
        <div>
            <div class="builder_inner" id="home_box_{{= data}}">
                <input type="hidden" name="home[{{= data}}][type]" value="gallery_box" />

                <div class="boxes_title">
                    <a class="handle " original-title="Move Box"><?php _e('MoveBox','bd') ?></a>
                    <?php _e('Photo Albums','bd') ?>
                    <a class="del" id="remove_{{= data}}" title="<?php _e('Remove Box','bd') ?>"><?php _e('Remove Box','bd') ?></a>
                    <span class="settings"><?php _e('Settings','bd') ?></span>
                </div>

                <div class="builder_content">
                    <div class="bd_item_content" style="display:none;">

                        <div class="bd_option_item">
                            <h3><?php _e('Category','bd') ?> </h3>
                            <select multiple="multiple" style="height: auto;" name="home[{{= data}}][cat][]" id="bd_setting_home_{{= data}}_cat">
                                {{= cats}}
                            </select>
                        </div>

                        <div class="bd_option_item">
                            <h3><?php _e('Title','bd') ?> </h3>
                            <input type="text" name="home[{{= data}}][title]" value="Photo Albums">
                        </div>

                        <div class="bd_option_item">
                            <h3><?php _e('Number of posts','bd') ?> </h3>
                            <input class="input_numb" name="home[{{= data}}][number]" type="text" value="12">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </script>

    <?php
    /**
     * Videos Box
     */
    ?>
    <script id="bd_add_videos" type="text/x-tmpl">
        <div>
            <div class="builder_inner" id="home_box_{{= data}}">
                <input type="hidden" name="home[{{= data}}][type]" value="videos_box" />

                <div class="boxes_title">
                    <a class="handle " original-title="Move Box"><?php _e('MoveBox','bd') ?></a>
                    <?php _e('Latest videos','bd') ?>
                    <a class="del" id="remove_{{= data}}" title="<?php _e('Remove Box','bd') ?>"><?php _e('Remove Box','bd') ?></a>
                    <span class="settings"><?php _e('Settings','bd') ?></span>
                </div>

                <div class="builder_content">
                    <div class="bd_item_content" style="display:none;">

                        <div class="bd_option_item">
                            <h3><?php _e('Category','bd') ?> </h3>
                            <select name="home[{{= data}}][cat]" id="bd_setting_home_{{= data}}_cat">
                                {{= cats}}
                            </select>
                        </div>

                        <div class="bd_option_item">
                            <h3><?php _e('Title','bd') ?> </h3>
                            <input type="text" name="home[{{= data}}][title]" value="Latest Videos">
                        </div>

                        <div class="bd_option_item">
                            <h3><?php _e('Number of posts','bd') ?> </h3>
                            <input class="input_numb" name="home[{{= data}}][number]" type="text" value="2">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </script>


    <?php
    /**
     * News Box
     */
    ?>
    <script id="bd_news_box" type="text/x-tmpl">
        <div>
            <div class="builder_inner" id="home_box_{{= data}}">
                <input type="hidden" name="home[{{= data}}][type]" value="news_box" />
                <div class="boxes_title">
                    <a class="handle " original-title="Move Box"><?php _e('MoveBox','bd') ?></a>
                    <a class="del" id="remove_{{= data}}" original-title="Remove Box"><?php _e('Remove Box','bd') ?></a>
                    <span class="settings"> <?php _e('Settings','bd') ?></span>
                    </div>
                <div class="builder_content">
                    <div class="bd_item_content" style="display:none;">
                        <div class="bd_option_item">
                            <h3><?php _e('Category','bd') ?> </h3>
                            <select name="home[{{= data}}][cat]" id="bd_setting_home_{{= data}}_cat">
                                {{= cats}}
                            </select>
                        </div>
                        <div class="bd_option_item">
                            <h3><?php _e('Number of posts','bd') ?> </h3>
                            <input class="input_numb" name="home[{{= data}}][number]" type="text" value="4">


                        </div>
                        <div class="bd_option_item">
                            <h3><?php _e('Box Layout','bd') ?> </h3>
                            <ul class="box_layout_list bd_box_layout">
                                <li class="selectd">
                                    <a href="#" original-title="First Post Left">
                                        <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>//on_col.png"></a>
                                    <input name="home[{{= data}}][layout]" type="radio" checked="checked" value="1"  />
                                </li>

                                <li>
                                    <a href="#" original-title="First Post Full Width">
                                        <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>//tow_col.png"></a>
                                    <input name="home[{{= data}}][layout]" type="radio" value="2"  />
                                </li>

                                <li>
                                    <a href="#" original-title="Two Box Small">
                                        <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>//three_col.png"></a>
                                    <input name="home[{{= data}}][layout]" type="radio" value="3"  />
                                </li>

                                <li>
                                    <a href="#" original-title="News in picrure">
                                        <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>//news_in_picrure.png"></a>
                                    <input name="home[{{= data}}][layout]" type="radio" value="4"  />
                                </li>

                                <li>
                                    <a href="#" original-title="News in picrure small">
                                        <img alt=" " src="<?php echo BD_ADMIN_IMG; ?>/news_in_picrure_small.png"></a>
                                    <input name="home[{{= data}}][layout]" type="radio" value="5"  />
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </script>

    <?php
    /**
     * Scrolling Box
     */
    ?>
    <script id="bd_scrolling_box" type="text/x-tmpl">
        <div>
            <div class="builder_inner" id="home_box_{{= data}}">
                <input type="hidden" name="home[{{= data}}][type]" value="scrolling_box" />
                <div class="boxes_title">
                    <a class="handle" original-title="Move Box"><?php _e('MoveBox','bd') ?></a>
                    <?php _e('Scrolling Box','bd') ?>
                    <a class="del" id="remove_{{= data}}" original-title="Remove Box"><?php _e('Remove Box','bd') ?></a>
                    <span class="settings"><?php _e ('Settings','bd') ?></span>
                </div>
                <div class="builder_content">
                    <div class="bd_item_content" style="display:none;">
                        <div class="bd_option_item">
                            <h3><?php _e('Category','bd') ?> </h3>
                            <select multiple="multiple" style="height: auto;" name="home[{{= data}}][cat][]" id="bd_setting_home_{{= data}}_cat">
                                {{= cats}}
                            </select>
                        </div>

                        <div class="bd_option_item">
                            <h3><?php _e('Title','bd') ?> </h3>
                            <input type="text" name="home[{{= data}}][title]" value="Scrolling Box">
                        </div>

                        <div class="bd_option_item">
                            <h3><?php _e('Number of posts','bd') ?> </h3>
                            <input class="input_numb" name="home[{{= data}}][number]" type="text" value="6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <?php
    /**
     * Recent Box
     */
    ?>
    <script id="bd_recent_box" type="text/x-tmpl">
        <div>
            <div class="builder_inner" id="home_box_{{= data}}">
                <input type="hidden" name="home[{{= data}}][type]" value="recent_box" />
                <div class="boxes_title">
                    <a class="handle " original-title="Move Box"><?php _e('MoveBox','bd') ?></a>
                    <?php _e('Recent Posts','bd') ?>
                    <a class="del" id="remove_{{= data}}" title="<?php _e('Remove Box','bd') ?>"><?php _e('Remove Box','bd') ?></a>
                    <span class="settings"><?php _e('Settings','bd') ?></span>
                </div>
                <div class="builder_content">
                    <div class="bd_item_content" style="display:none;">
                        <div class="bd_option_item">
                            <h3><?php _e('Category','bd') ?> </h3>
                            <select multiple="multiple" style="height: auto;" name="home[{{= data}}][cat][]" id="bd_setting_home_{{= data}}_cat">
                                {{= cats}}
                            </select>
                        </div>
                        <div class="bd_option_item">
                            <h3><?php _e('Title','bd') ?> </h3>
                            <input type="text" name="home[{{= data}}][title]" value="Recent Posts">
                        </div>
                        <div class="bd_option_item">
                            <h3><?php _e('Number of posts','bd') ?> </h3>
                            <input class="input_numb" name="home[{{= data}}][number]" type="text" value="6">
                        </div>
                        <div class="bd_option_item">
                            <h3>Layout Display </h3>
                            <select id="bd_setting_home_{{= data}}_display" name="home[{{= data}}][display]">
                                <option value="recent_box_default">Default Style</option>
                                <option value="recent_box_list">List Style</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <?php
    /**
     * Ads Box
     */
    ?>
    <script id="bd_ads_box" type="text/x-tmpl">
        <div>
            <div class="builder_inner" id="home_box_{{= data}}">
                <input type="hidden" name="home[{{= data}}][type]" value="ads_box" />
                <div class="boxes_title">
                    <a class="handle " original-title="Move Box"><?php _e('MoveBox','bd') ?></a>
                    <?php _e ('Ads','bd') ?>
                    <a class="del" id="remove_{{= data}}" title="<?php _e('Remove Box','bd') ?>"><?php _e('Remove Box','bd') ?></a>
                    <span class="settings"><?php _e ('Settings','bd') ?></span>
                </div>
                <div class="builder_content">
                    <div class="bd_item_content" style="display:none;">
                        <div class="bd_option_item">

                            <div class="check_radio_content">
                                <label class="check_radio">
                                    <input name="home[{{= data}}][ad_type]" class="ad_type" checked="checked"  type="radio" value="code">
                                    <?php _e('Ads Code','bd') ?> </label>
                                <label class="check_radio">
                                    <input name="home[{{= data}}][ad_type]" class="ad_type" type="radio" value="img">
                                    <?php _e('Image Upload','bd') ?></label>
                            </div>
                        </div>
                        <div class="bd_option_item ads_code">
                            <h3><?php _e('Ads Code','bd') ?> </h3>
                            <textarea class="textarea_full" name="home[{{= data}}][ad_code]" rows="7"></textarea>
                        </div>
                        <div class="bd_option_item ads_img"  style="display:none;">
                            <h3><?php _e('Image Upload','bd') ?></h3>

                            <input id="bd_setting_home_{{= data}}" class="img-path upload-url" type="text" name="home[{{= data}}][ad_img]" value="">
                            <input id="bd_setting_home_{{= data}}_img_button" type="button" class="btn st_upload_button" value="Upload">
                            <div class="upload_img" id="bd_setting_home_{{= data}}_img" style="display:none;">
                                <img src="" width="120"  alt="" border="0" />
                                <a href="#" class="remove_img btn" id="bd_setting_home_{{= data}}_remove"><?php _e('Remove','bd') ?></a>
                            </div>
                        <div class="bd_option_item">
                            <h3><?php _e('Ads Link','bd') ?> </h3>
                            <input type="text" name="home[{{= data}}][ad_link]" value="#">
                        </div>
                        <div class="bd_option_item">
                            <h3><?php _e('Alternate Name','bd') ?> </h3>
                            <input type="text" name="home[{{= data}}][ad_alt]" value="">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>
    </div>
    <?php
    if($head == true)
    {

    }
}

/**
 * Home Functions
 */
function home_news_box($k,$arr)
{
    global $wp_cats;
    ?>
    <div class="builder_inner" id="home_box_<?php echo $k; ?>">
        <input type="hidden" name="home[<?php echo $k; ?>][type]" value="news_box" />
        <div class="boxes_title">
            <a class="handle " original-title="Move Box">Move Box</a>
            <?php echo $wp_cats[$arr['cat']]; ?>

            <a class="del" id="remove_<?php echo $k; ?>" original-title="Remove Box">Remove Box</a>
            <span class="settings"> Settings</span>
        </div>
        <div class="builder_content">
            <div class="bd_item_content" style="display:none;">
                <div class="bd_option_item">
                    <h3>Category </h3>
                    <select name="home[<?php echo $k; ?>][cat]" id="bd_setting_home_<?php echo $k; ?>_cat">
                        <?php foreach($wp_cats as $c_id => $c_name ){ ?>
                            <option value="<?php echo $c_id;?>" <?php if($arr['cat'] == $c_id){echo "selected='selected'";} ?>><?php echo $c_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="bd_option_item">
                    <h3>Number of posts </h3>

                    <input class="input_numb" name="home[<?php echo $k; ?>][number]" type="text" value="<?php echo $arr['number']; ?>">
                </div>
                <div class="bd_option_item">
                    <h3>Box Layout </h3>
                    <ul class="box_layout_list bd_box_layout">
                        <li <?php if($arr['layout'] == 1){?>class="selectd" <?php }?>>
                            <a href="#" original-title="First Post Left">
                                <img alt=" " src="<?php echo BD_ADMIN ; ?>/images/on_col.png"></a>
                            <input name="home[<?php echo $k; ?>][layout]" type="radio" <?php if($arr['layout'] == 1){?> checked="checked" <?php }?> value="1"  />
                        </li>
                        <li <?php if($arr['layout'] == 2){?>class="selectd" <?php }?>>
                            <a href="#" original-title="First Post Full Width">
                                <img alt=" " src="<?php echo BD_ADMIN ;?>/images/tow_col.png"></a>
                            <input name="home[<?php echo $k; ?>][layout]" type="radio" <?php if($arr['layout'] == 2){?> checked="checked" <?php }?> value="2"  />
                        </li>
                        <li <?php if($arr['layout'] == 3){?>class="selectd" <?php }?>>
                            <a href="#" original-title="Two Box Small">
                                <img alt=" " src="<?php echo BD_ADMIN ; ?>/images/three_col.png"></a>
                            <input name="home[<?php echo $k; ?>][layout]" type="radio" <?php if($arr['layout'] == 3){?> checked="checked" <?php }?>  value="3"  />
                        </li>
                        <li <?php if(intval($arr['layout']) == 4){echo 'class="selectd"';}?> >
                            <a href="#" original-title="News in picrure">
                                <img alt=" " src="<?php echo BD_ADMIN ; ?>/images/news_in_picrure.png"></a>
                            <input name="home[<?php echo $k; ?>][layout]" type="radio" <?php if(intval($arr['layout']) == 4){?> checked="checked" <?php }?> value="4"  />
                        </li>
                        <li <?php if(intval($arr['layout']) == 5){echo 'class="selectd"';}?> >
                            <a href="#" original-title="News in picrure small">
                                <img alt=" " src="<?php echo BD_ADMIN ; ?>/images/news_in_picrure_small.png"></a>
                            <input name="home[<?php echo $k; ?>][layout]" type="radio" <?php if(intval($arr['layout']) == 5){?> checked="checked" <?php }?> value="5"  />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// Home scrolling
function home_scrolling_box($k,$arr)
{
    global $wp_cats;
    ?>
    <div class="builder_inner" id="home_box_<?php echo $k; ?>">
        <input type="hidden" name="home[<?php echo $k; ?>][type]" value="scrolling_box" />
        <div class="boxes_title"><a class="handle " original-title="Move Box">MoveBox</a>
            <?php echo $arr['title']; ?>
            <a class="del" id="remove_<?php echo $k; ?>" original-title="Remove Box">Remove Box</a>
            <span class="settings">Settings</span>
            </div>
        <div class="builder_content">
            <div class="bd_item_content" style="display:none;">
                <div class="bd_option_item">
                    <h3>Category </h3>
                    <select multiple="multiple" style="height: auto;" name="home[<?php echo $k; ?>][cat][]" id="bd_setting_home_<?php echo $k; ?>_cat">
                        <?php foreach($wp_cats as $c_id => $c_name ) { ?>
                            <option value="<?php echo $c_id;?>" <?php if(in_array($c_id,$arr['cat'])){echo "selected='selected'";} ?>><?php echo $c_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="bd_option_item">
                    <h3>Title </h3>
                    <input type="text" name="home[<?php echo $k; ?>][title]" value="<?php echo $arr['title']; ?>">
                </div>
                <div class="bd_option_item">
                    <h3>Number of posts </h3>
                    <input class="input_numb" name="home[<?php echo $k; ?>][number]" type="text" value="<?php echo $arr['number']; ?>">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// Home Ads
function home_ads_box($k,$arr)
{
    ?>
    <div class="builder_inner" id="home_box_<?php echo $k; ?>">
        <input type="hidden" name="home[<?php echo $k; ?>][type]" value="ads_box" />
        <div class="boxes_title"><a class="handle " original-title="Move Box">MoveBox</a>Ads
            <a class="del" id="remove_<?php echo $k; ?>" original-title="Remove Box">Remove Box</a>
            <span class="settings">Settings</span>
        </div>
        <div class="builder_content">
            <div class="bd_item_content" style="display:none;">
                <div class="bd_option_item">
                    <div class="check_radio_content">
                        <label class="check_radio"><input name="home[<?php echo $k; ?>][ad_type]" class="ad_type" <?php if($arr[ad_type] == 'code'){echo 'checked="checked"';}?>  type="radio" value="code">Ads Code </label>
                        <label class="check_radio">
                            <input name="home[<?php echo $k; ?>][ad_type]" class="ad_type" <?php if($arr[ad_type] == 'img'){echo 'checked="checked"';}?>   type="radio" value="img">Image Upload</label>
                    </div>
                </div>
                <div class="bd_option_item ads_code" <?php if($arr[ad_type] == 'img'){echo 'style="display:none;"';}?> >
                    <h3>Ads Code </h3>
                    <textarea class="textarea_full" name="home[<?php echo $k; ?>][ad_code]" rows="7"><?php echo stripcslashes($arr[ad_code]); ?></textarea>
                </div>
                <div class="bd_option_item ads_img" <?php if($arr[ad_type] == 'code'){echo 'style="display:none;"';}?>>
                    <h3>Image Upload</h3>
                    <input id="bd_setting_home_<?php echo $k; ?>" class="img-path upload-url" type="text" name="home[<?php echo $k; ?>][ad_img]" value="<?php echo $arr['ad_img']; ?>">
                    <input id="bd_setting_home_<?php echo $k; ?>_img_button" type="button" class="btn st_upload_button" value="Upload">
                    <div class="upload_img" id="bd_setting_home_<?php echo $k; ?>_img" <?php if( !$arr['ad_img']  ) echo 'style="display:none;"' ?>>
                        <img src="<?php echo $arr['ad_img']; ?>" alt="" border="0" />
                        <a href="#" class="remove_img btn" id="bd_setting_home_<?php echo $k; ?>_remove">Remove</a>
                    </div>
                <div class="bd_option_item">
                    <h3>Ads Link </h3>
                    <input type="text" name="home[<?php echo $k; ?>][ad_link]" value="<?php echo $arr['ad_link']; ?>">
                </div>

                    <div class="bd_option_item">
                    <h3>Alternate Name </h3>
                    <input type="text" name="home[<?php echo $k; ?>][ad_alt]" value="<?php echo $arr['ad_alt']; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// Home recent
function home_recent_box($k,$arr)
{
    $categories = get_categories('hide_empty=0&orderby=name');
    $wp_cats = array();
    foreach ($categories as $category_list )
    {
        $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
    }
    global $wp_cats;
    if(isset($wp_cats))
    {
        ?>
        <div class="builder_inner" id="home_box_<?php echo $k; ?>">
            <input type="hidden" name="home[<?php echo $k; ?>][type]" value="recent_box" />
            <div class="boxes_title"><a class="handle " original-title="Move Box">MoveBox</a><?php echo $arr['title']; ?>
                <a class="del" id="remove_<?php echo $k; ?>" original-title="Remove Box">Remove Box</a>
                <span class="settings">Settings</span>
            </div>
            <div class="builder_content">
                <div class="bd_item_content" style="display:none;">
                    <div class="bd_option_item">
                        <h3>Category </h3>
                        <select multiple="multiple" style="height: auto;" name="home[<?php echo $k; ?>][cat][]" id="bd_setting_home_<?php echo $k; ?>_cat">
                            <?php foreach($wp_cats as $c_id => $c_name ) { ?>
                                <option value="<?php echo $c_id;?>" <?php if(in_array($c_id,$arr['cat'])){echo "selected='selected'";} ?>><?php echo $c_name;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="bd_option_item">
                        <h3>Title </h3>
                        <input type="text" name="home[<?php echo $k; ?>][title]" value="<?php echo $arr['title']; ?>">
                    </div>
                    <div class="bd_option_item">
                        <h3>Number of posts </h3>
                        <input class="input_numb" name="home[<?php echo $k; ?>][number]" type="text" value="<?php echo $arr['number']; ?>">
                    </div>
                    <div class="bd_option_item">
                        <h3>Layout Display </h3>
                        <select id="bd_setting_home_<?php echo $k; ?>_display" name="home[<?php echo $k; ?>][display]">
                            <option value="recent_box_default" <?php if($arr['display'] == 'recent_box_default') { echo ' selected="selected"' ; } ?>>Default Style</option>
                            <option value="recent_box_list" <?php if($arr['display'] == 'recent_box_list') { echo ' selected="selected"' ; } ?>>List Style</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}

// Home videos
function home_videos_box($k,$arr)
{
    $categories = get_categories('hide_empty=0&orderby=name');
    $wp_cats = array();
    foreach ($categories as $category_list )
    {
        $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
    }
    global $wp_cats;
    if(isset($wp_cats))
    {
        ?>
        <div class="builder_inner" id="home_box_<?php echo $k; ?>">
            <input type="hidden" name="home[<?php echo $k; ?>][type]" value="videos_box" />

            <div class="boxes_title"><a class="handle " original-title="Move Box">MoveBox</a><?php echo $arr['title']; ?>
                <a class="del" id="remove_<?php echo $k; ?>" original-title="Remove Box">Remove Box</a>
                <span class="settings">Settings</span>
            </div>

            <div class="builder_content">
                <div class="bd_item_content" style="display:none;">

                    <div class="bd_option_item">
                        <h3>Category </h3>
                        <select name="home[<?php echo $k; ?>][cat]" id="bd_setting_home_<?php echo $k; ?>_cat">
                            <?php foreach($wp_cats as $c_id => $c_name ) { ?>
                                <option value="<?php echo $c_id;?>" <?php if($arr['cat'] == $c_id){echo "selected='selected'";} ?>><?php echo $c_name;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="bd_option_item">
                        <h3>Title </h3>
                        <input type="text" name="home[<?php echo $k; ?>][title]" value="<?php echo $arr['title']; ?>">
                    </div>

                    <div class="bd_option_item">
                        <h3>Number of posts </h3>
                        <input class="input_numb" name="home[<?php echo $k; ?>][number]" type="text" value="<?php echo $arr['number']; ?>">
                    </div>

                </div>
            </div>
        </div>
    <?php
    }
}


// Home gallery
function home_gallery_box($k,$arr)
{
    $categories = get_categories('hide_empty=0&orderby=name');
    $wp_cats = array();
    foreach ($categories as $category_list )
    {
        $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
    }
    global $wp_cats;
    if(isset($wp_cats))
    {
        ?>
        <div class="builder_inner" id="home_box_<?php echo $k; ?>">
            <input type="hidden" name="home[<?php echo $k; ?>][type]" value="gallery_box" />

            <div class="boxes_title"><a class="handle " original-title="Move Box">MoveBox</a><?php echo $arr['title']; ?>
                <a class="del" id="remove_<?php echo $k; ?>" original-title="Remove Box">Remove Box</a>
                <span class="settings">Settings</span>
            </div>

            <div class="builder_content">
                <div class="bd_item_content" style="display:none;">

                    <div class="bd_option_item">
                        <h3>Category </h3>
                        <select multiple="multiple" style="height: auto;" name="home[<?php echo $k; ?>][cat][]" id="bd_setting_home_<?php echo $k; ?>_cat">
                            <?php foreach($wp_cats as $c_id => $c_name ) { ?>
                                <option value="<?php echo $c_id;?>" <?php if(in_array($c_id,$arr['cat'])){echo "selected='selected'";} ?>><?php echo $c_name;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="bd_option_item">
                        <h3>Title </h3>
                        <input type="text" name="home[<?php echo $k; ?>][title]" value="<?php echo $arr['title']; ?>">
                    </div>

                    <div class="bd_option_item">
                        <h3>Number of posts </h3>
                        <input class="input_numb" name="home[<?php echo $k; ?>][number]" type="text" value="<?php echo $arr['number']; ?>">
                    </div>

                </div>
            </div>
        </div>
    <?php
    }
}


/**
 * GET Admin Tab
 */
function get_admin_tab( $input, $head = true ){
    switch( $input['type'] ){
        case"upload":
            upload_input($input,$head);
		break;
        case"text":
            text_input($input,$head);
		break;
        case"color":
            color($input,$head);
        break;
        case"tags":
            tags_input($input,$head);
        break;
        case"textarea":
            textarea($input,$head);
        break;
        case"checkbox":
            checkbox_input($input,$head);
        break;
        case"radio":
            radio_input($input,$head);
        break;
        case"select":
            select($input,$head);
        break;
        case"ui_slider":
            ui_slider($input,$head);
        break;
        case"txt":
            txt($input,$head);
        break;
        case"subtitle":
            subtitle($input,$head);
        break;
		case"msginfo":
            msg_info( $input, $head );
        break;
        case"home_builder":
            bd_home_builder($input,$head);
        break;
        case"images":
            images($input,$head);
        break;
        case"sellist":
            sellist($input,$head);
        break;
        case"bgop":
            bgop($input,$head);
        break;
        case"tybo":
            tybo($input,$head);
        break;
        case"layout_type":
            layout_type($input,$head);
        break;
        case"header_style":
            header_style($input,$head);
        break;
        case"footer_layout":
            footer_layout($input,$head);
        break;
        case"theme_colors":
            theme_colors($input,$head);
        break;
        case"pattrens_bg":
            pattrens_bg($input,$head);
        break;
        case"sidebarpo":
            sidebarpo_type($input,$head);
        break;
    }
}
?>