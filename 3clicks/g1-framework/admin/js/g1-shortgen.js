(function (exports, $) {
    var G1ShortcodeGenerator = (function() {
        var that = {};
        var instances;

        function init() {
            instances = {};
        }

        var getInstance = function(editor, generatorId) {
            if (typeof instances[generatorId] == 'undefined') {
                instances[generatorId] = createGenerator(editor, generatorId);
            }

            if (editor != null && !instances[generatorId].hasEditor()) {
                instances[generatorId].setEditor(editor);
            }

            return instances[generatorId];
        }

        var setInstance = function(generatorId, generator) {
            instances[generatorId] = generator;
        }

        var createShortcode = function ($shortcode) {
            return shortcode($shortcode);
        }

        var createShortcodeSection = function ($section) {
            return shortcodeSection($section)
        }

        var createGenerator = function (editor, generatorId) {
            return generator(editor, generatorId);
        }

        // public API
        that.getInstance = getInstance;
        that.setInstance = setInstance;
        that.createShortcode = createShortcode;
        that.createShortcodeSection = createShortcodeSection;
        that.createGenerator = createGenerator;

        init();

        return that;
    })();

    var shortcode = function($shortcode) {
        var that = {};
        var name;
        var id;
        var extract = {};

        function init() {
            name = getCleanName();
            id = getCleanId();

        }

        var getName = function() {
            return name;
        }

        var getId = function() {
            return id;
        }

        var getCleanName = function() {
            var val = $shortcode.find('.g1-shortcode h2:first').text();

            return val.replace(/[\[\]]/g, '');
        }

        var getCleanId = function () {
            var val = $shortcode.find('.g1-shortcode .g1-shortcode-meta input[name="id"]').val();

            if (!val) {
                return getName();
            }

            return val.replace(/[^\d_\w]/g, '');
        }

        var show = function() {
            $shortcode.show();
        }

        var render = function(isTinymceEditor) {
            var out;
            var displayType = $('.g1-shortcode .g1-shortcode-meta input[name="display"]', $shortcode).val();
            var $snippet = $('.g1-shortcode .g1-shortcode-result', $shortcode);
            var isSnippet = $snippet.length > 0;
            var $attributes = $('.g1-shortcode .g1-shortcode-attributes', $shortcode);
            var $content = $('.g1-shortcode .g1-shortcode-content', $shortcode);

            if (isSnippet) {
                out = composeSnippet($snippet, isTinymceEditor);
            } else {
                out = composeShortcode(getId(), displayType, parseAttributes($attributes), parseAttributes($content), isTinymceEditor);
            }

            return out;
        }

        var composeSnippet = function($snippet, isTinymceEditor) {
            if ( isTinymceEditor ) {
                return $snippet.find('textarea').val().replace(/\n/g,'<br />');
            } else {
                return $snippet.find('textarea').val();
            }
        }

        var parseOptionView = function($optionView) {
            var matches = $optionView.attr('class').match(/g1-option-view-([a-z-]+)/);

            if (matches == null) {
                return null;
            }

            var optionType = normalizeOptionType(matches[1]);

            if ( typeof extract[optionType] === 'function' ) {
                var result = extract[optionType]($optionView);

                if ( result instanceof Array ) {
                    return result;
                }
            }

            return null;
        }

        var parseAttributes = function($attributes) {

            var attributes = [];

            $('.g1-option-view', $attributes).each(function(){
                var attribute = parseOptionView($(this));;

                if (attribute != null) {
                    attributes.push(attribute);
                }
            });

            return attributes;
        }

        var composeShortcode = function(name, displayType, attributes, contentAttributes, isTinymceEditor) {
            var out = '[' + name;

            for (var i in attributes) {
                var attr = attributes[i];

                out += ' ' + attr[0] + '="' + attr[1] + '"';
            }

            out += ']';

            for (var i in contentAttributes) {
                var contentAttr = contentAttributes[i];

                var newLineSeparator = isTinymceEditor ? '<br />' : '\n';

                switch (displayType) {
                    case 'block':

                        out += newLineSeparator + contentAttr[1] + newLineSeparator + '[/' + name + ']';

                        break;
                    case 'inline':
                    default:
                        out += contentAttr[1] + '[/' + name + ']';
                        break;
                }
            }

            return out;
        }

        var normalizeOptionType = function(optionType) {
            var normalized = '';
            var parts = optionType.split( /-|_/ );
            for ( var i in parts ) {
                if (i == 0) {
                    normalized = parts[i];
                } else {
                    normalized += parts[i].charAt(0).toUpperCase() + parts[i].slice(1);
                }
            }

            return normalized;
        };

        /**
         * Extract name and value from string form unit
         */
        extract.string = function(x) {
            var out;
            $('input:eq(0)', x).each(function() {
                var attrValue = $(this).attr( 'value' );
                if ( attrValue.length ) {
                    out = new Array( $(this).attr( 'name' ), attrValue );

                }
            });

            return out;
        };

        /**
         * Extract name and value from input checkbox form unit
         */
        extract.checkbox = function(x) {
            var out;
            $('input:eq(0)[checked]', x).each(function() {
                out = new Array( $(this).attr( 'name' ), 'true');
            });

            return out;
        };

        /**
         * Extract name and value from Choice form unit
         */
        extract.choice = function(x) {
            var out;
            $('select:eq(0)', x).each(function() {
                var option = $( 'option:selected:eq(0)', this );
                if ( option.length && option.attr( 'value' ).length ) {
                    out = new Array( $(this).attr( 'name' ), option.attr( 'value' ) );
                }
            });

            return out;
        };

        /**
         * Extract name and value from MultiChoice Text form unit
         */
        extract.multichoiceText = function(x) {
            var out;
            $('input[type=hidden]:eq(0)', x).each(function() {
                var attrValue = $(this).attr( 'value' );
                attrValue = attrValue.replace(/-/g, '_');

                if ( attrValue.length ) {
                    out = new Array( $(this).attr( 'name' ), attrValue );
                }
            });

            return out;
        };

        /**
         * Extract name and value from text form unit
         */
        extract.text = function(x) {
            var out;
            $('textarea:eq(0)', x).each(function() {
                var attrValue = $(this).attr( 'value' );
                if ( attrValue.length ) {
                    out = new Array( $(this).attr( 'name' ), attrValue );
                }
            });

            return out;
        };

        /**
         * Extract name and value from textarea form unit
         */
        extract.longText = function(x) {
            return extract.text(x);
        };

        /**
         * Extract name and value from color form unit
         */
        extract.color = function(x) {
            var out;
            $('input:eq(0)', x).each(function() {
                var attrValue = $(this).attr( 'value' );
                if ( attrValue.length ) {
                    out = new Array( $(this).attr( 'name' ), attrValue );
                }
            });

            return out;
        };

        init();

        that.getName = getName;
        that.show = show;
        that.render = render;

        return that;
    }

    var shortcodeSection = function($section) {
        var that = {};
        var name;
        var shortcodes;

        function init() {
            name = $section.find('h3:first').text();
            shortcodes = [];

            $section.find('.g1-viewport-item').each(function() {
                addShortcode($(this));
            });
        }

        var addShortcode = function($shortcode) {
            shortcodes.push(shortcode($shortcode));
        }

        var getShortcodes = function() {
            return shortcodes;
        }

        var getName = function() {
            return name;
        }

        init();

        that.addShortcode = addShortcode;
        that.getShortcodes = getShortcodes;
        that.getName = getName;

        return that;
    }

    var generator = function( tinymceEditor, id, mode ) {
        var that = {};
        var editor;
        var editorMode;
        var managerWrapperId;
        var $generatorWrapper;
        var shortcodeSections;
        var $navigation;
        var $viewportItems;
        var $actions;

        function init () {
            editor = tinymceEditor;
            editorMode = mode;
            managerWrapperId = id;
            $generatorWrapper = $('#' + managerWrapperId + ' .g1-shortcode-generator');
            $viewportItems = $generatorWrapper.find('.g1-viewport .g1-viewport-item');
            $actions = $('#' + managerWrapperId + ' .g1-actions');
            shortcodeSections = [];

            hideUI();
            parseShortcodesHtmlStructure();
            buildNavigation();
            bindActions();
        }

        var parseShortcodesHtmlStructure = function() {
            $generatorWrapper.find('.g1-shortcode-generator-section').each(function() {
                addShortcodeSection($(this));
            });
        }

        var addShortcodeSection = function($section) {
            var section = shortcodeSection($section);

            shortcodeSections.push(section);
        }

        var getShortcodeSections = function() {
            return shortcodeSections;
        }

        var  buildNavigation = function() {
            $navigation = $('<select>').attr('name', 'general-navigation');
            var $emptyOption = $('<option>').
                data('emptyOption', true).
                attr('selected', 'selected').
                text('- - -');

            $emptyOption.appendTo($navigation);

            var sections = getShortcodeSections();

            for (var sectionId in sections) {
                var section = sections[sectionId];
                var shortcodes = section.getShortcodes();

                var $optgroup = $('<optgroup>').attr('label', section.getName());
                $optgroup.appendTo($navigation);

                for (var shortcodeId in  shortcodes) {
                    var shortcode = shortcodes[shortcodeId];

                    $option = $('<option>').
                        data('g1_shortcode', shortcode).
                        attr('value', shortcode.getName()).
                        text(shortcode.getName());
                    $option.appendTo($optgroup);

                }
            }

            var $navigationWrapper = $('<div>').addClass('g1-nav');
            var $navigationLabel = $('<label>').attr('for', 'general-navigation').text('Select Item');

            $navigationWrapper.append($navigationLabel);
            $navigationWrapper.append($navigation);
            $navigationWrapper.prependTo($generatorWrapper);
        }

        var bindActions = function() {
            handleSelectShortocodeAction();
            handleInsertShortcodeAction();
        }

        var handleInsertShortcodeAction = function() {
            $actions.find('a').click(function(e) {
                e.preventDefault();

                var shortcode = getSelectedShortcode();

                if (shortcode) {
                    insertShortcodeToEditor(shortcode);
                }

                hideUI();
            });
        }

        var handleSelectShortocodeAction = function() {
            $navigation.change(function() {
                $viewportItems.hide();
                $actions.hide();

                var selectedShortcode = getSelectedShortcode();

                if (selectedShortcode) {
                    selectedShortcode.show();
                    $actions.show();
                }
            });
        }

        var getSelectedShortcode = function() {
            var $selected = $('option:selected', $navigation);

            if ($selected.data('emptyOption') == true) {
                return null;
            }

            return $selected.data('g1_shortcode');
        }

        var isTinymceEditor = function(){
            if (typeof wpActiveEditor === 'undefined') {
                return false;
            }

            var $editor = $('#' + wpActiveEditor).parents('.wp-editor-wrap');

            return $editor.hasClass('tmce-active');
        }

        var insertShortcodeToEditor  = function(shortcode) {
            if ( isTinymceEditor() && hasEditor()) {
                tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode.render(true));
            } else {
                QTags.insertContent(shortcode.render(false));
            }
        }

        var showUI = function() {
            var windowWidth = jQuery(window).width();
            var windowWidth = (720 < windowWidth) ? 720 : windowWidth;
            var windowHeight = jQuery(window).height();

            var title = $generatorWrapper.find('h1').text();

            windowWidth -= 80;
            windowHeight -= 80;

            // Display shortcode generator UI
            $generatorWrapper.show();
            $generatorWrapper.find('h1,h3').hide();
            $navigation.val("");
            $viewportItems.hide();
            $actions.hide();

            tb_show( title, '#TB_inline?width=' + windowWidth + '&height=' + windowHeight + '&inlineId=' + managerWrapperId, null );
            $("#TB_overlay,#TB_closeWindowButton").click(hideUI);
        }

        var hideUI = function() {
            tb_remove();
            $generatorWrapper.hide();
        };

        var hasEditor = function() {
            return editor != null;
        }

        var setEditor = function(editorInstance) {
            editor = editorInstance;
        }

        init();

        // public api
        that.hasEditor = hasEditor;
        that.setEditor = setEditor;
        that.insertShortcodeToEditor = insertShortcodeToEditor;
        that.showUI = showUI;
        that.hideUI = hideUI;
        that.addShortcodeSection = addShortcodeSection;
        that.getShortcodeSections = getShortcodeSections;

        return that;
    }

    // expose to the world
    exports.G1ShortcodeGenerator = G1ShortcodeGenerator;
})(window, jQuery);