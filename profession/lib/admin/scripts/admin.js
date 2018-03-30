(function ($) {

    var utility = {
        //Checks if element as desired attribute
        HasAttr: function ($elm, attr) {
            return typeof $elm.attr(attr) != 'undefined';
        },
        GetAttr: function ($elm, attr, def){
            return this.HasAttr($elm, attr) ? $elm.attr(attr) : def;
        }
    };

    //Show/hide fields based on selected value
    function FieldSelector() {
        $('.field-selector select').each(function () {
            var $select   = $(this),
                $section  = $select.parents('.section'),
                fieldList = utility.GetAttr($select, 'data-fields', ''),
                $fields   = $section.find(fieldList);

            $select.change(function () {
                var $selected = $select.find('option:selected');

                if (!utility.HasAttr($selected, 'data-show')) {
                    $fields.slideUp('fast');
                    return;
                }
                
                var show   = $selected.attr('data-show'),
                    $items = $section.find(show);

                $fields.not($items).slideUp('fast');
                $items.slideDown('fast');
            }).change();
        });
    }

    function CSVInput() {

        $('.csv-input').each(function () {
            var $container = $(this),
                $hidden = $container.find('input[type="hidden"]'),
                $input = $container.find('input[type="text"]'),
                $addBtn = $container.find('.btn-add'),
                $list = $container.find('.list');

            var values = $hidden.val().length > 0 ? $hidden.val().split(',') : [];
            
            //Add current items to our list
            for (i = 0; i < values.length; i++) {
                var val  = values[i],
                    text = val.replace('%666', ','),//Evil char 
                    $item = GetNewItem(val, text);

                $list.append($item);
                HandleCloseBtn($item);
            }

            AssembleList();

            //Handle add button
            $addBtn.click(function (e) {
                e.preventDefault();

                var val = $input.val();
                val = $.trim(val);
                $input.val('');//Clear

                if (val.length < 1)
                    return;

                var $item = GetNewItem(val.replace(",", "%666"), val);
                HandleCloseBtn($item);
                $item.hide();

                $list.prepend($item);

                AssembleList();

                $item.slideDown('fast', function () { $(window).resize(); });
            });

            function AssembleList() {
                $hidden.val('');//Clear the current list
                var vals = [];

                $list.find('.value').each(function () {
                    var value = $(this).attr('data-val');
                    vals.push(value);
                });

                $hidden.val(vals.join(','));
            }

            function HandleCloseBtn($item) {
                //Remove item on click
                $item.find('.btn-close').click(function (e) {
                    e.preventDefault();

                    $item.slideUp('fast', function () { $item.remove(); AssembleList(); $(window).resize(); });
                });
            }

            function GetNewItem(val, text) {
                return $('<div class="value" data-val="' + val + '"><span>' + text + '</span><a href="#" class="btn-close"></a></div>');
            }

        });


    }

    //To fit winow 
    function AdjustContainer() {
        var timerId = 0;
        $(window).resize(function () {
            clearTimeout(timerId);

            timerId = setTimeout(function () {
                //Set height to auto
                $('.theme-settings').css({height:'auto'});

                var $footer = $('#wpfooter'),
                    h = $footer.offset().top - $footer.outerHeight() - 12;

                $('.theme-settings').height(h);
            }, 100);

        }).resize();
    }

    function ImageSelect() {
        var $controls = $('.imageSelect');

        $controls.each(function () {
            var $select = $(this),
                $input = $select.find('input'),
                $options = $select.find('a');

            //Hide input control
            $input.hide();

            $options.click(function (e) {
                e.preventDefault();

                var $ctl = $(this);

                if ($ctl.hasClass('selected'))
                    return;

                $options.removeClass('selected');
                $ctl.addClass('selected');

                $input.val($ctl.html());
            });
        });
    }

    function Chosen() {
        if (!$.fn.chosen)
            return;

        $('.chosen').chosen();
    }

    function Combobox() {
        $('.select').each(function () {
            var $this = $(this),
                $overlay = $this.find('div'),
                $select = $this.find('select');

            $select.change(function () {
                $overlay.html($select.find('option:selected').text());
            });

            $select.change();
        });
    }

    function ColorPicker() {
        if (!$.fn.ColorPicker)
            return;

        $('.colorinput').each(function () {
            var $this = $(this),
                $parent = $this.parent(),
				$picker = $('<div class="color-selector"><div></div></div>'),
				col   = $this.val();
			
            if ($('#px-container').hasClass('post-meta'))
                $parent.append($picker);
            else
                $parent.prepend($picker);

            if (col.length < 1)
                col = '#FFFFFF';

            $picker.find('div').css('backgroundColor', col);

            $picker.ColorPicker({
                color: col,
                onChange: function (hsb, hex, rgb) {
                    $picker.find('div').css('backgroundColor', '#' + hex);
                    $this.val('#' + hex);
                }
            });


        });
    }

    function Sliders() {
        if (!$.fn.noUiSlider)
            return;

        var $sliders = $('input[type="range"]');

        $sliders.each(function () {
            var $this      = $(this),
                $parent    = $this.parent(),
                $label     = $('<span></span>'),
                min        = 0,
                max        = 100,
                start      = 0,
                isSwitch   = $this.hasClass('switch'),
                sliderCls  = isSwitch ? 'switch' : 'slider',
                $slider    = $('<div class="' + sliderCls + '"></div>'),
                states     = ['Off', 'On'],
                setupState = true;//For switches
                
            
            //Set label
            $parent.find('.label').prepend($label);

            if ('value' in this.attributes)
                $label.html(this.attributes['value'].nodeValue);
            
            //Set values
            if (isSwitch) {
                min = 0;
                max = 1;

                if ($this.attr('data-state0') !== undefined)
                    states[0] = $this.attr('data-state0');

                if ($this.attr('data-state1') !== undefined)
                    states[1] = $this.attr('data-state1');

            }
            else {

                if ($this.attr('min') !== undefined)
                    min = parseInt($this.attr('min'));

                if ($this.attr('max') !== undefined)
                    max = parseInt($this.attr('max'));

            }

            if ('value' in this.attributes && 
                this.attributes['value'].nodeValue.length > 0)
                start = parseInt(this.attributes['value'].nodeValue);
            else
                start = min + max * 0.5;

            $this.hide();
            $slider.appendTo($parent);

            $slider.noUiSlider('init', {
                knobs: 1,
                start: [start, start],
                scale: [min, max],
                connect: "lower",
                change: Handle_Change
            });

            function Handle_Change(e) {
                var value = Get_Value();

                if (isNaN(value) || (setupState && isSwitch && start > 0 && start < 1))
                    value = min;

                if (isSwitch) 
                    $label.html(states[value]);
                else
                    $label.html(value);

                $this.val(value);

                setupState = false;
            }

            function Get_Value() {
                return $slider.noUiSlider('value')[1];
            }
            
            var $midbar = $slider.find('.noUi-midBar'),
                left = $midbar.css('left'),
                right = $midbar.css('right');

            if (left == '0px' && right == '0px' && Get_Value() != max) {
                $midbar.css({ right: $this.width() });
            }

            var $sliderHandle = $slider.find('.noUi-handle');


            if (isSwitch) {
                var currentValue = Get_Value(),
                    isMouseDown = false;
                    
                
                $(document).mouseup(function () {
                    if (!isMouseDown) 
                        return;
                        
                    var value = Get_Value();
                    $slider.noUiSlider('move', { knob: 'upper', to: value, scale: [0, 1] });

                    isMouseDown = false;
                });

                $sliderHandle.find('div').mousedown(function () {
                    isMouseDown = true;
                });
                
                $slider.click(function () {
                    currentValue = currentValue == 0 ? 1 : 0;

                    $slider.noUiSlider('move', { knob: 'upper', to: currentValue, scale: [0, 1] });
                });
                
                Handle_Change();
            }


        });

    }

    function Tooltips() {


        $('.section-tooltip').each(function () {
            var $this = $(this),
                text = $this.html(),
                $icon = $('<a href="#" class="icon"></a>'),
                $wrap = $('<div class="tip_wrapper"><div class="text">' + text + '</div><div class="arrow_shade"></div><div class="arrow"></div></div>'); 
              
            $this.html('');
            $this.append($icon);
            $this.append($wrap);
            $wrap.css({opacity:0, display:'none'});

            function Adjust_Tooltip() {
                $wrap.css({ right: 0, top: -($wrap.outerHeight() - $icon.outerHeight() * 0.5) });
            }

            Adjust_Tooltip();
            
            $icon.click(function (e) {
                e.preventDefault();
            });

            if ($.fn.hoverIntent)
                $this.hoverIntent(InHandler, OutHandler);
            else
                $this.hover(InHandler, OutHandler);
            
            function InHandler() {
                $wrap.css({ display: 'block' });
                Adjust_Tooltip();
                $wrap.stop().animate({ opacity: 1 }, 200);
            }

            function OutHandler() {
                $wrap.stop().animate({ opacity: 0 }, { duration: 200, complete: function () { $wrap.css({ display: 'none' }); } });
            }

        });

    }

    function Save_Button() {
        var $btns = $('#px-main .save-button'),
            $tooltips = $btns.find('.tooltip'),
            $tooltipsCnt = $tooltips.find('div'),
            $loadingIcons = $btns.find('.loading-icon'),
            $saveIcons = $btns.find('.save-icon'),
            $form = $('#px-container'),
            $dummyData = $('#px-main input[name="import_dummy_data"]');

        $btns.click(function (e) {
            var $btn     = $(this),
                $tooltip = $btn.find('.tooltip');

            if ($btn.hasClass('loading')) {
                e.preventDefault();
                return;
            }

            var data = $form.find('input,textarea,select').serialize();

            $loadingIcons.css({ display: 'inline' });
            $saveIcons.hide();

            $btns.addClass('loading');

            $tooltipsCnt.html('SAVING');
            Adjust_Tooltip($tooltip, $btn);

            //Todo: Save the settings
            //Test ajax call
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                success: function (data, textStatus, jqXHR) {
                    //TODO: Show proper saved message
                    //alert(data);
                    OnSaveComplete();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    OnSaveComplete();

                    alert('Error occured in saving data');
                }
            });

            function OnSaveComplete() {
                $loadingIcons.hide();
                $saveIcons.css({ display: 'inline' });
                $tooltipsCnt.html('SAVE');
                $btns.removeClass('loading');
                Adjust_Tooltip($tooltip, $btn);

                //Reload page if import dummy data option is selected
                if ($dummyData.length && $dummyData.val() == '1')
                    document.location.reload(true);
            }

            e.preventDefault();
        });

        $btns.hover(
            function () {
                var $btn = $(this),
                    $tooltip = $(this).find('.tooltip');

                Adjust_Tooltip($tooltip, $btn);

                $tooltip.stop().animate({ opacity: 1, top: -$btn.outerHeight() }, 200);

            }, function () {
                $(this).find('.tooltip').stop().animate({ opacity: 0, top: '0px' }, 200);
            }
        );


        function Adjust_Tooltip($tooltip, $btn) {
            $tooltip.css({ left: ($btn.outerWidth() - $tooltip.outerWidth()) * 0.5 });
        }

        $tooltips.css({ opacity: 0, top: 0 });
    }

    function Tabs() {
        var $tabs = $('.px-tab a'),
            $active = $();

        $tabs.each(function () {
            var $this = $(this),
                href = $this.attr('href'),
                $container = $(href);

            $this.click(function (e) {
                e.preventDefault();

                if ($this.hasClass('active'))
                    return;

                $tabs.removeClass('active');
                $this.addClass('active');

                $active.hide();
                $container.show();

                $active = $container;

                $(window).resize();
            });

            if ($this.hasClass('active')) {
                $this.removeClass('active');
                $this.click();
                $active = $container;
            }
            else {
                $container.hide();
            }

        });

    }

    function Sidebar_Accordion() {
        var $panels = $('#px-sidebar-accordion > div'),
            $head = $('#px-sidebar-accordion > h3 a');

        $panels.hide();

        var $active = $('#px-sidebar-accordion > h3 a.active'),
            $target = $();

        if ($active.length > 0) {
            $target = $active.parent().next();
            $target.show();
        }


        $head.click(function (e) {
            var $this = $(this);

            $target = $this.parent().next();

            if (!$this.hasClass('active')) {
                var $prev = $('#px-sidebar-accordion > h3 a.active').parent().next();

                $head.removeClass('active');

                $prev.slideUp('slow', 'easeOutBounce');
                $target.slideDown('slow', 'easeOutBounce');
                $this.addClass('active');

            }

            e.preventDefault();
        });
    }

    function Thickbox() {
        var $currentField = $();

        $('.upload-field .upload-button').click(function (e) {
            var $this = $(this),
                $parent = $this.parent(),
                referer = 'px-settings',
                title   = 'Upload';

            if ($parent.attr('data-referer') !== undefined)
                referer = $parent.attr('data-referer');

            if ($parent.attr('data-title') !== undefined)
                title = $parent.attr('data-title');

            $currentField = $(this).prev();

            var $pid   = jQuery('#post_ID'),
                postId = $pid.length > 0 ? $pid.val() : '0';

            tb_show(title, 'media-upload.php?post_id=' + postId + '&referer=' + referer + '&type=image&TB_iframe=true', false);

            e.preventDefault();
        });

       
        var orig_send_to_editor = window.send_to_editor;

        window.send_to_editor = function (html) {
            if ($currentField.length) {
                var image_url = $(html).attr('href');
                $currentField.val(image_url);
                $currentField = $();
                tb_remove();
            }
            else {
                if (typeof orig_send_to_editor != 'undefined')
                    orig_send_to_editor(html);
            }
        }
    }

    $(document).ready(function () {

        FieldSelector();
        CSVInput();
        ImageSelect();
        Save_Button();
        Thickbox();
        Tooltips();
        Sliders();
        ColorPicker();
        Combobox();
        Chosen();
        AdjustContainer();
        Tabs();
        Sidebar_Accordion();

    });

})(jQuery);