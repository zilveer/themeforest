TFE.one('tf-tabs-loading-finish', function()
{
    var $ = jQuery;
    var $type = $('#'+ tf_script.TF_THEME_PREFIX +'_mail__general__method');

    if ($type.length < 1) {
        console.log('[Warning] Cannot initialize email settings options');
        return;
    }

    new (function()
    {
        /** properties */
        {
            /** DOM references */
            this.$e = {
                heading:    $type.closest('.postbox'),
                typeSelect: $type
            };
        }

        /** methods */
        {
            /** show only options that belongs to current selected type and general options*/
            this.handleTypeChange = function()
            {
                var val = this.$e.typeSelect.val();

                var type = val;

                this.$e.heading.find('.tf-interface-option').each(function(){
                    var $this    = $(this);
                    var $divider = $this.next();
                    var id       = $this.find('.formcontainer [name]').attr('name');

                    var fieldType = id.split('_mail__').pop();
                    fieldType = fieldType.split('__');
                    var fieldName = fieldType.pop();
                    fieldType = fieldType.pop();

                    if (type == fieldType || fieldType == 'general') {
                        $this.show();
                        $divider.removeAttr('style');
                    } else {
                        $this.hide();
                        $divider.css({
                            opacity: '0',
                            margin: '0'
                        });
                    }
                });
            };
        }

        var that = this;

        // main()
        (function(){
            that.$e.typeSelect.on('change', function(){
                that.handleTypeChange();
            });

            that.handleTypeChange();
        })();
    })();
});