<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
	
	<?php 
		global $column_last_class,$column_size_class,$gorilla_footer_widget_area,$gorilla_after_content_area_width;
		$column_last_class="last";

		if (get_theme_mod('gorilla_footer_widget_column_number')) { 
			$column_last_class="";
			$column_size_class ="four-column";
		}
	?>	

	<?php if (is_active_sidebar( 'after-content-widget-area' )) { ?>
		<div id="alternate-widget-area">

			<?php if($gorilla_after_content_area_width == "boxed") : ?>
			<div class="container">
			<?php endif; ?>

			<?php dynamic_sidebar( 'after-content-widget-area' ); ?>

			<?php if($gorilla_after_content_area_width == "boxed") : ?>
			</div>
			<?php endif; ?>

		</div>
	<?php } ?>
	
	<?php if($gorilla_footer_widget_area) : ?>
	<div id="footer-widget-area" class="footer">
	
		<div class="container clearfix <?php echo esc_attr($column_size_class); ?>">
			
			<div class="widget-columns">
				<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-1') ) ?>
				<?php }  else { ?>
				<div class="widget">		
					    <h4 class="widget-title">Widget Area 1</h4>
					    <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Assign a Widget</a></p>
					</div>
				<?php } ?>
			</div>
			
			<div class="widget-columns">
				<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-2') ) ?>
				<?php }  else { ?>
				<div class="widget">		
					    <h4 class="widget-title">Widget Area 2</h4>
					    <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Assign a Widget</a></p>
					</div>
				<?php } ?>
			</div>

			<div class="widget-columns <?php echo esc_attr($column_last_class); ?>">
				<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-3') ) ?>
				<?php }  else { ?>
				<div class="widget">		
					    <h4 class="widget-title">Widget Area 3</h4>
					    <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Assign a Widget</a></p>
					</div>
				<?php } ?>
			</div>

			<?php if (get_theme_mod('gorilla_footer_widget_column_number')) { ?>
			<div class="widget-columns last">
				<?php if ( is_active_sidebar( 'footer-4' ) ) { ?>
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-4') ) ?>
				<?php }  else { ?>
				<div class="widget">		
					    <h4 class="widget-title">Widget Area 4</h4>
					    <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Assign a Widget</a></p>
					</div>
				<?php } ?>
			</div>
			<?php } ?>
			
		</div>
		
	</div>
	<?php endif; ?>

	
	
	<footer id="footer-copyright">
		
		<div class="container">
		
			<a href="#" class="goto-top"><i class="fa fa-angle-up"></i></a>
			
			<?php 
			if(get_theme_mod('gorilla_footer_navigation',false)) :
				wp_nav_menu( array( 'container' => false, 'theme_location' => 'secondary-menu', 'menu_class' => 'nav-menu footer-menu','fallback_cb' => 'gorilla_menu_add_alert' ) ); 
			endif;
			?>


			<?php if(get_theme_mod('gorilla_footer_copyright',true)) : ?>
				<p><?php echo wp_kses(get_theme_mod('gorilla_footer_copyright','Alison is a creative soft blog theme made with <i class="fa fa-heart"></i> by angrygorilla.'), wp_kses_allowed_html( 'post' ));  ?></p>
			<?php endif; ?>
			
		</div>
		
	</footer>

</div>

	<!-- Root element of PhotoSwipe. Must have class pswp. -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

	    <!-- Background of PhotoSwipe. 
	         It's a separate element as animating opacity is faster than rgba(). -->
	    <div class="pswp__bg"></div>

	    <!-- Slides wrapper with overflow:hidden. -->
	    <div class="pswp__scroll-wrap">

	        <!-- Container that holds slides. 
	            PhotoSwipe keeps only 3 of them in the DOM to save memory.
	            Don't modify these 3 pswp__item elements, data is added later on. -->
	        <div class="pswp__container">
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	        </div>

	        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
	        <div class="pswp__ui pswp__ui--hidden">

	            <div class="pswp__top-bar">

	                <!--  Controls are self-explanatory. Order can be changed. -->

	                <div class="pswp__counter"></div>

	                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

	                <button class="pswp__button pswp__button--share" title="Share"></button>

	                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

	                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

	                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
	                <!-- element will get class pswp__preloader-active when preloader is running -->
	                <div class="pswp__preloader">
	                    <div class="pswp__preloader__icn">
	                      <div class="pswp__preloader__cut">
	                        <div class="pswp__preloader__donut"></div>
	                      </div>
	                    </div>
	                </div>
	            </div>

	            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
	                <div class="pswp__share-tooltip"></div> 
	            </div>

	            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
	            </button>

	            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
	            </button>

	            <div class="pswp__caption">
	                <div class="pswp__caption__center"></div>
	            </div>

	        </div>

	    </div>

	</div>
	
	<?php wp_footer(); ?>
	
</body>

</html>