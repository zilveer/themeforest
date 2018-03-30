<!-- THEME COLORS -->
<?php
    echo td_panel_generator::ajax_box('GENERAL theme colors', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_general_theme_colors'
        )
    );
?>



<hr>
<div class="td-section-separator">Header</div>




<!-- TOP MENU -->
<?php
echo td_panel_generator::ajax_box('Top menu', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_top_menu'
    )
);
?>


<!-- MAIN MENU -->
<?php
echo td_panel_generator::ajax_box('Main menu', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_main_menu'
    )
);
?>

<!-- MOBILE MENU -->
<?php
echo td_panel_generator::ajax_box('Mobile menu / Mobile search', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_mobile_menu'
    )
);
?>

<!-- HEADER COLOR -->
<?php echo td_panel_generator::box_start('Header', false); ?>

<!-- Header color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">HEADER BACKGROUND COLOR</span>
        <p>Select header background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_header_wrap_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<!-- Text logo color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">TEXT LOGO COLOR</span>
        <p>Select text logo color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_text_logo_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<!-- Text logo tagline color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">TEXT LOGO TAGLINE COLOR</span>
        <p>Select text logo tagline color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_text_logo_tagline_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>

<!-- SIGN IN/JOIN MODAL -->
<?php
echo td_panel_generator::ajax_box('Sign in/Join modal', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_login_modal'
    )
);
?>


<hr>
<div class="td-section-separator">Footer</div>


<!-- FOOTER -->
<?php echo td_panel_generator::box_start('Footer', false); ?>

<!-- FOOTER color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BACKGROUND COLOR</span>
        <p>Select footer background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<!-- FOOTER text color -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">TEXT COLOR</span>
		<p>Select footer text color</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::color_picker(array(
			'ds' => 'td_option',
			'option_id' => 'tds_footer_text_color',
			'default_color' => '#fff'
		));
		?>
	</div>
</div>

<!-- FOOTER links hover color -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">LINKS HOVER COLOR</span>
		<p>Select footer links hover color</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::color_picker(array(
			'ds' => 'td_option',
			'option_id' => 'tds_footer_text_hover_color',
			'default_color' => ''
		));
		?>
	</div>
</div>

<!-- WIDGETS HEADER BACKGROUND COLOR -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">WIDGETS HEADER BG COLOR</span>
		<p>Select widgets header background color</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::color_picker(array(
			'ds' => 'td_option',
			'option_id' => 'tds_footer_widget_bg_color',
			'default_color' => '#fff'
		));
		?>
	</div>
</div>

<!-- WIDGETS HEADER TEXT COLOR -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">WIDGETS HEADER TEXT COLOR</span>
		<p>Select widgets header text color</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::color_picker(array(
			'ds' => 'td_option',
			'option_id' => 'tds_footer_widget_text_color',
			'default_color' => '#222'
		));
		?>
	</div>
</div>


<?php echo td_panel_generator::box_end();?>



<!-- SUB FOOTER -->
<?php echo td_panel_generator::box_start('Sub-footer', false); ?>

<!-- FOOTER bottom color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BACKGROUND COLOR</span>
        <p>Select sub footer bottom background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_bottom_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>


<!-- FOOTER bottom text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">TEXT COLOR</span>
        <p>Select sub footer bottom text color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_bottom_text_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<!-- FOOTER bottom text hover color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">FOOTER MENU HOVER COLOR</span>
        <p>Select sub footer menu items hover/active color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_bottom_hover_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>


<hr>
<div class="td-section-separator">Content</div>


<!-- POSTS PAGE -->
<?php
echo td_panel_generator::ajax_box('Posts', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_posts'
    )
);
?>




<!-- PAGES COLORS -->
<?php
echo td_panel_generator::ajax_box('Pages', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_pages'
    )
);
?>


<hr>
<div class="td-section-separator">Modules and Blocks</div>


<!-- ARTICLE TITLES -->
<?php
echo td_panel_generator::ajax_box('Article titles', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_article_titles'
    )
);
?>


<!-- AUTHOR NAME -->
<?php echo td_panel_generator::box_start('Author name', false); ?>

<!-- Author name -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">AUTHOR NAME COLOR</span>
        <p>Select Author name link color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_author_name_title_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>