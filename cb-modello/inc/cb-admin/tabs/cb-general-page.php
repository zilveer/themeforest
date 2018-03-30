<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:51
 */
add_action('wp_ajax_nopriv_save_cb_general', 'save_cb_general');
add_action('wp_ajax_save_cb_general', 'save_cb_general');


function save_cb_general()
{
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';

    if (get_option('cb5_upload_logo') != esc_attr($data['cb5_upload_logo']))
        $response = '3';
    if (get_option('cb5_favi') != esc_attr($data['cb5_favi']))
        $response = '3';

    update_option('cb5_upload_logo', esc_attr($data['cb5_upload_logo']));
    update_option('cb5_show_logo_text', esc_attr($data['cb5_show_logo_text']));
    update_option('cb5_logo_text', esc_attr($data['cb5_logo_text']));
    update_option('cb5_logo_f', esc_attr($data['cb5_logo_f']));
    update_option('cb5_logo_font', esc_attr($data['cb5_logo_font']));
    update_option('cb5_favi', esc_attr($data['cb5_favi']));
    update_option('cb5_show_bread', esc_attr($data['cb5_show_bread']));
    update_option('cb5_show_footer', esc_attr($data['cb5_show_footer']));
    update_option('cb5_wayp', esc_attr($data['cb5_wayp']));
    update_option('cb5_show_comments', esc_attr($data['cb5_show_comments']));
    update_option('cb5_show_above_footer', esc_attr($data['cb5_show_above_footer']));
    update_option('cb5_not_error', esc_attr($data['cb5_not_error']));
    update_option('cb5_not_desc', esc_attr($data['cb5_not_desc']));
    update_option('cb5_meta_description', esc_attr($data['cb5_meta_description']));
    update_option('cb5_meta_keywords', esc_attr($data['cb5_meta_keywords']));
    update_option('cb5_searchc', esc_attr($data['cb5_searchc']));


    update_option('cb5_scroll', esc_attr($data['cb5_scroll']));
    update_option('cb5_usescroll', esc_attr($data['cb5_usescroll']));
    update_option('cb5_echo', esc_attr($data['cb5_echo']));

    update_option('cb5_global_fade', esc_attr($data['cb5_global_fade']));
    update_option('cb5_global_fade_effect', esc_attr($data['cb5_global_fade_effect']));
    update_option('cb5_global_buttons', esc_attr($data['cb5_global_buttons']));

    update_option('cb5_loader', esc_attr($data['cb5_loader']));
    update_option('cb5_loader_gif', esc_attr($data['cb5_loader_gif']));
    update_option('cb5_loader_bg', esc_attr($data['cb5_loader_bg']));

    update_option('cb5_enable_export', esc_attr($data['cb5_enable_export']));
    update_option('cb5_logo_position', esc_attr($data['cb5_logo_position']));

    die($response);

}

