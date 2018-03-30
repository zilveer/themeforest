<?php jaw_template_inc_counter('login'); ?>
<?php
$rand = rand(0, 99);
$login = 'active';
$login_c = 'active in';
$register = '';
$register_c = '';
if (isset($_POST['jaw-register'])) {
    $login = '';
    $login_c = '';
    $register = 'active';
    $register_c = 'active in';
}
?>

<div class="row">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size', 'max'); ?>">
        <div id="jaw_login" class="login">
            <?php if (is_user_logged_in()) { ?>              
                <div class="jaw-tabs  <?php echo jaw_template_get_var('style', 'colored'); ?>">
                    <ul class="nav nav-tabs" >
                        <li class="<?php echo $login; ?>"><a data-toggle="tab" href="#tab_login_<?php echo jaw_template_get_counter('login'); ?>">
                                <?php echo __('Logged in', 'jawtemplates'); ?>
                            </a></li>
                        <?php jaw_template_inc_counter('login'); ?>
                        <li class="<?php echo $register; ?>" ><a data-toggle="tab" href="#tab_login_<?php echo jaw_template_get_counter('login'); ?>">
                                <?php echo __('My account', 'jawtemplates'); ?>
                            </a></li>
                    </ul>
                    <?php jaw_template_dec_counter('login'); ?>
                    <div class="tab-content" >
                        <div class="tab-pane fade <?php echo $login_c; ?>" id="tab_login_<?php echo jaw_template_get_counter('login'); ?>">
                            <?php
                            $current_user = wp_get_current_user();
                            $user_id = $current_user->ID;
                            echo get_avatar($user_id, 60);
                            ?>
                            <h4 class="user-name"><?php echo $current_user->display_name ?></h4>
                            <span class="logout-link"><a href="<?php echo wp_logout_url(); ?>">Log out</a></span>
                        </div>
                        <?php jaw_template_inc_counter('login'); ?>
                        <div class="tab-pane fade <?php echo $register_c; ?>" id="tab_login_<?php echo jaw_template_get_counter('login'); ?>">
                            <?php
                            if (has_nav_menu('my_account')) {

                                wp_nav_menu(array(
                                    'theme_location' => 'my_account',
                                    'menu_class' => 'menu',
                                    'depth' => 0,
                                ));
                            } else {
                                echo "Define your 'My Account' navigation in Apperance -> Menus";
                            }
                            ?>
                        </div>
                    </div>
                </div>

            <?php } else { ?>
                <div class="jaw-tabs  <?php echo jaw_template_get_var('style', 'colored'); ?>">
                    <ul class="nav nav-tabs" >
                        <li class="<?php echo $login; ?>"><a data-toggle="tab" href="#tab_login_<?php echo jaw_template_get_counter('login'); ?>">
                                <?php echo __('Login', 'jawtemplates'); ?>
                            </a></li>
                        <?php jaw_template_inc_counter('login'); ?>
                        <?php if (get_option('users_can_register')) { ?>

                            <li class="<?php echo $register; ?>" ><a data-toggle="tab" href="#tab_login_<?php echo jaw_template_get_counter('login'); ?>">
                                    <?php echo __('Register', 'jawtemplates'); ?>
                                </a></li>
                        <?php } ?>
                    </ul>
                    <?php jaw_template_dec_counter('login'); ?>
                    <div class="tab-content" >
                        <div class="tab-pane fade <?php echo $login_c; ?>" id="tab_login_<?php echo jaw_template_get_counter('login'); ?>">

                            <div class="login">
                                <?php
                                wp_login_form(jaw_template_get_data());
                                ?>
                            </div>
                        </div>
                        <?php if (get_option('users_can_register')) { ?>
                            <?php jaw_template_inc_counter('login'); ?>
                            <div class="tab-pane fade <?php echo $register_c; ?>" id="tab_login_<?php echo jaw_template_get_counter('login'); ?>">

                                <div class="registration-form-wrapper">
                                    <?php
                                    if (isset($_POST['svalue']) && $_POST['svalue'] != jaw_template_get_var('answer', '2')) {
                                        echo do_shortcode('[jaw_message message_style="warning" show_close="0" message_text="' . __('Wrong answer', 'jawtemplates') . '"]');
                                    } else if (defined('REGISTRATION_ERROR')) {
                                        foreach (unserialize(REGISTRATION_ERROR) as $error) {
                                            echo do_shortcode('[jaw_message message_style="warning" show_close="0" message_text="<strong>' . __('Error: ', 'jawtemplates') . '</strong>' . $error . '"]');
                                        }
                                    } elseif (defined('REGISTERED_A_USER')) {
                                        echo do_shortcode('[jaw_message message_style="success" show_close="0" message_text="<strong>' . __('Congratulations you have been registered.', 'jawtemplates') . '</strong><br>' . __('Please check your e-mail box: ', 'jawtemplates') . REGISTERED_A_USER . '"]');
                                    }
                                    ?>

                                    <form id="jaw-registration-form" method="post" action="<?php echo esc_url(add_query_arg('do', 'register', get_permalink($post->ID))); ?>#jaw_login">
                                        <p>
                                            <label for="username">Username</label>
                                            <input type="text" class="input" id="username" name="user" value=""/>
                                        </p><p>
                                            <label for="email">E-mail</label>
                                            <input type="text" class="input" id="email" name="email" value="" />
                                        </p><p>
                                            <label for="svalue"><?php echo jaw_template_get_var('question', 'What is a result of 1+1?'); ?></label>
                                            <input type="text"  class="input" name="svalue" value="" />
                                        </p><p>
                                            <?php echo __('A password will be e-mailed to you.', 'jawtemplates'); ?>
                                        </p><p>
                                            <input type="hidden" value="<?php echo jaw_template_get_var('answer', '2'); ?>" name="jaw-register" /> 
                                            <?php wp_nonce_field('jaw_register', 'jaw_register_nonce'); ?>
                                            <input type="submit" class="reg-submit" value="<?php echo __('Register', 'jawtemplates'); ?>" />
                                        </p>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>