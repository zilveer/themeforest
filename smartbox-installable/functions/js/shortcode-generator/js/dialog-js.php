<?php
	header( "Content-Type:text/javascript" );
	
	// Get the path to the root.
	/*
$full_path = __FILE__;
	
	$path_bits = explode( 'wp-content', $full_path );
	
	$url = $path_bits[0];
*/
	
	// Require WordPress bootstrap.
	$path = dirname(__FILE__);
	$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
	$abspath = ($os === "win") ? substr($path, 0, strpos($path, "\wp-content"))."\wp-load.php" : substr($path, 0, strpos($path, "/wp-content"))."/wp-load.php";
	require_once($abspath);
	//require_once( $url . '/wp-load.php' );
	
	//$path_bits = explode( 'wp-content', dirname(__FILE__) );
	
	//$des_framework_path = trailingslashit( '../wp-content' . substr( $path_bits[1], 0, -3 ) );
	
	$des_directory_url = get_template_directory_uri();
	
	$des_framework_url = get_template_directory_uri() . '/functions/';
	
	// Check if this is a Windows server or not.
	$_is_windows = false;
	$delimiter = '/';
	$dirname = dirname( __FILE__ );
	$_has_forwardslash = strpos( $dirname, $delimiter );
	
	if ( $_has_forwardslash === false ) {
	
		$_is_windows = true;
		$delimiter = '\\';
	
	} // End IF Statement
	
	$des_framework_functions_path = str_replace( 'js' . $delimiter . 'shortcode-generator' . $delimiter . 'js', '', dirname( __FILE__ ) );

	// Require admin functions.
	//require_once( $des_framework_functions_path . $delimiter . 'admin-functions.php' );

	$paris_fonts = designare_fonts_array_builder();
	$fonts = "";
	$first = true;
	foreach($paris_fonts as $f){
		if ($first){
			if (isset($f['name'])){
				$fonts .= $f['name'];
				$first = false;
			}
		} else {
			$fonts .= "|".$f['name'];
		}	
	}
	
	//GET PRICES
	global $wpdb;
	$q = "SELECT option_name from ".$wpdb->prefix."options WHERE option_name LIKE 'css3_grid_shortcode_settings_%'";
	$res = $wpdb->get_results($q, ARRAY_A);
	$prices = "";
	$pfirst = true;
	foreach($res as $r){
		$name = explode("css3_grid_shortcode_settings_",$r['option_name']);
		$name = $name[1];
		if($pfirst) {
			$prices .= $name . "$" . $name;
			$pfirst = false;
		} else {
			$prices .= "%". $name . "$" . $name;	
		}
	}
	
	// GET SIDEBARS
	$sides=get_option('des_sidebar_name_names');
	$sides.="Sidebar Widgets";
	
	
	// GET PORTFOLIOS	
	$args = array(
		'type' => 'post',
		'orderby' => 'id',
		'order' => 'ASC',
		'taxonomy' => 'portfolio_type',
		'hide_empty' => 0,
		'pad_counts' => false );
	
	$categories = get_categories( $args );
	$cat = "";
	$ch = 0;
	$ch2 = 0;
	
	foreach($categories as $c){
		
		if($ch == 0) $cat .= "all" . "$" . "All Portfolios";
	
		$cat .= "%" . $c->slug . "$" . $c->name;
		
		$ch++;
	}
	
	// GET Categories	
	$args = array(
		'type' => 'post',
		'orderby' => 'id',
		'order' => 'ASC',
		'hide_empty' => 0,
		'pad_counts' => false );
	
	$categories = get_categories( $args );
	$cat2 = "";
	$ch = 0;
	$ch2 = 0;
	
	foreach($categories as $c){
		
		if($ch == 0) $cat2 .= "all" . "$" . "All Categories";
	
		$cat2 .= "%" . $c->slug . "$" . $c->name;
		
		$ch++;
	}
	
	// GET SLIDERS
	$slide = designare_get_created_sliders2();
	$slides = "";
	
	foreach($slide as $s){
		if($ch2 == 0) $slides .= $s['id'] . "$" . $s['name'];
		else $slides .= "%" . $s['id'] . "$" . $s['name'];
		
		$ch2++;
	}
