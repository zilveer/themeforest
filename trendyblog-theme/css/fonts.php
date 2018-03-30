<?php
	function df_custom_fonts() { 

		//fonts
		$google_font_1 = df_get_option(THEME_NAME."_google_font_1");
		$google_font_2 = df_get_option(THEME_NAME."_google_font_2");
		$google_font_3 = df_get_option(THEME_NAME."_google_font_3");
		$google_font_4 = df_get_option(THEME_NAME."_google_font_4");
		
		$font_size_1 = df_get_option(THEME_NAME."_font_size_1");
		if(!$font_size_1) $font_size_1 = 14;		
		$font_size_2 = df_get_option(THEME_NAME."_font_size_2");
		if(!$font_size_2) $font_size_2 = 16;		
		$font_size_3 = df_get_option(THEME_NAME."_font_size_3");
		if(!$font_size_3) $font_size_3 = 12;		
		$font_size_4 = df_get_option(THEME_NAME."_font_size_4");
		if(!$font_size_4) $font_size_4 = 12;

		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "<style>";	
		} 
?>

/*------------------------------------------------------------------------------
    Body
------------------------------------------------------------------------------*/
body {
    font-family: "<?php echo esc_html__($google_font_1);?>", sans-serif;
    font-size: <?php echo intval($font_size_1);?>px;
}
/*------------------------------------------------------------------------------
    Main Menu
------------------------------------------------------------------------------*/
nav.site_navigation ul.menu > li > a {
    font-size: <?php echo intval($font_size_2);?>px;
}
nav.site_navigation ul.menu > li > a > div.subtitle {
	font-size: <?php echo intval($font_size_3);?>px;
}
nav.site_navigation ul.menu ul.sub-menu {
	font-size: <?php echo intval($font_size_4);?>px;
}
/*------------------------------------------------------------------------------
    Headings
    (headings, menu links, dropcap first letter, panel subtitle)
------------------------------------------------------------------------------*/
h1,
h2,
h3,
h4,
h5,
h6,
nav.site_navigation ul.menu > li > a,
.dropcap:first-letter,
.panel_title span {
    font-family: "<?php echo esc_html__($google_font_2);?>", sans-serif
}

<?php
		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "</style>";	
		} 
	}

	if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
		df_custom_fonts();	
	} 

?>