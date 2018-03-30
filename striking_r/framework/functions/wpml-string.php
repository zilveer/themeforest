<?php
wpml_register_string( THEME_NAME , 'Logo Image Source', json_encode(theme_get_option('general','logo')));

wpml_register_string( THEME_NAME , 'Logo Image Source For Mobile Devices', json_encode(theme_get_option('general','mobile_logo')));

wpml_register_string( THEME_NAME , 'Top Area Html Code', stripslashes(theme_get_option('general','top_area_html')));

wpml_register_string( THEME_NAME , 'Portfolio More Button Text', theme_get_option('portfolio','more_button_text'));

wpml_register_string( THEME_NAME , 'Portfolio Sortable Show Text', theme_get_option('portfolio','show_text'));

wpml_register_string( THEME_NAME , 'Copyright Footer Text', stripslashes(theme_get_option('footer','copyright')));

wpml_register_string( THEME_NAME , 'Footer Right Area Html Code', stripslashes(theme_get_option('footer','footer_right_area_html')));

wpml_register_string( THEME_NAME , 'Social Icon Widget Alt Title', __('Follow Us on','striking-r'));

wpml_register_string( THEME_NAME , 'Blog Post Read More Button Text', stripslashes(theme_get_option('blog','read_more_text')));

wpml_register_string( THEME_NAME , 'Category Archive Title', stripslashes(theme_get_option('advanced','category_title')));
wpml_register_string( THEME_NAME , 'Tag Archive Title', stripslashes(theme_get_option('advanced','tag_title')));
wpml_register_string( THEME_NAME , 'Daily Archive Title', stripslashes(theme_get_option('advanced','daily_title')));
wpml_register_string( THEME_NAME , 'Monthly Archive Title', stripslashes(theme_get_option('advanced','monthly_title')));
wpml_register_string( THEME_NAME , 'Weekly Archive Title', stripslashes(theme_get_option('advanced','weekly_title')));
wpml_register_string( THEME_NAME , 'Yearly Archive Title', stripslashes(theme_get_option('advanced','yearly_title')));
wpml_register_string( THEME_NAME , 'Author Archive Title', stripslashes(theme_get_option('advanced','author_title')));
wpml_register_string( THEME_NAME , 'Blog Archive Title', stripslashes(theme_get_option('advanced','blog_title')));
wpml_register_string( THEME_NAME , 'Taxonomy Archive Title', stripslashes(theme_get_option('advanced','taxonomy_title')));
wpml_register_string( THEME_NAME , '404 Page Title', stripslashes(theme_get_option('advanced','404_title')));
wpml_register_string( THEME_NAME , 'Search Page Title', stripslashes(theme_get_option('advanced','search_title')));

wpml_register_string( THEME_NAME , 'Category Archive Text', stripslashes(theme_get_option('advanced','category_text')));
wpml_register_string( THEME_NAME , 'Tag Archive Text', stripslashes(theme_get_option('advanced','tag_text')));
wpml_register_string( THEME_NAME , 'Daily Archive Text', stripslashes(theme_get_option('advanced','daily_text')));
wpml_register_string( THEME_NAME , 'Monthly Archive Text', stripslashes(theme_get_option('advanced','monthly_text')));
wpml_register_string( THEME_NAME , 'Weekly Archive Text', stripslashes(theme_get_option('advanced','weekly_text')));
wpml_register_string( THEME_NAME , 'Yearly Archive Text', stripslashes(theme_get_option('advanced','yearly_text')));
wpml_register_string( THEME_NAME , 'Author Archive Text', stripslashes(theme_get_option('advanced','author_text')));
wpml_register_string( THEME_NAME , 'Blog Archive Text', stripslashes(theme_get_option('advanced','blog_text')));
wpml_register_string( THEME_NAME , 'Taxonomy Archive Text', stripslashes(theme_get_option('advanced','taxonomy_text')));
wpml_register_string( THEME_NAME , '404 Page Text', stripslashes(theme_get_option('advanced','404_text')));
wpml_register_string( THEME_NAME , 'Search Page Text', stripslashes(theme_get_option('advanced','search_text')));
wpml_register_string( THEME_NAME , 'Search Nothing Found Text', stripslashes(theme_get_option('advanced','search_nothing_found')));

wpml_register_string( THEME_NAME , 'Select Menu Default Text', stripslashes(theme_get_option('advanced','nav2select_defaultText')));
wpml_register_string( THEME_NAME , 'Select Menu Item Indent String', stripslashes(theme_get_option('advanced','nav2select_indentString')));

wpml_register_string( THEME_NAME , 'Portfolio Permalink Slug', theme_get_option('portfolio','permalink_slug'));

$archives = get_post_types(array(
  'public'   => true,
  '_builtin' => false,
  'show_ui'=> true,
),'objects');
if ($archives) {
	foreach ($archives  as $archive ) {
		wpml_register_string( THEME_NAME , $archive->name.' Post Type Archive Title', stripslashes(theme_get_option('advanced','archive_'.$archive->name.'_title')));
		wpml_register_string( THEME_NAME , $archive->name.' Post Type Archive Text', stripslashes(theme_get_option('advanced','archive_'.$archive->name.'_text')));
	}
}
$taxonomies=get_taxonomies(array(
	'public'   => true,
	'_builtin' => false,
	'show_ui'=> true,
),'objects');
if ($taxonomies) {
	foreach ($taxonomies  as $taxonomy ) {
		wpml_register_string( THEME_NAME , $taxonomy->name.' Taxonomy Archive Title', stripslashes(theme_get_option('advanced','taxonomy_'.$taxonomy->name.'_title')));
		wpml_register_string( THEME_NAME , $taxonomy->name.' Taxonomy Archive Text', stripslashes(theme_get_option('advanced','taxonomy_'.$taxonomy->name.'_text')));
	}
}
