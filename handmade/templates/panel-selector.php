<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/20/2015
 * Time: 8:56 AM
 */
?>
<div id="panel-style-selector">
    <div class="panel-wrapper">
        <div class="panel-selector-open"><i class="fa fa-cog"></i></div>
        <div class="panel-selector-header"><?php esc_html_e('Style Selector','g5plus-handmade');?></div>
        <div class="panel-selector-body clearfix">
            <section class="panel-selector-section clearfix">
                <h3 class="panel-selector-title"><?php esc_html_e('Primary Color','g5plus-handmade'); ?></h3>
                <div class="panel-selector-row clearfix">
                    <ul class="panel-primary-color">
                        <li class="active" style="background-color: #DDBE86" data-color="#DDBE86"></li>
                        <li style="background-color: #B1D1C9" data-color="#B1D1C9"></li>
                        <li style="background-color: #C5CDA0" data-color="#C5CDA0"></li>
                        <li style="background-color: #FDB7AA" data-color="#FDB7AA"></li>
                    </ul>
                </div>
            </section>

            <section class="panel-selector-section clearfix">
                <h3 class="panel-selector-title"><?php esc_html_e('Layout','g5plus-handmade'); ?></h3>
                <div class="panel-selector-row clearfix">
                    <a data-type="layout" data-value="wide" href="#" class="panel-selector-btn"><?php esc_html_e('Wide','g5plus-handmade'); ?></a>
                    <a data-type="layout" data-value="boxed" href="#" class="panel-selector-btn"><?php esc_html_e('Boxed','g5plus-handmade'); ?></a>
                </div>
            </section>

            <section class="panel-selector-section clearfix">
                <h3 class="panel-selector-title"><?php esc_html_e('Background','g5plus-handmade'); ?></h3>
                <div class="panel-selector-row clearfix">
                    <ul class="panel-primary-background">
                        <li class="pattern-0" data-name="pattern-1.png" data-type="pattern" style="background-position: 0px 0px;"></li>
                        <li class="pattern-1" data-name="pattern-2.png" data-type="pattern" style="background-position: -45px 0px;"></li>
                        <li class="pattern-2" data-name="pattern-3.png" data-type="pattern" style="background-position: -90px 0px;"></li>
                        <li class="pattern-3" data-name="pattern-4.png" data-type="pattern" style="background-position: -135px 0px;"></li>
                        <li class="pattern-4" data-name="pattern-5.png" data-type="pattern" style="background-position: -180px 0px;"></li>
                        <li class="pattern-5" data-name="pattern-6.png" data-type="pattern" style="background-position: -225px 0px;"></li>
                        <li class="pattern-6" data-name="pattern-7.png" data-type="pattern" style="background-position: -270px 0px;"></li>
                        <li class="pattern-7" data-name="pattern-8.png" data-type="pattern" style="background-position: -315px 0px;"></li>
                    </ul>
                </div>
            </section>
            <section class="panel-selector-section clearfix">
                <div class="panel-selector-row clearfix">
                    <a id="panel-selector-reset" href="#" class="panel-selector-btn"><?php esc_html_e('Reset','g5plus-handmade'); ?></a>
                    <a data-mode="off" id="panel-selector-rtl" href="#" class="panel-selector-btn"><?php esc_html_e('RTL On','g5plus-handmade'); ?></a>
                </div>
            </section>
        </div>
    </div>
</div>