<div class="zn_pb_placeholder"></div>
<div class="zn_front_pb_wrap">
	<div class="zn_pb_dragbar"></div>
	<div class="zn_pb_header clearfix">
		<div class="zn_fpb_buttons zn_left">
			<!-- Will be populated by React -->
			<span id="klpb-toolbar"></span>
			<a href="#" data-zn-tab="zn_pb_content" class="zn_pb_add_el zn_pb_tab_handler zn-pb-active-tab">ADD ELEMENTS</a>

			<?php do_action( 'znpb_editor_tabs_menu' ); ?>

			<a class="zn_pb_icon zn_pb_help_icon" href="http://docs.kallyas.net/" target="_blank" data-tooltip="Access Documentation">
				<span class="dashicons dashicons-editor-help"></span>
			</a>

		</div>

		<div class="zn_fpb_buttons zn_right">
			<div class="zn_pb_editor_right_action">
				<?php do_action( 'zn_pb_editor_right' ); ?>
			</div>

			<input class="zn_pb_search" type="search" placeholder="Search for an element" autofocus/>
			<a class="zn_publish" href="#">
				<span class="zn_publish_loading"></span>
				<span class="zn_publish_text">PUBLISH</span>
			</a>
		</div>
	</div>

	<div class="zn_pb_tab_wrapper" class="fixclear">

		<div id="zn_pb_content" class="zn_pb_tab"></div>

		<?php
		/*
		*	HOOK INTO THE TABS
		*/
		do_action( 'znpb_editor_tabs_content' );

		?>


	</div>
	<input type="hidden" id="zn_post_id" value="<?php echo ZN()->pagebuilder->get_post_id();?>"/>
</div>
<div class="zn_page_loading"></div>
