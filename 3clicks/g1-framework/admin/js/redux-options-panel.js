(function ($) {
    var sections = [
        {
            'id': 'general_section_group_li',
            'subsections': [
                {
                    'id': 'general_main_section_group_li'
                },
                {
                    'id': 'general_branding_section_group_li'
                }
            ]
        },
        {
            'id': 'style_section_group_li',
            'subsections': [
                {
                    'id': 'style_main_section_group_li'
                },
                {
                    'id': 'style_fonts_section_group_li'
                },
                {
                    'id': 'style_images_section_group_li'
                },
                {
                    'id': 'style_preheader_section_group_li'
                },
                {
                    'id': 'style_header_section_group_li'
                },
                {
                    'id': 'style_precontent_section_group_li'
                },
                {
                    'id': 'style_content_section_group_li'
                },
                {
                    'id': 'style_prefooter_section_group_li'
                },
                {
                    'id': 'style_footer_section_group_li'
                }
            ]
        },
        {
            'id': 'empty_post_archive_section_group_li',
            'subsections': [
                {
                    'id': 'post_single_section_group_li'
                },
                {
                    'id': 'post_archive_section_group_li'
                },
                {
                    'id': 'category_archive_section_group_li'
                },
                {
                    'id': 'posttag_archive_section_group_li'
                }
            ]
        },
        {
            'id': 'empty_g1work_archive_section_group_li',
            'subsections': [
                {
                    'id': 'g1work_single_section_group_li'
                },
                {
                    'id': 'g1work_archive_section_group_li'
                },
                {
                    'id': 'g1workcategory_archive_section_group_li'
                },
                {
                    'id': 'g1worktag_archive_section_group_li'
                }
            ]
        }
    ];

    var skins = [
        {
            name: 'Skin 01',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/01.txt'
        },
        {
            name: 'Skin 02',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/02.txt'
        },
        {
            name: 'Skin 03',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/03.txt'
        },
        {
            name: 'Skin 04',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/04.txt'
        },
        {
            name: 'Skin 05',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/05.txt'
        },
        {
            name: 'Skin 06',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/06.txt'
        },
        {
            name: 'Skin 07',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/07.txt'
        },
        {
            name: 'Skin 08',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/08.txt'
        },
        {
            name: 'Skin 09',
            link: 'http://3clicks.bringthepixel.com/wp-content/themes/3clicks/css/demos/09.txt'
        }
    ];

    $(document).ready(function () {
        $('a[href="http://www.google.com/webfonts"]').parent().remove();

        addImportSkinFeature();

		// hide old map settings
		$('#g1-gmaps-plugin-activated').each(function () {
			var $wrapper = $(this).parents('#map_section_group');

			$wrapper.find('.form-table').hide();
		});

        $('.redux-option-disabled').each(function() {
            var $wrapper = $(this).parents('td');

            $wrapper.find('select').prop('disabled', 'disabled');
        });

        // bind links to configs
        $('#g1-map-configuration-link').click(function(e) {
            e.preventDefault();
            $("#map_section_group_li_a").trigger("click");
        });

        $('#g1-twitter-configuration-link').click(function(e) {
            e.preventDefault();
            $("#twitter_section_group_li_a").trigger("click");
        });

        // show/hide background image components
        $('.g1-background-image-fieldset').each(function () {
            var $this = $(this);
            var $selectedOption = $this.find('option:selected').val();

            $this.parents('tr').nextAll(':lt(5)').addClass('g1-fieldset-element');

            toggleBackgroundImageFieldset($this);

            $this.change(function () {
                toggleBackgroundImageFieldset($this);
            });
        });

        function toggleBackgroundImageFieldset ($select) {
            var show = $select.find('option:selected').val() !== 'none';

            var $components = $select.parents('tr').nextAll(':lt(5)');

            show ? $components.show() : $components.hide();
        }

        // show/hide divider components
        $('.g1-divider-fieldset').each(function () {
            var $this = $(this);
            var $selectedOption = $this.find('option:selected').val();

            $this.parents('tr').nextAll(':lt(2)').addClass('g1-fieldset-element');

            toggleDividerFieldset($this);

            $this.change(function () {
                toggleDividerFieldset($this);
            });
        });

        function toggleDividerFieldset ($select) {
            var show = $select.find('option:selected').val() !== 'none';

            var $components = $select.parents('tr').nextAll(':lt(2)');

            show ? $components.show() : $components.hide();
        }

        function addImportSkinFeature () {
            var $skinSelectionWrapper = $('<ol>').attr('id', 'redux-skin-selection');
            var $hiddenInput = $('<input type="hidden" name="import_type" value="" />');
            $('#import-link-value').after($hiddenInput);

            $(skins).each(function (i) {
                var skin = skins[i];
                var $link = $('<a href="#">').text(skin.name);

                $link.click(function (e) {
                    e.preventDefault();
                    $('#import-link-value').val(skin.link);
                });

                $skinSelectionWrapper.append($('<li>').append($link));
            });

            $('#redux-opts-import-link-wrapper').prepend($skinSelectionWrapper);

            $('#redux-opts-import-skin-button').click(function () {
                if ($('#redux-opts-import-code-wrapper').is(':visible')) {
                    $('#redux-opts-import-code-wrapper').fadeOut('fast');
                    $('#import-code-value').val('');
                }
                $('#redux-opts-import-link-wrapper').fadeIn('slow');
                $skinSelectionWrapper.show();
                $hiddenInput.val('skin');
            });

            $('#redux-opts-import-link-button').click(function () {
                $skinSelectionWrapper.hide();
                $hiddenInput.val('all');
            });
        }

        // handle subsections
        $('#redux-opts-group-menu').each(function () {
            var $context = $(this);

            for (var i in sections) {
                var section = sections[i];

                // build subsections
                (function() {
                    var $section = $context.find('#' + section.id);
                    var subsections = section.subsections;
                    var $subsections = $('<ul>').addClass('redux-subsections');

                    for (var k in subsections) {
                        var subsection = subsections[k];
                        var $subsection = $context.find('#' + subsection.id);
                        $subsection.addClass('redux-subsection');

                        $subsection.appendTo($subsections);
                    }

                    $subsections.hide();
                    $subsections.appendTo($section);
                    $section.addClass('redux-section-with-subsections');

                    $section.children('.redux-opts-group-tab-link-a').click(function () {
                        $context.find('.redux-subsections').trigger('collapse');
                        $subsections.trigger('select');
                    });
                })(section);
            }

            $context.find('> li:not(.redux-section-with-subsections) > a').click(function () {
                $context.find('.redux-subsections').trigger('collapse');
            });

            $context.find('.redux-opts-group-tab-link-a').bind('click', function () {
                var $subsections = $(this).parents('.redux-subsections');

                if ($subsections && !$subsections.is(':visible')) {
                    $subsections.trigger('select');
                }

                saveSelection($(this));
            });

            $context.find('.redux-subsections').each(function () {
                var $subsections = $(this);

                $subsections.bind('collapse', function () {
                    $(this).hide();
                    $(this).parent().removeClass('redux-expanded');
                });

                $subsections.bind('select', function () {
                    if ($(this).is(':visible')) {
                        return;
                    }

                    $(this).show();
                    $(this).parent().addClass('redux-expanded');

                    if ($(this).find('.redux-subsection.active').length === 0) {
                        $(this).find('.redux-subsection:first .redux-opts-group-tab-link-a').trigger('click');
                    }
                });
            });

            restoreSelection();
        });
    });

    function restoreSelection () {
        var selectionId = getSelection();

        if (selectionId) {
            $('#' + selectionId).trigger('click');
        } else {
            $('#general_section_group_li_a:first').trigger('click');
        }

        $('#redux-opts-main-loaded').remove();
    }

    function saveSelection ( $obj ) {
        createCookie('redux_options_panel_selection', $obj.attr('id'))
    }

    function getSelection () {
        return readCookie('redux_options_panel_selection');
    }

    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
})(jQuery);