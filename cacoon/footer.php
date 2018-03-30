<?php
if('' != get_theme_mod('cacoon_twitter_username')):
	wp_enqueue_script('metcreative-caroufredsel');
	wp_enqueue_style('metcreative-caroufredsel');
	?>
	<div class="met_twitter_ticker_wrap met_bgcolor">
		<div class="met_content clearfix">
			<i class="icon-twitter icon-2x pull-left met_color2"></i>
			<div class="met_twitter_ticker_pager">
				<a href="#"><i class="icon-angle-left icon-large"></i></a>
				<a href="#"><i class="icon-angle-right icon-large"></i></a>
			</div>

			<div class="met_news_ticker_wrapper clearfix">
				<div class="met_twitter_ticker">
					<?php
						//Remove old twitter options if Cacoon older than v3.0.2
						if( get_option('footer_twitter_plugin_tweets') ){
							delete_option('footer_twitter_plugin_tweets');
							delete_option('footer_twitter_plugin_last_cache_time');
							delete_option('footer_twitter_plugin_username');
						}

						$footer_twitter_user_name = get_theme_mod('cacoon_twitter_username');

						$footer_tweets = mc_get_tweets($footer_twitter_user_name);

						if( $footer_tweets ){
							foreach( $footer_tweets as $footer_tweet ){
								echo '<div class="met_color2">'.$footer_tweet.'</div>';
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<script>
		jQuery().ready(function(){
			jQuery(".met_twitter_ticker").carouFredSel({
				responsive: true,
				prev: {
					button : function(){
						return jQuery(this).parents('.met_news_ticker_wrapper').prev('.met_twitter_ticker_pager').children('a:first-child')
					}
				},
				next:{
					button : function(){
						return jQuery(this).parents('.met_news_ticker_wrapper').prev('.met_twitter_ticker_pager').children('a:last-child')
					}
				},
				width: '100%',
				circular: false,
				infinite: true,
				auto: {
					play : true,
					pauseDuration: 0,
					duration: 2000
				},
				scroll: {
					items: 1,
					duration: 400,
					wipe: true
				},
				items: {
					visible: {
						min: 1,
						max: 1  },
					width: 795,
					height: 'auto'
				}
			});
		});
	</script>
<?php endif; ?>

<footer class="met_bgcolor3 clearfix">
	<div class="met_content">
		<div class="row-fluid">
			<?php $cacoon_footer_style = ''; $cacoon_footer_style = intval(get_theme_mod('cacoon_footer_style')); ?>
			<?php if($cacoon_footer_style == 0): ?>
			<div class="span4">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-sidebar') ); ?>
			</div>
			<div class="span8">
				<ul class="met_footer_menu">
					<?php
					$currentPageParent = '';
					$locations = get_registered_nav_menus();
					$menus = wp_get_nav_menus();
					$menu_locations = get_nav_menu_locations();
					$footer_parentMenus = array();

					$location_id = 'footer_menu';
					if (isset($menu_locations[ $location_id ])) {
						foreach ($menus as $menu) {
							if ($menu->term_id == $menu_locations[ $location_id ]) {
								$menu_items = wp_get_nav_menu_items($menu);
								foreach($menu_items as $menu_item){
									if($menu_item->menu_item_parent == 0){
										$footer_parentMenus[] = $menu_item;
									}
								}
								break;
							}
						}
					}

					if($footer_parentMenus){
						foreach($footer_parentMenus as $footer_parentMenu){
							echo '<li><a class="met_color2" href="'.$footer_parentMenu->url.'" target="'.$footer_parentMenu->target.'">'.$footer_parentMenu->title.'</a></li>';
						}
					}
					?>
				</ul>

				<?php if($footer_parentMenus): ?>
				<select class="met_responsive_nav">
					<?php
						foreach($footer_parentMenus as $footer_parentMenu){
							echo '<option value="'.$footer_parentMenu->url.'">'.$footer_parentMenu->title.'</option>';
						}
					?>
				</select>
				<?php endif; ?>

			</div>
			<?php endif; ?>

			<?php if($cacoon_footer_style > 0): ?>
				<?php
				$footer_column_sizes = array('s1' => 'span3','s2' => 'span6','s3' => 'span9','s4' => 'span12');
				for($i = 1; $i <= $cacoon_footer_style; $i++){
					$current_column_size = get_theme_mod('cacoon_footer_column_'.$i.'_width');
					if($i == 1){
						$current_sidebar_id = 'footer-sidebar';
					}else{
						$current_sidebar_id = 'footer-sidebar-'.$i;
					}

					echo '<div class="'.$footer_column_sizes[$current_column_size].'">';
					( ( is_active_sidebar( $current_sidebar_id ) ) ? dynamic_sidebar( $current_sidebar_id ) : '' );
					echo ( ( !is_active_sidebar( $current_sidebar_id ) ) ? '<span class="met_color2">Please go "Appearance -> Widgets -> Footer Sidebar ('.$i.')" and setup your widgets..</span>' : '' );
					echo '</div>';
				}
				?>
			<?php endif; ?>
		</div>
	</div>
	<?php
		$footer_text = get_theme_mod('cacoon_footer_text','');
		if(!empty($footer_text)):
	?>
	<div class="met_footer_copyright clearfix">
		<div class="met_content">
			<p class="met_color2"><?php echo $footer_text ?></p>
		</div>
	</div>
	<?php endif; ?>

</footer>

</div>

<div id="back-to-top" class="off back-to-top-off"></div>

<script>
	jQuery(document).ready(function(){
		if(jQuery('body').attr('data-smooth-scrolling') == 1 && !jQuery.browser.mobile){
			jQuery("html").niceScroll({
				scrollspeed: <?php echo get_theme_mod('cacoon_scrollspeed',60) ?>,
				mousescrollstep: <?php echo get_theme_mod('cacoon_mousescrollstep',35) ?>,
				cursorwidth: <?php echo get_theme_mod('cacoon_cursorwidth',10) ?>,
				cursorborder: '1px solid #7E8A96',
				cursorcolor: '<?php echo get_theme_mod('cacoon_cursorcolor','#18ADB6') ?>',
				cursorborderradius: <?php echo get_theme_mod('cacoon_cursorborderradius',10) ?>,
				autohidemode: <?php echo get_theme_mod('cacoon_scrollautohidemode','false') ?>,
				cursoropacitymin: 0.1,
				cursoropacitymax: 1
			});
		}
	})
</script>
<?php echo get_theme_mod('cacoon_tracking_code'); ?>
<?php wp_footer(); ?>
</body>
</html>