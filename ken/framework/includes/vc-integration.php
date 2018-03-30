<?php

if (!class_exists('WPBakeryShortCode')) {
	return false;
}

function mk_vc_mapper() {
	require_once locate_template('shortcodes-config/config-head.php');
	require_once locate_template('shortcodes-config/general.php');
	require_once locate_template('shortcodes-config/typography.php');
	require_once locate_template('shortcodes-config/loops.php');
	require_once locate_template('shortcodes-config/slideshows.php');
	require_once locate_template('shortcodes-config/social.php');
	if (defined('MODIFIED_VC_ACTIVATED')) {
		require_once locate_template('shortcodes-config/vc_map.php');
	}
}
add_action('vc_mapper_init_before', 'mk_vc_mapper');

/*
Sets Visual Composer as a theme
 */
add_action('vc_before_init', 'mk_set_vc_as_theme');
function mk_set_vc_as_theme() {
	vc_set_as_theme($disable_updater = true);

	if (defined('MODIFIED_VC_ACTIVATED')) {
		$child_dir = get_stylesheet_directory() . '/shortcodes';
		$parent_dir = get_template_directory() . '/shortcodes';

		vc_set_shortcodes_parent_templates_dir($parent_dir);
		vc_set_shortcodes_templates_dir($child_dir);
	} else {

		$child_dir = get_template_directory() . '/shortcodes';
		$parent_dir = get_template_directory() . '/shortcodes';
		vc_set_shortcodes_templates_dir($parent_dir);
		vc_set_shortcodes_templates_dir($child_dir);
	}

	vc_disable_frontend();

}

/*-----------------*/

/*
Add Range Option to Visual Composer Params
 */
if (function_exists('add_shortcode_param')) {
	add_shortcode_param('range', 'mk_range_settings_field');
}

function mk_range_settings_field($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$min = isset($settings['min']) ? $settings['min'] : '';
	$max = isset($settings['max']) ? $settings['max'] : '';
	$step = isset($settings['step']) ? $settings['step'] : '';
	$unit = isset($settings['unit']) ? $settings['unit'] : '';
	$uniqeID = uniqid();
	$output = '';
	$output .= '<div class="mk-ui-input-slider" ><div ' . $dependency . ' class="mk-range-input ' . $dependency . '" data-value="' . $value . '" data-min="' . $min . '" data-max="' . $max . '" data-step="' . $step . '" id="rangeInput-' . $uniqeID . '"></div><input name="' . $param_name . '"  class="range-input-selector wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="text" value="' . $value . '"/><span class="unit">' . $unit . '</span></div>';
	$output .= '<script type="text/javascript">

        var range_wrapper_' . $uniqeID . ' = jQuery("#rangeInput-' . $uniqeID . '"),

            mk_min = parseFloat(range_wrapper_' . $uniqeID . '.attr("data-min")),
            mk_max = parseFloat(range_wrapper_' . $uniqeID . '.attr("data-max")),
            mk_step = parseFloat(range_wrapper_' . $uniqeID . '.attr("data-step")),
            mk_value = parseFloat(range_wrapper_' . $uniqeID . '.attr("data-value"));

            range_wrapper_' . $uniqeID . '.slider({
                  value:mk_value,
                  min: mk_min,
                  max: mk_max,
                  step: mk_step,
                  slide: function( event, ui ) {
                    range_wrapper_' . $uniqeID . '.siblings(".range-input-selector").val(ui.value );
                  }
            });

    </script>';
	return $output;
}

/*
Add Toggle Option to Visual Composer Params
 */
if (function_exists('add_shortcode_param')) {
	add_shortcode_param('toggle', 'mk_toggle_param_field');
}
function mk_toggle_param_field($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$output = '';
	$uniqeID = uniqid();

	$output .= '<span class="mk-toggle-button mk-composer-toggle" id="toggle-switch-' . $uniqeID . '"><span class="toggle-handle"></span><input type="hidden" ' . $dependency . ' class="wpb_vc_param_value ' . $dependency . ' ' . $param_name . ' ' . $type . '" value="' . $value . '" name="' . $param_name . '"/></span>';

	$output .= '<script type="text/javascript">

        var this_toggle_' . $uniqeID . ' = jQuery("#toggle-switch-' . $uniqeID . '"),
            this_input_' . $uniqeID . ' = this_toggle_' . $uniqeID . '.find("input");

        if(this_input_' . $uniqeID . '.val() == "true"){
            this_toggle_' . $uniqeID . '.addClass("on");
        } else {
            this_toggle_' . $uniqeID . '.addClass("off");
        }

        this_toggle_' . $uniqeID . '.click(function() {

            if(this_toggle_' . $uniqeID . '.hasClass("on")) {
                    this_toggle_' . $uniqeID . '.removeClass("on").addClass("off");
                    this_input_' . $uniqeID . '.val("false");
            } else {
                    this_toggle_' . $uniqeID . '.removeClass("off").addClass("on");
                    this_input_' . $uniqeID . '.val("true");
            }
        });

    </script>';

	return $output;
}

