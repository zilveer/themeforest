<?php 
	add_action('wp_head','ebor_custom_colours', 20);
	function ebor_custom_colours(){
		
	$highlight = get_option('highlight_colour','#E84E41');
	$footer = get_option('footer_colour','#2E3138');
?>
	
<style type="text/css">
	
	.colour {color:<?php echo $highlight; ?>; } 
	 
	a {color: <?php echo $highlight; ?>;}
	a:hover {color:#333;}
	
	::selection { background: <?php echo $highlight; ?>; color: #fff; }
	::-moz-selection { background: <?php echo $highlight; ?>; color: #fff; }
	
	blockquote { border-left:4px solid <?php echo $highlight; ?>!important;  }
	
	.btn,
	#ajax-contact-form2 input[type="submit"] { background-color: <?php echo $highlight; ?>!important; }
	.btn-inverse:hover { background-color: <?php echo $highlight; ?>!important;}
	
	#menu li a:hover,  #menu  a:focus, #menu a.active { color:<?php echo $highlight; ?>!important; background-color:transparent; }
	
	.colour-section { color:#f0f0f0!important; background:<?php echo $highlight; ?>!important;}
	.colour-section .lead, .colour-section h1 {color:#f0f0f0!important; }
	
	.footer a { color: <?php echo $highlight; ?>!important;  }
	.footer a:hover { color: #999!important; }
	
	/**** CIRCLE LINK ****/
	.circle { background: <?php echo $highlight; ?>!important; }
	.circle:hover {  background: #2E3138!important; }
	
	/*  ---------------------------------------------------------------
	  	SERVICE ICONS
	    --------------------------------------------------------------- */
	.service { background: <?php echo $highlight; ?>!important; }
	
	/*  ---------------------------------------------------------------
	  	PROGRESS BARS/SKILL BARS
	    --------------------------------------------------------------- */
	.bars-wrapper .progress-bar { background:<?php echo $highlight; ?>!important; }
	
	/*  ---------------------------------------------------------------
	  	TEAM ICONS
	    --------------------------------------------------------------- */
	.hi-icon2 { color: <?php echo $highlight; ?>!important; }
	.hi-icon-effect-a .hi-icon2 { box-shadow: 0 0 0 3px <?php echo $highlight; ?>!important; }
	.no-touch .hi-icon-effect-a1 .hi-icon2:hover { color:<?php echo $highlight; ?>!important;}
	.hi-icon-effect-a .hi-icon2:after { background: <?php echo $highlight; ?>!important; color:<?php echo $highlight; ?>!important; }
	
	/*  ---------------------------------------------------------------
	   	HOVER CAPTIONS ( TEAM - VIEW PROFILE + WORK - VIEW BUTTONS 
	    --------------------------------------------------------------- */
	.cbp-l-caption-buttonLeft:hover, .cbp-l-caption-buttonRight:hover {
	    color: #fff!important;
		background-color: <?php echo $highlight; ?>!important;
	}
	
	/*  ---------------------------------------------------------------
	  PORTFOLIO FILTERS
	    --------------------------------------------------------------- */
	.cbp-l-filters-button .cbp-filter-item-active { background-color:<?php echo $highlight; ?>!important;  color: #fff !important; }
	.cbp-l-filters-button .cbp-filter-counter { background-color: <?php echo $highlight; ?>!important; color: #fff!important; }
	.cbp-l-filters-button .cbp-filter-counter:before { border-top: 4px solid <?php echo $highlight; ?>!important;}
	
	.nav-tabs .active a, .nav-tabs a:hover, .nav-tabs .active  a:focus { background-color:<?php echo $highlight; ?>!important;}
	
	.footer {
		background: <?php echo $footer; ?>;
	}
	
	<?php if( get_option('flair_fixed_header', '0') == 1 ) : ?>
		#header {
			top: 0 !important;
		}
		.admin-bar #header {
			top: 32px !important;
		}
	<?php endif; ?>
	
	<?php
		echo get_option('custom_css'); 
	?>
	
</style>
	
<?php }

add_action('login_head','ebor_custom_admin');
function ebor_custom_admin(){
	if( get_option('custom_login_logo') )
		echo '<style type="text/css">
				.login h1 a { 
					background-image: url("'.get_option('custom_login_logo').'"); 
					background-size: auto 80px;
					width: 100%; 
				} 
			</style>';
}