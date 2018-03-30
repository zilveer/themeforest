/**
 * G1 admin namespace
 */
var G1admin = {};

(function($) {
    G1admin.addCustomLayersToRevslider = function () {
        if (typeof UniteLayersRev === 'object' && typeof UniteLayersRev.setInitCaptionClasses === 'function') {
            var origFunc_setInitCaptionClasses = UniteLayersRev.setInitCaptionClasses;

            // override native revslider func
            UniteLayersRev.setInitCaptionClasses = function (jsonCaptions) {
                if (typeof jsonCaptions !== 'string') {
                    origFunc_setInitCaptionClasses(jsonCaptions);
                    return;
                }

                var customLayers = [
                    '"g1-layer-small-black"',
                    '"g1-layer-small-white"',
                    '"g1-layer-medium-black"',
                    '"g1-layer-medium-white"',
                    '"g1-layer-large-black"',
                    '"g1-layer-large-white"',
                    '"g1-layer-xlarge-black"',
                    '"g1-layer-xlarge-white"'
                ];

                // remove closing ]
                jsonCaptions = jsonCaptions.replace(']', '');

                // append new layers and add closing ]
                jsonCaptions += ',' + customLayers.join(',') + ']';

                // run orig func
                origFunc_setInitCaptionClasses(jsonCaptions);
            };
        }
    };

jQuery(document).ready(function() {

    //G1admin.addCustomLayersToRevslider();

    // replace revslider buttons
    $("#dialog_insert_button ul.list-buttons").each(function() {
        var $ul = $(this);

        if (typeof UniteLayersRev === 'object') {
            /*
            var origFunc = UniteLayersRev.setInitCaptionClasses;

            UniteLayersRev.setInitCaptionClasses = function(url) {
                var arr = $.parseJSON(url);

                // add classes here
                arr.push('3clicks-class-1');
                arr.push('3clicks-class-2');

                origFunc(JSON.stringify(arr));
            };
            */
        }

        // define buttons here
        var buttons = [
            //'<a class="g1-revslider-button" href="javascript:UniteLayersRev.insertButton(\'g1-button g1-style-solid\',\'html content 1\')">Button desc 1</a>',
        ];

        for (var i = 0; i < buttons.length; i += 1) {
            $ul.append($('<li>').append(buttons[i]));
        }
    });

	// INITIALIZE COLOR PICKER
	jQuery('.g1-field-color').each(function(){
		var $this = jQuery(this);
		
		var $container = $this.find('.g1-color-picker-container').eq(0);
		var $input = $this.find('input').eq(0);
		var $preview = $this.find('.g1-color-picker-preview').eq(0);
		var $previewCurrent = $this.find('.g1-color-picker-preview-current').eq(0);
		var $previewNew = $this.find('.g1-color-picker-preview-new').eq(0);
		var $toggle = $this.find('.g1-color-picker-toggle').eq(0);
		
		var openColorPicker = function(){
			$preview.addClass('on');
			$container.addClass('on');
			
			$container.farbtastic(function callback(color){			 			 
				 $previewNew.css('background-color', color);
				 $input.attr('value', color);
			 });
			
			jQuery.farbtastic($container).setColor($input.attr('value'));		
		};
		
		$this.blur(function(){
			if ( $preview.is( '.on' ) ) {
				//$previewCurrent.css( 'background-image', 'none' );
				$previewCurrent.css( 'background', $previewNew.css('background-color') );
				$preview.removeClass( 'on' );
				$container.removeClass( 'on' );
			}	
		});
		
		$previewCurrent.click(function(){			
			if ( $preview.is('.on') ) {	
				$previewNew.css('background-color', $previewCurrent.css('background-color'));			
			} else {				
				openColorPicker();
			}	
		});		
		
		$toggle.click( openColorPicker );	
	});
	
	jQuery('.g1-option-view-color input').blur(function(){
		var $preview = jQuery(this).siblings('.g1-color-picker-preview').eq(0);
		$preview.find('.g1-color-picker-preview-current').css('background-color', jQuery(this).attr('value'));
	});
	
	
	// INITIALIZE FORM UNITS
	jQuery('.g1-option-view .g1-help').each(function(){
		var context = this;		
		jQuery('.g1-help-content',context).hide();
		jQuery('.g1-help-toggle', context).toggleClass('g1-help-toggle-off').click(function(){
			jQuery(this).toggleClass('g1-help-toggle-on').toggleClass('g1-help-toggle-off');
			jQuery('.g1-help-content', context).toggle('fast');
		});
	});
	
	
	jQuery( '.g1-field-image-choice' ).each( function() {
		var container = jQuery(this);
		jQuery( 'div:has( input:checked )', this).addClass( 'g1-checked' );
				
		jQuery( 'div input', this ).change( function() {
			jQuery(this).blur();
			jQuery( 'div', container ).removeClass( 'g1-checked' );
			jQuery( 'div:has( input:checked )', container).addClass( 'g1-checked' );
		} ); 
		
	} );
	
	jQuery('input[type="range"]').rangeinput({ progress: true });

	// INITIALIZE SHORTCODE GENERATOR
	if ( typeof tinymce !== "undefined" && tinymce && typeof tinymce.create === 'function') {
        jQuery( '.g1-shortcode-generator' ).parent().each( function() {
			var $this = jQuery( this );

			var image = $this.find( 'h1 img' ).attr( 'src' );
			var title = $this.find( 'h1' ).text();

			var id = $this.attr( 'id' );
			id = id.replace( /\-/g, '_' );

			tinymce.create('tinymce.plugins.' + id, {
				init : function(ed, url){
                    var generator = G1ShortcodeGenerator.getInstance(ed, $this.attr( 'id' ));

			        ed.addButton(id, {
			        	title : title,
			            	onclick : function() {
			            		generator.showUI();
			                },
			            image: image
			        });
			    },
			    createControl : function(n, cm) {
			    	return null;
			    }
			});
		
			tinymce.PluginManager.add( id, tinymce.plugins[ id ]);
		});
	}

    function registerShortcodeGeneratorForHTMLEditor()
    {
        if ( typeof(QTags) !== 'function' ) {
            return;
        }

        if ( typeof(G1ShortcodeGenerator) === 'undefined' ) {
            return;
        }

        var qt = QTags;

        var generator = G1ShortcodeGenerator.getInstance(null, 'g1_shortcode_manager');

        qt.ShortcodeGeneratorHTMLButton = function() {
            qt.Button.call(this, 'g1_shotgen', '[/]', 'f', 'General Shortcode Generator');
        };
        qt.ShortcodeGeneratorHTMLButton.prototype = new qt.Button();
        qt.ShortcodeGeneratorHTMLButton.prototype.callback = function(e, c) {
            generator.showUI();
        };

        edButtons[edButtons.length] = new qt.ShortcodeGeneratorHTMLButton();
    }

    registerShortcodeGeneratorForHTMLEditor();

    $('.g1-option-view-multichoice-text input[type="checkbox"]').live('change', function() {
        reload_multichoice_text_option_value($(this).parents('.g1-option-view-multichoice-text'));
    });

    $(document).bind('g1-field-loaded', function() {
        populate_multichoice_options_from_value();
    });

    function reload_multichoice_text_option_value($option) {
        var $value = $('input[type="hidden"]', $option);

        var values = [];
        $('input[type="checkbox"]:checked', $option).each(function() {
            values.push($(this).val());
        });

        $value.val(values.join(','));
    }

    function populate_multichoice_options_from_value() {
        $('.g1-option-view-multichoice-text').each(function() {
            var value = $(this).find('input[type=hidden]').val();

            if (!value) {
                return;
            }

            var values = value.split(',');

            for (var i = 0; i < values.length; i += 1) {
                $(this).find('input[name=' + values[i] + ']').attr('checked', 'checked');
            }
        });
    }

    populate_multichoice_options_from_value();

    // HELP ToGGLES
    $('.g1-help').each(function() {
        var $this = $(this);
        var $label = $('.g1-label label', $this.parent());
        var $helpSwitch = $('<a class="g1-help-switch">[?]</a>');
        $helpSwitch.click(function(e) {
            e.preventDefault();
            $this.toggle();
        });

        $label.append($helpSwitch);
    });

    $(window).load(function() {
        if ($('body').hasClass('nav-menus-php')) {
            $(document).bind('DOMNodeInserted', function(e) {
                var $target = $(e.target);

                if ($target.hasClass('menu-item')) {
                    // 100ms delay to read new menu item depth value
                    setTimeout(function() {
                        registerMenuItemElements($target);
                    }, 100);

                }
            });
        }
    });

    $('#menu-to-edit a.item-edit').click(function() {
        var $menuItem = $(this).parents('.menu-item');

        // menu item registered?
        if ($menuItem.find('.g1-type,.g1-color').length > 0) {
            return;
        }

        registerMenuItemElements($menuItem);
    });

    function registerMenuItemElements ($this) {
        var $cssClassesInput = $('.field-css-classes input.edit-menu-item-classes', $this);

        var isMenuDepth0 = $this.hasClass('menu-item-depth-0');
        var isMenuDepth1 = $this.hasClass('menu-item-depth-1');

        // item custom components
        var $typeSelect = $this.find('.g1-type-wrapper');
        var $colorSelect = $this.find('.g1-color-wrapper');
        var $iconSelect = $this.find('.g1-menu-icon-wrapper');

        if (!isMenuDepth0 && !isMenuDepth1) {
            $typeSelect.remove();
            $colorSelect.remove();
        }

        if (isMenuDepth0) {
            $colorSelect.remove();

            // remove color
            var classes = $cssClassesInput.val().split(' ');
            var newClasses = [];

            for (var i = 0; i < classes.length; i += 1) {
                    if (!classes[i].match('g1-color')) {
                        newClasses.push(classes[i]);
                    }
            }
            $cssClassesInput.val(newClasses.join(' '));
        }

        if (isMenuDepth1) {
            $typeSelect.remove();

            // remove type class
            var classes = $cssClassesInput.val().split(' ');
            var newClasses = [];

            for (var i = 0; i < classes.length; i += 1) {
                if (!classes[i].match('g1-type')) {
                    newClasses.push(classes[i]);
                }
            }
            $cssClassesInput.val(newClasses.join(' '));
        }

        var $cssClassesAttributeField = $('.field-css-classes', $this);

        var matches = $this.attr('id').match(/[0-9]+$/);
        var menuItemId = matches[0];

        var selectCallback = function () {
            var value = $(this).find('option:selected').val();
            //var field = $(this).data('field');
            var field = $(this).attr('data-g1-field');

            var classes = [];
            if ($cssClassesInput.val().length > 0) {
                classes = $cssClassesInput.val().split(' ');
            }

            for (var i in classes) {
                if (classes.hasOwnProperty(i)) {
                    if (classes[i].match(field)) {
                        classes.splice(i, 1);
                    }
                }
            }

            var foundIndex = $.inArray(value, classes);

            // add class
            if (value.length > 0 && foundIndex === -1) {
                classes.push(value);
            }

            $cssClassesInput.val(classes.join(' '));
        };

        var createSelectField = function ( label, fieldName, id, options, $storage ) {
            var storage = $storage.val();

            var field = '<p class="' + fieldName + '-wrapper description description-thin">';
            var fieldLabel = '<label for="'+ id +'">'+ label +'</label>';

            var fieldSelect = '<select class="'+ fieldName +' widefat" id="'+ id +'" data-g1-field="'+ fieldName +'">';

            for (var i in options) {
                if (options.hasOwnProperty(i)) {
                    var selected = '';

                    if (i.length > 0 && storage.match(i)) {
                        selected = 'selected="selected"';
                    }

                    var option = '<option '+ selected +' value="'+ i +'">'+ options[i] +'</option>';
                    fieldSelect += option;
                }
            }

            fieldSelect += '</select>';

            field += fieldLabel;
            field += '<br>';
            field += fieldSelect;

            var $field = $(field);

            $field.find('select').change(selectCallback);

            return $field;
        };

        // define 'type' option
        var types = {
            '': '',
            'g1-type-drops':'Dropdown',
            'g1-type-tile-2': 'Tiles x2',
            'g1-type-tile-3': 'Tiles x3',
            'g1-type-tile-4': 'Tiles x4',
            'g1-type-tile-5': 'Tiles x5',
            'g1-type-tile-6': 'Tiles x6',
            'g1-type-column-2': 'Columns x2',
            'g1-type-column-3': 'Columns x3',
            'g1-type-column-4': 'Columns x4',
            'g1-type-column-5': 'Columns x5',
            'g1-type-column-6': 'Columns x6'
        };

        if ($typeSelect.length === 0 && isMenuDepth0) {
            var $type = createSelectField('Menu type', 'g1-type', 'g1-menu-type-' + menuItemId, types, $cssClassesInput);
            $cssClassesAttributeField.before($type);
        }

        // define 'color' option
        var colors = {
            '': '',
            'g1-color-orange-1': 'Orange 1',
            'g1-color-orange-2': 'Orange 2',
            'g1-color-red-1': 'Red 1',
            'g1-color-red-2': 'Red 2',
            'g1-color-blue-1': 'Blue 1',
            'g1-color-blue-2': 'Blue 2',
            'g1-color-purple-1': 'Purple 1',
            'g1-color-purple-2': 'Purple 2',
            'g1-color-green-1': 'Green 1',
            'g1-color-green-2': 'Green 2',
            'g1-color-turquoise-1': 'Turquoise 1',
            'g1-color-turquoise-2': 'Turquoise 2'
        };

        if ($colorSelect.length === 0 && isMenuDepth1) {
            var $color = createSelectField('Tile color', 'g1-color', 'g1-color-' + menuItemId, colors, $cssClassesInput);
            $cssClassesAttributeField.before($color);
        }

        // define 'icon' option
        var icons = {
            '': ''
        };

        var iconList = getFontAwesomeList();
        for (var i in iconList) {
            var icon = iconList[i];
            var key = 'g1-menu-icon-' + icon['name'];
            var value = icon['name'];

            icons[key] = value;
        }

        if ($iconSelect.length === 0) {
            var $icon = createSelectField('Icon', 'g1-menu-icon', 'g1-menu-icon-' + menuItemId, icons, $cssClassesInput);
            $cssClassesAttributeField.before($icon);
        }

        $cssClassesInput.keyup(function() {
            var selects = [];

            if (typeof $type !== 'undefined') {
                selects.push($('select', $type));
            }

            if (typeof $color !== 'undefined') {
                selects.push($('select', $color));
            }

            if (typeof $icon !== 'undefined') {
                selects.push($('select', $icon));
            }

            for (var i in selects) {
                var $select = selects[i];
                var $selectedOption = $select.find('option:selected');

                // remove selection
                if (!$cssClassesInput.val().match($selectedOption.val())) {
                    $selectedOption.removeAttr('selected');
                }
            }
        });
    }

    function getFontAwesomeList () {
        var fontAwesomeList = [{"code":"f26e","name":"500px"},{"code":"f042","name":"adjust"},{"code":"f170","name":"adn"},{"code":"f037","name":"align-center"},{"code":"f039","name":"align-justify"},{"code":"f036","name":"align-left"},{"code":"f038","name":"align-right"},{"code":"f270","name":"amazon"},{"code":"f0f9","name":"ambulance"},{"code":"f13d","name":"anchor"},{"code":"f17b","name":"android"},{"code":"f209","name":"angellist"},{"code":"f103","name":"angle-double-down"},{"code":"f100","name":"angle-double-left"},{"code":"f101","name":"angle-double-right"},{"code":"f102","name":"angle-double-up"},{"code":"f107","name":"angle-down"},{"code":"f104","name":"angle-left"},{"code":"f105","name":"angle-right"},{"code":"f106","name":"angle-up"},{"code":"f179","name":"apple"},{"code":"f187","name":"archive"},{"code":"f1fe","name":"area-chart"},{"code":"f0ab","name":"arrow-circle-down"},{"code":"f0a8","name":"arrow-circle-left"},{"code":"f01a","name":"arrow-circle-o-down"},{"code":"f190","name":"arrow-circle-o-left"},{"code":"f18e","name":"arrow-circle-o-right"},{"code":"f01b","name":"arrow-circle-o-up"},{"code":"f0a9","name":"arrow-circle-right"},{"code":"f0aa","name":"arrow-circle-up"},{"code":"f063","name":"arrow-down"},{"code":"f060","name":"arrow-left"},{"code":"f061","name":"arrow-right"},{"code":"f062","name":"arrow-up"},{"code":"f047","name":"arrows"},{"code":"f0b2","name":"arrows-alt"},{"code":"f07e","name":"arrows-h"},{"code":"f07d","name":"arrows-v"},{"code":"f069","name":"asterisk"},{"code":"f1fa","name":"at"},{"code":"f1b9","name":"automobile"},{"code":"f04a","name":"backward"},{"code":"f24e","name":"balance-scale"},{"code":"f05e","name":"ban"},{"code":"f19c","name":"bank"},{"code":"f080","name":"bar-chart"},{"code":"f080","name":"bar-chart-o"},{"code":"f02a","name":"barcode"},{"code":"f0c9","name":"bars"},{"code":"f244","name":"battery-0"},{"code":"f243","name":"battery-1"},{"code":"f242","name":"battery-2"},{"code":"f241","name":"battery-3"},{"code":"f240","name":"battery-4"},{"code":"f244","name":"battery-empty"},{"code":"f240","name":"battery-full"},{"code":"f242","name":"battery-half"},{"code":"f243","name":"battery-quarter"},{"code":"f241","name":"battery-three-quarters"},{"code":"f236","name":"bed"},{"code":"f0fc","name":"beer"},{"code":"f1b4","name":"behance"},{"code":"f1b5","name":"behance-square"},{"code":"f0f3","name":"bell"},{"code":"f0a2","name":"bell-o"},{"code":"f1f6","name":"bell-slash"},{"code":"f1f7","name":"bell-slash-o"},{"code":"f206","name":"bicycle"},{"code":"f1e5","name":"binoculars"},{"code":"f1fd","name":"birthday-cake"},{"code":"f171","name":"bitbucket"},{"code":"f172","name":"bitbucket-square"},{"code":"f15a","name":"bitcoin"},{"code":"f27e","name":"black-tie"},{"code":"f293","name":"bluetooth"},{"code":"f294","name":"bluetooth-b"},{"code":"f032","name":"bold"},{"code":"f0e7","name":"bolt"},{"code":"f1e2","name":"bomb"},{"code":"f02d","name":"book"},{"code":"f02e","name":"bookmark"},{"code":"f097","name":"bookmark-o"},{"code":"f0b1","name":"briefcase"},{"code":"f15a","name":"btc"},{"code":"f188","name":"bug"},{"code":"f1ad","name":"building"},{"code":"f0f7","name":"building-o"},{"code":"f0a1","name":"bullhorn"},{"code":"f140","name":"bullseye"},{"code":"f207","name":"bus"},{"code":"f20d","name":"buysellads"},{"code":"f1ba","name":"cab"},{"code":"f1ec","name":"calculator"},{"code":"f073","name":"calendar"},{"code":"f274","name":"calendar-check-o"},{"code":"f272","name":"calendar-minus-o"},{"code":"f133","name":"calendar-o"},{"code":"f271","name":"calendar-plus-o"},{"code":"f273","name":"calendar-times-o"},{"code":"f030","name":"camera"},{"code":"f083","name":"camera-retro"},{"code":"f1b9","name":"car"},{"code":"f0d7","name":"caret-down"},{"code":"f0d9","name":"caret-left"},{"code":"f0da","name":"caret-right"},{"code":"f150","name":"caret-square-o-down"},{"code":"f191","name":"caret-square-o-left"},{"code":"f152","name":"caret-square-o-right"},{"code":"f151","name":"caret-square-o-up"},{"code":"f0d8","name":"caret-up"},{"code":"f218","name":"cart-arrow-down"},{"code":"f217","name":"cart-plus"},{"code":"f20a","name":"cc"},{"code":"f1f3","name":"cc-amex"},{"code":"f24c","name":"cc-diners-club"},{"code":"f1f2","name":"cc-discover"},{"code":"f24b","name":"cc-jcb"},{"code":"f1f1","name":"cc-mastercard"},{"code":"f1f4","name":"cc-paypal"},{"code":"f1f5","name":"cc-stripe"},{"code":"f1f0","name":"cc-visa"},{"code":"f0a3","name":"certificate"},{"code":"f0c1","name":"chain"},{"code":"f127","name":"chain-broken"},{"code":"f00c","name":"check"},{"code":"f058","name":"check-circle"},{"code":"f05d","name":"check-circle-o"},{"code":"f14a","name":"check-square"},{"code":"f046","name":"check-square-o"},{"code":"f13a","name":"chevron-circle-down"},{"code":"f137","name":"chevron-circle-left"},{"code":"f138","name":"chevron-circle-right"},{"code":"f139","name":"chevron-circle-up"},{"code":"f078","name":"chevron-down"},{"code":"f053","name":"chevron-left"},{"code":"f054","name":"chevron-right"},{"code":"f077","name":"chevron-up"},{"code":"f1ae","name":"child"},{"code":"f268","name":"chrome"},{"code":"f111","name":"circle"},{"code":"f10c","name":"circle-o"},{"code":"f1ce","name":"circle-o-notch"},{"code":"f1db","name":"circle-thin"},{"code":"f0ea","name":"clipboard"},{"code":"f017","name":"clock-o"},{"code":"f24d","name":"clone"},{"code":"f00d","name":"close"},{"code":"f0c2","name":"cloud"},{"code":"f0ed","name":"cloud-download"},{"code":"f0ee","name":"cloud-upload"},{"code":"f157","name":"cny"},{"code":"f121","name":"code"},{"code":"f126","name":"code-fork"},{"code":"f1cb","name":"codepen"},{"code":"f284","name":"codiepie"},{"code":"f0f4","name":"coffee"},{"code":"f013","name":"cog"},{"code":"f085","name":"cogs"},{"code":"f0db","name":"columns"},{"code":"f075","name":"comment"},{"code":"f0e5","name":"comment-o"},{"code":"f27a","name":"commenting"},{"code":"f27b","name":"commenting-o"},{"code":"f086","name":"comments"},{"code":"f0e6","name":"comments-o"},{"code":"f14e","name":"compass"},{"code":"f066","name":"compress"},{"code":"f20e","name":"connectdevelop"},{"code":"f26d","name":"contao"},{"code":"f0c5","name":"copy"},{"code":"f1f9","name":"copyright"},{"code":"f25e","name":"creative-commons"},{"code":"f09d","name":"credit-card"},{"code":"f283","name":"credit-card-alt"},{"code":"f125","name":"crop"},{"code":"f05b","name":"crosshairs"},{"code":"f13c","name":"css3"},{"code":"f1b2","name":"cube"},{"code":"f1b3","name":"cubes"},{"code":"f0c4","name":"cut"},{"code":"f0f5","name":"cutlery"},{"code":"f0e4","name":"dashboard"},{"code":"f210","name":"dashcube"},{"code":"f1c0","name":"database"},{"code":"f03b","name":"dedent"},{"code":"f1a5","name":"delicious"},{"code":"f108","name":"desktop"},{"code":"f1bd","name":"deviantart"},{"code":"f219","name":"diamond"},{"code":"f1a6","name":"digg"},{"code":"f155","name":"dollar"},{"code":"f192","name":"dot-circle-o"},{"code":"f019","name":"download"},{"code":"f17d","name":"dribbble"},{"code":"f16b","name":"dropbox"},{"code":"f1a9","name":"drupal"},{"code":"f282","name":"edge"},{"code":"f044","name":"edit"},{"code":"f052","name":"eject"},{"code":"f141","name":"ellipsis-h"},{"code":"f142","name":"ellipsis-v"},{"code":"f1d1","name":"empire"},{"code":"f0e0","name":"envelope"},{"code":"f003","name":"envelope-o"},{"code":"f199","name":"envelope-square"},{"code":"f12d","name":"eraser"},{"code":"f153","name":"eur"},{"code":"f153","name":"euro"},{"code":"f0ec","name":"exchange"},{"code":"f12a","name":"exclamation"},{"code":"f06a","name":"exclamation-circle"},{"code":"f071","name":"exclamation-triangle"},{"code":"f065","name":"expand"},{"code":"f23e","name":"expeditedssl"},{"code":"f08e","name":"external-link"},{"code":"f14c","name":"external-link-square"},{"code":"f06e","name":"eye"},{"code":"f070","name":"eye-slash"},{"code":"f1fb","name":"eyedropper"},{"code":"f09a","name":"facebook"},{"code":"f09a","name":"facebook-f"},{"code":"f230","name":"facebook-official"},{"code":"f082","name":"facebook-square"},{"code":"f049","name":"fast-backward"},{"code":"f050","name":"fast-forward"},{"code":"f1ac","name":"fax"},{"code":"f09e","name":"feed"},{"code":"f182","name":"female"},{"code":"f0fb","name":"fighter-jet"},{"code":"f15b","name":"file"},{"code":"f1c6","name":"file-archive-o"},{"code":"f1c7","name":"file-audio-o"},{"code":"f1c9","name":"file-code-o"},{"code":"f1c3","name":"file-excel-o"},{"code":"f1c5","name":"file-image-o"},{"code":"f1c8","name":"file-movie-o"},{"code":"f016","name":"file-o"},{"code":"f1c1","name":"file-pdf-o"},{"code":"f1c5","name":"file-photo-o"},{"code":"f1c5","name":"file-picture-o"},{"code":"f1c4","name":"file-powerpoint-o"},{"code":"f1c7","name":"file-sound-o"},{"code":"f15c","name":"file-text"},{"code":"f0f6","name":"file-text-o"},{"code":"f1c8","name":"file-video-o"},{"code":"f1c2","name":"file-word-o"},{"code":"f1c6","name":"file-zip-o"},{"code":"f0c5","name":"files-o"},{"code":"f008","name":"film"},{"code":"f0b0","name":"filter"},{"code":"f06d","name":"fire"},{"code":"f134","name":"fire-extinguisher"},{"code":"f269","name":"firefox"},{"code":"f024","name":"flag"},{"code":"f11e","name":"flag-checkered"},{"code":"f11d","name":"flag-o"},{"code":"f0e7","name":"flash"},{"code":"f0c3","name":"flask"},{"code":"f16e","name":"flickr"},{"code":"f0c7","name":"floppy-o"},{"code":"f07b","name":"folder"},{"code":"f114","name":"folder-o"},{"code":"f07c","name":"folder-open"},{"code":"f115","name":"folder-open-o"},{"code":"f031","name":"font"},{"code":"f280","name":"fonticons"},{"code":"f286","name":"fort-awesome"},{"code":"f211","name":"forumbee"},{"code":"f04e","name":"forward"},{"code":"f180","name":"foursquare"},{"code":"f119","name":"frown-o"},{"code":"f1e3","name":"futbol-o"},{"code":"f11b","name":"gamepad"},{"code":"f0e3","name":"gavel"},{"code":"f154","name":"gbp"},{"code":"f1d1","name":"ge"},{"code":"f013","name":"gear"},{"code":"f085","name":"gears"},{"code":"f22d","name":"genderless"},{"code":"f265","name":"get-pocket"},{"code":"f260","name":"gg"},{"code":"f261","name":"gg-circle"},{"code":"f06b","name":"gift"},{"code":"f1d3","name":"git"},{"code":"f1d2","name":"git-square"},{"code":"f09b","name":"github"},{"code":"f113","name":"github-alt"},{"code":"f092","name":"github-square"},{"code":"f184","name":"gittip"},{"code":"f000","name":"glass"},{"code":"f0ac","name":"globe"},{"code":"f1a0","name":"google"},{"code":"f0d5","name":"google-plus"},{"code":"f0d4","name":"google-plus-square"},{"code":"f1ee","name":"google-wallet"},{"code":"f19d","name":"graduation-cap"},{"code":"f184","name":"gratipay"},{"code":"f0c0","name":"group"},{"code":"f0fd","name":"h-square"},{"code":"f1d4","name":"hacker-news"},{"code":"f255","name":"hand-grab-o"},{"code":"f258","name":"hand-lizard-o"},{"code":"f0a7","name":"hand-o-down"},{"code":"f0a5","name":"hand-o-left"},{"code":"f0a4","name":"hand-o-right"},{"code":"f0a6","name":"hand-o-up"},{"code":"f256","name":"hand-paper-o"},{"code":"f25b","name":"hand-peace-o"},{"code":"f25a","name":"hand-pointer-o"},{"code":"f255","name":"hand-rock-o"},{"code":"f257","name":"hand-scissors-o"},{"code":"f259","name":"hand-spock-o"},{"code":"f256","name":"hand-stop-o"},{"code":"f292","name":"hashtag"},{"code":"f0a0","name":"hdd-o"},{"code":"f1dc","name":"header"},{"code":"f025","name":"headphones"},{"code":"f004","name":"heart"},{"code":"f08a","name":"heart-o"},{"code":"f21e","name":"heartbeat"},{"code":"f1da","name":"history"},{"code":"f015","name":"home"},{"code":"f0f8","name":"hospital-o"},{"code":"f236","name":"hotel"},{"code":"f254","name":"hourglass"},{"code":"f251","name":"hourglass-1"},{"code":"f252","name":"hourglass-2"},{"code":"f253","name":"hourglass-3"},{"code":"f253","name":"hourglass-end"},{"code":"f252","name":"hourglass-half"},{"code":"f250","name":"hourglass-o"},{"code":"f251","name":"hourglass-start"},{"code":"f27c","name":"houzz"},{"code":"f13b","name":"html5"},{"code":"f246","name":"i-cursor"},{"code":"f20b","name":"ils"},{"code":"f03e","name":"image"},{"code":"f01c","name":"inbox"},{"code":"f03c","name":"indent"},{"code":"f275","name":"industry"},{"code":"f129","name":"info"},{"code":"f05a","name":"info-circle"},{"code":"f156","name":"inr"},{"code":"f16d","name":"instagram"},{"code":"f19c","name":"institution"},{"code":"f26b","name":"internet-explorer"},{"code":"f224","name":"intersex"},{"code":"f208","name":"ioxhost"},{"code":"f033","name":"italic"},{"code":"f1aa","name":"joomla"},{"code":"f157","name":"jpy"},{"code":"f1cc","name":"jsfiddle"},{"code":"f084","name":"key"},{"code":"f11c","name":"keyboard-o"},{"code":"f159","name":"krw"},{"code":"f1ab","name":"language"},{"code":"f109","name":"laptop"},{"code":"f202","name":"lastfm"},{"code":"f203","name":"lastfm-square"},{"code":"f06c","name":"leaf"},{"code":"f212","name":"leanpub"},{"code":"f0e3","name":"legal"},{"code":"f094","name":"lemon-o"},{"code":"f149","name":"level-down"},{"code":"f148","name":"level-up"},{"code":"f1cd","name":"life-bouy"},{"code":"f1cd","name":"life-buoy"},{"code":"f1cd","name":"life-ring"},{"code":"f1cd","name":"life-saver"},{"code":"f0eb","name":"lightbulb-o"},{"code":"f201","name":"line-chart"},{"code":"f0c1","name":"link"},{"code":"f0e1","name":"linkedin"},{"code":"f08c","name":"linkedin-square"},{"code":"f17c","name":"linux"},{"code":"f03a","name":"list"},{"code":"f022","name":"list-alt"},{"code":"f0cb","name":"list-ol"},{"code":"f0ca","name":"list-ul"},{"code":"f124","name":"location-arrow"},{"code":"f023","name":"lock"},{"code":"f175","name":"long-arrow-down"},{"code":"f177","name":"long-arrow-left"},{"code":"f178","name":"long-arrow-right"},{"code":"f176","name":"long-arrow-up"},{"code":"f0d0","name":"magic"},{"code":"f076","name":"magnet"},{"code":"f064","name":"mail-forward"},{"code":"f112","name":"mail-reply"},{"code":"f122","name":"mail-reply-all"},{"code":"f183","name":"male"},{"code":"f279","name":"map"},{"code":"f041","name":"map-marker"},{"code":"f278","name":"map-o"},{"code":"f276","name":"map-pin"},{"code":"f277","name":"map-signs"},{"code":"f222","name":"mars"},{"code":"f227","name":"mars-double"},{"code":"f229","name":"mars-stroke"},{"code":"f22b","name":"mars-stroke-h"},{"code":"f22a","name":"mars-stroke-v"},{"code":"f136","name":"maxcdn"},{"code":"f20c","name":"meanpath"},{"code":"f23a","name":"medium"},{"code":"f0fa","name":"medkit"},{"code":"f11a","name":"meh-o"},{"code":"f223","name":"mercury"},{"code":"f130","name":"microphone"},{"code":"f131","name":"microphone-slash"},{"code":"f068","name":"minus"},{"code":"f056","name":"minus-circle"},{"code":"f146","name":"minus-square"},{"code":"f147","name":"minus-square-o"},{"code":"f289","name":"mixcloud"},{"code":"f10b","name":"mobile"},{"code":"f10b","name":"mobile-phone"},{"code":"f285","name":"modx"},{"code":"f0d6","name":"money"},{"code":"f186","name":"moon-o"},{"code":"f19d","name":"mortar-board"},{"code":"f21c","name":"motorcycle"},{"code":"f245","name":"mouse-pointer"},{"code":"f001","name":"music"},{"code":"f0c9","name":"navicon"},{"code":"f22c","name":"neuter"},{"code":"f1ea","name":"newspaper-o"},{"code":"f247","name":"object-group"},{"code":"f248","name":"object-ungroup"},{"code":"f263","name":"odnoklassniki"},{"code":"f264","name":"odnoklassniki-square"},{"code":"f23d","name":"opencart"},{"code":"f19b","name":"openid"},{"code":"f26a","name":"opera"},{"code":"f23c","name":"optin-monster"},{"code":"f03b","name":"outdent"},{"code":"f18c","name":"pagelines"},{"code":"f1fc","name":"paint-brush"},{"code":"f1d8","name":"paper-plane"},{"code":"f1d9","name":"paper-plane-o"},{"code":"f0c6","name":"paperclip"},{"code":"f1dd","name":"paragraph"},{"code":"f0ea","name":"paste"},{"code":"f04c","name":"pause"},{"code":"f28b","name":"pause-circle"},{"code":"f28c","name":"pause-circle-o"},{"code":"f1b0","name":"paw"},{"code":"f1ed","name":"paypal"},{"code":"f040","name":"pencil"},{"code":"f14b","name":"pencil-square"},{"code":"f044","name":"pencil-square-o"},{"code":"f295","name":"percent"},{"code":"f095","name":"phone"},{"code":"f098","name":"phone-square"},{"code":"f03e","name":"photo"},{"code":"f03e","name":"picture-o"},{"code":"f200","name":"pie-chart"},{"code":"f1a7","name":"pied-piper"},{"code":"f1a8","name":"pied-piper-alt"},{"code":"f0d2","name":"pinterest"},{"code":"f231","name":"pinterest-p"},{"code":"f0d3","name":"pinterest-square"},{"code":"f072","name":"plane"},{"code":"f04b","name":"play"},{"code":"f144","name":"play-circle"},{"code":"f01d","name":"play-circle-o"},{"code":"f1e6","name":"plug"},{"code":"f067","name":"plus"},{"code":"f055","name":"plus-circle"},{"code":"f0fe","name":"plus-square"},{"code":"f196","name":"plus-square-o"},{"code":"f011","name":"power-off"},{"code":"f02f","name":"print"},{"code":"f288","name":"product-hunt"},{"code":"f12e","name":"puzzle-piece"},{"code":"f1d6","name":"qq"},{"code":"f029","name":"qrcode"},{"code":"f128","name":"question"},{"code":"f059","name":"question-circle"},{"code":"f10d","name":"quote-left"},{"code":"f10e","name":"quote-right"},{"code":"f1d0","name":"ra"},{"code":"f074","name":"random"},{"code":"f1d0","name":"rebel"},{"code":"f1b8","name":"recycle"},{"code":"f1a1","name":"reddit"},{"code":"f281","name":"reddit-alien"},{"code":"f1a2","name":"reddit-square"},{"code":"f021","name":"refresh"},{"code":"f25d","name":"registered"},{"code":"f00d","name":"remove"},{"code":"f18b","name":"renren"},{"code":"f0c9","name":"reorder"},{"code":"f01e","name":"repeat"},{"code":"f112","name":"reply"},{"code":"f122","name":"reply-all"},{"code":"f079","name":"retweet"},{"code":"f157","name":"rmb"},{"code":"f018","name":"road"},{"code":"f135","name":"rocket"},{"code":"f0e2","name":"rotate-left"},{"code":"f01e","name":"rotate-right"},{"code":"f158","name":"rouble"},{"code":"f09e","name":"rss"},{"code":"f143","name":"rss-square"},{"code":"f158","name":"rub"},{"code":"f158","name":"ruble"},{"code":"f156","name":"rupee"},{"code":"f267","name":"safari"},{"code":"f0c7","name":"save"},{"code":"f0c4","name":"scissors"},{"code":"f28a","name":"scribd"},{"code":"f002","name":"search"},{"code":"f010","name":"search-minus"},{"code":"f00e","name":"search-plus"},{"code":"f213","name":"sellsy"},{"code":"f1d8","name":"send"},{"code":"f1d9","name":"send-o"},{"code":"f233","name":"server"},{"code":"f064","name":"share"},{"code":"f1e0","name":"share-alt"},{"code":"f1e1","name":"share-alt-square"},{"code":"f14d","name":"share-square"},{"code":"f045","name":"share-square-o"},{"code":"f20b","name":"shekel"},{"code":"f20b","name":"sheqel"},{"code":"f132","name":"shield"},{"code":"f21a","name":"ship"},{"code":"f214","name":"shirtsinbulk"},{"code":"f290","name":"shopping-bag"},{"code":"f291","name":"shopping-basket"},{"code":"f07a","name":"shopping-cart"},{"code":"f090","name":"sign-in"},{"code":"f08b","name":"sign-out"},{"code":"f012","name":"signal"},{"code":"f215","name":"simplybuilt"},{"code":"f0e8","name":"sitemap"},{"code":"f216","name":"skyatlas"},{"code":"f17e","name":"skype"},{"code":"f198","name":"slack"},{"code":"f1de","name":"sliders"},{"code":"f1e7","name":"slideshare"},{"code":"f118","name":"smile-o"},{"code":"f1e3","name":"soccer-ball-o"},{"code":"f0dc","name":"sort"},{"code":"f15d","name":"sort-alpha-asc"},{"code":"f15e","name":"sort-alpha-desc"},{"code":"f160","name":"sort-amount-asc"},{"code":"f161","name":"sort-amount-desc"},{"code":"f0de","name":"sort-asc"},{"code":"f0dd","name":"sort-desc"},{"code":"f0dd","name":"sort-down"},{"code":"f162","name":"sort-numeric-asc"},{"code":"f163","name":"sort-numeric-desc"},{"code":"f0de","name":"sort-up"},{"code":"f1be","name":"soundcloud"},{"code":"f197","name":"space-shuttle"},{"code":"f110","name":"spinner"},{"code":"f1b1","name":"spoon"},{"code":"f1bc","name":"spotify"},{"code":"f0c8","name":"square"},{"code":"f096","name":"square-o"},{"code":"f18d","name":"stack-exchange"},{"code":"f16c","name":"stack-overflow"},{"code":"f005","name":"star"},{"code":"f089","name":"star-half"},{"code":"f123","name":"star-half-empty"},{"code":"f123","name":"star-half-full"},{"code":"f123","name":"star-half-o"},{"code":"f006","name":"star-o"},{"code":"f1b6","name":"steam"},{"code":"f1b7","name":"steam-square"},{"code":"f048","name":"step-backward"},{"code":"f051","name":"step-forward"},{"code":"f0f1","name":"stethoscope"},{"code":"f249","name":"sticky-note"},{"code":"f24a","name":"sticky-note-o"},{"code":"f04d","name":"stop"},{"code":"f28d","name":"stop-circle"},{"code":"f28e","name":"stop-circle-o"},{"code":"f21d","name":"street-view"},{"code":"f0cc","name":"strikethrough"},{"code":"f1a4","name":"stumbleupon"},{"code":"f1a3","name":"stumbleupon-circle"},{"code":"f12c","name":"subscript"},{"code":"f239","name":"subway"},{"code":"f0f2","name":"suitcase"},{"code":"f185","name":"sun-o"},{"code":"f12b","name":"superscript"},{"code":"f1cd","name":"support"},{"code":"f0ce","name":"table"},{"code":"f10a","name":"tablet"},{"code":"f0e4","name":"tachometer"},{"code":"f02b","name":"tag"},{"code":"f02c","name":"tags"},{"code":"f0ae","name":"tasks"},{"code":"f1ba","name":"taxi"},{"code":"f26c","name":"television"},{"code":"f1d5","name":"tencent-weibo"},{"code":"f120","name":"terminal"},{"code":"f034","name":"text-height"},{"code":"f035","name":"text-width"},{"code":"f00a","name":"th"},{"code":"f009","name":"th-large"},{"code":"f00b","name":"th-list"},{"code":"f08d","name":"thumb-tack"},{"code":"f165","name":"thumbs-down"},{"code":"f088","name":"thumbs-o-down"},{"code":"f087","name":"thumbs-o-up"},{"code":"f164","name":"thumbs-up"},{"code":"f145","name":"ticket"},{"code":"f00d","name":"times"},{"code":"f057","name":"times-circle"},{"code":"f05c","name":"times-circle-o"},{"code":"f043","name":"tint"},{"code":"f150","name":"toggle-down"},{"code":"f191","name":"toggle-left"},{"code":"f204","name":"toggle-off"},{"code":"f205","name":"toggle-on"},{"code":"f152","name":"toggle-right"},{"code":"f151","name":"toggle-up"},{"code":"f25c","name":"trademark"},{"code":"f238","name":"train"},{"code":"f224","name":"transgender"},{"code":"f225","name":"transgender-alt"},{"code":"f1f8","name":"trash"},{"code":"f014","name":"trash-o"},{"code":"f1bb","name":"tree"},{"code":"f181","name":"trello"},{"code":"f262","name":"tripadvisor"},{"code":"f091","name":"trophy"},{"code":"f0d1","name":"truck"},{"code":"f195","name":"try"},{"code":"f1e4","name":"tty"},{"code":"f173","name":"tumblr"},{"code":"f174","name":"tumblr-square"},{"code":"f195","name":"turkish-lira"},{"code":"f26c","name":"tv"},{"code":"f1e8","name":"twitch"},{"code":"f099","name":"twitter"},{"code":"f081","name":"twitter-square"},{"code":"f0e9","name":"umbrella"},{"code":"f0cd","name":"underline"},{"code":"f0e2","name":"undo"},{"code":"f19c","name":"university"},{"code":"f127","name":"unlink"},{"code":"f09c","name":"unlock"},{"code":"f13e","name":"unlock-alt"},{"code":"f0dc","name":"unsorted"},{"code":"f093","name":"upload"},{"code":"f287","name":"usb"},{"code":"f155","name":"usd"},{"code":"f007","name":"user"},{"code":"f0f0","name":"user-md"},{"code":"f234","name":"user-plus"},{"code":"f21b","name":"user-secret"},{"code":"f235","name":"user-times"},{"code":"f0c0","name":"users"},{"code":"f221","name":"venus"},{"code":"f226","name":"venus-double"},{"code":"f228","name":"venus-mars"},{"code":"f237","name":"viacoin"},{"code":"f03d","name":"video-camera"},{"code":"f27d","name":"vimeo"},{"code":"f194","name":"vimeo-square"},{"code":"f1ca","name":"vine"},{"code":"f189","name":"vk"},{"code":"f027","name":"volume-down"},{"code":"f026","name":"volume-off"},{"code":"f028","name":"volume-up"},{"code":"f071","name":"warning"},{"code":"f1d7","name":"wechat"},{"code":"f18a","name":"weibo"},{"code":"f1d7","name":"weixin"},{"code":"f232","name":"whatsapp"},{"code":"f193","name":"wheelchair"},{"code":"f1eb","name":"wifi"},{"code":"f266","name":"wikipedia-w"},{"code":"f17a","name":"windows"},{"code":"f159","name":"won"},{"code":"f19a","name":"wordpress"},{"code":"f0ad","name":"wrench"},{"code":"f168","name":"xing"},{"code":"f169","name":"xing-square"},{"code":"f23b","name":"y-combinator"},{"code":"f1d4","name":"y-combinator-square"},{"code":"f19e","name":"yahoo"},{"code":"f23b","name":"yc"},{"code":"f1d4","name":"yc-square"},{"code":"f1e9","name":"yelp"},{"code":"f157","name":"yen"},{"code":"f167","name":"youtube"},{"code":"f16a","name":"youtube-play"},{"code":"f166","name":"youtube-square"}];

        if (typeof G1admin.fontAwesomeListFilter !== 'undefined') {
            fontAwesomeList = G1admin.fontAwesomeListFilter(fontAwesomeList);
        }

        return fontAwesomeList;
    }
});
})(jQuery);

/**
 *
 * Check for update
 *
 */
(function($) {

    'use strict';

    $(document).ready(function(){
        if ($('body.appearance_page_g1_theme_options').length > 0) {
            $('a[href=\\#check-for-update]').on('click', function (e) {
                e.preventDefault();

                var $link = $(this);

                $link.text('Checking...');

                var xhr = $.ajax({
                    'type': 'GET',
                    'url' : ajaxurl,
                    'data': {
                        'action'   :    'g1_force_update_checking'
                    }
                });

                xhr.done(function (res) {
                    $link.hide();

                    if (res === 'update available') {
                        $('#g1-updates-available').show();
                    } else {
                        $('#g1-no-updates').show();
                    }
                });
            });
        }
    });

})(jQuery);