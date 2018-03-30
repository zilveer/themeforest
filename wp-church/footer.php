<?php
/**
 * The template for displaying the footer.
 *
 */
?>
					</div><!-- #main -->
					<?php if (get_option('nets_mapdisable') == 'false') {?>
					<div class="dirclose"><?php _e( 'Close', 'wp-church' ); ?></div>
					<div class="dirhelp"><?php _e( 'Need Driving Directions? ', 'wp-church' ); ?><a href="<?php echo get_option('nets_addraddr'); ?>"><?php _e( 'Click here ', 'wp-church' ); ?></a></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>	
		
	<div id="footer" role="contentinfo">
		<div class="footmess">
			<div id="main" class="container footwidget">
				<?php if ( is_active_sidebar( 'footer-left' ) ) : ?>	
				<div id="primary" class="widget-area grid4 first" role="complementary">		
					<ul class="xoxo">	
						<?php dynamic_sidebar( 'footer-left' ); ?>
					</ul>
				</div>
				<?php endif; ?>
					
				<?php if ( is_active_sidebar( 'footer-center' ) ) : ?>	
				<div id="primary" class="widget-area grid4" role="complementary">				
					<ul class="xoxo">
						<?php dynamic_sidebar( 'footer-center' ); ?>
					</ul>
				</div>
				<?php endif; ?>
					
				<?php if ( is_active_sidebar( 'footer-right' ) ) : ?>	
				<div id="primary" class="widget-area grid4" role="complementary">				
					<ul class="xoxo">
						<?php dynamic_sidebar( 'footer-right' ); ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div id="footerbottom">
			<div id="bottominner">	
				<div id="site-info">
					<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?> &copy; (<?php echo date('Y'); ?>)
					</a>
				</div><!-- #site-info -->
				<div id="site-generator">
					<?php do_action( 'twentyten_credits' ); ?>
					<a href="<?php echo esc_url( __('http://www.netstudio.co.za/', 'wp-church') ); ?>"
							title="<?php esc_attr_e('Netstudio', 'wp-church'); ?>" rel="generator">
						<?php printf( __('Proudly Designed by %s.', 'wp-church'), 'Netstudio' ); ?>
					</a>
				</div><!-- #site-generator -->
				<div class="clear"></div>
			</div>
		</div><!-- #footer -->
	</div>	
	
</div><!-- #wrapper -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/coinslider.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/imagegallery.js" type="text/javascript"></script>
		<?php add_action('wp_head','helper_js',100); ?>
		<?php function helper_js () {
		$g_bookmark_add=get_option('g_bookmark');
		$g_next_click_add=get_option('g_next_click');
		}
		?>
		
		<script type='text/javascript'>
		/*<![CDATA[*/
		jQuery(function($){jQuery('.gallery').addClass('gallery_reloaded');jQuery('ul.gallery_reloaded').gallery_reloaded({history:false,clickNext:true,insert:'.main_image',onImage:function(a,b,c){a.css('display','none').fadeIn(1000);b.css('display','none').fadeIn(1000);var d=c.parents('li');d.siblings().children('img.selected').fadeTo(500,0.5);c.fadeTo('fast',1).addClass('selected');a.attr('title','Next image >>')},onThumb:function(a){var b=a.parents('li');var c=b.is('.active')?'1':'0.5';a.css({display:'none',opacity:c}).fadeIn(500);a.hover(function(){a.fadeTo('fast',1)},function(){b.not('.active').children('img').fadeTo('fast',0.5)})}});jQuery('ul.gallery_reloaded li:first-child').addClass('active')});function makeScrollable(j,k){var j=jQuery(j),k=jQuery(k);k.hide();var l=jQuery('<div class=loading>Loading Gallery...</div>').appendTo(j);var m=setInterval(function(){var a=k.find('img');var b=0;a.each(function(){if(this.complete)b++});if(b==a.length){clearInterval(m);setTimeout(function(){l.hide();j.css({overflow:'hidden'});k.slideDown('slow',function(){enable()})},1000)}},100);function enable(){var c=50;var d=j.width();var f=j.height();var g=k.outerWidth()+2*c;var h=j.offset();j.css({overflow:'hidden'});var i=k.find('li:last-child');j.mousemove(function(e){var a=i[0].offsetLeft+i.outerWidth()+c;var b=(e.pageX-j.offset().left)*(a-d)/d-c;if(b<0){b=0}j.scrollLeft(b)})}}jQuery(function(jQuery){makeScrollable('div.gholder','ul.gallery_reloaded')});this.gr_tooltip=function(){xOffset=10;yOffset=20;jQuery("div.gbackgr img").hover(function(e){this.t=this.title;this.alt = this.t;this.title = "";jQuery("body").append("<p id='gr_tooltip'>"+this.t+"</p>");jQuery("#gr_tooltip").css("top",(e.pageY-xOffset)+"px").css("left",(e.pageX+yOffset)+"px").fadeIn("fast")},function(){this.title=this.alt;jQuery("#gr_tooltip").remove()});jQuery("div.gbackgr img").mousemove(function(e){jQuery("#gr_tooltip").css("top",(e.pageY-xOffset)+"px").css("left",(e.pageX+yOffset)+"px")})};jQuery(function($){gr_tooltip()});/*]]>*/ 
		</script>
		
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
			base_url = '<?php echo get_template_directory_uri(); ?>';
			<?php if (get_option('nets_countdown')  == 'true') {?>
			timerhelp = 'no';
			<?php } else { ?>
			timerhelp = 'yes';
			<?php }?>

			<?php $ttime =  get_option("nets_transtime") * 1000; ?>
			<?php if  (get_option("nets_transprev") == 'true') {echo 'navigation: true,'; } 
			else {echo 'navigation: false,';}?>

			$('#coin-slider').coinslider({
				width: 958, // width of slider panel
				height: 340, // height of slider panel
				spw: 5, // squares per width
				sph: 5, // squares per height
				delay: <?php echo $ttime; ?>, // delay between images in ms
				sDelay: 40, // delay beetwen squares in ms
				opacity: 0.7, // opacity of title and navigation
				titleSpeed: 1500, // speed of title appereance in ms
				effect: '<?php echo get_option("nets_transtype"); ?>', // random, swirl, rain, straight
				<?php if  (get_option("nets_transprev") == 'true') {echo 'navigation: true,'; } 
				else {echo 'navigation: false,';}?>
				<?php if  (get_option("nets_translink") == 'true') {echo 'links : true,'; } 
				else {echo 'links : false,';}?>
				<?php if  (get_option("nets_transpause") == 'true') {echo 'hoverPause: true'; } 
				else {echo 'hoverPause: false';}?>
			});
		});			
		</script>
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js" type="text/javascript"></script>

<?php
	wp_footer();
?>
<?php echo stripslashes(get_option('nets_tracking')); ?>
</body>
</html>
