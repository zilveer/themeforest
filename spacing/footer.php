	</div>
    
    <!-- Main page content end -->
    
    <?php global $of_option; if (is_active_sidebar(2) || is_active_sidebar(5)){ ?>

	<div id="footer" class="footer-widget-area <?php if($of_option['st_footer_scheme'] == "2"){ echo "footer-light"; }else{ echo "footer-dark"; } ?>">
    	<div class="container">
            <div class="four columns">
                <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Column 1') ) ?>
            </div>
            <div class="four columns">
                <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Column 2') ) ?>
            </div>
            <div class="four columns">               
                <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Column 3') ) ?>
            </div>
            <div class="four columns">
                <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Column 4') ) ?>                
            </div>  
        </div>     	        
    </div>
    
    <?php } ?>
    
    <div id="subfooter">
    	<div class="container">
    
        <div class="copyright eight columns">
       	<?php echo $of_option['st_copyright']; ?>
        </div>
        
        <?php if($of_option['st_social_footer']) : ?>
        <div class="social-footer eight columns">
        	<div class="social">
            <?php
            foreach (range(1, 20) as $v ){
                if($of_option['st_social_'.$v]) :
                echo '<a href="'.$of_option['st_social_'.$v].'"><img src="'.get_template_directory_uri().'/img/social/social_'.$v.'.png" alt></a>';
                endif;
            }					
            ?>
            </div>
        </div> 
        <?php endif; ?>
        
        </div>    
    </div>
</div>

<?php 
	global $custom_bg; $meta = get_post_meta(get_the_id(), $custom_bg->get_the_id(), TRUE); 
	if($meta){
	if($meta['imgurl'] && $meta['fixed']){
?>
<script type="text/javascript">
jQuery(document).ready(function(){	
	jQuery('.bg-image img').hide().load(function () {
		jQuery(this).fadeIn(800);
	});
});
</script>
<div class="bg-image">
	<img width="100%" height="100%" src="<?php echo $meta['imgurl']; ?>" />
</div>
<?php }} ?>

<?php wp_footer(); ?>

</body>
</html>