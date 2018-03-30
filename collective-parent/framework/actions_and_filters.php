<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

add_action('wp_ajax_change_gallery_id', 'change_gallery_id');
function change_gallery_id() {
    if (!tf_current_user_can(array('manage_options', 'edit_posts', 'tf_admin_boutique'), false))
        return false;

    global $TFUSE;

    $post_id   = $TFUSE->request->REQUEST('post_id');
    if(!tfuse_parse_boolean($TFUSE->request->REQUEST('change'))) {echo json_encode(array('id'=> $post_id));die;}
    $id        = $TFUSE->request->REQUEST('input_id');
    $media     = $TFUSE->request->REQUEST('media');

    $_token    = (trim($id) != '') ? $id . '_' . $post_id : $post_id;
    $post_fnc  = ($media == 'image') ? 'tfuse_gallery_group_post' : 'tfuse_download_group_post';
    $post_type = str_replace('_post', '', $post_fnc);
    $post      = get_post($post_id);
    if ($post->post_type != $post_type)
        $post_id = $post_fnc($_token);
    echo json_encode(array('id'=> $post_id));
    die;
}

/**
 * 'Exclude from slider' and 'Set as main' checkboxes for attachment
 */
{
    add_filter('attachment_fields_to_edit', 'media_galery_image_edit', 11, 2);
    function media_galery_image_edit($form_fields, $post) {
        $content = get_post_meta($post->ID,'image_options',true);

        $form_fields['tfseek_exclude_slider'] = array(
            'label' => __('Exclude from slider', 'tfuse'),
            'input' => 'html',
            'html'  => '<label for="imgexcludefromslider_check"><input id="imgexcludefromslider_check" type="checkbox" ' . (@$content['imgexcludefromslider_check'] ? 'checked' : '') . ' value="yes" name="imgexcludefromslider_check_'.$post->ID.'"/> <span>' . __('Yes', 'tfuse') . '</span></label>'
        );

        $form_fields['tfseek_main'] = array(
            'label' => __('Set as main', 'tfuse'),
            'input' => 'html',
            'html'  => '<label for="imgmain_check"><input id="imgmain_check" type="checkbox" ' . (@$content['imgmain_check']== 'yes'? 'checked' : '') . ' value="yes" name="imgmain_check_'.$post->ID.'"/> <span>' . __('Yes', 'tfuse') . '</span></label>'
        );

        return $form_fields;
    }

    add_filter('attachment_fields_to_save', 'media_galery_image_save', 11, 2);
    function media_galery_image_save($post, $attachment) {
        global $TFUSE;

        $a = array();
        if($TFUSE->request->isset_POST('imgexcludefromslider_check_'.$post['ID']))
            $a['imgexcludefromslider_check'] = $TFUSE->request->POST('imgexcludefromslider_check_'.$post['ID']);
        if($TFUSE->request->isset_POST('imgmain_check_'.$post['ID']))
            $a['imgmain_check'] = $TFUSE->request->POST('imgmain_check_'.$post['ID']);
        tf_update_post_meta($post['ID'],'image_options',$a);

        return $post;
    }
}

add_filter('media_upload_tabs', 'remove_media_tabs');
function remove_media_tabs($tabs) {
    global $TFUSE;

    if ($TFUSE->request->isset_REQUEST('no_tabs')) {
        unset($tabs['library']);
        unset($tabs['type_url']);
    }

    return $tabs;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'tfuse_formatter', 99);
add_filter('themefuse_shortcodes', 'tfuse_formatter', 99);
function tfuse_formatter($content) {
    $new_content      = '';
    $pattern_full     = '{(\[raw\].*?\[/raw\])}is';
    $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
    $pieces           = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

    foreach ($pieces as $piece) {
        if (preg_match($pattern_contents, $piece, $matches)) {
            $new_content .= $matches[1];
        } else {
            $new_content .= wptexturize(wpautop($piece));
        }
    }
    return $new_content;
}

