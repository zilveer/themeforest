/**
 * Created by cb-theme on 31.10.13.
 */

/**
 * From RGB to HEX
 * @param rgb
 * @returns {color in RGB}
 */

function rgb2hex(rgb) {
    if (rgb.search("rgb") == -1) {
        return rgb;
    } else {
        rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
        function hex(x) {
            return ("0" + parseInt(x).toString(16)).slice(-2);
        }

        return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }
}

/**
 * CB Font Awesome object
 */
CBFontAwesome = {
    /**
     * @var string
     */
    currentContentId: '',

    /**
     * Show the editor
     * @param string contentId
     */

    showEditor: function (contentId) {
        jQuery('#cb-icon-backdrop').show();
        jQuery('#cb-icon-container').show();
        this.currentContentId = contentId;

        if (typeof this.currentContentId !== 'undefined' && jQuery('#' + this.currentContentId + '-val').html() != '') {
            this.setIcon(jQuery('#' + this.currentContentId + '-val').text());
            this.setColor(jQuery('#cur_icon i').css('color'));
            this.setSize(parseInt(jQuery('#cur_icon i').css('font-size'), 10));
            this.setTip(jQuery('#cur_icon i').attr('data-tip'));
            this.setAni1(jQuery('#cur_icon i').attr('data-ani1'));
            this.setAni2(jQuery('#cur_icon i').attr('data-ani2'));
            this.setAni3(jQuery('#cur_icon i').attr('data-ani3'));
            this.setAni4(jQuery('#cur_icon i').attr('data-ani4'));
            this.setWh(jQuery('#cur_icon i').attr('data-wh'));

        }
        else {
            this.setIcon('');
            this.setSize(20);
            this.setColor('#000');
        }
        return false;
    },
    /**
     * Hide editor
     */
    hideEditor: function () {
        jQuery('#cb-icon-backdrop').hide();
        jQuery('#cb-icon-container').hide();
        jQuery('#send_to_full').val('');
        jQuery('#svg-icons').hide();
        jQuery('#svg-icons-content').hide();
        window.onbeforeunload = null;
    },
    /**
     * Set icon size
     * @param integer size
     * @param boolean hide
     */
    setSize: function (size, hide) {

        jQuery('#font-size').simpleSlider("setValue", size);
        if (hide == true)jQuery('#font-size').parent().parent().hide();
        else
            jQuery('#font-size').parent().parent().show();

    },
    /**
     * Set icon color
     * @param string color
     */
    setColor: function (color) {
        var color2 = rgb2hex(color);
        jQuery("#color").wpColorPicker('color', color2);

    },
    /**
     * Save icon to block
     */
    saveIcon: function () {
        var data = jQuery('#cur_icon').html();
        if (typeof this.currentContentId !== 'undefined') {
            if (data != '') {
                jQuery('#' + this.currentContentId + '-val').html(data);
                jQuery('#' + this.currentContentId).html('<span class="res-icon">' + data + '</span>');
                if( jQuery('#send_to_full').val()=='true')jQuery('#' + this.currentContentId + '-full').html(data);
            }
        } else {
            window.send_to_editor(data);
        }
        if (data != '') {
            jQuery('.last_icon_prev').html(data);
            jQuery('#last_icon').show();
        } else {
            jQuery('.last_icon_prev').html('');
            jQuery('#last_icon').hide();
        }

        this.hideEditor();

    },
    saveIconSVG: function () {

        var data = jQuery('#cur_icon_svg span').clone().empty().html('&nbsp;');
        data = jQuery('<div>').append(data.clone()).html();
        if (typeof this.currentContentId !== 'undefined') {
            if (data != '') {
                jQuery('#' + this.currentContentId + '-val').html(data);
                jQuery('#' + this.currentContentId).html('<span class="res-icon">' + data + '</span>');
                if( jQuery('#send_to_full').val()=='true')jQuery('#' + this.currentContentId + '-full').html(data);
            }
        } else {
            window.send_to_editor(data);
        }


        this.hideEditor();

    },
    /**
     * Set Icon
     * * @param string <i>
     */
    setIcon: function (i) {
        jQuery('#cur_icon').html(i);


    },
    setTip: function (tip) {
        jQuery('#tip').val(tip);
    },
    setAni1: function (ani) {
        jQuery('#icon_ani_select').val(ani);
    },
    setAni2: function (ani) {
        jQuery('#icon_ani_color_after').val(ani);
    },
    setAni3: function (ani) {
        jQuery('#icon_ani_bg').val(ani);
    },
    setAni4: function (ani) {
        jQuery('#icon_ani_bg_after').val(ani);
    },
    setWh: function (wh) {
        jQuery('#icon_wh_size').val(wh);
    },
    hideLast: function () {
        jQuery('#last_icon').hide();
    },
    hideAni: function () {
        jQuery('#icon_ani').hide();
    },
    sendFull: function () {
        jQuery('#send_to_full').val('true');
    },
    showSVG: function () {
        jQuery('#svg-icons').show();
    }


};
jQuery(document).ready(function ($) {
    jQuery('.admin-icons-content i').click(function () {

        var size = jQuery('#font-size').val();
        var color = jQuery('#color').val();
        var tip = jQuery('#tip').val();
        var icon_ani_select = jQuery('#icon_ani_select').val();
        var icon_ani_color_after = jQuery('#icon_ani_color_after').val();
        var icon_ani_bg = jQuery('#icon_ani_bg').val();
        var icon_ani_bg_after = jQuery('#icon_ani_bg_after').val();
        var wh = jQuery('#icon_wh_size').val();

        var style = '';
        var data = '';
        var icon_class = jQuery(this).attr('class');
        if (size) {
            style += 'font-size:' + size + 'px;';
        }
        if (color) {
            style += 'color:' + color + ';';
        }

        data = '<i class="' + icon_class + ' builder-icon" style="' + style + '" data-tip="' + tip + '" data-wh="' + wh + '" data-ani1="' + icon_ani_select + '" data-ani2="' + icon_ani_color_after + '" data-ani3="' + icon_ani_bg + '" data-ani4="' + icon_ani_bg_after + '">&nbsp;</i>';
        jQuery('#cur_icon').html(data);

        jQuery("#cb-icon-container").animate({
            scrollTop: "0px"
        }, {
            duration: 800
        });
    });
    jQuery('#tip').bind('input propertychange', function () {
        jQuery('.builder-icon').attr('data-tip', (jQuery(this).val()));
    });
    jQuery('#icon_ani_select').change(function () {
        jQuery('.builder-icon').attr('data-ani1', (jQuery(this).val()));
    });
    jQuery('#icon_ani_color_after').change(function () {
        jQuery('.builder-icon').attr('data-ani2', (jQuery(this).val()));
    });
    jQuery('#icon_ani_bg').change(function () {
        jQuery('.builder-icon').attr('data-ani3', (jQuery(this).val()));
    });
    jQuery('#icon_ani_bg_after').change(function () {
        jQuery('.builder-icon').attr('data-ani4', (jQuery(this).val()));
    });
    jQuery('#icon_wh_size').change(function () {
        jQuery('.builder-icon').attr('data-wh', (jQuery(this).val()));
    });



    $(document).on('click', '.last_icon_prev i', function () {
        CBFontAwesome.setColor(jQuery('.last_icon_prev i').css('color'));
        CBFontAwesome.setSize(parseInt(jQuery('.last_icon_prev i').css('font-size'), 10));
        CBFontAwesome.setTip(jQuery('.last_icon_prev i').attr('data-tip'));
        CBFontAwesome.setAni1(jQuery('.last_icon_prev i').attr('data-ani1'));
        CBFontAwesome.setAni2(jQuery('.last_icon_prev i').attr('data-ani2'));
        CBFontAwesome.setAni3(jQuery('.last_icon_prev i').attr('data-ani3'));
        CBFontAwesome.setAni4(jQuery('.last_icon_prev i').attr('data-ani4'));
        CBFontAwesome.setWh(jQuery('.last_icon_prev i').attr('data-wh'));

    });

    jQuery('#color').wpColorPicker({
        change: function (event, ui) {
            var selectedColor = ui.color.toString();
            jQuery('#cur_icon i').css("color", selectedColor);
        }
    });
    jQuery('#color-svg').wpColorPicker({
        change: function (event, ui) {
            var selectedColor = ui.color.toString();
            set_color_svg(selectedColor);
        }
    });

    jQuery('.remo').click(function () {
        jQuery(this).parent().find('.res-icon').parent().html('');
        jQuery(this).parent().find('.hide-icon').html('');
        return false;
    });
    function set_icon_size() {
        var size = jQuery('#font-size').val();
        jQuery('#cur_icon i').css("font-size", size + "px");

    }
    function set_icon_size_svg() {
        var size = jQuery('#font-size-svg').val();
        $('#cur_icon_svg span').empty().attr({'data-size':size}).css({'height':size+"px",'width':size+"px"});
        new svgIcon( document.querySelector( '#cur_icon_svg span.si-icon' ), svgIconConfig, { easing : mina.backin, evtoggle : 'mouseover',size : { w : size, h : size }} );

    }

    $("#font-size").bind("slider:changed", function (event, data) {
        set_icon_size();
    });

    $("#font-size-svg").bind("slider:changed", function (event, data) {
        set_icon_size_svg();
    });

    $("#icons-pack-select button").click(function () {
        jQuery(this).parent().find('button').removeClass('button-primary');
        jQuery(this).addClass('button-primary');
        jQuery('.icons-pack').slideUp();
        jQuery('#'+jQuery(this).attr('id')+'-content').slideDown();
        return false;
    });
    $(document).on('click', '.si-icons-default > .si-icon', function(event) {
        $('#cur_icon_svg').html($(this).clone().empty());
        set_icon_size_svg();
        setInterval(function(){set_color_svg($('#color-svg').val());},3);

    });
        /*
    $('.si-icons-default > .si-icon').click(function () {
        $('#cur_icon_svg').html($(this).clone().empty());
        set_icon_size_svg();
        set_color_svg($('#color-svg').val());
    });*/

});
// from https://github.com/desandro/classie/blob/master/classie.js
function classReg( className ) {
    return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

function hasClass( el, c ) {
    return 'classList' in document.documentElement ? el.classList.contains( c ) : classReg( c ).test( el.className )
}

function extend( a, b ) {
    for( var key in b ) {
        if( b.hasOwnProperty( key ) ) {
            a[key] = b[key];
        }
    }
    return a;
}

// from http://stackoverflow.com/a/11381730/989439
function mobilecheck() {
    var check = false;
    (function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
}

// http://snipplr.com/view.php?codeview&id=5259
function isMouseLeaveOrEnter( e, handler ) {
    if (e.type != 'mouseout' && e.type != 'mouseover') return false;
    var reltg = e.relatedTarget ? e.relatedTarget :
        e.type == 'mouseout' ? e.toElement : e.fromElement;
    while (reltg && reltg != handler) reltg = reltg.parentNode;
    return (reltg != handler);
}

function svgIcon( el, config, options ) {
    this.el = el;
    if(el!='null'&&el!=null) {
        this.options = extend( {}, this.options );
        extend( this.options, options );
        this.svg = Snap( this.options.size.w, this.options.size.h );
        this.svg.attr( 'viewBox', '0 0 64 64' );
        this.el.appendChild( this.svg.node );
        // state
        this.toggled = false;
        // click event (if mobile use touchstart)
        this.clickevent = mobilecheck() ? 'touchstart' : 'click';
        // icons configuration
        this.config = config[ this.el.getAttribute( 'data-icon-name' ) ];
        // reverse?
        if( hasClass( this.el, 'si-icon-reverse' ) ) {
            this.reverse = true;
        }
        if( !this.config ) return;
        var self = this;
        // load external svg
        Snap.load( settings.WP_THEME_URL+'/inc/assets/AnimatedSVGIcons/'+this.config.url, function (f) {
            var g = f.select( 'g' );
            self.svg.append( g );
            self.options.onLoad();
            self._initEvents();
            if( self.reverse ) {
                self.toggle();
            }
        });
    }
}
function set_color_svg(selectedColor){
    jQuery('#cur_icon_svg span').attr({'data-color':selectedColor})
    jQuery('#cur_icon_svg span g > *').each(function( index ) {
        if(jQuery( this).attr('stroke')!==undefined && jQuery( this).attr('stroke')!='none')jQuery( this).css('stroke',selectedColor);
        if(jQuery( this).attr('fill')!==undefined && jQuery( this).attr('fill')!='none')jQuery( this).css('fill',selectedColor);
    });
}
