<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 13/01/16
 * Time: 2:24 PM
 */
global $current_user;
wp_get_current_user();
$userID                 =   $current_user->ID;
$user_login             =   $current_user->user_login;
?>
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-left">
                <h1 class="title-head"><?php esc_html_e('Welcome back, ','houzez'); echo esc_attr( $user_login );?></h1>
            </div>
            <div class="page-title-right">
                <?php get_template_part( 'inc/breadcrumb' ); ?>
            </div>
        </div>
    </div>
</div>