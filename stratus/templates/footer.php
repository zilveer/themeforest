<?php
/* Themovation Theme Options */
if ( function_exists( 'ot_get_option' ) ) {	
	/* Footer Widget Switch */
	
	$themo_footer_widget_switch = ot_get_option( 'themo_footer_widget_switch' ); // Get Google Analytics Tracking Code
	

	/* Footer  Copyright*/
	$themo_footer_copyright = ot_get_option( 'themo_footer_copyright' ); // Get Google Analytics Tracking Code
	$themo_footer_copyright_output = "";
	if ($themo_footer_copyright > ""){
		$themo_footer_copyright_output = "<span class='footer_copy'>".$themo_footer_copyright."</span>";
	}else{
		$themo_footer_copyright_output = "<span class='footer_copy'>&copy; " . date('Y') . " " . get_bloginfo('name')."</span>";
	}
	/* Footer  Credit */
	$themo_footer_credit = ot_get_option( 'themo_footer_credit' ); // Get Google Analytics Tracking Code
	$themo_footer_credit_output = "";
	$themo_footer_spacer = "";
	if ($themo_footer_credit > ""){
		$themo_footer_credit_output = "<span class='footer_credit'>".$themo_footer_credit."</span>";
		$themo_footer_spacer = " - ";
	}

	/* Themovation Theme Options */
	if ( function_exists( 'ot_get_option' ) ) {	
		/* Footer  Columns */
		$themo_footer_columns = ot_get_option( 'themo_footer_columns', 2 );
		$bootstrap_footer_column_class = ''; // Bootstrap 3 grid column size
		switch ($themo_footer_columns) {
			case 1:
				$bootstrap_footer_column_class = "col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2";
				break;
			case 2:
				$bootstrap_footer_column_class = "col-sm-6";
				break;
			case 3:
				$bootstrap_footer_column_class = "col-md-4 col-sm-6";
				break;
			case 4:
				$bootstrap_footer_column_class = "col-md-3 col-sm-6";
				break;
		}
	}
			
	
}
/* END Theme Options */
?>

<div class="prefooter"></div>

<footer class="footer" role="contentinfo">
	<div class="container">
			<?php 
            // Footer Widget Area / Enabled / Disabled via Theme Options
            if ($themo_footer_widget_switch === "on"){ ?>
				<div class="footer-widgets row">
              	<?php // Footer column 1
                if ( is_active_sidebar('sidebar-footer-1') ) {?>
                    <div class="footer-area-1 <?php echo sanitize_text_field($bootstrap_footer_column_class); ?>">
                    <?php dynamic_sidebar('sidebar-footer-1'); ?>
                    </div>
                <?php } ?>
                <?php // Footer column 2
                if ( is_active_sidebar('sidebar-footer-2') ) {?>
                    <div class="footer-area-2 <?php echo sanitize_text_field($bootstrap_footer_column_class); ?>">
                    <?php dynamic_sidebar('sidebar-footer-2'); ?>
                    </div>
                <?php } ?>
                 <?php // Footer column 3
                if ( is_active_sidebar('sidebar-footer-3') ) {?>
                    <div class="footer-area-3 <?php echo sanitize_text_field($bootstrap_footer_column_class); ?>">
                    <?php dynamic_sidebar('sidebar-footer-3'); ?>
                    </div>
                <?php } ?>
                 <?php // Footer column 4
                if ( is_active_sidebar('sidebar-footer-4') ) {?>
                    <div class="footer-area-4 <?php echo sanitize_text_field($bootstrap_footer_column_class); ?>">
                    <?php dynamic_sidebar('sidebar-footer-4'); ?>
                    </div>
                <?php } ?>
				</div>
			<?php } ?>
    </div>
    <div class="footer-btm-bar">        
        <div class="container">    
            <div class="footer-copyright row">
                <div class="col-xs-12">
                    <p><?php echo wp_kses_post($themo_footer_copyright_output) ;?> <?php echo sanitize_text_field($themo_footer_spacer);?> <?php echo wp_kses_post($themo_footer_credit_output);?></p>
                </div>
            </div>
        </div>
    </div>
</footer>

    
<?php wp_footer(); ?>