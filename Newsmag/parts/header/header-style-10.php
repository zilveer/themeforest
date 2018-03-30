<!--
Header style 10
-->
<?php
// read if we have a mobile logo loaded - to hide the main logo on mobile
$td_logo_mobile = '';
if (td_util::get_option('tds_logo_menu_upload') != '') {
	$td_logo_mobile = 'td-logo-mobile-loaded';
}
?>

<div class="td-header-wrap td-header-style-10">
	<div class="td-top-menu-full">
        <div class="td-header-row td-header-top-menu td-make-full">
		    <?php td_api_top_bar_template::_helper_show_top_bar() ?>
	    </div>
	</div>

	<div class="td-header-row td-header-header <?php echo $td_logo_mobile?>">
		<div class="td-header-text-logo">
			<?php locate_template('parts/header/logo-text.php', true, false); ?>
		</div>
	</div>

    <div class="td-header-menu-wrap">
        <div class="td-header-row td-header-main-menu">
            <div class="td-make-full">
                <?php locate_template('parts/header/header-menu.php', true); ?>
            </div>
        </div>
    </div>

	<div class="td-header-container">
		<div class="td-header-row">
			<div class="td-header-sp-rec">
				<?php locate_template('parts/header/ads.php', true); ?>
			</div>
		</div>
	</div>
</div>