add_action('wp_head', 'tfuse_favicon_and_css');
function tfuse_favicon_and_css() {
    // Favicon
    $favicon = tfuse_options('favicon');
    if (!empty($favicon))
        echo '<link rel="shortcut icon" href="' . $favicon . '"/>' . PHP_EOL;

    // Custom CSS block in header
    $custom_css = tfuse_options('custom_css');
    if (!empty($custom_css)) {
        $output = '<style type="text/css">' . PHP_EOL;
        $output .= html_entity_decode($custom_css);
        $output .= '</style>' . PHP_EOL;
        echo $output;
    }
}

add_action('wp_footer', 'tfuse_analytics', 100);
function tfuse_analytics() {
    echo tfuse_options('google_analytics');
}

{
    // Available Google webfont names
    $google_fonts = array(	array( 'name' => "Cantarell", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Cardo", 'variant' => ''),
        array( 'name' => "Crimson Text", 'variant' => ''),
        array( 'name' => "Droid Sans", 'variant' => ':r,b'),
        array( 'name' => "Droid Sans Mono", 'variant' => ''),
        array( 'name' => "Droid Serif", 'variant' => ':r,b,i,bi'),
        array( 'name' => "IM Fell DW Pica", 'variant' => ':r,i'),
        array( 'name' => "Inconsolata", 'variant' => ''),
        array( 'name' => "Josefin Sans", 'variant' => ':400,400italic,700,700italic'),
        array( 'name' => "Josefin Slab", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Lobster", 'variant' => ''),
        array( 'name' => "Molengo", 'variant' => ''),
        array( 'name' => "Nobile", 'variant' => ':r,b,i,bi'),
        array( 'name' => "OFL Sorts Mill Goudy TT", 'variant' => ':r,i'),
        array( 'name' => "Old Standard TT", 'variant' => ':r,b,i'),
        array( 'name' => "Reenie Beanie", 'variant' => ''),
        array( 'name' => "Tangerine", 'variant' => ':r,b'),
        array( 'name' => "Vollkorn", 'variant' => ':r,b'),
        array( 'name' => "Yanone Kaffeesatz", 'variant' => ':r,b'),
        array( 'name' => "Cuprum", 'variant' => ''),
        array( 'name' => "Neucha", 'variant' => ''),
        array( 'name' => "Neuton", 'variant' => ''),
        array( 'name' => "PT Sans", 'variant' => ':r,b,i,bi'),
        array( 'name' => "PT Sans Caption", 'variant' => ':r,b'),
        array( 'name' => "PT Sans Narrow", 'variant' => ':r,b'),
        array( 'name' => "Philosopher", 'variant' => ''),
        array( 'name' => "Allerta", 'variant' => ''),
        array( 'name' => "Allerta Stencil", 'variant' => ''),
        array( 'name' => "Arimo", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Arvo", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Bentham", 'variant' => ''),
        array( 'name' => "Coda", 'variant' => ':800'),
        array( 'name' => "Cousine", 'variant' => ''),
        array( 'name' => "Covered By Your Grace", 'variant' => ''),
        array( 'name' => "Geo", 'variant' => ''),
        array( 'name' => "Just Me Again Down Here", 'variant' => ''),
        array( 'name' => "Puritan", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Raleway", 'variant' => ':100'),
        array( 'name' => "Tinos", 'variant' => ':r,b,i,bi'),
        array( 'name' => "UnifrakturCook", 'variant' => ':bold'),
        array( 'name' => "UnifrakturMaguntia", 'variant' => ''),
        array( 'name' => "Mountains of Christmas", 'variant' => ''),
        array( 'name' => "Lato", 'variant' => ':400,700,400italic'),
        array( 'name' => "Orbitron", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Allan", 'variant' => ':bold'),
        array( 'name' => "Anonymous Pro", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Copse", 'variant' => ''),
        array( 'name' => "Kenia", 'variant' => ''),
        array( 'name' => "Ubuntu", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Vibur", 'variant' => ''),
        array( 'name' => "Sniglet", 'variant' => ':800'),
        array( 'name' => "Syncopate", 'variant' => ''),
        array( 'name' => "Cabin", 'variant' => ':400,400italic,700,700italic,'),
        array( 'name' => "Merriweather", 'variant' => ''),
        array( 'name' => "Maiden Orange", 'variant' => ''),
        array( 'name' => "Just Another Hand", 'variant' => ''),
        array( 'name' => "Kristi", 'variant' => ''),
        array( 'name' => "Corben", 'variant' => ':b'),
        array( 'name' => "Gruppo", 'variant' => ''),
        array( 'name' => "Buda", 'variant' => ':light'),
        array( 'name' => "Lekton", 'variant' => ''),
        array( 'name' => "Luckiest Guy", 'variant' => ''),
        array( 'name' => "Crushed", 'variant' => ''),
        array( 'name' => "Chewy", 'variant' => ''),
        array( 'name' => "Coming Soon", 'variant' => ''),
        array( 'name' => "Crafty Girls", 'variant' => ''),
        array( 'name' => "Fontdiner Swanky", 'variant' => ''),
        array( 'name' => "Permanent Marker", 'variant' => ''),
        array( 'name' => "Rock Salt", 'variant' => ''),
        array( 'name' => "Sunshiney", 'variant' => ''),
        array( 'name' => "Unkempt", 'variant' => ''),
        array( 'name' => "Calligraffitti", 'variant' => ''),
        array( 'name' => "Cherry Cream Soda", 'variant' => ''),
        array( 'name' => "Homemade Apple", 'variant' => ''),
        array( 'name' => "Irish Growler", 'variant' => ''),
        array( 'name' => "Kranky", 'variant' => ''),
        array( 'name' => "Schoolbell", 'variant' => ''),
        array( 'name' => "Slackey", 'variant' => ''),
        array( 'name' => "Walter Turncoat", 'variant' => ''),
        array( 'name' => "Radley", 'variant' => ''),
        array( 'name' => "Meddon", 'variant' => ''),
        array( 'name' => "Kreon", 'variant' => ':r,b'),
        array( 'name' => "Dancing Script", 'variant' => ''),
        array( 'name' => "Goudy Bookletter 1911", 'variant' => ''),
        array( 'name' => "PT Serif Caption", 'variant' => ':r,i'),
        array( 'name' => "PT Serif", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Astloch", 'variant' => ':b'),
        array( 'name' => "Bevan", 'variant' => ''),
        array( 'name' => "Anton", 'variant' => ''),
        array( 'name' => "Expletus Sans", 'variant' => ':b'),
        array( 'name' => "VT323", 'variant' => ''),
        array( 'name' => "Pacifico", 'variant' => ''),
        array( 'name' => "Candal", 'variant' => ''),
        array( 'name' => "Architects Daughter", 'variant' => ''),
        array( 'name' => "Indie Flower", 'variant' => ''),
        array( 'name' => "League Script", 'variant' => ''),
        array( 'name' => "Quattrocento", 'variant' => ''),
        array( 'name' => "Amaranth", 'variant' => ''),
        array( 'name' => "Irish Grover", 'variant' => ''),
        array( 'name' => "Oswald", 'variant' => ':400,300,700'),
        array( 'name' => "EB Garamond", 'variant' => ''),
        array( 'name' => "Nova Round", 'variant' => ''),
        array( 'name' => "Nova Slim", 'variant' => ''),
        array( 'name' => "Nova Script", 'variant' => ''),
        array( 'name' => "Nova Cut", 'variant' => ''),
        array( 'name' => "Nova Mono", 'variant' => ''),
        array( 'name' => "Nova Oval", 'variant' => ''),
        array( 'name' => "Nova Flat", 'variant' => ''),
        array( 'name' => "Terminal Dosis Light", 'variant' => ''),
        array( 'name' => "Michroma", 'variant' => ''),
        array( 'name' => "Miltonian", 'variant' => ''),
        array( 'name' => "Miltonian Tattoo", 'variant' => ''),
        array( 'name' => "Annie Use Your Telescope", 'variant' => ''),
        array( 'name' => "Dawning of a New Day", 'variant' => ''),
        array( 'name' => "Sue Ellen Francisco", 'variant' => ''),
        array( 'name' => "Waiting for the Sunrise", 'variant' => ''),
        array( 'name' => "Special Elite", 'variant' => ''),
        array( 'name' => "Quattrocento Sans", 'variant' => ''),
        array( 'name' => "Smythe", 'variant' => ''),
        array( 'name' => "The Girl Next Door", 'variant' => ''),
        array( 'name' => "Aclonica", 'variant' => ''),
        array( 'name' => "News Cycle", 'variant' => ''),
        array( 'name' => "Damion", 'variant' => ''),
        array( 'name' => "Wallpoet", 'variant' => ''),
        array( 'name' => "Over the Rainbow", 'variant' => ''),
        array( 'name' => "MedievalSharp", 'variant' => ''),
        array( 'name' => "Six Caps", 'variant' => ''),
        array( 'name' => "Swanky and Moo Moo", 'variant' => ''),
        array( 'name' => "Bigshot One", 'variant' => ''),
        array( 'name' => "Francois One", 'variant' => ''),
        array( 'name' => "Sigmar One", 'variant' => ''),
        array( 'name' => "Carter One", 'variant' => ''),
        array( 'name' => "Holtwood One SC", 'variant' => ''),
        array( 'name' => "Paytone One", 'variant' => ''),
        array( 'name' => "Monofett", 'variant' => ''),
        array( 'name' => "Rokkitt", 'variant' => ':400,700'),
        array( 'name' => "Megrim", 'variant' => ''),
        array( 'name' => "Judson", 'variant' => ':r,ri,b'),
        array( 'name' => "Didact Gothic", 'variant' => ''),
        array( 'name' => "Play", 'variant' => ':r,b'),
        array( 'name' => "Ultra", 'variant' => ''),
        array( 'name' => "Metrophobic", 'variant' => ''),
        array( 'name' => "Mako", 'variant' => ''),
        array( 'name' => "Shanti", 'variant' => ''),
        array( 'name' => "Caudex", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Jura", 'variant' => ''),
        array( 'name' => "Ruslan Display", 'variant' => ''),
        array( 'name' => "Brawler", 'variant' => ''),
        array( 'name' => "Nunito", 'variant' => ''),
        array( 'name' => "Wire One", 'variant' => ''),
        array( 'name' => "Podkova", 'variant' => ''),
        array( 'name' => "Muli", 'variant' => ''),
        array( 'name' => "Maven Pro", 'variant' => ':400,500,700'),
        array( 'name' => "Tenor Sans", 'variant' => ''),
        array( 'name' => "Limelight", 'variant' => ''),
        array( 'name' => "Playfair Display", 'variant' => ''),
        array( 'name' => "Artifika", 'variant' => ''),
        array( 'name' => "Lora", 'variant' => ''),
        array( 'name' => "Kameron", 'variant' => ':r,b'),
        array( 'name' => "Cedarville Cursive", 'variant' => ''),
        array( 'name' => "Zeyada", 'variant' => ''),
        array( 'name' => "La Belle Aurore", 'variant' => ''),
        array( 'name' => "Shadows Into Light", 'variant' => ''),
        array( 'name' => "Lobster Two", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Nixie One", 'variant' => ''),
        array( 'name' => "Redressed", 'variant' => ''),
        array( 'name' => "Bangers", 'variant' => ''),
        array( 'name' => "Open Sans Condensed", 'variant' => ':300italic,400italic,700italic,400,300,700'),
        array( 'name' => "Open Sans", 'variant' => ':r,i,b,bi'),
        array( 'name' => "Varela", 'variant' => ''),
        array( 'name' => "Goblin One", 'variant' => ''),
        array( 'name' => "Asset", 'variant' => ''),
        array( 'name' => "Gravitas One", 'variant' => ''),
        array( 'name' => "Hammersmith One", 'variant' => ''),
        array( 'name' => "Stardos Stencil", 'variant' => ''),
        array( 'name' => "Love Ya Like A Sister", 'variant' => ''),
        array( 'name' => "Loved by the King", 'variant' => ''),
        array( 'name' => "Bowlby One SC", 'variant' => ''),
        array( 'name' => "Forum", 'variant' => ''),
        array( 'name' => "Patrick Hand", 'variant' => ''),
        array( 'name' => "Varela Round", 'variant' => ''),
        array( 'name' => "Yeseva One", 'variant' => ''),
        array( 'name' => "Give You Glory", 'variant' => ''),
        array( 'name' => "Modern Antiqua", 'variant' => ''),
        array( 'name' => "Bowlby One", 'variant' => ''),
        array( 'name' => "Tienne", 'variant' => ''),
        array( 'name' => "Istok Web", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Yellowtail", 'variant' => ''),
        array( 'name' => "Pompiere", 'variant' => ''),
        array( 'name' => "Unna", 'variant' => ''),
        array( 'name' => "Rosario", 'variant' => ''),
        array( 'name' => "Leckerli One", 'variant' => ''),
        array( 'name' => "Snippet", 'variant' => ''),
        array( 'name' => "Ovo", 'variant' => ''),
        array( 'name' => "IM Fell English", 'variant' => ':r,i'),
        array( 'name' => "IM Fell English SC", 'variant' => ''),
        array( 'name' => "Gloria Hallelujah", 'variant' => ''),
        array( 'name' => "Kelly Slab", 'variant' => ''),
        array( 'name' => "Black Ops One", 'variant' => ''),
        array( 'name' => "Carme", 'variant' => ''),
        array( 'name' => "Aubrey", 'variant' => ''),
        array( 'name' => "Federo", 'variant' => ''),
        array( 'name' => "Delius", 'variant' => ''),
        array( 'name' => "Rochester", 'variant' => ''),
        array( 'name' => "Rationale", 'variant' => ''),
        array( 'name' => "Abel", 'variant' => ''),
        array( 'name' => "Marvel", 'variant' => ':r,b,i,bi'),
        array( 'name' => "Actor", 'variant' => ''),
        array( 'name' => "Delius Swash Caps", 'variant' => ''),
        array( 'name' => "Smokum", 'variant' => ''),
        array( 'name' => "Tulpen One", 'variant' => ''),
        array( 'name' => "Coustard", 'variant' => ':r,b'),
        array( 'name' => "Andika", 'variant' => ''),
        array( 'name' => "Alice", 'variant' => ''),
        array( 'name' => "Questrial", 'variant' => ''),
        array( 'name' => "Comfortaa", 'variant' => ':r,b'),
        array( 'name' => "Geostar", 'variant' => ''),
        array( 'name' => "Geostar Fill", 'variant' => ''),
        array( 'name' => "Volkhov", 'variant' => ''),
        array( 'name' => "Voltaire", 'variant' => ''),
        array( 'name' => "Montez", 'variant' => ''),
        array( 'name' => "Short Stack", 'variant' => ''),
        array( 'name' => "Vidaloka", 'variant' => ''),
        array( 'name' => "Aldrich", 'variant' => ''),
        array( 'name' => "Numans", 'variant' => ''),
        array( 'name' => "Days One", 'variant' => ''),
        array( 'name' => "Gentium Book Basic", 'variant' => ''),
        array( 'name' => "Monoton", 'variant' => ''),
        array( 'name' => "Alike", 'variant' => ''),
        array( 'name' => "Delius Unicase", 'variant' => ''),
        array( 'name' => "Abril Fatface", 'variant' => ''),
        array( 'name' => "Dorsa", 'variant' => ''),
        array( 'name' => "Antic", 'variant' => ''),
        array( 'name' => "Passero One", 'variant' => ''),
        array( 'name' => "Fanwood Text", 'variant' => ''),
        array( 'name' => "Prociono", 'variant' => ''),
        array( 'name' => "Merienda One", 'variant' => ''),
        array( 'name' => "Changa One", 'variant' => ''),
        array( 'name' => "Julee", 'variant' => ''),
        array( 'name' => "Prata", 'variant' => ''),
        array( 'name' => "Adamina", 'variant' => ''),
        array( 'name' => "Sorts Mill Goudy", 'variant' => ''),
        array( 'name' => "Terminal Dosis", 'variant' => ''),
        array( 'name' => "Sansita One", 'variant' => ''),
        array( 'name' => "Chivo", 'variant' => ''),
        array( 'name' => "Spinnaker", 'variant' => ''),
        array( 'name' => "Poller One", 'variant' => ''),
        array( 'name' => "Alike Angular", 'variant' => ''),
        array( 'name' => "Gochi Hand", 'variant' => ''),
        array( 'name' => "Poly", 'variant' => ''),
        array( 'name' => "Andada", 'variant' => ''),
        array( 'name' => "Federant", 'variant' => ''),
        array( 'name' => "Ubuntu Condensed", 'variant' => ''),
        array( 'name' => "Ubuntu Mono", 'variant' => ''),
        array( 'name' => "Sancreek", 'variant' => ''),
        array( 'name' => "Coda", 'variant' => ''),
        array( 'name' => "Rancho", 'variant' => ''),
        array( 'name' => "Satisfy", 'variant' => ''),
        array( 'name' => "Pinyon Script", 'variant' => ''),
        array( 'name' => "Vast Shadow", 'variant' => ''),
        array( 'name' => "Marck Script", 'variant' => ''),
        array( 'name' => "Salsa", 'variant' => ''),
        array( 'name' => "Amatic SC", 'variant' => ''),
        array( 'name' => "Quicksand", 'variant' => ''),
        array( 'name' => "Linden Hill", 'variant' => ''),
        array( 'name' => "Corben", 'variant' => ''),
        array( 'name' => "Creepster Caps", 'variant' => ''),
        array( 'name' => "Butcherman Caps", 'variant' => ''),
        array( 'name' => "Eater Caps", 'variant' => ''),
        array( 'name' => "Nosifer Caps", 'variant' => ''),
        array( 'name' => "Atomic Age", 'variant' => ''),
        array( 'name' => "Contrail One", 'variant' => ''),
        array( 'name' => "Jockey One", 'variant' => ''),
        array( 'name' => "Cabin Sketch", 'variant' => ':r,b'),
        array( 'name' => "Cabin Condensed", 'variant' => ':r,b'),
        array( 'name' => "Fjord One", 'variant' => ''),
        array( 'name' => "Rametto One", 'variant' => ''),
        array( 'name' => "Mate", 'variant' => ':r,i'),
        array( 'name' => "Mate SC", 'variant' => ''),
        array( 'name' => "Arapey", 'variant' => ':r,i'),
        array( 'name' => "Supermercado One", 'variant' => ''),
        array( 'name' => "Petrona", 'variant' => ''),
        array( 'name' => "Lancelot", 'variant' => ''),
        array( 'name' => "Convergence", 'variant' => ''),
        array( 'name' => "Cutive", 'variant' => ''),
        array( 'name' => "Karla", 'variant' => ':400,400italic,700,700italic'),
        array( 'name' => "Bitter", 'variant' => ':r,i,b'),
        array( 'name' => "Asap", 'variant' => ':400,700,400italic,700italic'),
        array( 'name' => "Bree Serif", 'variant' => '')
    );

    class TF_Typography extends TF_TFUSE
    {
        public function __construct()
        {
            if(!is_admin()){
                add_action('wp_head', array($this, 'tfuse_load_google_fonts'), 1);
            }
        }

        public function tfuse_load_google_fonts()
        {
            global $google_fonts;
            $fonts = '';
            $output = '';
            $tfuse_options = tfuse_options();

            // Go through the options
            if ( !empty($tfuse_options['framework']) ) {
                foreach ( $tfuse_options['framework'] as $option ) {
                    // Check if option has "face" in array
                    if ( is_array($option) && isset($option['face']) ) {
                        // Go through the google font array
                        foreach ($google_fonts as $font) {
                            // Check if the google font name exists in the current "face" option
                            if ( $option['face'] == $font['name'] AND !strstr($fonts, $font['name']) ) {
                                // Add google font to output
                                $fonts .= $font['name'].$font['variant']."|";
                            } // End If Statement
                        } // End Foreach Loop
                    } // End If Statement
                } // End Foreach Loop

                // Output google font css in header
                if ( $fonts ) {
                    $fonts = str_replace( " ","+",$fonts);
                    $output .= "\n<!-- Google Webfonts -->\n";
                    $output .= '<link href="//fonts.googleapis.com/css?family=' . $fonts .'" rel="stylesheet" type="text/css" />'."\n";
                    $output = str_replace( '|"','"',$output);

                    echo $output;
                }
            }
        }
    }
    new TF_Typography();
}

/** multi_upload2 */
{
    class _TF_OPTIGEN_MULTI_UPLOAD2
    {
        private $post_type = 'tf_multi_upload2'; // max length is 20

        public function __construct()
        {
            add_action('wp_ajax_multi_upload2_get_temp_gallery_post_id',        array($this, 'ajax_get_temp_gallery_post_id'));
            add_action('wp_ajax_multi_upload2_get_temp_gallery_attachments',    array($this, 'ajax_get_temp_gallery_attachments'));
            add_action('init',                                                  array($this, 'action_init'));

            add_action('media_upload_image',                                    array($this, 'action_media_upload_image'));
            add_action('media_upload_gallery',                                  array($this, 'action_media_upload_gallery'));
            add_action('media_upload_library',                                  array($this, 'action_media_upload_library'));
        }

        public function action_init()
        {
            register_post_type($this->post_type, array(
                'labels' => array(
                    'name' => __('ThemeFuse Multi Upload2', 'tfuse'),
                ),
                'public'            => true,
                'show_ui'           => false,
                'capability_type'   => 'post',
                'hierarchical'      => false,
                'rewrite'           => false,
                'supports'          => array(),
                'query_var'         => false,
                'can_export'        => false,
                'show_in_nav_menus' => false
            ));
        }

        /**
         * Get gallery images uploaded in popup
         * and delete everything about temp post_id
         */
        public function ajax_get_temp_gallery_attachments()
        {
            if (!tf_current_user_can(array('manage_options', 'edit_posts', 'tf_admin_boutique'), false))
                return false;

            /** @var TF_TFUSE */
            global $TFUSE;

            $response = array(
                'status' => 0
            );

            do {
                $post_id = $TFUSE->request->POST('post_id');
                if (!is_numeric($post_id) || $post_id < 1)
                    break;

                $post_id = intval($post_id);
                $attachments = array();
                foreach(get_children('post_type=attachment&orderby=menu_order&order=ASC&post_parent='. $post_id) as $key => $attachment) {
                    $attachments[] = array(
                        'url'       => $attachment->guid,
                        'title'     => $attachment->post_title,
                        'alt'       => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
                        'caption'   => $attachment->post_excerpt,
                        'desc'      => $attachment->post_content
                    );
                }
                $response['attachments'] = $attachments;

                $this->delete_all_posts();

                $response['status'] = 1;
            } while(false);

            echo json_encode($response);
            die;
        }

        /**
         * Create post_id for opening gallery popup
         * and attach to it given images
         */
        function ajax_get_temp_gallery_post_id()
        {
            if (!tf_current_user_can(array('manage_options', 'edit_posts', 'tf_admin_boutique'), false))
                return false;

            /** @var TF_TFUSE $TFUSE */

            global $TFUSE;

            $value = json_decode($TFUSE->request->POST('value'));
            if ($value === null)
                $value = array();

            $response = array(
                'status' => 0
            );

            $this->delete_all_posts();

            do {
                $attachments = array();
                foreach ($value as $file) {
                    if (!is_object($file))
                        continue;

                    $attachments[] = array(
                        'url'       => $file->url,
                        'title'     => @$file->title,
                        'alt'       => @$file->alt,
                        'caption'   => @$file->caption,
                        'desc'      => @$file->desc,
                    );
                }

                $post_id = $this->create_post();

                if (!$post_id)
                    break;

                $this->create_attachments($post_id, $attachments);

                $response['post_id'] = $post_id;
                $response['status'] = 1;
            } while(false);

            echo json_encode($response);
            die;
        }

        /**
         * Delete all trash from db
         */
        private function delete_all_posts()
        {
            /** @var WPDB $wpdb */

            global $wpdb;

            foreach (
                $wpdb->get_results(
                     $wpdb->prepare("SELECT ID FROM ". $wpdb->posts ." WHERE post_type = %s", $this->post_type)
                 ) as $post
            ) {
                wp_delete_post($post->ID, true);
            }
        }

        /**
         * Create a post to contain attachments (added in upload popup)
         */
        private function create_post($attachments = array())
        {
            $post_data = array(
                'post_type'     => $this->post_type,
                'post_status'   => 'draft',
                'comment_status'=> 'closed',
                'ping_status'   => 'closed',
                'post_title'    => '~',
                'post_name'     => '~',
            );

            $post_id = wp_insert_post($post_data);

            if (is_wp_error($post_id) || !$post_id)
                return 0;

            return $post_id;
        }

        private function create_attachments($post_id, $attachments)
        {
            /** @var WPDB $wpdb */
            global $wpdb;

            do {
                // you must first include the image.php file
                // for the function wp_generate_attachment_metadata() to work
                require_once(ABSPATH . 'wp-admin/includes/image.php');

                $wp_upload_dir = wp_upload_dir();

                if ($wp_upload_dir['error'])
                    break;

                $menu_order = 1;
                foreach ($attachments as $attachment) {
                    {
                        $url = $attachment['url'];

                        $rel_path = explode('/wp-content/uploads/', $url);
                        array_shift($rel_path);
                        $rel_path = array_pop($rel_path);

                        if (empty($rel_path))
                            continue;

                        $path = $wp_upload_dir['basedir'] .'/'. $rel_path;
                    }

                    if (!file_exists($path))
                        continue;

                    $wp_filetype = wp_check_filetype(basename($path), null );

                    $alt = $attachment['alt'];

                    $attachment = array(
                        'guid'              => $wp_upload_dir['url'] . '/' . basename($path),
                        'post_mime_type'    => $wp_filetype['type'],
                        'post_title'        => $attachment['title'] ? $attachment['title'] : preg_replace('/\.[^.]+$/', '', basename($path)),
                        'post_excerpt'      => $attachment['caption'],
                        'post_content'      => $attachment['desc'],
                        'post_status'       => 'inherit',
                        'menu_order'        => $menu_order++
                    );

                    $attach_id = $wpdb->get_var(
                        $wpdb->prepare("SELECT
                            ID
                                FROM $wpdb->posts
                                WHERE guid = '%s' AND
                                    post_type = 'attachment'
                            LIMIT 1",
                            $attachment['guid']
                        )
                    );

                    if ($attach_id) {
                        wp_update_post(array(
                            'ID' => $attach_id,
                            'post_parent' => $post_id
                        ));

                        unset($attachPost);
                    } else {
                        $attach_id = wp_insert_attachment($attachment, $path, $post_id);
                    }

                    tf_update_post_meta($attach_id, '_wp_attachment_image_alt', $alt);

                    $attach_data = wp_generate_attachment_metadata($attach_id, $path);
                    wp_update_attachment_metadata($attach_id, $attach_data);
                }

                return true;
            } while(false);

            return false;
        }

        public function action_media_upload_image()
        {
            $this->media_upload_popup_output('image');
        }

        public function action_media_upload_gallery()
        {
            $this->media_upload_popup_output('gallery');
        }

        public function action_media_upload_library()
        {
            $this->media_upload_popup_output('library');
        }

        /**
         * When multi_upload popup content is generated
         * Hide elements that does not work
         */
        public function media_upload_popup_output($type)
        {
            if (get_post_type((int)@$_GET['post_id']) !== $this->post_type)
                return;

            ?>
            <style type="text/css">
                #sidemenu #tab-type_url,
                #gallery-form #media-items .media-item td.savesend input.button,

                #media-upload .media-item .slidetoggle tr.tfseek_exclude_slider,
                #media-upload .media-item .slidetoggle tr.tfseek_main,
                #media-upload .media-item .slidetoggle tr.align,
                #media-upload .media-item .slidetoggle tr.image-size,
                #media-upload .media-item .slidetoggle tr.url,

                #gallery-settings {
                    display: none !important;
                }
            </style>
            <?php
        }
    }
    new _TF_OPTIGEN_MULTI_UPLOAD2();
}
