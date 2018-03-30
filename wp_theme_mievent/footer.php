<?php
if( !is_singular('event') && !is_page_template('template-event-landing.php') && MthemeCore::getOption("contact_active","true")=='true'){
	echo do_shortcode('[footer_contact]');
}
?>
<?php if(MthemeCore::getOption("footer_active","true")=='true'){ ?>
<!--FOOTER-->
<?php
$made_in_title=MthemeCore::getOption("made_in_title","Made in Multia");
$declaration_title=MthemeCore::getOption("declaration_title","");
$declaration_content=MthemeCore::getOption("declaration_content","Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea");
?>
<?php if(!empty($made_in_title) || !empty($declaration_title)){ ?>
<footer style="background-color:<?php echo MthemeCore::getOption("header_color","#0f1726 "); ?>">
	<div class="container">
		<div class="row">
			<div class="align-center">
				<ul class="legals">
					<?php if(!empty($declaration_title)){ ?>
					<li><?php echo do_shortcode("[modal title='$declaration_title']".$declaration_content."[/modal]"); ?></li>
					<?php } if(!empty($made_in_title)){ ?>
					<li><a href="<?php echo esc_url(MthemeCore::getOption("made_in_link","#")); ?>" target="_blank">
					<?php echo esc_html($made_in_title);?></a></li>
					<?php } ?>
				</ul>
			</div>			
		</div>
	</div>
</footer>
<?php } } ?>
<?php wp_footer(); ?>
</body>
</html>