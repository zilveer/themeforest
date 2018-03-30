(function (exports, $) {
    var executeCallbackIfDefined = function(config, type, args) {
        var key = type + '_callback';
        var context = window;
        args = args || {};

        if (typeof config[key] != 'undefined') {
            var callbackFuncName = config[key];

            if (typeof context[callbackFuncName] != 'undefined') {
                context[callbackFuncName](args);
            }
        }
    }

    $(document).ready(function() {
        $('.g1-async-upload-box').each(function() {
            var $this = $(this);
            var id = $this.attr('id');
            var config = window[id];
            config =  $.parseJSON(config);

            var uploaderConfig = {
                container: $this,
                browser:   $this.find('.upload'),
                dropzone:  $this.find('.upload-dropzone'),
                success:   function(attachment) {
                    var args = {
                        'widget_id': id,
                        'attachment': attachment
                    };

                    executeCallbackIfDefined(config, 'success', args);
                },
                init:     function() {
                    executeCallbackIfDefined(config, 'init', arguments);
                },
                error:    function() {
                    executeCallbackIfDefined(config, 'error', arguments);
                },
                added:    function() {
                    executeCallbackIfDefined(config, 'added', arguments);
                },
                progress: function() {
                    executeCallbackIfDefined(config, 'progress', arguments);
                },
                complete: function() {
                    executeCallbackIfDefined(config, 'complete', arguments);
                }
            };

            var uploader = new wp.Uploader(uploaderConfig);
        });
    });
})(window, jQuery);