?>

	var framework_url = '<?php echo dirname( __FILE__ ); ?>';

	var shortcode_generator_url = '<?php echo $des_framework_url; ?>' + 'js/shortcode-generator/';
	
	var desSelectedShortcodeType;

	var desDialogHelper = {
	    desSelectedShortcodeType: '',
	    needsPreview: false,
	    setUpButtons: function () {
	        var a = this;
	        jQuery( "#des-btn-cancel").click(function () {
	            a.closeDialog()
	        });
	        jQuery( "#des-btn-insert").click(function () {
	            a.insertAction()
	        });
	    },

	    setupShortcodeType: function ( shortcode ) {
	        desSelectedShortcodeType = shortcode;
	        this.desSelectedShortcodeType = shortcode;
	    },

	    setUpColourPicker: function () {
	        var startingColour = '000000';

	        jQuery( '.des-marker-colourpicker-control div.colorSelector').each ( function () {

	            var colourPicker = jQuery(this).ColorPicker({

	            color: startingColour,
	            onShow: function (colpkr) {
	                jQuery(colpkr).fadeIn(500);
	                return false;
	            },
	            onHide: function (colpkr) {
	                jQuery(colpkr).fadeOut(500);
	                return false;
	            },
	            onChange: function (hsb, hex, rgb) {
	                jQuery(colourPicker).children( 'div').css( 'backgroundColor', '#' + hex);
	                jQuery(colourPicker).next( 'input').attr( 'value','#' + hex);
	            }

	            });

	            // jQuery(colourPicker).children( 'div').css( 'backgroundColor', '#' + startingColour);
	            // jQuery(colourPicker).next( 'input').attr( 'value','#' + startingColour);


	        });

	        jQuery( '.colorpicker').css( 'position', 'absolute').css( 'z-index', '999999' );
	    },

	    loadShortcodeDetails: function () {
	        if (typeof desSelectedShortcodeType !== 'undefined') {
	            var a = this;
	            // Clean out the table rows before applying the new ones.
	            jQuery( '#des-options-table' ).html( '' );
	            jQuery.getScript(shortcode_generator_url + "shortcodes/" + desSelectedShortcodeType + ".js", function () {
	                a.initializeDialog();

	                // Set the default content to the highlighted text, for certain shortcode types.
	                switch ( desSelectedShortcodeType ) {
	                    case 'box':
	                    case 'ilink':
	                    case 'quote':
	                    case 'button':
	                    case 'abbr':
	                    case 'unordered_list':
	                    case 'ordered_list':
	                    case 'typography':
	                        jQuery( 'input#des-value-content').val( selectedText );
	                    case 'toggle':
	                        jQuery( 'textarea#des-value-content').val( selectedText );
	                    break;
	                }
	            })

	        }

	    },
	    initializeDialog: function () {
	        if (typeof desShortcodeMeta == "undefined") {
	            jQuery( "#des-options").append( "<p>Error loading details for shortcode: " + desSelectedShortcodeType + "</p>" );
	        } else {
	            if (desShortcodeMeta.disablePreview) {
	                jQuery( "#des-preview").remove();
	                jQuery( "#des-btn-preview").remove()
	            }
	            var a = desShortcodeMeta.attributes,
	                b = jQuery( "#des-options-table" );
	
	            for (var c in a) {
	                var f = "des-value-" + a[c].id,
	                    d = a[c].isRequired ? "des-required" : "",
	                    g = jQuery( '<th valign="top" scope="row"></th>' );
	
	                var requiredSpan = '<span class="optional"></span>';
	
	                if (a[c].isRequired) {
	
	                    requiredSpan = '<span class="required">*</span>';
	
	                } // End IF Statement
	                jQuery( "<label/>").attr( "for", f).attr( "class", d).html(a[c].label).append(requiredSpan).appendTo(g);
	                f = jQuery( "<td/>" );
	
	                d = (d = a[c].controlType) ? d : "text-control";
	
	                switch (d) {
	
	                case "column-control":
	
	                    this.createColumnControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "tab-control":
	
	                    this.createTabControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "acc-control":
	
	                    this.createAccControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "bars-control":
	
	                    this.createBarsControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "diagram-control":
	
	                    this.createDiagramControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "team-control":
	
	                    this.createTeamControl(a[c], f, c == 0);
	
	                    break;
	                    
	               	case "service-control":
	
	                    this.createServiceControl(a[c], f, c == 0);
	
	                    break;
	                
	                case "servicefa-control":
	
	                    this.createServiceFAControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "fontawesome-control":
	
	                    this.createFontAwesomeControl(a[c], f, c == 0);
	
	                    break;
	                
	                case "partners-control":
	
	                    this.createPartnersControl(a[c], f, c == 0);
	
	                    break;
	
	                case "icon-control":
	                case "color-control":
	                case "link-control":
	                case "text-control":
	
	                    this.createTextControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "textarea-control":
	
	                    this.createTextAreaControl(a[c], f, c == 0);
	
	                    break;
	
	                case "select-control":
	
	                    this.createSelectControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "select-control-icons":
	
	                    this.createSelectControlIcons(a[c], f, c == 0);
	
	                    break;
	                    
	                case "font-control":
	
	                    this.createFontControl(a[c], f, c == 0);
	
	                    break;
	                
	                case "sidebars-control":
	
	                    this.createSidebarsControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "pricing-tables-control":
	
	                    this.createPricingTablesControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "portfolio-control":
	
	                    this.createPortfolioControl(a[c], f, c == 0);
	
	                    break;
	                case "category-control":
	
	                    this.createCategoryControl(a[c], f, c == 0);
	
	                    break;
	                    
	                case "slider-control":
	
	                    this.createSliderControl(a[c], f, c == 0);
	
	                    break;
	                    
	                 case "range-control":
	
	                    this.createRangeControl(a[c], f, c == 0);
	
	                    break;
	                    
	                 case "colourpicker-control":
	                 
	                 	this.createColourPickerControl(a[c], f, c == 0);
	                 
	                 	break;
	
	                }
	
	                jQuery( "<tr/>").append(g).append(f).appendTo(b)
	            }
	            jQuery( ".des-focus-here:first").focus()
	
				// Add additional wrappers, etc, to each select box.
				
				jQuery( '#des-options select').wrap( '<div class="select_wrapper"></div>' ).before( '<span></span>' );
				
				jQuery( '#des-options select option:selected').each( function () {
				
					jQuery(this).parents( '.select_wrapper').find( 'span').text( jQuery(this).text() );
				
				});
				
				// Setup the colourpicker.
	            this.setUpColourPicker();
	
	        } // End IF Statement
	    },

	    /* Column Generator Element */
	
	    createColumnControl: function (a, b, c) {
	        new desColumnMaker(b, 4, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-column-control")
	    },
	    
	     /* Tab Generator Element */
	
	    createTabControl: function (a, b, c) {
	        new desTabMaker(b, 10, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-tab-control")
	    },
	    
	     createTeamControl: function (a, b, c) {
	        new desTeamMaker(b, 10, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-team-control")
	    },
	    
	    createServiceControl: function (a, b, c) {
	        new desServiceMaker(b, 10, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-service-control")
	    },
	    
	    createServiceFAControl: function (a, b, c) {
	        new desServiceFAMaker(b, 10, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-servicefa-control")
	    },
	    
	    createFontAwesomeControl: function (a, b, c) {
	        new desFontAwesomeMaker(b, 10, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-fontawesome-control")
	    },
	    
	    createPartnersControl: function (a, b, c) {
	        new desPartnersMaker(b, 10, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-partners-control")
	    },
	    
	    /* Accordion Generator Element */
	
	    createAccControl: function (a, b, c) {
	        new desAccMaker(b, 10, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-acc-control")
	    },
	    
	    /* Bars Generator Element */
	
	    createBarsControl: function (a, b, c) {
	        new desBarsMaker(b, 11, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-bars-control")
	    },
	    
	    /* Diagram Generator Element */
	
	    createDiagramControl: function (a, b, c) {
	        new desDiagramMaker(b, 11, c ? "des-focus-here" : null);
	        b.addClass( "des-marker-diagram-control")
	    },
	
		/* Colour Picker Element */
	
	    createColourPickerControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
			b.attr( 'id', 'des-marker-colourpicker-control').addClass( "des-marker-colourpicker-control" );
	
			jQuery( '<div class="colorSelector"><div></div></div>').appendTo(b);
	
	        jQuery( '<input type="text">').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'txt input-text input-colourpicker').addClass(c ? "des-focus-here" : "").appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	        b.find( "#" + g).bind( "keydown focusout", function (e) {
	            if (e.type == "keydown" && e.which != 13 && e.which != 9 && !e.shiftKey) h.needsPreview = true;
	            else if (h.needsPreview && (e.type == "focusout" || e.which == 13)) {
	                h.previewAction(e.target);
	                h.needsPreview = false
	            }
	        })
	
	    },
	
	    /* Generic Text Element */
	
	    createTextControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id, 
	            defaultValue = a.defaultValue ? a.defaultValue : "";
	
	        jQuery( '<input type="text">').attr( "id", g).attr( "name", g).attr( 'value', defaultValue ).addClass(f).addClass(d).addClass( 'txt input-text').addClass(c ? "des-focus-here" : "").appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	        b.find( "#" + g).bind( "keydown focusout", function (e) {
	            if (e.type == "keydown" && e.which != 13 && e.which != 9 && !e.shiftKey) h.needsPreview = true;
	            else if (h.needsPreview && (e.type == "focusout" || e.which == 13)) {
	                h.previewAction(e.target);
	                h.needsPreview = false
	            }
	        })
	
	    },
	    
	    /* Generic TextArea Element */
	
	    createTextAreaControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        jQuery( '<textarea>').attr( "id", g).attr( "name", g).attr( "rows", 10).attr( "cols", 30).addClass(f).addClass(d).addClass( 'txt input-textarea').addClass(c ? "des-focus-here" : "").appendTo(b);
	        b.addClass( "des-marker-textarea-control" );
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	        b.find( "#" + g).bind( "keydown focusout", function (e) {
	            if (e.type == "keydown" && e.which != 13 && e.which != 9 && !e.shiftKey) h.needsPreview = true;
	            else if (h.needsPreview && (e.type == "focusout" || e.which == 13)) {
	                h.previewAction(e.target);
	                h.needsPreview = false
	            }
	        })
	
	    },
	
	    /* Select Box Element */
	
	    createSelectControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control' );
	
	        var selectBoxValues = a.selectValues;
	        
	        var labelValues = a.selectValues;
	
	        for (v in selectBoxValues) {
	
	            var value = selectBoxValues[v];
	            var label = labelValues[v];
	            var selected = '';
	
	            if (value == '') {
	
	                if (a.defaultValue == value) {
	
	                    label = a.defaultText;
	
	                } // End IF Statement
	            } else {
	
	                if (value == a.defaultValue) {
	                    label = a.defaultText;
	                } // End IF Statement
	            } // End IF Statement
	            if (value == a.defaultValue) {
	                selected = ' selected="selected"';
	            } // End IF Statement
	            
	            selectNode.append( '<option value="' + value + '"' + selected + '>' + label + '</option>' );
	
	        } // End FOREACH Loop
	        
	        selectNode.appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	    
	    /* Select Box Icons Element */
	
	    createSelectControlIcons: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control' );
	
	        var selectBoxValues = a.selectValues;
	        
	        var labelValues = a.selectValues;
	
	        for (v in selectBoxValues) {
	
	            var value = selectBoxValues[v];
	            var label = labelValues[v];
	            var selected = '';
	
	            if (value == '') {
	
	                if (a.defaultValue == value) {
	
	                    label = a.defaultText;
	
	                } // End IF Statement
	            } else {
	
	                if (value == a.defaultValue) {
	                    label = a.defaultText;
	                } // End IF Statement
	            } // End IF Statement
	            if (value == a.defaultValue) {
	                selected = ' selected="selected"';
	            } // End IF Statement
	            
	            selectNode.append( '<option value="' + value + '"' + selected + '>' + label + '</option>' );
	
	        } // End FOREACH Loop
	
	        
	        selectNode.appendTo(b);
	        
	        jQuery('<img id="icon_preview" class="img_preview_icon" src="<?php echo $des_directory_url; ?>/img/designare_icons/icon1.png" width="22px" height="22px">').appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	        
	        
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	        
	        	
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            var img_link = '<?php echo $des_directory_url; ?>/img/designare_icons/' + newText + '.png';
	            jQuery(this).parents( '.select_wrapper').siblings('#icon_preview').attr('src', img_link);
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	    
	    /* Range Select Box Element */
	
	    createRangeControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-range').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control' );
	
	        // var selectBoxValues = a.selectValues;
	        
	        var rangeStart = a.rangeValues[0];
	        var rangeEnd = a.rangeValues[1];
			var defaultValue = 0;
			if ( a.defaultValue ) {
			
				defaultValue = a.defaultValue;
			
			} // End IF Statement
			
			for ( var i = rangeStart; i <= rangeEnd; i++ ) {
			
				var selected = '';
				
				if ( i == defaultValue ) { selected = ' selected="selected"'; } // End IF Statement
			
				selectNode.append( '<option value="' + i + '"' + selected + '>' + i + '</option>' );
			
			} // End FOR Loop
	        
	        selectNode.appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	    
	    /* Fonts Select Box Element */
	
	    createFontControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-font').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control').addClass( 'des-marker-font-control' );
	
	        var selectBoxValues = '<?php echo $fonts; ?>';
	        selectBoxValues = selectBoxValues.split( '|' );
	
	        for (v in selectBoxValues) {
	
	            var value = selectBoxValues[v];
	            var label = selectBoxValues[v];
	            var selected = '';
	
	            if (value == '') {
	
	                if (a.defaultValue == value) {
	
	                    label = a.defaultText;
	
	                } // End IF Statement
	            } else {
	
	                if (value == a.defaultValue) {
	                    label = a.defaultText;
	                } // End IF Statement
	            } // End IF Statement
	            if (value == a.defaultValue) {
	                selected = ' selected="selected"';
	            } // End IF Statement
	            
	            selectNode.append( '<option value=\'' + value + '\'' + selected + '>' + label + '</option>' );
	
	        } // End FOREACH Loop
	        
	        selectNode.appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	    
	     /* Sidebars Select Box Element */
	
	    createSidebarsControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-font').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control').addClass( 'des-marker-sidebar-control' );
	
	        var selectBoxValues = '<?php echo $sides; ?>';
	        selectBoxValues = selectBoxValues.split( '<?php echo DESIGNARE_SEPARATOR; ?>' );
	
	        for (v in selectBoxValues) {
	
	            var value = selectBoxValues[v];
	            var label = selectBoxValues[v];
	            var selected = '';
	
	            if (value == '') {
	
	                if (a.defaultValue == value) {
	
	                    label = a.defaultText;
	
	                } // End IF Statement
	            } else {
	
	                if (value == a.defaultValue) {
	                    label = a.defaultText;
	                } // End IF Statement
	            } // End IF Statement
	            if (value == a.defaultValue) {
	                selected = ' selected="selected"';
	            } // End IF Statement
	            
	            selectNode.append( '<option value=\'' + value + '\'' + selected + '>' + label + '</option>' );
	
	        } // End FOREACH Loop
	        
	        selectNode.appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	    
	    
	    /* Pricing Tables Element */
	
	    createPricingTablesControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-pricing-table').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control').addClass( 'des-marker-pricing-tables-control' );
	
	        var selectBoxValues = '<?php echo $prices; ?>';
	        selectBoxValues = selectBoxValues.split( '%' );
	        
	        for (v in selectBoxValues) {
	
	            var value = selectBoxValues[v];
	            var label = selectBoxValues[v].split( '$' );
	            var selected = '';
	            
	           
	
	            if (label[1] == '') {
	
	                if (a.defaultValue == value) {
	
	                    label[1] = a.defaultText;
	
	                } // End IF Statement
	            } else {
	
	                if (label[1] == a.defaultValue) {
	                    label[1] = a.defaultText;
	                } // End IF Statement
	            } // End IF Statement
	            if (label[1] == a.defaultValue) {
	                selected = ' selected="selected"';
	            } // End IF Statement
	            
	            selectNode.append( '<option value=\'' + label[0] + '\'' + selected + '>' + label[1] + '</option>' );
	
	        } // End FOREACH Loop
	        
	        selectNode.appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	    
	   
	    /* Portfolio Select Box Element */
	
	    createPortfolioControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-font').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control').addClass( 'des-marker-portfolio-control' );
	
	        var selectBoxValues = '<?php echo $cat; ?>';
	        selectBoxValues = selectBoxValues.split( '%' );
	
	        for (v in selectBoxValues) {
	
	            var value = selectBoxValues[v];
	            var label = selectBoxValues[v].split( '$' );
	            var selected = '';
	            
	           
	
	            if (label[1] == '') {
	
	                if (a.defaultValue == value) {
	
	                    label[1] = a.defaultText;
	
	                } // End IF Statement
	            } else {
	
	                if (label[1] == a.defaultValue) {
	                    label[1] = a.defaultText;
	                } // End IF Statement
	            } // End IF Statement
	            if (label[1] == a.defaultValue) {
	                selected = ' selected="selected"';
	            } // End IF Statement
	            
	            selectNode.append( '<option value=\'' + label[0] + '\'' + selected + '>' + label[1] + '</option>' );
	
	        } // End FOREACH Loop
	        
	        selectNode.appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	    
	    /* Category Select Box Element */
	
	    createCategoryControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-font').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control').addClass( 'des-marker-category-control' );
	
	        var selectBoxValues = '<?php echo $cat2; ?>';
	        selectBoxValues = selectBoxValues.split( '%' );
	
	        for (v in selectBoxValues) {
	
	            var value = selectBoxValues[v];
	            var label = selectBoxValues[v].split( '$' );
	            var selected = '';
	            
	           
	
	            if (label[1] == '') {
	
	                if (a.defaultValue == value) {
	
	                    label[1] = a.defaultText;
	
	                } // End IF Statement
	            } else {
	
	                if (label[1] == a.defaultValue) {
	                    label[1] = a.defaultText;
	                } // End IF Statement
	            } // End IF Statement
	            if (label[1] == a.defaultValue) {
	                selected = ' selected="selected"';
	            } // End IF Statement
	            
	            selectNode.append( '<option value=\'' + label[0] + '\'' + selected + '>' + label[1] + '</option>' );
	
	        } // End FOREACH Loop
	        
	        selectNode.appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	    
	    /* Slider Select Box Element */
	
	    createSliderControl: function (a, b, c) {
	
	        var f = a.validateLink ? "des-validation-marker" : "",
	            d = a.isRequired ? "des-required" : "",
	            g = "des-value-" + a.id;
	
	        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-font').addClass(c ? "des-focus-here" : "" );
	
	        b.addClass( 'des-marker-select-control').addClass( 'des-marker-slider-control' );
	
	        var selectBoxValues = '<?php echo $slides; ?>';
	        selectBoxValues = selectBoxValues.split( '%' );
	
	        for (v in selectBoxValues) {
	
	            var value = selectBoxValues[v];
	            var label = selectBoxValues[v].split( '$' );
	            var selected = '';
	            
	           
	
	            if (label[1] == '') {
	
	                if (a.defaultValue == value) {
	
	                    label[1] = a.defaultText;
	
	                } // End IF Statement
	            } else {
	
	                if (label[1] == a.defaultValue) {
	                    label[1] = a.defaultText;
	                } // End IF Statement
	            } // End IF Statement
	            if (label[1] == a.defaultValue) {
	                selected = ' selected="selected"';
	            } // End IF Statement
	            
	            selectNode.append( '<option value=\'' + label[0] + '\'' + selected + '>' + label[1] + '</option>' );
	
	        } // End FOREACH Loop
	        
	        selectNode.appendTo(b);
	
	        if (a = a.help) {
	            jQuery( "<br/>").appendTo(b);
	            jQuery( "<span/>").addClass( "des-input-help").html(a).appendTo(b)
	        }
	
	        var h = this;
	
	        b.find( "#" + g).bind( "change", function (e) {
	
	            if ((e.type == "change" || e.type == "focusout") || e.which == 9) {
	
	                h.needsPreview = true;
	
	            }
	
	            if (h.needsPreview) {
	
	                h.previewAction(e.target);
	
	                h.needsPreview = false
	            }
	            
	            // Update the text in the appropriate span tag.
	            var newText = jQuery(this).children( 'option:selected').text();
	            
	            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
	        })
	
	    },
	
	
	   getTextKeyValue: function (a) {
		    var b = a.find( "input" );
		    if (!b.length) return null;
		    a = 'text-input-id';
		    if ( b.attr( 'id' ) != undefined ) {
		    	a = b.attr( "id" ).substring(10);
		    }
		    b = b.val();
		    return {
		        key: a,
		        value: b
		    }
		},
	
		getTextAreaKeyValue: function (a) {
	        var b = a.find( "textarea" );
	        if (!b.length) return null;
	        a = b.attr( "id").substring(10);
	        b = b.val();
			b = b.replace(/\n\r?/g, '<br />');
	        return {
	            key: a,
	            value: b
	        }
	    },
	
	    getColumnKeyValue: function (a) {
	        var b = a.find( "#des-column-text").text();
	        if (a = Number(a.find( "select option:selected").val())) return {
	            key: "data",
	            value: {
	                content: b,
	                numColumns: a
	            }
	        }
	    },
	    
	    getTabKeyValue: function (a) {
	        var b = a.find( "#des-tab-text").text();
	        if (a = Number(a.find( "select option:selected").val())) return {
	            key: "data",
	            value: {
	                content: b,
	                numTabs: a
	            }
	        }
	    },
	    
	    getAccKeyValue: function (a) {
	        var b = a.find( "#des-acc-text").text();
	        if (a = Number(a.find( "select option:selected").val())) return {
	            key: "data",
	            value: {
	                content: b,
	                numTabs: a
	            }
	        }
	    },
	    
	    getBarsKeyValue: function (a) {
	        var b = a.find( "#des-bars-text").text();
	        if (a = Number(a.find( "select option:selected").val())) return {
	            key: "data",
	            value: {
	                content: b,
	                numTabs: a
	            }
	        }
	    },
	    
	    getDiagramKeyValue: function (a) {
	        var b = a.find( "#des-diagram-text").text();
	        if (a = Number(a.find( "select option:selected").val())) return {
	            key: "data",
	            value: {
	                content: b,
	                numTabs: a
	            }
	        }
	    },
	    
	    getTeamKeyValue: function (a) {
	        var b = a.find( "#des-team-text").text();
	        if (a = Number(a.find( "select option:selected").val())) return {
	            key: "data",
	            value: {
	                content: b,
	                numTabs: a
	            }
	        }
	    },
	    
	    getServiceKeyValue: function (a) {
	        var b = a.find( "#des-service-text").text();
	        if (a = Number(a.find( "select option:selected").val())) return {
	            key: "data",
	            value: {
	                content: b,
	                numTabs: a
	            }
	        }
	    },
	    
	    getServiceFAKeyValue: function (a) {
	        var b = a.find( "#des-servicefa-text").text();
	        if (a = Number(a.find( "select option:selected").val())) return {
	            key: "data",
	            value: {
	                content: b,
	                numTabs: a
	            }
	        }
	    },
	
	    makeShortcode: function () {
	
	        var a = {},
	            b = this;
	
	        jQuery( "#des-options-table td").each(function () {
	
	            var h = jQuery(this),
	                e = null;
	
	            if (e = h.hasClass( "des-marker-column-control") ? b.getColumnKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-select-control") ? b.getSelectKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-tab-control") ? b.getTabKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-acc-control") ? b.getAccKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-bars-control") ? b.getBarsKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-diagram-control") ? b.getDiagramKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-team-control") ? b.getTeamKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-service-control") ? b.getServiceKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-servicefa-control") ? b.getServiceFAKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	            if (e = h.hasClass( "des-marker-textarea-control") ? b.getTextAreaKeyValue(h) : b.getTextKeyValue(h)) a[e.key] = e.value
	
	        });
	
	        if (desShortcodeMeta.customMakeShortcode) return desShortcodeMeta.customMakeShortcode(a);
	        var c = a.content ? a.content : desShortcodeMeta.defaultContent,
	            f = "";
	        for (var d in a) {
	            var g = a[d];
	            if (g && d != "content") f += " " + d + '="' + g + '"'
	        }
	        
	        // Customise the shortcode output for various shortcode types.
	        
	        switch ( desShortcodeMeta.shortcodeType ) {
	        
	        	case 'text-replace':
	        	
	        		var shortcode = "[" + desShortcodeMeta.shortcode + f + "]" + (c ? c + "[/" + desShortcodeMeta.shortcode + "]" : " ")
	        	
	        	break;
	        	
	        	default:
	        	
	        		var shortcode = "[" + desShortcodeMeta.shortcode + f + "]" + (c ? c + "[/" + desShortcodeMeta.shortcode + "] " : " ")
	        	
	        	break;
	        
	        } // End SWITCH Statement
	        
	        return shortcode;
	    },
	
	    getSelectKeyValue: function (a) {
	        var b = a.find( "select" );
	        if (!b.length) return null;
	        a = b.attr( "id").substring(10);
	        b = b.val();
	        return {
	            key: a,
	            value: b
	        }
	    },
	
	    insertAction: function () {
	        if (typeof desShortcodeMeta != "undefined") {
	            var a = this.makeShortcode();
	            tinyMCE.activeEditor.execCommand( "mceInsertContent", false, a);
	            this.closeDialog()
	        }
	    },
	
	    closeDialog: function () {
	        this.needsPreview = false;
	        tb_remove();
	        jQuery( "#des-dialog").remove()
	    },
	
	    previewAction: function (a) {},
	
	    validateLinkFor: function (a) {
	        var b = jQuery(a);
	        b.removeClass( "des-validation-error" );
	        b.removeClass( "des-validated" );
	        if (a = b.val()) {
	            b.addClass( "des-validating" );
	            jQuery.ajax({
	                url: ajaxurl,
	                dataType: "json",
	                data: {
	                    action: "des_check_url_action",
	                    url: a
	                },
	                error: function () {
	                    b.removeClass( "des-validating")
	                },
	                success: function (c) {
	                    b.removeClass( "des-validating" );
	                    c.error || b.addClass(c.exists ? "des-validated" : "des-validation-error")
	                }
	            })
	        }
	    }

	};

	desDialogHelper.setUpButtons();
	desDialogHelper.loadShortcodeDetails();
