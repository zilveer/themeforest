<?php

class crazyblog_PluginsAjax {

	static public function init() {
		$ajax = array(
			'crazyblog_download_plugin' => 'crazyblog_download_plugin_response',
			'crazyblog_activate_plugin' => 'crazyblog_activate_plugin_response',
			'crazyblog_update_plugin' => 'crazyblog_update_plugin_response',
			'crazyblog_installDemo' => 'crazyblog_installDemo',
			'crazyblog_installTheme' => 'crazyblog_installTheme',
			'crazyblog_dimissNotice' => 'crazyblog_dimissNotice',
		);

		foreach ( $ajax as $name => $request ) {
			add_action( "wp_ajax_nopriv_{$name}", array( 'crazyblog_AjaxResponse', $request ) );
			add_action( "wp_ajax_{$name}", array( 'crazyblog_AjaxResponse', $request ) );
		}
	}

}
