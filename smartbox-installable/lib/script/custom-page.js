(function ($) {
    $.fn.customPage = function (options) {
        var defaults = {
            itemWrapper: '.custom-item-wrapper',
            valueContainer: 'div.item > span',
            singleItem: 'div.item',
            nonce: '#designare_nonce',
            errorMsg: 'An error occurred, please try again later.',
            instanceMsg: 'An instance with this name already exists',
            deleteMsg: 'This item will be permanently deleted. Are you sure?',
            deleteSliderMsg: 'This slider and all the items that belong to it will be permanently deleted. Are you sure?'
        };
        options = $.extend(defaults, options);
        var root = null;
        $root = $(this);
        function init() {
        	setFontSelectors();
            setAddButtonClickHandlers();
            setAddInstanceClickHandlers();
            setAccordion();
            setSortableFunctionality();
            setDeleteButtonClickHandlers();
            setEditButtonClickHandlers();
            setDeleteSliderClickHandlers();
            $root.delegate('.hover', 'mouseover', function () {
                $(this).css({
                    cursor: 'pointer'
                })
            });
            if ($.browser.safari) {
                $('body').addClass('chrome')
            }
        }
        function setFontSelectors(){
	    	$('#titlefontfamily option').add('#descfontfamily option').each(function(){ $(this).val($(this).html()); });   
        }
        function setAddButtonClickHandlers() {
            $root.delegate('.custom-option-button', 'click', function () {
                var data = {}, $form = null,
                    valid = true;
                $form = $(this).parents('form.custom-page-form:first');
                $form.find('input.required, textarea.required, select').each(function () {
                    $(this).removeClass('invalid');
                    if (!$(this).is('select')){
	                    if (!$(this).val()) {
	                        $(this).addClass('invalid');
	                        valid = false
	                    }   
                    }
                });
                if (valid) {
                    var $sortable = $form.parents('.custom-section:first').find('ul.sortable'),
                        order = $sortable.sortable('toArray').join(',');
                    data = $form.serialize() + '&action=designare_insert_post&order=' + order + '&nonce=' + $(options.nonce).val();
                    $form.find('.loading').show();
                    $.ajax({
                        type: 'post',
                        data: data,
                        url: ajaxurl,
                        dataType: 'html',
                        success: function (html) {
                            $sortable.append(html);
                            $form.get(0).reset();
                            $form.find('input.upload').val('');
                            $form.find('.loading').hide()
                        }
                    })
                }
            });
            $root.delegate('input, textarea', 'focus', function () {
                $(this).removeClass('invalid')
            })
        }
        function setAddInstanceClickHandlers() {
            $('.new-instance-button').click(function (e) {
                e.preventDefault();
                var dialogHtml = '<div><label>Slider name:</label><input type="text" id="instance-name" /><div class="loading"></div></div>',
                    btn = $(this);
                $(dialogHtml).dialog({
                    modal: true,
                    title: btn.text(),
                    buttons: {
                        "Add": function () {
                            addInstance($(this).find('#instance-name').val(), $(this))
                        }
                    },
                    open: function(event, ui){
						jQuery(event.target).parent().css({'background-color':'white', 'z-index':'99'});
						jQuery(event.target).parent().find('.ui-icon-closethick').css('left','0px');
                    }
                })
            })
        }
        function addInstance(name, $dialog) {
            var data = {
                action: 'designare_add_instance',
                name: name,
                taxonomy: $('#taxnonomy_id').val(),
                post_type: $('#post_type').val(),
                'nonce': $(options.nonce).val()
            };
            $.ajax({
                url: ajaxurl,
                data: data,
                type: 'POST',
                dataType: 'html',
                complete:function(response){
	                //console.log(response);
                },
                success: function (html) {
                    if (html !== '-1') {
                        $(html).insertBefore(options.itemWrapper + ':first');
                        $dialog.dialog("close").remove();
                        $(".sortable").sortable()
                    } else {
                        $dialog.dialog("close").remove();
                        displayMessage(options.instanceMsg)
                    }
                }
            })
        }
        function setAccordion() {
            var closedClass = 'closed-container';
            $root.delegate(options.itemWrapper + ' h3', 'click', function () {
                var $container = $(this).siblings('.custom-section:first'),
                    $parent = $(this).parents(options.itemWrapper + ':first');
                if ($container.css('display') === 'none') {
                    $container.slideDown();
                    $parent.removeClass(closedClass)
                } else {
                    $container.slideUp();
                    $parent.addClass(closedClass)
                }
            });
            $(".custom-section").not(':first').each(function () {
                $(this).hide().parents(options.itemWrapper + ':first').addClass(closedClass)
            })
        }
        function setSortableFunctionality() {
            $(".sortable").sortable();
            $root.delegate('.sortable', 'sortupdate', function () {
                if (!$(this).data('firstchanged')) {
                    var $ul = $(this);
                    $('<a />', {
                        'class': 'button order-button',
                        text: 'Save Order'
                    }).click(function () {
                        var order = $ul.sortable('toArray').join(','),
                            $container = $(this).parents(options.itemWrapper + ':first'),
                            category = $container.find('.category').val(),
                            posttype = $container.find('input[name=post_type]').val(),
                            data = {
                                'action': 'designare_save_order',
                                'order': order,
                                'category': category,
                                'nonce': $(options.nonce).val(),
                                'posttype': posttype
                            };
                        $container.find('.custom-container .loading').show();
                        $.ajax({
                            type: 'post',
                            url: ajaxurl,
                            data: data,
                            success: function (res) {
                                $container.find('.loading').hide()
                            }
                        })
                    }).insertBefore($ul);
                    $(this).data('firstchanged', true)
                }
            });
            $root.delegate('.sortable', 'sortstart', function () {
                if (!$(this).data('firstchanged')) {
                    $(this).data('initialorder', $(this).sortable('toArray'))
                }
            })
        }
        function setDeleteButtonClickHandlers() {
            $root.delegate('.delete-button', 'click', function () {
                var $btn = $(this);
                $('<div>' + options.deleteMsg + '<br/><div class="loading"></div></div>').dialog({
                    modal: true,
                    title: 'Delete Item',
                    height: 160,
                    buttons: {
                        "Delete": function () {
                            var $parentLi = $btn.parents('li:first'),
                                itemid = $parentLi.find('#itemid').val(),
                                category = $parentLi.parents(options.itemWrapper + ':first').find('.category').val(),
                                posttype = $parentLi.parents(options.itemWrapper + ':first').find('input[name=post_type]').val(),
                                data = {
                                    'action': 'designare_detele_item',
                                    'itemid': itemid,
                                    'category': category,
                                    'nonce': $(options.nonce).val(),
                                    'posttype': posttype
                                }, $dialog = $(this);
                            $dialog.find('.loading').show();
                            $.ajax({
                                type: 'post',
                                url: ajaxurl,
                                data: data,
                                success: function (res) {
                                    if (res === '-1') {
                                        $dialog.dialog("close").remove();
                                        if ($parentLi.siblings().length > 0) $parentLi.remove();
                                        else displayMessage(options.errorMsg)
                                    } else {
                                        $dialog.dialog("close").remove();
                                        $parentLi.slideUp(500, function () {
                                            $(this).remove()
                                        })
                                    }
                                }
                            })
                        },
                        "Cancel": function () {
                            $(this).dialog("close").remove()
                        }
                    }
                })
            })
        }
        function setEditButtonClickHandlers() {
            $root.delegate('.edit-button', 'click', function () {
                var $parentLi = $(this).parents('li:first');
                $parentLi.find(options.valueContainer).each(function () {
                    var $that = $(this),
                        itemClasses = $that.attr('class').split(" "),
                        isTextarea = itemClasses[1] === 'textarea' ? true : false;
                        isSelect = itemClasses[1] === 'select' ? true : false;
                        isSelectC = itemClasses[1] === 'select-color' ? true : false;
                        isSelectFT = itemClasses[0] === 'custom_titlefontfamily' ? true : false;
                        isSelectFD = itemClasses[0] === 'custom_descfontfamily' ? true : false;
                        
                    if (isTextarea) {
                        $that.replaceWith($('<textarea />', {
                            name: itemClasses[0],
                            value: $that.html(),
                            'class': $that.attr('class')
                        }))
                    } else if (isSelect) {
                    
                    		var fonts = false;
                    		if (isSelectFT){
                    			var value = $that.html();
                    			var opts = "";
                    			$('#titlefontfamily').eq(0).find('option').each(function(){
	                    			if ($(this).val() == value)
	                    				opts += "<option value='"+$(this).val()+"' selected='selected' >"+$(this).val()+"</option>";
	                    			else
	                    				opts += "<option value='"+$(this).val()+"' >"+$(this).val()+"</option>"; 
                    			});
                    			$that.replaceWith($('<select value="'+value+'" class="'+$that.attr('class')+'" name="'+itemClasses[0]+'">'+opts+'</select>')).val(value);
                    			//console.log(opts);
	                    		fonts = true;
                    		}
                    		if (isSelectFD){
                    			var value = $that.html();
                    			var opts = "";
                    			$('#descfontfamily').eq(0).find('option').each(function(){
	                    			if ($(this).val() == value)
	                    				opts += "<option value='"+$(this).val()+"' selected='selected' >"+$(this).val()+"</option>";
	                    			else
	                    				opts += "<option value='"+$(this).val()+"' >"+$(this).val()+"</option>"; 
                    			});
	                    		$that.replaceWith($('<select value="'+value+'" class="'+$that.attr('class')+'" name="'+itemClasses[0]+'">'+opts+'</select>')).val(value);
	                    		fonts = true;
                    		}
                    		if (!fonts){
	                    		var myoptions = "";
                    		
	                    		myoptions += "<option value='des_moveFromTop' ";
	                    		if($that.html() == 'des_moveFromTop') myoptions +=" selected";
	                    		myoptions += ">Move From Top</option>";
	                    		
	                    		myoptions += "<option value='des_moveFromBottom' ";
	                    		if($that.html() == 'des_moveFromBottom') myoptions +=" selected";
	                    		myoptions += ">Move From Bottom</option>";
	                    		
	                    		myoptions += "<option value='des_moveFromLeft' ";
	                    		if($that.html() == 'des_moveFromLeft') myoptions +=" selected";
	                    		myoptions += ">Move From Left</option>";
	                    		
	                    		myoptions += "<option value='des_moveFromRight' ";
	                    		if($that.html() == 'des_moveFromRight') myoptions +=" selected";
	                    		myoptions += ">Move From Right</option>";
	                    		
	                    		myoptions += "<option value='des_fade' ";
	                    		if($that.html() == 'des_fade') myoptions +=" selected";
	                    		myoptions += ">Fade</option>";
	                    		
	                    		$that.replaceWith($('<select class="'+$that.attr('class')+'" name="'+itemClasses[0]+'"><option value=""></option>'+myoptions+'</select>'));
	
                    		}                    		
                    } else if (isSelectC) {
                    		var myoptions = "";
                    		
                    		myoptions += "<option value='black' ";
                    		if($that.html() == 'black') myoptions +=" selected";
                    		myoptions += ">Black</option>";
                    		
                    		myoptions += "<option value='white' ";
                    		if($that.html() == 'white') myoptions +=" selected";
                    		myoptions += ">White</option>";
                    		
                    		myoptions += "<option value='yellow' ";
                    		if($that.html() == 'yellow') myoptions +=" selected";
                    		myoptions += ">Yellow</option>";
                    		
                    		myoptions += "<option value='orange' ";
                    		if($that.html() == 'orange') myoptions +=" selected";
                    		myoptions += ">Orange</option>";
                    		
                    		myoptions += "<option value='red' ";
                    		if($that.html() == 'red') myoptions +=" selected";
                    		myoptions += ">Red</option>";
                    		
                    		myoptions += "<option value='green' ";
                    		if($that.html() == 'green') myoptions +=" selected";
                    		myoptions += ">Green</option>";
                    		
                    		myoptions += "<option value='blue' ";
                    		if($that.html() == 'blue') myoptions +=" selected";
                    		myoptions += ">Blue</option>";
                    		
                    		myoptions += "<option value='violet' ";
                    		if($that.html() == 'violet') myoptions +=" selected";
                    		myoptions += ">Violet</option>";
                    		
                    		myoptions += "<option value='greensmartbox' ";
                    		if($that.html() == 'greensmartbox') myoptions +=" selected";
                    		myoptions += ">GreenSmartbox</option>";
                    		
                    		$that.replaceWith($('<select class="'+$that.attr('class')+'" name="'+itemClasses[0]+'">'+myoptions+'</select>'));
                    		
                    } else {
                        $that.replaceWith($('<input />', {
                            name: itemClasses[0],
                            value: $that.html(),
                            type: 'text',
                            'class': $that.attr('class')
                        }))
                    }
                });
                $(this).replaceWith($('<div />', {
                    'class': 'done-button hover'
                }).click(function () {
                    var valid = true,
                        data = [],
                        $btn = $(this),
                        $inputs = $parentLi.find('input, textarea, select');
                    $inputs.each(function () {
                        var $that = $(this);
                        data.push($.param($that));
                        if ($that.hasClass('required')) {
                            $that.removeClass('invalid');
                            if (!$that.val()) {
                                $that.addClass('invalid');
                                valid = false
                            }
                        }
                    });
                    if (valid) {
                        $parentLi.find('.loading').show();
                        var dataString = data.join('&') + '&action=designare_edit_item&nonce=' + $(options.nonce).val();
                        $.ajax({
                            url: ajaxurl,
                            data: dataString,
                            type: 'post',
                            success: function () {
                                $inputs.each(function () {
                                    if ($(this).attr('type') !== 'hidden') {
                                        var $input = $(this);
								                        
                                        $input.replaceWith($('<span />', {
                                            'class': $input.attr('class'),
                                            html: $input.val()
                                        }));
                                        $parentLi.find('.loading').hide();
                                        $btn.replaceWith($('<div />', {
                                            'class': 'edit-button hover'
                                        }))
                                    }
                                })
                            }
                        })
                    }
                }))
            })
        }
        function setDeleteSliderClickHandlers() {
            $root.delegate('.delete-slider-button', 'click', function () {
                var $btn = $(this);
                $('<div>' + options.deleteSliderMsg + '<br/><div class="loading"></div></div>').dialog({
                    modal: true,
                    title: 'Delete Slider',
                    height: 180,
                    buttons: {
                        "Delete": function () {
                            var $parent = $btn.parents(options.itemWrapper + ':first'),
                                category = $parent.find('.category').val(),
                                data = {
                                    'action': 'designare_detele_instance',
                                    'taxonomy': $('#taxnonomy_id').val(),
                                    'category': category,
                                    'post_type': $('#post_type').val(),
                                    'nonce': $(options.nonce).val()
                                }, $dialog = $(this);
                            $dialog.find('.loading').show();
                            $.ajax({
                                type: 'post',
                                url: ajaxurl,
                                data: data,
                                success: function () {
                                    $dialog.dialog("close").remove();
                                    $parent.slideUp(500, function () {
                                        $(this).remove()
                                    })
                                }
                            })
                        },
                        "Cancel": function () {
                            $(this).dialog("close").remove()
                        }
                    }
                })
            })
        }
        function displayMessage(message) {
            $('<div>' + message + '</div>').dialog({
                modal: true,
                buttons: {
                    "Close": function () {
                        $(this).dialog("close").remove()
                    }
                }
            })
        }
        if ($root.length > 0) {
            init()
        }
    }
}(jQuery));
jQuery(function () {
    jQuery('.custom-page-wrapper:first').customPage()
});