function show_cb_general_page()
{
    ?>
    <h3>General Settings</h3>
    <div class="tab_desc">General theme settings and API credentials</div>

    <!-- GENERAL SECTION START -->
    <form method="post" class="cb-admin-form">
    <?php $upload_logo = get_option('cb5_upload_logo'); ?>
    <div class="pd5" style="border-top:none;">
        <?php echo generate_hint('Enter an URL or upload logo'); ?>
        <label for="cb5_upload_logo"><?php _e('Logo', 'cb-modello'); ?></label>
        <input id="cb5_upload_logo" type="text" name="cb5_upload_logo" class="upurl input-upload"
               value="<?php echo $upload_logo; ?>"/><input class="upload_button2" type="button" value="Upload"/>
    </div>
    <div class="pd5" id="general_logo">
        <?php if ($upload_logo != '') {
            if (!function_exists('bfi_thumb'))
                require_once(get_template_directory() . '/inc/cb-lib/bfithumb.php');
            echo '<label class="info">Current logo:</label><a href="' . $upload_logo . '" target="_blank">
                <img class="sele" src="' . bfi_thumb($upload_logo, array('width' => 145, 'crop' => true)) . '" align="absmiddle" alt="logo" /></a>';
        } ?>
    </div>

    <div class="pd5">
        <?php echo generate_hint('Disable image logo'); ?>
        <?php generate_check(__('Show only text logo?', 'cb-modello'), get_option('cb5_show_logo_text'), 'cb5_show_logo_text'); ?>

    </div>

    <div class="pd5">
        <?php echo generate_hint('Your website name'); ?>
        <label for="cb5_logo_text"><?php _e('Logo Text', 'cb-modello'); ?></label>
        <input type="text" name="cb5_logo_text" id="cb5_logo_text" value="<?php echo get_option('cb5_logo_text'); ?>"/>
    </div>


    <div class="pd5">
        <?php echo generate_hint('Google Webfonts Font'); ?>
        <label for="cb5_logo_f"><?php _e('Logo Font Family', 'cb-modello'); ?></label>
        <select name="cb5_logo_f" id="cb5_logo_f">
            <?php
            $google_font = array('------', 'Abel', 'Abril+Fatface', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent+Pro', 'Aguafina+Script', 'Aladin', 'Aldrich', 'Alegreya', 'Alegreya+SC', 'Alex+Brush', 'Alfa+Slab+One', 'Alice', 'Alike', 'Alike+Angular', 'Allan', 'Allerta', 'Allerta+Stencil', 'Allura', 'Almendra', 'Almendra+SC', 'Amarante', 'Amaranth', 'Amatic+SC', 'Amethysta', 'Andada', 'Andika', 'Angkor', 'Annie+Use+Your+Telescope', 'Anonymous+Pro', 'Antic', 'Antic+Didone', 'Antic+Slab', 'Anton', 'Arapey', 'Arbutus', 'Architects+Daughter', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Asap', 'Asset', 'Astloch', 'Asul', 'Atomic+Age', 'Aubrey', 'Audiowide', 'Average', 'Averia+Gruesa+Libre', 'Averia+Libre', 'Averia+Sans+Libre', 'Averia+Serif+Libre', 'Bad+Script', 'Balthazar', 'Bangers', 'Basic', 'Battambang', 'Baumans', 'Bayon', 'Belgrano', 'Belleza', 'Bentham', 'Berkshire+Swash', 'Bevan', 'Bigshot+One', 'Bilbo', 'Bilbo+Swash+Caps', 'Bitter', 'Black+Ops+One', 'Bokor', 'Bonbon', 'Boogaloo', 'Bowlby+One', 'Bowlby+One+SC', 'Brawler', 'Bree+Serif', 'Bubblegum+Sans', 'Buda', 'Buenard', 'Butcherman', 'Butterfly+Kids', 'Cabin', 'Cabin+Condensed', 'Cabin+Sketch', 'Caesar+Dressing', 'Cagliostro', 'Calligraffitti', 'Cambo', 'Candal', 'Cantarell', 'Cantata+One', 'Cantora+One', 'Capriola', 'Cardo', 'Carme', 'Carter+One', 'Caudex', 'Cedarville+Cursive', 'Ceviche+One', 'Changa+One', 'Chango', 'Chau+Philomene+One', 'Chelsea+Market', 'Chenla', 'Cherry+Cream+Soda', 'Chewy', 'Chicle', 'Chivo', 'Coda', 'Coda+Caption', 'Codystar', 'Comfortaa', 'Coming+Soon', 'Concert+One', 'Condiment', 'Content', 'Contrail+One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Courgette', 'Cousine', 'Coustard', 'Covered+By+Your+Grace', 'Crafty+Girls', 'Creepster', 'Crete+Round', 'Crimson+Text', 'Crushed', 'Cuprum', 'Cutive', 'Damion', 'Dancing+Script', 'Dangrek', 'Dawning+of+a+New+Day', 'Days+One', 'Delius', 'Delius+Swash+Caps', 'Delius+Unicase', 'Della+Respira', 'Devonshire', 'Didact+Gothic', 'Diplomata', 'Diplomata+SC', 'Doppio+One', 'Dorsa', 'Dosis', 'Dr+Sugiyama', 'Droid+Sans', 'Droid+Sans+Mono', 'Droid+Serif', 'Duru+Sans', 'Dynalight', 'EB+Garamond', 'Eagle+Lake', 'Eater', 'Economica', 'Electrolize', 'Emblema+One', 'Emilys+Candy', 'Engagement', 'Enriqueta', 'Erica+One', 'Esteban', 'Euphoria+Script', 'Ewert', 'Exo', 'Expletus+Sans', 'Fanwood+Text', 'Fascinate', 'Fascinate+Inline', 'Fasthand', 'Federant', 'Federo', 'Felipa', 'Fjord+One', 'Flamenco', 'Flavors', 'Fondamento', 'Fontdiner+Swanky', 'Forum', 'Francois+One', 'Fredericka+the+Great', 'Fredoka+One', 'Freehand', 'Fresca', 'Frijole', 'Fugaz+One', 'GFS+Didot', 'GFS+Neohellenic', 'Galdeano', 'Galindo', 'Gentium+Basic', 'Gentium+Book+Basic', 'Geo', 'Geostar', 'Geostar+Fill', 'Germania+One', 'Give+You+Glory', 'Glass+Antiqua', 'Glegoo', 'Gloria+Hallelujah', 'Goblin+One', 'Gochi+Hand', 'Gorditas', 'Goudy+Bookletter+1911', 'Graduate', 'Gravitas+One', 'Great+Vibes', 'Gruppo', 'Gudea', 'Habibi', 'Hammersmith+One', 'Handlee', 'Hanuman', 'Happy+Monkey', 'Henny+Penny', 'Herr+Von+Muellerhoff', 'Holtwood+One+SC', 'Homemade+Apple', 'Homenaje', 'IM+Fell+DW+Pica', 'IM+Fell+DW+Pica+SC', 'IM+Fell+Double+Pica', 'IM+Fell+Double+Pica+SC', 'IM+Fell+English', 'IM+Fell+English+SC', 'IM+Fell+French+Canon', 'IM+Fell+French+Canon+SC', 'IM+Fell+Great+Primer', 'IM+Fell+Great+Primer+SC', 'Iceberg', 'Iceland', 'Imprima', 'Inconsolata', 'Inder', 'Indie+Flower', 'Inika', 'Irish+Grover', 'Istok+Web', 'Italiana', 'Italianno', 'Jim+Nightshade', 'Jockey+One', 'Jolly+Lodger', 'Josefin+Sans', 'Josefin+Slab', 'Judson', 'Julee', 'Junge', 'Jura', 'Just+Another+Hand', 'Just+Me+Again+Down+Here', 'Kameron', 'Karla', 'Kaushan+Script', 'Kelly+Slab', 'Kenia', 'Khmer', 'Knewave', 'Kotta+One', 'Koulen', 'Kranky', 'Kreon', 'Kristi', 'Krona+One', 'La+Belle+Aurore', 'Lancelot', 'Lato', 'League+Script', 'Leckerli+One', 'Ledger', 'Lekton', 'Lemon', 'Life+Savers', 'Lilita+One', 'Limelight', 'Linden+Hill', 'Lobster', 'Lobster+Two', 'Londrina+Outline', 'Londrina+Shadow', 'Londrina+Sketch', 'Londrina+Solid', 'Lora', 'Love+Ya+Like+A+Sister', 'Loved+by+the+King', 'Lovers+Quarrel', 'Luckiest+Guy', 'Lusitana', 'Lustria', 'Macondo', 'Macondo+Swash+Caps', 'Magra', 'Maiden+Orange', 'Mako', 'Marck+Script', 'Marko+One', 'Marmelad', 'Marvel', 'Mate', 'Mate+SC', 'Maven+Pro', 'McLaren', 'Meddon', 'MedievalSharp', 'Medula+One', 'Megrim', 'Merienda+One', 'Merriweather', 'Metal', 'Metal+Mania', 'Metamorphous', 'Metrophobic', 'Michroma', 'Miltonian', 'Miltonian+Tattoo', 'Miniver', 'Miss+Fajardose', 'Modern+Antiqua', 'Molengo', 'Monofett', 'Monoton', 'Monsieur+La+Doulaise', 'Montaga', 'Montez', 'Montserrat', 'Moul', 'Moulpali', 'Mountains+of+Christmas', 'Mr+Bedfort', 'Mr+Dafoe', 'Mr+De+Haviland', 'Mrs+Saint+Delafield', 'Mrs+Sheppards', 'Muli', 'Mystery+Quest', 'Neucha', 'Neuton', 'News+Cycle', 'Niconne', 'Nixie+One', 'Nobile', 'Nokora', 'Norican', 'Nosifer', 'Nothing+You+Could+Do', 'Noticia+Text', 'Nova+Cut', 'Nova+Flat', 'Nova+Mono', 'Nova+Oval', 'Nova+Round', 'Nova+Script', 'Nova+Slim', 'Nova+Square', 'Numans', 'Nunito', 'Odor+Mean+Chey', 'Old+Standard+TT', 'Oldenburg', 'Oleo+Script', 'Open+Sans', 'Open+Sans+Condensed', 'Orbitron', 'Oregano', 'Original+Surfer', 'Oswald', 'Over+the+Rainbow', 'Overlock', 'Overlock+SC', 'Ovo', 'Oxygen', 'PT+Mono', 'PT+Sans', 'PT+Sans+Caption', 'PT+Sans+Narrow', 'PT+Serif', 'PT+Serif+Caption', 'Pacifico', 'Parisienne', 'Passero+One', 'Passion+One', 'Patrick+Hand', 'Patua+One', 'Paytone+One', 'Peralta', 'Permanent+Marker', 'Petrona', 'Philosopher', 'Piedra', 'Pinyon+Script', 'Plaster', 'Play', 'Playball', 'Playfair+Display', 'Podkova', 'Poiret+One', 'Poller+One', 'Poly', 'Pompiere', 'Pontano+Sans', 'Port+Lligat+Sans', 'Port+Lligat+Slab', 'Prata', 'Preahvihear', 'Press+Start+2P', 'Princess+Sofia', 'Prociono', 'Prosto+One', 'Puritan', 'Quando', 'Quantico', 'Quattrocento', 'Quattrocento+Sans', 'Questrial', 'Quicksand', 'Qwigley', 'Racing+Sans+One', 'Radley', 'Raleway', 'Rammetto+One', 'Rancho', 'Rationale', 'Redressed', 'Reenie+Beanie', 'Revalia', 'Ribeye', 'Ribeye+Marrow', 'Righteous', 'Roboto', 'Rochester', 'Rock+Salt', 'Rokkitt', 'Romanesco', 'Ropa+Sans', 'Rosario', 'Rosarivo', 'Rouge+Script', 'Ruda', 'Ruge+Boogie', 'Ruluko', 'Ruslan+Display', 'Russo+One', 'Ruthie', 'Sail', 'Salsa', 'Sancreek', 'Sansita+One', 'Sarina', 'Satisfy', 'Schoolbell', 'Seaweed+Script', 'Sevillana', 'Shadows+Into+Light', 'Shadows+Into+Light+Two', 'Shanti', 'Share', 'Shojumaru', 'Short+Stack', 'Siemreap', 'Sigmar+One', 'Signika', 'Signika+Negative', 'Simonetta', 'Sirin+Stencil', 'Six+Caps', 'Slackey', 'Smokum', 'Smythe', 'Sniglet', 'Snippet', 'Sofia', 'Sonsie+One', 'Sorts+Mill+Goudy', 'Source+Sans+Pro', 'Special+Elite', 'Spicy+Rice', 'Spinnaker', 'Spirax', 'Squada+One', 'Stardos+Stencil', 'Stint+Ultra+Condensed', 'Stint+Ultra+Expanded', 'Stoke', 'Sue+Ellen+Francisco', 'Sunshiney', 'Supermercado+One', 'Suwannaphum', 'Swanky+and+Moo+Moo', 'Syncopate', 'Tangerine', 'Taprom', 'Telex', 'Tenor+Sans', 'The+Girl+Next+Door', 'Tienne', 'Tinos', 'Titan+One', 'Trade+Winds', 'Trocchi', 'Trochut', 'Trykker', 'Tulpen+One', 'Ubuntu', 'Ubuntu+Condensed', 'Ubuntu+Mono', 'Ultra', 'Uncial+Antiqua', 'UnifrakturCook', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'VT323', 'Varela', 'Varela+Round', 'Vast+Shadow', 'Vibur', 'Vidaloka', 'Viga', 'Voces', 'Volkhov', 'Vollkorn', 'Voltaire', 'Waiting+for+the+Sunrise', 'Wallpoet', 'Walter+Turncoat', 'Wellfleet', 'Wire+One', 'Yanone+Kaffeesatz', 'Yellowtail', 'Yeseva+One', 'Yesteryear', 'Zeyada');
            $google_font = str_replace('+', ' ', $google_font);
            for ($i = 0; $i < sizeof($google_font); $i++) {
                if (get_option('cb5_logo_f') == $google_font[$i]) $ffg = ' selected'; else $ffg = '';
                echo '<option value="' . $google_font[$i] . '" ' . $ffg . '>' . $google_font[$i] . '</option>';
            } ?>
        </select>
    </div>

    <div class="pd5"><label for="cb5_logo_font"><?php _e('Logo Font Size', 'cb-modello'); ?></label>

        <div class="slider_inside">
            <input type="text" name="cb5_logo_font" id="cb5_logo_font"
                   value="<?php echo get_option('cb5_logo_font'); ?>" data-slider="true" data-slider-step="1"
                   data-slider-range="8,100" data-slider-highlight="true"/>
            <?php _e('px', 'cb-modello'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="pd5"><label for="cb5_logo_position"><?php _e('Logo Top Position', 'cb-modello'); ?></label>

        <div class="slider_inside">
            <input type="text" name="cb5_logo_position" id="cb5_logo_position"
                   value="<?php echo get_option('cb5_logo_position'); ?>" data-slider="true" data-slider-step="1"
                   data-slider-range="-200,200" data-slider-highlight="true"/>
            <?php _e('px', 'cb-modello'); ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="pd5">
        <?php echo generate_hint('Enter an URL or upload favicon'); ?>
        <label for="cb5_favi"><?php _e('Favicon upload', 'cb-modello'); ?></label>
        <input id="cb5_favi" type="text" size="36" name="cb5_favi" class="upurl input-upload"
               value="<?php echo get_option('cb5_favi'); ?>"/><input
            class="upload_button2" type="button"
            value="<?php _e('Upload', 'cb-modello'); ?>"/>
    </div>

    <div class="pd5">
        <?php generate_check(__('Show breadcrumbs?', 'cb-modello'), get_option('cb5_show_bread'), 'cb5_show_bread'); ?>

    </div>

    <div class="pd5">
        <?php echo generate_hint('Animate builder elements on scroll. Can be overwritten in each block.'); ?>
        <?php generate_check(__('Animate blocks on scroll?', 'cb-modello'), get_option('cb5_wayp'), 'cb5_wayp'); ?>
    </div>
    <div class="pd5 hide">
        <?php echo generate_hint('Global animation for images hover effect. Can be overwritten.'); ?>
        <?php generate_select(__('Images Animation', 'cb-modello'), get_option('cb5_global_fade'), array(
            array('', __('-----', 'cb-modello')), array('left_to_right', __('Left to right', 'cb-modello')),
            array('right_to_left', __('Right to left', 'cb-modello')),
            array('bottom_to_top', __('Bottom to top, cut', 'cb-modello')),
            array('top_to_bottom', __('Top to bottom', 'cb-modello')),
            array('only_icons', __('Only Icons with text, from left', 'cb-modello')),
            array('only_icons_top', __('Only Icons with text, from top', 'cb-modello')),
        ), 'cb5_global_fade');?>
    </div>
    <div class="pd5 hide">
        <?php echo generate_hint('Global effect for images hover effect. Can be overwritten.'); ?>
        <?php generate_select(__('Images Effect', 'cb-modello'), get_option('cb5_global_fade_effect'), array(
            array('', __('-----', 'cb-modello')), array('e1_opacity', __('Opacity', 'cb-modello')),
            array('e2_blur', __('Blur', 'cb-modello')),
            array('e3_opacity_blury', __('Blur + Opacity', 'cb-modello')),
            array('e4_bright', __('Bright', 'cb-modello')),
            array('e5_zoom_only', __('Zoom', 'cb-modello')),
            array('e6_zoom_opacity', __('Zoom + Opacity', 'cb-modello')),
            array('e7_zoom_blur', __('Zoom + Blur', 'cb-modello')),
            array('e8_zoom_bright', __('Zoom + Bright', 'cb-modello')),
            array('e9_zoom_short', __('Zoom out short', 'cb-modello')),
            array('e10_zoom_out_opacity', __('Zoom out short + Opacity', 'cb-modello')),
            array('e11_zoom_out_blur', __('Zoom out short + Blur', 'cb-modello')),
            array('e12_zoom_out_blur_bright', __('Zoom out short + Bright', 'cb-modello'))
        ), 'cb5_global_fade_effect');?>
    </div>
    <div class="pd5 hide">
        <?php echo generate_hint('Global effect for buttons hover effect. Can be overwritten.'); ?>
        <?php generate_select(__('Buttons effect', 'cb-modello'), get_option('cb5_global_buttons'), array(
            array('ani_fade', __('Fade', 'cb-modello')),
            array('ani_top_bottom', __('Top to bottom', 'cb-modello')),
            array('ani_3d', __('3D buttons', 'cb-modello')),
            array('ani_rotate', __('Rotate', 'cb-modello')),
            array('ani_flip', __('Flip', 'cb-modello')),
            array('ani_left_right', __('Left to right', 'cb-modello'))
        ), 'cb5_global_buttons');?>
    </div>

    <div class="pd5 hide">
        <?php generate_check(__('Show above-footer widget?', 'cb-modello'), get_option('cb5_show_above_footer'), 'cb5_show_above_footer'); ?>

    </div>


    <div class="pd5">
        <?php generate_check(__('Show scroll to top button?', 'cb-modello'), get_option('cb5_scroll'), 'cb5_scroll'); ?>

    </div>
    <div class="pd5">
        <?php generate_check(__('Load images on scroll?', 'cb-modello'), get_option('cb5_echo'), 'cb5_echo'); ?>

    </div>


    <div class="pd5">
        <?php generate_select(__('Custom mouse scrolling', 'cb-modello'), get_option('cb5_usescroll'), array(
            array('no', __('no', 'cb-modello')),
            array('smooth', __('smooth- no styling', 'cb-modello'))
            /* ,
           array('nicescroll', __('styled- nice scroll', 'cb-modello'))*/
            ), 'cb5_usescroll');?>

    </div>

    <div class="pd5 hide">
        <?php echo generate_hint('Preloader animation'); ?>
        <?php generate_select(__('Preloader', 'cb-modello'), get_option('cb5_loader'), array(
            array('', __('none', 'cb-modello')),
            array('yes', __('image + percentage', 'cb-modello')),
            array('ani', __('just fade', 'cb-modello'))
        ), 'cb5_loader');?>
    </div>

    <div class="pd5 hide">
        <?php echo generate_hint('Gif'); ?>
        <?php generate_select(__('Preloader image', 'cb-modello'), get_option('cb5_loader_gif'), array(
            array('modello_loader.gif', __('Modello', 'cb-modello')),
            array('loader.gif', __('line', 'cb-modello')),
            array('loader2.gif', __('circle', 'cb-modello')),
            array('loader3.gif', __('circle small', 'cb-modello')),
            array('loader4.gif', __('circle arrow', 'cb-modello')),
            array('loader5.gif', __('Blue circle', 'cb-modello'))
        ), 'cb5_loader_gif');?>
    </div>
    <div class="pd5 hide">
        <?php generate_select(__('Preloader background', 'cb-modello'), get_option('cb5_loader_bg'), array(
            array('white', __('white', 'cb-modello')),
            array('black', __('black', 'cb-modello'))
        ), 'cb5_loader_bg');?>
    </div>


    <div class="pd5">
        <button type="button" class="extend_button cb_button"><?php _e('Show more options', 'cb-modello'); ?> <i
                class="fa fa-angle-down"></i></button>

    </div>
    <div class="extend">

        <div class="pd5" style="display:none;">
            <?php echo generate_hint('Proudly powered by Wordpress message'); ?>

            <?php generate_check(__('Show wordpress footer?', 'cb-modello'), get_option('cb5_show_footer'), 'cb5_show_footer'); ?>

        </div>

        <div class="pd5">
            <?php generate_check(__('Show comments?', 'cb-modello'), get_option('cb5_show_comments'), 'cb5_show_comments'); ?>

        </div>

        <div class="pd5"><label for="cb5_not_error"><?php _e('Not found page title', 'cb-modello'); ?></label>
            <input type="text" name="cb5_not_error" id="cb5_not_error"
                   value="<?php echo get_option('cb5_not_error'); ?>"/>
        </div>

        <div class="pd5"><label for="cb5_not_desc"><?php _e('Not found page desc', 'cb-modello'); ?></label>
            <textarea name="cb5_not_desc"
                      id="cb5_not_desc"/><?php echo stripslashes(get_option('cb5_not_desc')); ?></textarea>
        </div>

        <div class="pd5"><label for="cb5_meta_description"><?php _e('Blog meta description', 'cb-modello'); ?></label>
            <textarea name="cb5_meta_description"
                      id="cb5_meta_description"><?php echo get_option('cb5_meta_description'); ?></textarea>
        </div>

        <div class="pd5"><label for="cb5_meta_keywords"><?php _e('Blog meta keywords', 'cb-modello'); ?></label>
            <textarea name="cb5_meta_keywords"
                      id="cb5_meta_keywords"/><?php echo get_option('cb5_meta_keywords'); ?></textarea>
        </div>


        <div class="pd5">
            <?php generate_check(__('Disable prettyPhoto?', 'cb-modello'), get_option('cb5_disable_pp'), 'cb5_disable_pp'); ?>

        </div>

        <div class="pd5">
            <?php generate_check(__('Export page/post on save?', 'cb-modello'), get_option('cb5_enable_export'), 'cb5_enable_export'); ?>

        </div>
    <div class="pd5">
        <?php echo generate_hint('Number of columns for search page'); ?>
        <?php generate_select(__('Search Columns', 'cb-modello'), get_option('cb5_searchc'), array(
            array('1', __('1', 'cb-modello')),
            array('2', __('2', 'cb-modello')),
            array('3', __('3', 'cb-modello')),
            array('4', __('4', 'cb-modello'))
        ), 'cb5_searchc');?>
    </div>


    </div>

    <input type="hidden" name="tab" class="cb-tab" value="cb-general-page"/>
    <input type="hidden" name="action" value="save_cb_general"/>
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>"/>

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello'); ?>"
                                         class="cb-save"></div>
    </form>
<?php


}
