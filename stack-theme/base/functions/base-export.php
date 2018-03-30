<?php

add_action('rss2_head','Base_Export::custom_export');

class Base_Export {	
	const OPEN_TAG = '<wg_export><![CDATA[';
	const CLOSE_TAG = ']]></wg_export>';

	private static function getWidgetsConf() {
		$sidebars_widgets = get_option('sidebars_widgets');
		$widgets_options = array();
		foreach($sidebars_widgets as $sidebar => $widgets){
			if(is_array($widgets)){
				foreach($widgets as $name){
					$name = preg_replace('/-\d+$/','',$name);
					$widgets_options[$name] = get_option("widget_$name");
				}
			}
		}
		$conf['sidebar'] = $sidebars_widgets;
		$conf['options'] =& $widgets_options;
		return $conf;
	}

	private static function printfAttachmentUrlMapping() {
		$args = array(
			'post_type' => 'attachment',
			'numberposts' => -1,
			'suppress_filters'  => 0,
		); 
		$attachments = get_posts($args);
		if ($attachments) {
			printf ("\t<wg_custom_attachment_url>\n");
			foreach ($attachments as $attachment) {
				printf ("\t\t<attachment>\n");
				printf ("\t\t\t<post_id>%s</post_id>\n", $attachment->ID);
				printf ("\t\t\t<post_name>%s</post_name>\n", $attachment->post_name);
				printf ("\t\t\t<attachment_url>%s</attachment_url>\n", wp_get_attachment_url($attachment->ID));
				printf ("\t\t\t<custom_url>%s</custom_url>\n", preg_replace( '/.*[\/\\\\]/', '', get_attached_file( $attachment->ID ) ) );
				printf ("\t\t</attachment>\n");
			}
			printf ("\t</wg_custom_attachment_url>\n");
		}
	}

	public static function custom_export(){
		$config['theme_options'] = theme_options();
		$config['widgets'] = Base_Export::getWidgetsConf();
		Base_Export::printfAttachmentUrlMapping();
		printf('%s'.Base_Export::OPEN_TAG.'%s'.Base_Export::CLOSE_TAG,"\t",base64_encode(serialize($config)));
	}
}

?>