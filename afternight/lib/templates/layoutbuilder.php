<div id="element-builder-shadow"></div>
<div id="the-closet" style="display: none;">
    <div class="select-box categories">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_categories();
            ?>
        </div>
    </div>

    <div class="select-box tags">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_tags();
            ?>
        </div>
    </div>

    <div class="select-box eventcategories">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_event_categories();
            ?>
        </div>
    </div>

    <div class="select-box portfolios">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_portfolios();
            ?>
        </div>
    </div>
    
    <div class="select-box pages">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_pages();
            ?>
        </div>
    </div>

    <div class="select-box posts">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_posts();
            ?>
        </div>
    </div>

    <div class="select-box events">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_events();
            ?>
        </div>
    </div>

    <div class="select-box boxes">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_boxes();
            ?>
        </div>
    </div>

    <div class="select-box teams">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_teams();
            ?>
        </div>
    </div>

    <div class="select-box sidebars">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
            $this -> list_sidebars();
            ?>
        </div>
    </div>

    <div class="select-box banners">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_banners();
            ?>
        </div>
    </div>

    <div class="select-box testimonials">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php
                $this -> list_testimonials();
            ?>
        </div>
    </div>

    <ul id="menu-item-prototypes">
        <li class="template-menu-item has-hidden-input">
            <a class="dbl-clickable-text">
                <span class="has-popup wrapper">
                    <span class="text"></span>
                    <div class="popup">
                        <?php echo __( 'Double-click this text to edit the title', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </span>
                <span class="delete has-popup" href="javascript:void(0);">
                    <div class="popup">
                        <?php echo __( 'Delete this template', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </span>
            </a>
            <input class="hidden hidden-input" value="<?php echo __( 'Type the name here', 'cosmotheme' );?>">
        </li>
    </ul>
    <?php
        $template = new LBTemplate(
            array(
                '_header_rows' => array(
            'topmenu' => array(
                'id' => 'topmenu123',
                'row_bottom_margin_removed' => 'yes',
                '_elements' => array(
                    
                    'delimiter_top' => array(
                        'id' => 'topmenu123',
                        'type' => 'top_menu',
                        'element_columns' => 12,
                        'numberposts' => 6
                    )
                )
            ),
            'delimiter_top' => array(
                'id' => 'delimiter_top123',
                'row_bottom_margin_removed' => 'yes',
                    '_elements' => array(
                        
                        'delimiter_top' => array(
                            'id' => 'delimiter_top123',
                            'delimiter_margin' => 'margin_15px',
                            'type' => 'delimiter'
                        )
                    )
                ),
                'logo_big' => array(
                    'id' => 'logo_big',
                    'row_bottom_margin_removed' => 'yes',
                    '_elements' => array(
                        'delimiter_top' => array(
                            'id' => 'delimiter_top123',
                            'type' => 'logo'
                        )
                    )
                ),
                'headermenu' => array(
                    'id' => 'headermenu',
                    '_elements' => array(
                        'menu' => array(
                            'id' => 'menu',
                            'type' => 'menu',
                            'element_columns' => 11,
                            'numberposts' => 6
                        ),
                        'search' => array(
                            'id' => 'search',
                            'type' => 'searchbar',
                            'element_columns' => 1
                        )
                    )
                ),
                'empty' => array( /*this element must be ALWAYS PRESENT at the end, otherwise you'll have unexpected problems*/
                    '_elements' => array(
                        array()
                    )
                )
            ),
                '_rows' => array(
                    array(
                        '_elements' => array(
                            array()
                        ),
                        'is_additional' => true,
                        'id' => 'additional'
                    ),
                    array(
                        '_elements' => array(
                            array()
                        )
                    )
                ),
                '_footer_rows' => array(
                    'delimiter123' => array(
                        'id' => 'delimiter123',
                        'row_bottom_margin_removed' => 'yes',
                        '_elements' => array(
                            'delimiter123' => array(
                                'id' => 'delimiter44',
                                'type' => 'delimiter',
                                'delimiter_margin' => 'margin_15px',
                                'element_columns' => 12
                            )
                        )
                    ),
                    
                    'copyright' => array(
                        'id' => 'copyright',
                        '_elements' => array(
                            'copyright' => array(
                                'id' => 'copyright',
                                'type' => 'copyright',
                                'element_columns' => 6
                            ),
                            'social_footer' => array(
                                'id' => 'social_footer',
                                'type' => 'socialicons',
                                'element_columns' => 6
                            )
                        )
                    ),

                    'empty' => array(  /*this element must be ALWAYS PRESENT at the end, otherwise you'll have unexpected problems*/
                        '_elements' => array(
                            array()
                        )
                    )
                )
            )
        );
        $template -> builder =& $this;
        $template -> render_backend();
    ?>
</div>
<div class="admin-page">
    <?php
    if( BRAND == '' ){
        $brand_logo = get_template_directory_uri().'/images/freetotryme.png';
    }else{
        $brand_logo = get_template_directory_uri().'/images/cosmothemes.png';
    }

    $ct = wp_get_theme();

    ?>
    <div class="mythemes-intro">
        <img src="<?php echo $brand_logo;?>">
        <span class="theme"><?php echo $ct->title.' '.__('Version' , 'cosmotheme').': '.$ct->version;?></span>
    </div>
    <div class="admin-menu">
        <ul>
            <?php
                foreach( $this -> templates as $template ){
                    if( '__template__' != $template -> id ){
                        ?>
                            <li class="template-menu-item has-hidden-input for_template_<?php echo $template -> id;?>" data-id="<?php echo $template -> id;?>" id="<?php echo $template -> id;?>">
                                <a class="dbl-clickable-text" href="admin.php?page=cosmothemes__templates&tab=<?php echo $template -> id;?>">
                                    <span class="has-popup wrapper">
                                        <span class="text"><?php echo $template -> name;?></span>
                                    </span>
                                    <span class="delete has-popup" href="javascript:void(0);" onclick="delete_template('<?php echo $template -> id; ?>')">
                                        <div class="popup">
                                            <div class="maybe-pointer"></div>
                                            <?php echo __( 'Delete this template', 'cosmotheme' );?>
                                        </div>
                                    </span>
                                </a>
                                <input class="hidden hidden-input" value="<?php echo $template -> name;?>" name="<?php echo $template -> get_prefix();?>[name]">
                            </li>
                        <?php
                    }
                }
            ?>
            <li><a class="add-new" href="javascript:void(0);"><?php echo __( 'Add new', 'cosmotheme' );?></a></li>
        </ul>
    </div>
    <div class="admin-content">
        <?php if(isset($_GET['settings-updated']) && $_GET['settings-updated'] = 'true'){ ?>  
            <div id="message" class="updated">
                <p><strong><?php _e('Settings saved.','cosmotheme') ?></strong></p>
            </div>
        <?php } ?>      
        <form action="options.php" method="post" class="template_form">
            <input type="hidden" name="option_page" value="cosmothemes__templates__mainpage">
<!--             <input type="hidden" name="action" value="update">
 -->            <?php //settings_fields( 'cosmothemes__templates' ); ?>
            <div class="layout-builder hidden">
                <?php if(isset($_GET['tab'])){ $tab_id = $_GET['tab'];} else { $tab_id = get_first_template_id(); }?>
                <input type="hidden" name="<?php echo $this -> get_prefix();?>[last_selected]" id="last_selected_template" value="<?php echo $tab_id; ?>">
                <input type="hidden" name="current_template_id" id="current_template_id" value="<?php echo $tab_id; ?>">
                <?php
                    foreach( $this -> templates as $template ){
                        if ($tab_id == $template->id) {
                            $template -> render_backend();
                        }                        
                    }
                ?>
            </div>
            <div class="standard-generic-field submit">
                <div class="field">
                    <!-- <input type="submit" value="Update Settings"> -->
                    <input type="button" value="Update Settings" onclick="save_templates()">
                     <h2 class="saving-mesage hidden">Saving...</h2>
                </div>
                <div class="clear"></div>
            </div>
        </form>
    </div>
</div>

<?php
function get_first_template_id(){
    $k = 'mainpage123';
    $templates= get_option("templates");
     foreach( $templates as $key => $template ){
        if($key != 'last_selected'){
            $k = $key;
            break;
        }
     }
     return $k;
}
?>