<?php if( !empty( $heading_title ) ) { ?>
	<h3 class="mk-fancy-title pattern-style">
		<span> <?php echo $heading_title ?></span>
	</h3>
<?php } ?>

<div id="mk-tabs-<?php echo $id ?>" class="mk-tabs <?php echo $class ?>  js-el"
	data-mk-component="Tabs">

	<ul id="mk-tabs-tabs-<?php echo $id ?>" class="mk-tabs-tabs">
		<!-- 
			%s 1 'tab-with-icon' class name if icon is added
			%s 2 tab ID
			$s 3 <i></i> output
			$s 4 tab title
		 -->
		<?php echo vc_tabs__get_tabs('
			<li class="mk-tabs-tab %s"><a href="#">%s %s</a></li>
		', $content) ?>
		<div class="clearboth"></div>
	</ul>
	<div class="mk-tabs-panes page-bg-color">
		<?php // panes are retrived from vc_tab shortcode
		echo vc_tabs__get_panes( $content ) ?>
		<div class="clearboth"></div>
	</div>
	<div class="clearboth"></div>
</div>