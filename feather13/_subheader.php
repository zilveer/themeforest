<?php if ( !wpb_option('disable-subheader') ): ?>
<div id="subheader">
	<div class="container fix">
		
		<ul class="dropdown-btn">
			<li>
				<a href="#" class="drop"><?php _e('Categories','feather'); ?></a>
				<ul class="sub-menu">
					<?php wp_list_categories('title_li=' ); ?>
				</ul>
			</li>
		</ul>
		
		<ul class="dropdown-btn">
			<li>
				<a href="#" class="drop"><?php _e('Archives','feather'); ?></a>
				<ul class="sub-menu">
					<?php wp_get_archives('title_li=' ); ?>
				</ul>
			</li>
		</ul>
		
		<div id="subheader-search" class="fix">
			<?php get_search_form(); ?>
		</div>
		
		<a id="subheader-rss" href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS','feather'); ?></a>
		
	</div>
</div><!--/subheader-->
<?php endif; ?>