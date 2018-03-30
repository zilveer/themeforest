<?php

$meta_boxes = array(
	'title' => sprintf( __( '%1$s SEO', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'mysite_post_seo_meta_box',
	'pages' => mysite_seo_posttypecolumns(),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
		array(
			'name' => __( 'Title', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The title display in search engines is limited to 70 chars. If the SEO title is empty the title will be generated based on your title template in your SEO settings.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_seo_title',
			'type' => 'text'
		),
		array(
			'name' => __( 'Description', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The meta description will be limited to 140 chars. If the meta description is empty the description will be generated based on your meta description options in your SEO settings.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_seo_description',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Keywords (comma separated)', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Add any additional keywords here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_seo_keywords',
			'type' => 'text'
		),
		array(
			'name' => __( 'Disable on this page/post', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Disable all SEO settings on this page.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_seo_disable',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		)
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>