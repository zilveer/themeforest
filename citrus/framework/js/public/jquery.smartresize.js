/*! jquery-smartresize http://github.com/louisremi/jquery-smartresize | http://louisremi.mit-license.org/ */
(function (a) {
    var b = a.event,
        c;
    b.special
        .smartresize = {
        setup: function () {
            a(this).bind("resize", b.special
                .smartresize
                .handler)
        },
        teardown: function () {
            a(this).unbind("resize", b.special
                .smartresize
                .handler)
        },
        handler: function (a, b) {
            var d = this,
                e = arguments;
            a.type = "smartresize";
            c && clearTimeout(c);
            c = setTimeout(function () {
                jQuery.event
                    .handle
                    .apply(d, e)
            }, "execAsap" === b ? 0 : 100)
        }
    };
    a.fn
        .smartresize = function (a) {
        return a ? this.bind("smartresize", a) : this
            .trigger("smartresize", ["execAsap"])
    }
})(jQuery);