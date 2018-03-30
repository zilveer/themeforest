<?php

/*
 * Load defaults theme settings
 */

//add_action('after_switch_theme', 'wpgrade_load_theme_defaults');

function wpgrade_load_theme_defaults(){

    $theme_options = get_option(wpgrade::shortname().'_options');

    // Remember to encode in base64 if you want to change this default
     $defaults = 'IyMjYTo5Mzp7czo4OiJsYXN0X3RhYiI7czoyOiIxMiI7czoxNzoidXNlX3Ntb290aF9zY3Jvb2wiO3M6MToiMSI7czo5OiJtYWluX2xvZ28iO3M6MDoiIjtzOjE1OiJtYWluX3NtYWxsX2xvZ28iO3M6MDoiIjtzOjE2OiJyZXRpbmFfbWFpbl9sb2dvIjtzOjA6IiI7czo3OiJmYXZpY29uIjtzOjA6IiI7czoxNjoiYXBwbGVfdG91Y2hfaWNvbiI7czowOiIiO3M6MTA6Im1ldHJvX2ljb24iO3M6MDoiIjtzOjE2OiJnb29nbGVfYW5hbHl0aWNzIjtzOjA6IiI7czoxMDoibWFpbl9jb2xvciI7czo3OiIjZWUzNDMwIjtzOjE2OiJnb29nbGVfbWFpbl9mb250IjtzOjA6IiI7czoxNjoiZ29vZ2xlX2JvZHlfZm9udCI7czowOiIiO3M6MTY6Imdvb2dsZV9tZW51X2ZvbnQiO3M6MDoiIjtzOjEwOiJjdXN0b21fY3NzIjtzOjA6IiI7czo5OiJjdXN0b21fanMiO3M6MDoiIjtzOjEyOiJoZWFkZXJfZml4ZWQiO3M6MToiMSI7czoyMzoibm9jb250ZW50X2hlYWRlcl9oZWlnaHQiO3M6MzoiNDAwIjtzOjIyOiJ1c2VfZm9vdGVyX3R3aXR0ZXJfYm94IjtzOjE6IjEiO3M6MTc6ImZvb3Rlcl90d2l0dGVyX2lkIjtzOjc6InR3aXR0ZXIiO3M6MjA6ImZvb3Rlcl90d2l0dGVyX2NvdW50IjtzOjE6IjMiO3M6MjA6ImZvb3Rlcl90d2l0dGVyX3RpdGxlIjtzOjIwOiJGb2xsb3cgVXMgb24gVHdpdHRlciI7czoxNDoiY29weXJpZ2h0X3RleHQiO3M6NDM6IkNvcHlyaWdodCAyMDEzIENpdHlodWIgQWxsIFJpZ2h0cyBSZXNlcnZlZC4iO3M6MjE6ImRvX3NvY2lhbF9mb290ZXJfbWVudSI7czoxOiIxIjtzOjE5OiJob21lcGFnZV91c2Vfc2xpZGVyIjtzOjE6IjEiO3M6MjE6ImhvbWVwYWdlX3NsaWRlcl9zcGVlZCI7czo0OiI3MDAwIjtzOjI2OiJob21lcGFnZV9zbGlkZXJfZnVsbHNjcmVlbiI7czoxOiIxIjtzOjIyOiJob21lcGFnZV9zbGlkZXJfaGVpZ2h0IjtzOjA6IiI7czozMToiaG9tZXBhZ2Vfc2xpZGVyX2FuaW1hdGlvbl9zcGVlZCI7czo0OiIxMDAwIjtzOjI4OiJob21lcGFnZV9zbGlkZXJfZGlyZWN0aW9ubmF2IjtzOjE6IjEiO3M6MTc6ImhvbWVwYWdlX2NvbnRlbnQxIjtzOjMxOToiPGgxIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7Ij5Db25ncmF0dWxhdGlvbnMhPC9oMT4KPGgzIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7Ij5Zb3VyIHNpdGUgaXMganVzdCBhcm91bmQgdGhlIGNvcm5lci48L2gzPgombmJzcDsKPHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiPlN0YXJ0IGJ5IDxzdHJvbmc+PGEgaHJlZj0iaHR0cHM6Ly93d3cueW91dHViZS5jb20vd2F0Y2g/dj1QWHR0bHp6cFRWOCI+d2F0Y2hpbmcgdGhpcyB2aWRlbzwvYT48L3N0cm9uZz4gYWJvdXQgaG93IHRvIEluc3RhbGwgYW5kIFNldHVwIHRoaXMgdGhlbWUuPC9wPiI7czoxNzoidXNlX3NpdGVfd2lkZV9ib3giO3M6MToiMSI7czoxNzoic2l0ZV93aWRlX3NlY3Rpb24iO3M6NjU6IjxoMz5UaGlzIGlzIGEgc2l0ZS13aWRlIGNhbGwgdG8gYWN0aW9uISBTby4uLiBhY3Rpb24gcGxlYXNlITwvaDM+IjtzOjIyOiJzaXRlX3dpZGVfYnV0dG9uX2xhYmVsIjtzOjg6IkNsaWNrIE1lIjtzOjIxOiJzaXRlX3dpZGVfYnV0dG9uX2xpbmsiO3M6MToiIyI7czoyMjoiaG9tZXBhZ2VfdXNlX3BvcnRmb2xpbyI7czoxOiIxIjtzOjI0OiJob21lcGFnZV9wb3J0Zm9saW9fdGl0bGUiO3M6MTQ6IkZlYXR1cmVkIFdvcmtzIjtzOjIzOiJob21lcGFnZV9wb3J0Zm9saW9fbW9yZSI7czo0OiJNb3JlIjtzOjI0OiJob21lcGFnZV9wb3J0Zm9saW9fbGltaXQiO3M6MToiNSI7czoxNzoiaG9tZXBhZ2VfY29udGVudDIiO3M6NDU6IjxoMz5UaGlzIGlzIHlvdXIgc2Vjb25kYXJ5IGNvbnRlbnQgYXJlYSE8L2gzPiI7czoyMToiY29udGFjdF9zaWRlYmFyX3RpdGxlIjtzOjEyOiJHZXQgaW4gVG91Y2giO3M6MjA6ImNvbnRhY3RfY29udGVudF9sZWZ0IjtzOjE3MDoiSWYgeW91IGhhdmUgcXVlc3Rpb25zIG9yIGNvbW1lbnRzLCBwbGVhc2UgZ2V0IGEgaG9sZCBvZiB1cyBpbiB3aGljaGV2ZXIgd2F5IGlzIG1vc3QgY29udmVuaWVudC4KCkFzayBhd2F5LiBUaGVyZSBpcyBubyByZWFzb25hYmxlIHF1ZXN0aW9uIHRoYXQgb3VyIHRlYW0gY2FuIG5vdCBhbnN3ZXIuIjtzOjE4OiJjb250YWN0X2Zvcm1fdGl0bGUiO3M6MTI6IkNvbnRhY3QgRm9ybSI7czoxNDoiY29udGFjdF9mb3JtXzciO3M6MToiNCI7czoxMzoiY29udGFjdF9waG9uZSI7czowOiIiO3M6MTM6ImNvbnRhY3RfZW1haWwiO3M6MDoiIjtzOjE1OiJjb250YWN0X2FkZHJlc3MiO3M6MDoiIjtzOjE3OiJjb250YWN0X2dtYXBfbGluayI7czowOiIiO3M6MjU6ImNvbnRhY3RfZ21hcF9jdXN0b21fc3R5bGUiO3M6MToiMSI7czoxNToicG9ydGZvbGlvX3RpdGxlIjtzOjEzOiJPdXIgUHJvamVjdHMuIjtzOjIyOiJwb3J0Zm9saW9faGVhZGVyX2ltYWdlIjtzOjA6IiI7czoyNToicG9ydGZvbGlvX2hlYWRlcl9iZ19jb2xvciI7czo3OiIjMDAwMDAwIjtzOjMwOiJwb3J0Zm9saW9fY2F0ZWdvcnlfZGVzY3JpcHRpb24iO3M6MToiMSI7czoyMjoicG9ydGZvbGlvX3NpbmdsZV9sYWJlbCI7czo5OiJQb3J0Zm9saW8iO3M6MjI6InBvcnRmb2xpb19wbHVyYWxfbGFiZWwiO3M6ODoiUHJvamVjdHMiO3M6MjI6InBvcnRmb2xpb19yZXdyaXRlX3NsdWciO3M6MToiMSI7czoxNDoicG9ydGZvbGlvX3NsdWciO3M6OToicG9ydGZvbGlvIjtzOjIyOiJwb3J0Zm9saW9fYXJjaGl2ZV9zbHVnIjtzOjA6IiI7czozMToicG9ydGZvbGlvX2NhdGVnb3J5X3Jld3JpdGVfc2x1ZyI7czoxOiIxIjtzOjIzOiJwb3J0Zm9saW9fY2F0ZWdvcnlfc2x1ZyI7czoxODoicG9ydGZvbGlvLWNhdGVnb3J5IjtzOjE4OiJibG9nX2FyY2hpdmVfdGl0bGUiO3M6MTI6IkJsb2cgJiBOZXdzLiI7czoxNzoiYmxvZ19oZWFkZXJfaW1hZ2UiO3M6MDoiIjtzOjI0OiJibG9nX3Nob3dfZmVhdHVyZWRfaW1hZ2UiO3M6MToiMSI7czoxOToiYmxvZ19leGNlcnB0X2xlbmd0aCI7czozOiIxMDAiO3M6Mjg6ImJsb2dfc2luZ2xlX3Nob3dfc2hhcmVfbGlua3MiO3M6MToiMSI7czozMToiYmxvZ19zaW5nbGVfc2hhcmVfbGlua3NfdHdpdHRlciI7czoxOiIxIjtzOjMyOiJibG9nX3NpbmdsZV9zaGFyZV9saW5rc19mYWNlYm9vayI7czoxOiIxIjtzOjM0OiJibG9nX3NpbmdsZV9zaGFyZV9saW5rc19nb29nbGVwbHVzIjtzOjE6IjEiO3M6MjM6ImJsb2dfc2luZ2xlX3Nob3dfYXV0aG9yIjtzOjE6IjEiO3M6MjQ6InByZXBhcmVfZm9yX3NvY2lhbF9zaGFyZSI7czoxOiIxIjtzOjE1OiJmYWNlYm9va19pZF9hcHAiO3M6MDoiIjtzOjE3OiJmYWNlYm9va19hZG1pbl9pZCI7czowOiIiO3M6MTU6Imdvb2dsZV9wYWdlX3VybCI7czowOiIiO3M6MTc6InR3aXR0ZXJfY2FyZF9zaXRlIjtzOjA6IiI7czoyNjoic29jaWFsX3NoYXJlX2RlZmF1bHRfaW1hZ2UiO3M6MDoiIjtzOjE4OiJ1c2VfdHdpdHRlcl93aWRnZXQiO3M6MToiMSI7czoyMDoidHdpdHRlcl9jb25zdW1lcl9rZXkiO3M6MjE6IlVHY2lVa1B3akRwQ1J5RXFjR3NiZyI7czoyMzoidHdpdHRlcl9jb25zdW1lcl9zZWNyZXQiO3M6NDI6Im51SGtxUkx4S1RFSXNUSHVPanIxWFg1WVpZZXRFUjZIRjdwS3hrVjExRSI7czoyNjoidHdpdHRlcl9vYXV0aF9hY2Nlc3NfdG9rZW4iO3M6NTA6IjIwNTgxMzAxMS1vTHlnaFJ3cVJOSGJaU2hPaW1sR0tmQTZCSTRoazNLUkJXcWxEWUlYIjtzOjMzOiJ0d2l0dGVyX29hdXRoX2FjY2Vzc190b2tlbl9zZWNyZXQiO3M6NDM6IjRMcWxaamY3akRxbXhxWFFqYzZNeUl1dEhDWFBTdElhM1R2RUhYOU5FWXciO3M6MTI6InNvY2lhbF9pY29ucyI7YToxMzp7czo3OiJ0d2l0dGVyIjtzOjA6IiI7czo4OiJmYWNlYm9vayI7czowOiIiO3M6NToiZ3BsdXMiO3M6MDoiIjtzOjU6InNreXBlIjtzOjA6IiI7czo4OiJsaW5rZWRpbiI7czowOiIiO3M6NzoieW91dHViZSI7czowOiIiO3M6NToidmltZW8iO3M6MDoiIjtzOjk6Imluc3RhZ3JhbSI7czowOiIiO3M6NjoiZmxpY2tyIjtzOjA6IiI7czo5OiJwaW50ZXJlc3QiO3M6MDoiIjtzOjY6InR1bWJsciI7czowOiIiO3M6NjoibGFzdGZtIjtzOjA6IiI7czo2OiJhcHBuZXQiO3M6MDoiIjt9czoyNToic29jaWFsX2ljb25zX3RhcmdldF9ibGFuayI7czoxOiIxIjtzOjE5OiJ0aGVtZWZvcmVzdF91cGdyYWRlIjtzOjE6IjEiO3M6MjA6Im1hcmtldHBsYWNlX3VzZXJuYW1lIjtzOjA6IiI7czoxOToibWFya2V0cGxhY2VfYXBpX2tleSI7czowOiIiO3M6MTU6InVzZV9yZXRpbmFfbG9nbyI7aTowO3M6MTY6InVzZV9nb29nbGVfZm9udHMiO2k6MDtzOjI1OiJkaXNwbGF5X2N1c3RvbV9jc3NfaW5saW5lIjtpOjA7czoxNjoiY29udGFjdF91c2VfZ21hcCI7aTowO3M6MzA6InBvcnRmb2xpb19yZXdyaXRlX2FyY2hpdmVfc2x1ZyI7aTowO3M6MTg6InBvcnRmb2xpb191c2VfdGFncyI7aTowO3M6MzE6ImJsb2dfc2luZ2xlX3Nob3dfY29tbWVudHNfdGl0bGUiO2k6MDtzOjk6Im5hdl9tZW51cyI7YToxOntzOjk6Im1haW5fbWVudSI7czoxMToiSGVhZGVyIE1lbnUiO31zOjE3OiJyZWR1eC1vcHRzLWJhY2t1cCI7czoxOiIxIjt9IyMj';

    $imported_options = unserialize(trim(base64_decode( $defaults ),'###'));

    if ( empty($theme_options) || !isset($theme_options["last_tab"] )) { // load options only first time
         update_option(wpgrade::shortname().'_options', $imported_options );
    }
}