if (function_exists('add_shortcode_param')) {
	add_shortcode_param('item_id', 'mk_item_id_form_field');
}
function mk_item_id_form_field($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);

	if (empty($value)) {
		$value = time() . '-' . uniqid();
	}
	return '<div class="my_param_block">'
	. '<input name="' . $settings['param_name']
	. '" class="wpb_vc_param_value wpb-textinput '
	. $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="'
	. $value . '" ' . $dependency . ' />'
	. '<label>' . $value . '</label>'
	. '</div>';
}

/*
Add Upload Option to Visual Composer Params
 */
if (function_exists('add_shortcode_param')) {
	add_shortcode_param('upload', 'mk_upload_param_field');
}
function mk_upload_param_field($settings, $value) {
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$output = '';
	$uniqeID = uniqid();

	$output .= '<div class="upload-option">';
	$output .= '<input class="mk-upload-url vc-mk-upload-url wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="text" id="' . $uniqeID . '" name="' . $param_name . '" size="50"  value="' . $value . '" /><a class="option-upload-button button thickbox" id="' . $uniqeID . '_button" href="#">' . __('Upload', 'mk_framework') . '</a>';
	$output .= '<span id="' . $uniqeID . '-preview" class="show-upload-image" alt=""><img src="' . $value . '" title="" /></span></div>';

	$output .= '<script type="text/javascript">

        var _custom_media = true,
          _orig_send_attachment = wp.media.editor.send.attachment;

      jQuery("#' . $uniqeID . '_button").click(function(e) {

        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(this);
        var id = button.attr("id").replace("_button", "");
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
          if ( _custom_media ) {
            jQuery("#"+id).val(attachment.url);
            jQuery("#"+id+"-preview img").attr("src", attachment.url);
          } else {
            return _orig_send_attachment.apply( this, [props, attachment] );
          };
        }
        wp.media.editor.open(button);
        return false;
      });
      jQuery(".add_media").on("click", function(){
        _custom_media = false;
      });

    </script>';

	return $output;
}

/*
Add MultiSelect Option to Visual Composer Params
 */
if (function_exists('add_shortcode_param')) {
	add_shortcode_param('multiselect', 'mk_multiselect_param_field');
}
function mk_multiselect_param_field($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$options = isset($settings['options']) ? $settings['options'] : '';
	$output = '';
	$uniqeID = uniqid();

	$output .= '<select multiple="multiple" name="' . $param_name . '" id="multiselect-' . $uniqeID . '" style="width:100%" ' . $dependency . ' class="wpb-multiselect ' . $dependency . ' wpb_vc_param_value ' . $param_name . ' ' . $type . '">';
	if ($options != null && !empty($options)) {
		foreach ($options as $key => $option) {
			$selected = '';
			if (in_array($key, explode(',', $value))) {
				$selected = ' selected="selected"';
			}
			$output .= '<option value="' . $key . '"' . $selected . '>' . $option . '</option>';
		}
	}
	$output .= '</select>';

	$output .= '<script type="text/javascript">

        jQuery("#multiselect-' . $uniqeID . '").chosen();

    </script>';

	return $output;
}

/*
Add Visual Selector Option to Visual Composer Params
 */
