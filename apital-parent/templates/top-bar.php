<?php $topbar = fw_get_db_settings_option('topbar');?>

<?php if(isset($topbar['enable-topbar']) && $topbar['enable-topbar'] == 'yes'):?>
    <div class="w-hidden-small w-hidden-tiny top-nav"> <!-- start top navigation -->
        <div class="w-container">

            <?php if(function_exists('icl_object_id')):?>
                <?php $languages = icl_get_languages();// fw_print($languages);?>

                <?php if(!empty($languages)):?>
                    <div class="w-clearfix top-left-wrapper top-left-click" data-ix="open-language-drop">
                        <div class="top-ico">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="top-text"><?php _e('Language','fw');?>:&nbsp;&nbsp;
                            <?php $count = 0; foreach($languages as $language): ?>

                                <?php if(isset($_GET['lang']) && $_GET['lang'] == $language['language_code']): ?>
                                    <span class="blue"><?php echo esc_html($language['translated_name']);?></span>
                                <?php elseif(!isset($_GET['lang']) && $count == 0):?>
                                    <span class="blue"><?php echo esc_html($language['translated_name']);?></span>
                                <?php endif; ?>

                                <?php $count++; endforeach; ?>
                        </div>

                        <ul class="w-list-unstyled language-drop" data-ix="move-language-drop">
                            <?php $cnt = 0; foreach($languages as $language): ?>
                                <li>
                                    <?php
                                        if(isset($_GET['lang']) && $_GET['lang'] == $language['language_code']):
                                            $active = 'active';
                                        elseif(!isset($_GET['lang']) && $cnt == 0):
                                            $active = 'active';
                                        else:
                                            $active = '';
                                        endif;
                                    ?>

                                    <a class="language-link <?php echo esc_attr($active); ?>" href="<?php echo esc_url($language['url']);?>">
                                        <?php echo esc_html($language['translated_name']);?>
                                    </a>
                                </li>
                                <?php $cnt++; endforeach; ?>
                        </ul>
                        <div class="arrow-language">
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </div>
                <?php endif;?>
            <?php endif;?>

            <?php if(!empty($topbar['yes']['phone'])):?>
                <div class="w-clearfix top-left-wrapper">
                    <div class="top-ico">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="top-text"><?php _e('Phone','fw');?>:&nbsp;&nbsp;<?php echo esc_attr($topbar['yes']['phone']);?></div>
                </div>
            <?php endif;?>

            <?php if(!empty($topbar['yes']['email'])):?>
                <div class="w-clearfix top-left-wrapper">
                    <div class="top-ico">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="top-text"><?php _e('Mail','fw');?>:&nbsp;&nbsp;
                        <a class="email" href="mailto:<?php echo esc_attr($topbar['yes']['email']);?>"><?php echo esc_attr($topbar['yes']['email']);?></a>
                    </div>
                </div>
            <?php endif;?>

            <div class="top-right-wrapper">
                <?php foreach($topbar['yes']['header-socials'] as $social): ?>
                    <?php if(!empty($social['icon'])):?>
                        <a class="w-inline-block social-ico" target="_blank" href="<?php echo esc_url($social['url']); ?>">
                            <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
<?php endif;?>