<?php

		?>
			<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
			    <div><label class="screen-reader-texts" for="s">Search for:</label>
			        <input type="text" value="" placeholder="<?php echo __(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>" onfocus="if ($(this).val() === '<?php echo __(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>') $(this).val('');" onblur="if ($(this).val() === '') $(this).val('<?php echo __(get_option(DESIGNARE_SHORTNAME."_search_box_text"), "smartbox"); ?>');" name="s" id="s" />
			        <input type="submit" id="searchsubmit" value="Search" />
			    </div>
			</form>
		<?php

?>