if (function_exists('add_shortcode_param')) {
	add_shortcode_param('visual_selector', 'mk_visual_selector_param_field');
}
function mk_visual_selector_param_field($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$border = isset($settings['border']) ? $settings['border'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$options = isset($settings['value']) ? $settings['value'] : '';
	$output = '';
	$uniqeID = uniqid();

	$border_css = ($border == 'true') ? 'border:1px solid #ddd;' : '';

	$output .= '<div class="mk-visual-selector" id="visual-selector' . $uniqeID . '">';
	foreach ($options as $key => $option) {
		$output .= '<a style="margin:10px 10px 0 0;' . $border_css . '" href="#" rel="' . $option . '"><img  src="' . THEME_ADMIN_ASSETS_URI . '/images/' . $key . '" /></a>';
	}
	$output .= '<input name="' . $param_name . '" id="' . $param_name . '" ' . $dependency . ' class="wpb_vc_param_value ' . $dependency . ' ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
	$output .= '</div>';

	$output .= '<script type="text/javascript">

        mk_visual_selector();

    </script>';

	return $output;
}

/*
Add Range Option to Visual Composer Params
 */
if (function_exists('add_shortcode_param')) {
	add_shortcode_param('theme_fonts', 'mk_fonts_settings_field');
}

function mk_fonts_settings_field($settings, $value) {
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$uniqeID = uniqid();
	$output = '';
	$output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="mk-shortcode-fonts-list wpb-select wpb_vc_param_value ' . $param_name . ' ' . $type . '">';

	$google_webfonts = array(
		'ABeeZee',
		'Abel',
		'Abril+Fatface',
		'Aclonica',
		'Acme',
		'Actor',
		'Adamina',
		'Advent+Pro',
		'Aguafina+Script',
		'Akronim',
		'Aladin',
		'Aldrich',
		'Alef',
		'Alegreya',
		'Alegreya+SC',
		'Alegreya+Sans',
		'Alegreya+Sans+SC',
		'Alex+Brush',
		'Alfa+Slab+One',
		'Alice',
		'Alike',
		'Alike+Angular',
		'Allan',
		'Allerta',
		'Allerta+Stencil',
		'Allura',
		'Almendra',
		'Almendra+Display',
		'Almendra+SC',
		'Amarante',
		'Amaranth',
		'Amatic+SC',
		'Amethysta',
		'Anaheim',
		'Andada',
		'Andika',
		'Angkor',
		'Annie+Use+Your+Telescope',
		'Anonymous+Pro',
		'Antic',
		'Antic+Didone',
		'Antic+Slab',
		'Anton',
		'Arapey',
		'Arbutus',
		'Arbutus+Slab',
		'Architects+Daughter',
		'Archivo+Black',
		'Archivo+Narrow',
		'Arimo',
		'Arizonia',
		'Armata',
		'Artifika',
		'Arvo',
		'Asap',
		'Asset',
		'Astloch',
		'Asul',
		'Atomic+Age',
		'Aubrey',
		'Audiowide',
		'Autour+One',
		'Average',
		'Average+Sans',
		'Averia+Gruesa+Libre',
		'Averia+Libre',
		'Averia+Sans+Libre',
		'Averia+Serif+Libre',
		'Bad+Script',
		'Balthazar',
		'Bangers',
		'Basic',
		'Battambang',
		'Baumans',
		'Bayon',
		'Belgrano',
		'Belleza',
		'BenchNine',
		'Bentham',
		'Berkshire+Swash',
		'Bevan',
		'Bigelow+Rules',
		'Bigshot+One',
		'Bilbo',
		'Bilbo+Swash+Caps',
		'Bitter',
		'Black+Ops+One',
		'Bokor',
		'Bonbon',
		'Boogaloo',
		'Bowlby+One',
		'Bowlby+One+SC',
		'Brawler',
		'Bree+Serif',
		'Bubblegum+Sans',
		'Bubbler+One',
		'Buda',
		'Buenard',
		'Butcherman',
		'Butterfly+Kids',
		'Cabin',
		'Cabin+Condensed',
		'Cabin+Sketch',
		'Caesar+Dressing',
		'Cagliostro',
		'Calligraffitti',
		'Cambay',
		'Cambo',
		'Candal',
		'Cantarell',
		'Cantata+One',
		'Cantora+One',
		'Capriola',
		'Cardo',
		'Carme',
		'Carrois+Gothic',
		'Carrois+Gothic+SC',
		'Carter+One',
		'Caudex',
		'Cedarville+Cursive',
		'Ceviche+One',
		'Changa+One',
		'Chango',
		'Chau+Philomene+One',
		'Chela+One',
		'Chelsea+Market',
		'Chenla',
		'Cherry+Cream+Soda',
		'Cherry+Swash',
		'Chewy',
		'Chicle',
		'Chivo',
		'Cinzel',
		'Cinzel+Decorative',
		'Clicker+Script',
		'Coda',
		'Coda+Caption',
		'Codystar',
		'Combo',
		'Comfortaa',
		'Coming+Soon',
		'Concert+One',
		'Condiment',
		'Content',
		'Contrail+One',
		'Convergence',
		'Cookie',
		'Copse',
		'Corben',
		'Courgette',
		'Cousine',
		'Coustard',
		'Covered+By+Your+Grace',
		'Crafty+Girls',
		'Creepster',
		'Crete+Round',
		'Crimson+Text',
		'Croissant+One',
		'Crushed',
		'Cuprum',
		'Cutive',
		'Cutive+Mono',
		'Damion',
		'Dancing+Script',
		'Dangrek',
		'Dawning+of+a+New+Day',
		'Days+One',
		'Dekko',
		'Delius',
		'Delius+Swash+Caps',
		'Delius+Unicase',
		'Della+Respira',
		'Denk+One',
		'Devonshire',
		'Dhurjati',
		'Didact+Gothic',
		'Diplomata',
		'Diplomata+SC',
		'Domine',
		'Donegal+One',
		'Doppio+One',
		'Dorsa',
		'Dosis',
		'Dr+Sugiyama',
		'Droid+Sans',
		'Droid+Sans+Mono',
		'Droid+Serif',
		'Duru+Sans',
		'Dynalight',
		'EB+Garamond',
		'Eagle+Lake',
		'Eater',
		'Economica',
		'Ek+Mukta',
		'Electrolize',
		'Elsie',
		'Elsie+Swash+Caps',
		'Emblema+One',
		'Emilys+Candy',
		'Engagement',
		'Englebert',
		'Enriqueta',
		'Erica+One',
		'Esteban',
		'Euphoria+Script',
		'Ewert',
		'Exo',
		'Exo+2',
		'Expletus+Sans',
		'Fanwood+Text',
		'Fascinate',
		'Fascinate+Inline',
		'Faster+One',
		'Fasthand',
		'Fauna+One',
		'Federant',
		'Federo',
		'Felipa',
		'Fenix',
		'Finger+Paint',
		'Fira+Mono',
		'Fira+Sans',
		'Fjalla+One',
		'Fjord+One',
		'Flamenco',
		'Flavors',
		'Fondamento',
		'Fontdiner+Swanky',
		'Forum',
		'Francois+One',
		'Freckle+Face',
		'Fredericka+the+Great',
		'Fredoka+One',
		'Freehand',
		'Fresca',
		'Frijole',
		'Fruktur',
		'Fugaz+One',
		'GFS+Didot',
		'GFS+Neohellenic',
		'Gabriela',
		'Gafata',
		'Galdeano',
		'Galindo',
		'Gentium+Basic',
		'Gentium+Book+Basic',
		'Geo',
		'Geostar',
		'Geostar+Fill',
		'Germania+One',
		'Gidugu',
		'Gilda+Display',
		'Give+You+Glory',
		'Glass+Antiqua',
		'Glegoo',
		'Gloria+Hallelujah',
		'Goblin+One',
		'Gochi+Hand',
		'Gorditas',
		'Goudy+Bookletter+1911',
		'Graduate',
		'Grand+Hotel',
		'Gravitas+One',
		'Great+Vibes',
		'Griffy',
		'Gruppo',
		'Gudea',
		'Gurajada',
		'Habibi',
		'Halant',
		'Hammersmith+One',
		'Hanalei',
		'Hanalei+Fill',
		'Handlee',
		'Hanuman',
		'Happy+Monkey',
		'Headland+One',
		'Henny+Penny',
		'Herr+Von+Muellerhoff',
		'Hind',
		'Holtwood+One+SC',
		'Homemade+Apple',
		'Homenaje',
		'IM+Fell+DW+Pica',
		'IM+Fell+DW+Pica+SC',
		'IM+Fell+Double+Pica',
		'IM+Fell+Double+Pica+SC',
		'IM+Fell+English',
		'IM+Fell+English+SC',
		'IM+Fell+French+Canon',
		'IM+Fell+French+Canon+SC',
		'IM+Fell+Great+Primer',
		'IM+Fell+Great+Primer+SC',
		'Iceberg',
		'Iceland',
		'Imprima',
		'Inconsolata',
		'Inder',
		'Indie+Flower',
		'Inika',
		'Irish+Grover',
		'Istok+Web',
		'Italiana',
		'Italianno',
		'Jacques+Francois',
		'Jacques+Francois+Shadow',
		'Jim+Nightshade',
		'Jockey+One',
		'Jolly+Lodger',
		'Josefin+Sans',
		'Josefin+Slab',
		'Joti+One',
		'Judson',
		'Julee',
		'Julius+Sans+One',
		'Junge',
		'Jura',
		'Just+Another+Hand',
		'Just+Me+Again+Down+Here',
		'Kalam',
		'Kameron',
		'Kantumruy',
		'Karla',
		'Karma',
		'Kaushan+Script',
		'Kavoon',
		'Kdam+Thmor',
		'Keania+One',
		'Kelly+Slab',
		'Kenia',
		'Khand',
		'Khmer',
		'Khula',
		'Kite+One',
		'Knewave',
		'Kotta+One',
		'Koulen',
		'Kranky',
		'Kreon',
		'Kristi',
		'Krona+One',
		'La+Belle+Aurore',
		'Laila',
		'Lakki+Reddy',
		'Lancelot',
		'Lato',
		'League+Script',
		'Leckerli+One',
		'Ledger',
		'Lekton',
		'Lemon',
		'Libre+Baskerville',
		'Life+Savers',
		'Lilita+One',
		'Lily+Script+One',
		'Limelight',
		'Linden+Hill',
		'Lobster',
		'Lobster+Two',
		'Londrina+Outline',
		'Londrina+Shadow',
		'Londrina+Sketch',
		'Londrina+Solid',
		'Lora',
		'Love+Ya+Like+A+Sister',
		'Loved+by+the+King',
		'Lovers+Quarrel',
		'Luckiest+Guy',
		'Lusitana',
		'Lustria',
		'Macondo',
		'Macondo+Swash+Caps',
		'Magra',
		'Maiden+Orange',
		'Mako',
		'Mallanna',
		'Mandali',
		'Marcellus',
		'Marcellus+SC',
		'Marck+Script',
		'Margarine',
		'Marko+One',
		'Marmelad',
		'Marvel',
		'Mate',
		'Mate+SC',
		'Maven+Pro',
		'McLaren',
		'Meddon',
		'MedievalSharp',
		'Medula+One',
		'Megrim',
		'Meie+Script',
		'Merienda',
		'Merienda+One',
		'Merriweather',
		'Merriweather+Sans',
		'Metal',
		'Metal+Mania',
		'Metamorphous',
		'Metrophobic',
		'Michroma',
		'Milonga',
		'Miltonian',
		'Miltonian+Tattoo',
		'Miniver',
		'Miss+Fajardose',
		'Modern+Antiqua',
		'Molengo',
		'Molle',
		'Monda',
		'Monofett',
		'Monoton',
		'Monsieur+La+Doulaise',
		'Montaga',
		'Montez',
		'Montserrat',
		'Montserrat+Alternates',
		'Montserrat+Subrayada',
		'Moul',
		'Moulpali',
		'Mountains+of+Christmas',
		'Mouse+Memoirs',
		'Mr+Bedfort',
		'Mr+Dafoe',
		'Mr+De+Haviland',
		'Mrs+Saint+Delafield',
		'Mrs+Sheppards',
		'Muli',
		'Mystery+Quest',
		'NTR',
		'Neucha',
		'Neuton',
		'New+Rocker',
		'News+Cycle',
		'Niconne',
		'Nixie+One',
		'Nobile',
		'Nokora',
		'Norican',
		'Nosifer',
		'Nothing+You+Could+Do',
		'Noticia+Text',
		'Noto+Sans',
		'Noto+Serif',
		'Nova+Cut',
		'Nova+Flat',
		'Nova+Mono',
		'Nova+Oval',
		'Nova+Round',
		'Nova+Script',
		'Nova+Slim',
		'Nova+Square',
		'Numans',
		'Nunito',
		'Odor+Mean+Chey',
		'Offside',
		'Old+Standard+TT',
		'Oldenburg',
		'Oleo+Script',
		'Oleo+Script+Swash+Caps',
		'Open+Sans',
		'Open+Sans+Condensed',
		'Oranienbaum',
		'Orbitron',
		'Oregano',
		'Orienta',
		'Original+Surfer',
		'Oswald',
		'Over+the+Rainbow',
		'Overlock',
		'Overlock+SC',
		'Ovo',
		'Oxygen',
		'Oxygen+Mono',
		'PT+Mono',
		'PT+Sans',
		'PT+Sans+Caption',
		'PT+Sans+Narrow',
		'PT+Serif',
		'PT+Serif+Caption',
		'Pacifico',
		'Paprika',
		'Parisienne',
		'Passero+One',
		'Passion+One',
		'Pathway+Gothic+One',
		'Patrick+Hand',
		'Patrick+Hand+SC',
		'Patua+One',
		'Paytone+One',
		'Peddana',
		'Peralta',
		'Permanent+Marker',
		'Petit+Formal+Script',
		'Petrona',
		'Philosopher',
		'Piedra',
		'Pinyon+Script',
		'Pirata+One',
		'Plaster',
		'Play',
		'Playball',
		'Playfair+Display',
		'Playfair+Display+SC',
		'Podkova',
		'Poiret+One',
		'Poller+One',
		'Poly',
		'Pompiere',
		'Pontano+Sans',
		'Port+Lligat+Sans',
		'Port+Lligat+Slab',
		'Prata',
		'Preahvihear',
		'Press+Start+2P',
		'Princess+Sofia',
		'Prociono',
		'Prosto+One',
		'Puritan',
		'Purple+Purse',
		'Quando',
		'Quantico',
		'Quattrocento',
		'Quattrocento+Sans',
		'Questrial',
		'Quicksand',
		'Quintessential',
		'Qwigley',
		'Racing+Sans+One',
		'Radley',
		'Rajdhani',
		'Raleway',
		'Raleway+Dots',
		'Ramabhadra',
		'Ramaraja',
		'Rambla',
		'Rammetto+One',
		'Ranchers',
		'Rancho',
		'Ranga',
		'Rationale',
		'Ravi+Prakash',
		'Redressed',
		'Reenie+Beanie',
		'Revalia',
		'Ribeye',
		'Ribeye+Marrow',
		'Righteous',
		'Risque',
		'Roboto',
		'Roboto+Condensed',
		'Roboto+Slab',
		'Rochester',
		'Rock+Salt',
		'Rokkitt',
		'Romanesco',
		'Ropa+Sans',
		'Rosario',
		'Rosarivo',
		'Rouge+Script',
		'Rozha+One',
		'Rubik+Mono+One',
		'Rubik+One',
		'Ruda',
		'Rufina',
		'Ruge+Boogie',
		'Ruluko',
		'Rum+Raisin',
		'Ruslan+Display',
		'Russo+One',
		'Ruthie',
		'Rye',
		'Sacramento',
		'Sail',
		'Salsa',
		'Sanchez',
		'Sancreek',
		'Sansita+One',
		'Sarina',
		'Sarpanch',
		'Satisfy',
		'Scada',
		'Schoolbell',
		'Seaweed+Script',
		'Sevillana',
		'Seymour+One',
		'Shadows+Into+Light',
		'Shadows+Into+Light+Two',
		'Shanti',
		'Share',
		'Share+Tech',
		'Share+Tech+Mono',
		'Shojumaru',
		'Short+Stack',
		'Siemreap',
		'Sigmar+One',
		'Signika',
		'Signika+Negative',
		'Simonetta',
		'Sintony',
		'Sirin+Stencil',
		'Six+Caps',
		'Skranji',
		'Slabo+13px',
		'Slabo+27px',
		'Slackey',
		'Smokum',
		'Smythe',
		'Sniglet',
		'Snippet',
		'Snowburst+One',
		'Sofadi+One',
		'Sofia',
		'Sonsie+One',
		'Sorts+Mill+Goudy',
		'Source+Code+Pro',
		'Source+Sans+Pro',
		'Source+Serif+Pro',
		'Special+Elite',
		'Spicy+Rice',
		'Spinnaker',
		'Spirax',
		'Squada+One',
		'Sree+Krushnadevaraya',
		'Stalemate',
		'Stalinist+One',
		'Stardos+Stencil',
		'Stint+Ultra+Condensed',
		'Stint+Ultra+Expanded',
		'Stoke',
		'Strait',
		'Sue+Ellen+Francisco',
		'Sunshiney',
		'Supermercado+One',
		'Suranna',
		'Suravaram',
		'Suwannaphum',
		'Swanky+and+Moo+Moo',
		'Syncopate',
		'Tangerine',
		'Taprom',
		'Tauri',
		'Teko',
		'Telex',
		'Tenali+Ramakrishna',
		'Tenor+Sans',
		'Text+Me+One',
		'The+Girl+Next+Door',
		'Tienne',
		'Timmana',
		'Tinos',
		'Titan+One',
		'Titillium+Web',
		'Trade+Winds',
		'Trocchi',
		'Trochut',
		'Trykker',
		'Tulpen+One',
		'Ubuntu',
		'Ubuntu+Condensed',
		'Ubuntu+Mono',
		'Ultra',
		'Uncial+Antiqua',
		'Underdog',
		'Unica+One',
		'UnifrakturCook',
		'UnifrakturMaguntia',
		'Unkempt',
		'Unlock',
		'Unna',
		'VT323',
		'Vampiro+One',
		'Varela',
		'Varela+Round',
		'Vast+Shadow',
		'Vesper+Libre',
		'Vibur',
		'Vidaloka',
		'Viga',
		'Voces',
		'Volkhov',
		'Vollkorn',
		'Voltaire',
		'Waiting+for+the+Sunrise',
		'Wallpoet',
		'Walter+Turncoat',
		'Warnes',
		'Wellfleet',
		'Wendy+One',
		'Wire+One',
		'Yanone+Kaffeesatz',
		'Yellowtail',
		'Yeseva+One',
		'Yesteryear',
		'Zeyada',
	);

	$safe_fonts = array(
		'Arial, Helvetica, sans-serif',
		'Arial Black, Gadget, sans-serif',
		'Bookman Old Style, serif',
		'Comic Sans MS, cursive',
		'Courier, monospace',
		'Courier New, Courier, monospace',
		'Garamond, serif',
		'Georgia, serif',
		'Impact, Charcoal, sans-serif',
		'Lucida Console, Monaco, monospace',
		'Lucida Grande, Lucida Sans Unicode, sans-serif',
		'MS Sans Serif, Geneva, sans-serif',
		'MS Serif, New York, sans-serif',
		'Palatino Linotype, Book Antiqua, Palatino, serif',
		'Tahoma, Geneva, sans-serif',
		'Times New Roman, Times, serif',
		'Trebuchet MS, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif',
	);

	$output .= '<option data-type="" value="none">Select Font</option>';
	/* List Safe Fonts */
	foreach ($safe_fonts as $safe_font) {

		$output .= '<option data-type="safefont" ';
		if ($value == $safe_font) {
			$output .= ' selected="selected"';
		}
		$output .= " value='" . $safe_font . "' >- Safe Font - " . $safe_font . "</option>";
	}

	/* List Google Fonts */
	foreach ($google_webfonts as $google_webfont) {

		$output .= '<option data-type="google" ';
		if ($value == $google_webfont) {
			$output .= ' selected="selected"';
		}
		$output .= 'value="' . $google_webfont . '" >- Google Fonts - ' . str_replace('+', ' ', $google_webfont) . '</option>';
	}

	$output .= '</select>';

	$output .= '<script type="text/javascript">

                           mk_shortcode_fonts();

                </script>';

	return $output;
}

if (function_exists('add_shortcode_param')) {
	add_shortcode_param('hidden_input', 'mk_hidden_input_settings_field');
}

function mk_hidden_input_settings_field($settings, $value) {
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';

	$output = '<input name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value mk_shortcode_hidden ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';

	return $output;
}

class WPBakeryShortCode_mk_table extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_icon_box extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_call_to_action extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_gallery extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_social_networks extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_portfolio extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_blog extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_moving_image extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_font_icons extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_blockquote extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_dropcaps extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_highlight extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_skill_meter extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_skill_meter_chart extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_chart extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_custom_list extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_message_box extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_divider extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_button extends WPBakeryShortCode {

}

class WPBakeryShortCode_mk_toggle extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_fancy_title extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_fancy_text extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_pricing_table extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_employees extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_clients extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_testimonials extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_image_slideshow extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_padding_divider extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_contact_form extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_contact_info extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_audio extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_countdown extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_gmaps extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_milestone extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_edge_slider extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_tab_slider extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_instagram extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_header extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_window_scroller extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_icon_text extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_image extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_image_box extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_tablet_slideshow extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_mobile_slideshow extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_edge_one_pager extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_animated_columns extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_blog_teaser extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_custom_sidebar extends WPBakeryShortCode {
}
class WPBakeryShortCode_mk_theatre_slider extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_process_steps extends WPBakeryShortCodesContainer {
}

class WPBakeryShortCode_mk_step extends WPBakeryShortCodesContainer {
}

class WPBakeryShortCode_vc_content_scroller extends WPBakeryShortCodesContainer {
}

class WPBakeryShortCode_vc_content_scroller_item extends WPBakeryShortCodesContainer {
}

class WPBakeryShortCode_mk_custom_box extends WPBakeryShortCodesContainer {
}

class WPBakeryShortCode_mk_fade_txt_box extends WPBakeryShortCodesContainer
{
}

class WPBakeryShortCode_mk_fade_txt_item extends WPBakeryShortCode
{
}

class WPBakeryShortCode_mk_products extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_product_categories extends WPBakeryShortCode {
}

class WPBakeryShortCode_mk_flipbox extends WPBakeryShortCode
{
}

class WPBakeryShortCode_mk_gradient_text extends WPBakeryShortCode
{
}



class WPBakeryShortCode_mk_page_section extends WPBakeryShortCode
{
    protected $predefined_atts = array('el_class' => '');

    protected function content($atts, $content = null)
    {
        $prefix = '';
        return $prefix . $this->loadTemplate($atts, $content);
    }


    public function getLayoutsControl() {
        global $vc_row_layouts;
        $controls_layout = '<span class="vc_row_layouts vc_control">';
        foreach ( $vc_row_layouts as $layout ) {
            $controls_layout .= '<a class="vc_control-set-column set_columns ' . $layout['icon_class'] . '" data-cells="' . $layout['cells'] . '" data-cells-mask="' . $layout['mask'] . '" title="' . $layout['title'] . '"></a> ';
        }
        $controls_layout .= '<br/><a class="vc_control-set-column set_columns custom_columns" data-cells="custom" data-cells-mask="custom" title="' . __( 'Custom layout', 'mk_framework' ) . '">' . __( 'Custom', 'mk_framework' ) . '</a> ';
        $controls_layout .= '</span>';

        return $controls_layout;
    }

    public function getColumnControls( $controls, $extended_css = '' ) {
        $output       = '<div class="vc_controls vc_controls-row controls controls_row vc_clearfix">';
        $controls_end = '</div>';
        //Create columns
        $controls_layout = $this->getLayoutsControl();

        $controls_move   = ' <a class="vc_control column_move vc_column-move" href="#" title="'
                           . __( 'Drag Page Section to reorder', 'mk_framework' ) . '" data-vc-control="move"><i class="vc_icon"></i></a>';
        $controls_add    = ' <a class="vc_control column_add vc_column-add" href="#" title="'
                           . __( 'Add column', 'mk_framework' ) . '" data-vc-control="add"><i class="vc_icon"></i></a>';
        $controls_delete = '<a class="vc_control column_delete vc_column-delete" href="#" title="'
                           . __( 'Delete this Page Section', 'mk_framework' ) . '" data-vc-control="delete"><i class="vc_icon"></i></a>';
        $controls_edit   = ' <a class="vc_control column_edit vc_column-edit" href="#" title="'
                           . __( 'Edit this Page Section', 'mk_framework' ) . '" data-vc-control="edit"><i class="vc_icon"></i></a>';
        $controls_clone  = ' <a class="vc_control column_clone vc_column-clone" href="#" title="'
                           . __( 'Clone this Page Section', 'mk_framework' ) . '" data-vc-control="clone"><i class="vc_icon"></i></a>';
        $controls_toggle = ' <span class="vc_control vc_row_section_mark" title="">Page Section</span><a class="vc_control column_toggle vc_column-toggle" href="#" title="'
                           . __( 'Toggle Page Section', 'mk_framework' ) . '" data-vc-control="toggle"><i class="vc_icon"></i></a>';
        if ( is_array( $controls ) && ! empty( $controls ) ) {
            foreach ( $controls as $control ) {
                $control_var = 'controls_' . $control;
                $output .= $$control_var;
            }
            $output .= $controls_end;
        } elseif ( is_string( $controls ) ) {
            $control_var = 'controls_' . $controls;
            $output .= $$control_var . $controls_end;
        } else {
            $row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
            $row_edit_clone_delete .= $controls_delete . $controls_clone . $controls_edit . $controls_toggle;
            $row_edit_clone_delete .= '</span>';

            //$column_controls_full =  $controls_start. $controls_move . $controls_center_start . $controls_layout . $controls_delete . $controls_clone . $controls_edit . $controls_center_end . $controls_end;
            $output .= $controls_move . $controls_layout . $controls_add . $row_edit_clone_delete . $controls_end;
        }
        return $output;
    }

   public function contentAdmin( $atts, $content = null ) {
        $width = $el_class = '';
        extract( shortcode_atts( $this->predefined_atts, $atts ) );

        $output = '';

        $column_controls = $this->getColumnControls( $this->settings( 'controls' ) );

        for ( $i = 0; $i < count( $width ); $i ++ ) {
            $output .= '<div' . $this->customAdminBockParams() . ' data-element_type="' . $this->settings["base"] . '" class="' . $this->cssAdminClass() . '">';
            $output .= str_replace( "%column_size%", 1, $column_controls );
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row vc_row-fluid wpb_row_container vc_container_for_children">';
            if ( $content == '' && ! empty( $this->settings["default_content_in_template"] ) ) {
                $output .= do_shortcode( shortcode_unautop( $this->settings["default_content_in_template"] ) );
            } else {
                $output .= do_shortcode( shortcode_unautop( $content ) );

            }
            $output .= '</div>';
            if ( isset( $this->settings['params'] ) ) {
                $inner = '';
                foreach ( $this->settings['params'] as $param ) {
                    $param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
                    if ( is_array( $param_value ) ) {
                        // Get first element from the array
                        reset( $param_value );
                        $first_key   = key( $param_value );
                        $param_value = $param_value[ $first_key ];
                    }
                    $inner .= $this->singleParamHtmlHolder( $param, $param_value );
                }
                $output .= $inner;
            }
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }

    public function cssAdminClass() {
        return 'wpb_' . $this->settings['base'] . ' wpb_sortable';
    }
    /**
     * @deprecated - due to it is not used anywhere?
     * @typo Bock - Block
     * @return string
     */
    public function customAdminBockParams() {
        return '';
    }

    public function buildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {
        $has_image = false;
        $style     = '';
        if ( (int) $bg_image > 0 && ( $image_url = wp_get_attachment_url( $bg_image, 'large' ) ) !== false ) {
            $has_image = true;
            $style .= "background-image: url(" . $image_url . ");";
        }
        if ( ! empty( $bg_color ) ) {
            $style .= vc_get_css_color( 'background-color', $bg_color );
        }
        if ( ! empty( $bg_image_repeat ) && $has_image ) {
            if ( $bg_image_repeat === 'cover' ) {
                $style .= "background-repeat:no-repeat;background-size: cover;";
            } elseif ( $bg_image_repeat === 'contain' ) {
                $style .= "background-repeat:no-repeat;background-size: contain;";
            } elseif ( $bg_image_repeat === 'no-repeat' ) {
                $style .= 'background-repeat: no-repeat;';
            }
        }
        if ( ! empty( $font_color ) ) {
            $style .= vc_get_css_color( 'color', $font_color ); // 'color: '.$font_color.';';
        }
        if ( $padding != '' ) {
            $style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
        }
        if ( $margin_bottom != '' ) {
            $style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
        }

        return empty( $style ) ? $style : ' style="' . esc_attr( $style ) . '"';
    }
}