//add_action('after_switch_theme', 'wpgrade_import_footer_widgets');
function wpgrade_import_footer_widgets(){

    /*
    * Footer widgets
    */

    $sidebars_widgets = get_option("sidebars_widgets");

    if (  isset( $sidebars_widgets["sidebar-footer"] ) && empty( $sidebars_widgets["sidebar-footer"] ) ) {
		$sidebars_widgets["sidebar-footer"] = generate_default_footer_widgets();
        update_option("sidebars_widgets", $sidebars_widgets);
    }
}

function generate_default_footer_widgets(){

    $text_widgets = get_option( "widget_text" );
    $text_widget_count = count($text_widgets);

    $recent_posts_widgets = get_option("widget_recent-posts");
    $recent_count = count($recent_posts_widgets);

    $recent_posts = '';

    $new_recent_posts_widget[(int)$recent_count+1] = array (
            'title' => 'From the Blog',
            'number' => 4,
            'show_date' => true,
        );

    if ( update_option("widget_recent-posts", $new_recent_posts_widget) ) {
        $recent_posts = 'recent-posts-'.(string)((int)$recent_count+1);

    }

    $wtext1 = '';
    $the_widget_text1 = array(
        'title' => "Widget Area",
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae felis eu diam ullamcorper hendrerit. Aliquam tempus ultrices enim, ac consectetur nibh lacinia eu.',
        'filter' => false,
    );
    $wtext2 = '';
    $the_widget_text2 = array(
         'title' => "Widget Area",
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae felis eu diam ullamcorper hendrerit. Aliquam tempus ultrices enim, ac consectetur nibh lacinia eu.',
        'filter' => false,
    );

    if ( empty( $text_widgets ) ) {

        $new_widget[2] = $the_widget_text1;
        $new_widget[3] = $the_widget_text2;

        if ( update_option( "widget_text", $new_widget ) ){

            $wtext1 = 'text-2';
            $wtext2 = 'text-3';
        }

    } else {

        $text_widgets[ $text_widget_count+1 ] = $the_widget_text1;
        $text_widgets[ $text_widget_count+2 ] = $the_widget_text2;

        if ( update_option( "widget_text", $text_widgets ) ){
            $wtext1 = 'text-'.(string)($text_widget_count+1);
            $wtext2 = 'text-'.(string)($text_widget_count+2);
        }
    }

    $new_social_links_widget[2] = array (
            'title' => ''
    );
    $ks_socials = '';
    if ( update_option("widget_wpgrade_social_links", $new_social_links_widget) ) {
        $ks_socials = 'ks_social_links-2';
    }

    if ( !empty( $wtext1 ) && !empty( $wtext2 ) && !empty( $recent_posts ) && !empty( $ks_socials ) ){
        return array( $wtext1, $recent_posts,$wtext2,$ks_socials );
    } else {
        return false;
    }

}