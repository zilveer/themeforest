(function ($) {
    var Shortcodes = vc.shortcodes;

    window.VcImageBoxView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
          var params = this.model.get('params'), $wrapper;
          window.VcImageBoxView.__super__.changeShortcodeParams.call(this, model);
          $wrapper = this.$el.find('> .wpb_element_wrapper');
            if (_.isObject(params)) {
                $wrapper.html("<h4 class=\"wpb_element_title\"><span class=\"vc_element-icon trizzy_icon\"></span> Image with caption</h4> Title: "+ params.title+"; <br /> Subtitle: "+params.subtitle).css('height','auto');
            }
        }
    });
    window. VcTrizzyHeadlineView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
          var params = this.model.get('params'), $wrapper;
          window. VcTrizzyHeadlineView.__super__.changeShortcodeParams.call(this, model);
          $wrapper = this.$el.find('> .wpb_element_wrapper');
            if (_.isObject(params)) {
                $wrapper.html("<h4 class=\"wpb_element_title\"><span class=\"vc_element-icon trizzy_icon\"></span> Headline: "+ params.content+"</h4>").css('height','auto');

            }
        }
    });

})(window.jQuery);



