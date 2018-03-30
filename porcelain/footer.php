<?php 
/**
 * Footer template - this file content is displayed on every page after the main content.
 */
?>
</div>
<footer id="footer" class="center">
	<?php if(pexeto_option('show_scroll_btn')){ ?>
	<div class="scroll-to-top"><span></span></div>
	<?php } ?>

	<?php if(pexeto_option('show_ca')){ 
		$ca_use_po = pexeto_option('ca_use_po');
		$ca_title = $ca_use_po ? __( 'Call to action section title', 'pexeto' ) : pexeto_option('ca_title');
		$ca_desc = $ca_use_po ? __( 'Call to action section description', 'pexeto' ) : pexeto_option('ca_desc');
		$ca_btn_text = $ca_use_po ? __( 'Call to action button text', 'pexeto' ) : pexeto_option('ca_btn_text');

		//PRINT THE CALL TO ACTION SECTION
		?>
	<div id="footer-cta">
		<div class="section-boxed">
		<div class="footer-cta-first"><h5><?php echo $ca_title; ?></h5></div>
		<div class="footer-cta-disc"><p><?php echo $ca_desc; ?></p></div>
		<?php 
		if(pexeto_option('ca_btn_link') || $ca_btn_text){ ?>
		<div class="footer-cta-button">
			<a href="<?php echo esc_url(pexeto_option('ca_btn_link')); ?>" class="button"><?php echo $ca_btn_text; ?></a>
		</div>
		<?php  } ?>
		<div class="clear"></div>
	</div>
	</div>
	<?php } 

//PRINT THE FOOTER COLUMNS
$footer_layout = pexeto_option("footer_layout");
$sidebar_numbers = array("one", "two", "three", "four");
$column_num = intval($footer_layout);
if($footer_layout!="no-footer"){ ?>
	<div class="cols-wrapper footer-widgets section-boxed cols-<?php echo $column_num; ?>">
	<?php
	if($column_num>0){
		for($i=1; $i<=$column_num; $i++){
			$number = $sidebar_numbers[$i-1]; 
			$add_class = $i==$column_num ? ' nomargin':'';
			?><div class="col<?php echo $add_class; ?>"><?php
			dynamic_sidebar("footer-".$number);
			?></div><?php
		}
	}
	?>
	</div>
	<?php
}
?>
<div class="footer-bottom">
	<div class="section-boxed">
<span class="copyrights">
&copy; <?php echo __( 'Copyright', 'pexeto' ).' ';
	bloginfo('name'); 
?>
</span>
<div class="footer-nav">
<?php wp_nav_menu(array('theme_location' => 'pexeto_footer_menu', 'fallback_cb'=>'pexeto_no_footer_menu', 'depth'=>1)); ?>
</div>

<?php locate_template( array( 'includes/social-icons.php' ), true, false ); ?>

</div>
</div>
</footer> <!-- end #footer-->
</div> <!-- end #main-container -->


<!-- FOOTER ENDS -->

<?php 
wp_footer(); 
?>
</body>
</html>