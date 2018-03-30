// Bind popup scripts
// safe to use $
jQuery(document).ready(function ($) {
    var $popup = $(),
        $ajaxCnt = $(),
        $tbWindow = $(),
        $frame    = $(),
        scTemplate = '';
        hasPreview = true,
        flags = [];

    //Get shortcode flags
    function GetFlags() {
        var flagsString = $('#px-sc-flags').html();
        return flagsString.split(' ');
    }

    //Initialize form
    function Init() {

        //Load settings
        $popup    = $('#px-sc');
        hasPreview   = $popup.hasClass('px-sc-has-preview');
        $ajaxCnt  = $('#TB_ajaxContent');
        $tbWindow = $('#TB_window');
        $frame    = $('#px-sc-preview-frame');
        flags      = GetFlags();
        scTemplate = $('#px-sc-template').html();

        if (GetFlags().indexOf('duplicable') < 0) {

            //Hide all buttons
            $('#px-sc-form .px-sc-head a').hide();
        }
        else {
            InitClone();

            //Add sorting plugin
            $("#px-sc-form").sortable({
                placeholder: "px-sortable-placeholder"
            });
        }

        // when insert is clicked
        $('#px-sc .px-submit').click(function (e) {
			
			if (window.tinyMCE) {
		
				if(window.tinyMCE.execInstanceCommand)
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, GetShortcode());
				else if(window.tinyMCE.execCommand)
					parent.tinyMCE.execCommand('mceInsertContent', false, GetShortcode());
				
				tb_remove();
			}

            e.preventDefault();
        });

        //Update shortcode on value change
        if (hasPreview) {
            $popup.find('input[type="text"],select,textarea').change(UpdatePreview);
            UpdatePreview();
        }
    }

    function ExtractShortcode($li) {
        var sc = scTemplate, attrs = '';

        $li.find('input[type="text"],select,textarea').each(function () {
            var $me = $(this),
                name = $me.attr('name'),
                val = $me.val(),
                isAttr = (typeof $me.attr('data-attr') != 'undefined');

            if (isAttr) {
                attrs += name + '="' + val + '" ';
                return;
            }

            var regex = new RegExp('{' + name + '}', 'g');
            sc = sc.replace(regex, val);
        });

        //Replace attributes
        var regex = new RegExp('{attributes}', 'g');
        sc = sc.replace(regex, attrs);

        return sc;
    }

    function GetShortcode() {
        var $list = $('#px-sc-form li'), sc='';

        for (i = 0; i < $list.length; i++) {
            sc += ExtractShortcode($list.eq(i));
        }

        return sc;
    }

    //Initialize clone/sort function
    function InitClone() {
        var $form = $('#px-sc-form li'),
            $closeBtn = $(),
            $cloneBtn = $();

        function onBind() {
            $form = $('#px-sc-form li');
            $closeBtn = $form.find('.close_button');
            $cloneBtn = $form.find('.clone_button');
        }

        //Call the function
        onBind();

        function onCloneClick() {
            var $me    = $(this),
                $li    = $me.parent().parent().parent(),
                $ul    = $li.parent(),
                $clone = $li.clone();

            $clone.find('.close_button').click(onCloseClick);
            $clone.find('.clone_button').click(onCloneClick);

            $clone.appendTo($ul);

            onBind();

            $closeBtn.show();
        }

        $cloneBtn.click(onCloneClick);

        function onCloseClick() {

            var $me = $(this),
                $li = $me.parent().parent().parent();

            $li.remove();

            onBind();

            if ($form.length < 2) {
                $closeBtn.hide();
                return;
            }
        }

        $closeBtn.click(onCloseClick);

        //Hide close buttons if only one element exists
        if ($form.length < 2) {
            $closeBtn.hide();
        }



    }

    //Updates first item preview
    function UpdatePreview() {
        var $li = $('#px-sc-form li:first-child'), sc = ExtractShortcode($li);

        /*alert(sc);
        return;*/

        //Create a form and attach it to the iframe
        var $form    = $(document.createElement('form')),
            $scInput = $(document.createElement('input'));

        $form.attr({ "action": $frame.attr('src'), "method": "post" });
        $scInput.attr({'name': 'sc', 'value' : sc, 'type':'hidden'});
        $form.append($scInput);
        $frame.contents().find('body').append($form);

        $frame.load(function () {
            $frame = $('#px-sc-preview-frame');
        });

        $form.submit();

        
    }

	function Resize(){

		
		if (flags.indexOf('duplicable') > -1) {

		    $ajaxCnt.css({
		        backgroundColor: $popup.css('background-color'),
		        paddingLeft: 0,
                paddingTop: 0,
		        width: $popup.outerWidth()+2,
		        height: $tbWindow.outerHeight()-47,
		        overflow: 'scroll', // IMPORTANT
		    });

		    $tbWindow.css({
		        width: $ajaxCnt.outerWidth(),
		        marginLeft: -($ajaxCnt.outerWidth() / 2)
		    });

		}
		else {

		    $ajaxCnt.css({
		        backgroundColor: $popup.css('background-color'),
		        padding: 0,
		        width:  $popup.outerWidth(),
		        height: $popup.outerHeight(),
		        overflow: 'hidden', // IMPORTANT
		    });

		    $tbWindow.css({
		        height: $ajaxCnt.outerHeight()+28,
		        width: $ajaxCnt.outerWidth(),
		        marginLeft: -($ajaxCnt.outerWidth() / 2),
		        marginTop: -(($ajaxCnt.outerHeight() + 47) / 2),
                top: '50%'
		    });

		}

		if (hasPreview) {
		    $frame.css({ height: $popup.outerHeight() - 65 });
		}
		
	}

	function Load() {

	    Init();
	    Resize();
        
	}

	$('#px-sc').livequery(function () { Load(); });

	$(window).resize(Resize);
});

//Utility functions

//IE Fix
if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function (needle) {
        for (var i = 0; i < this.length; i++) {
            if (this[i] === needle) {
                return i;
            }
        }
        return -1;
    };
}