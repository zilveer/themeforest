jQuery(document).ready(init_datepickers);

function init_datepickers() {
    jQuery('.popbox').popbox();

    if (jQuery('.tfuse_datepicker').length > 0) {
        var datepickers = jQuery('.tf_datepicker_holder');
        datepickers.each(function(){
            jQuery(this).find('.tfuse_datepicker').removeClass('hasDatepicker').removeAttr('id');
            var prnt;
            if (jQuery(this).find('.popbox').length > 0)
                prnt = jQuery(this).find('.tfuse_datepicker').parents('.tfuse_datepicker_popbox');
            else
                prnt = jQuery(this).find('.tfuse_datepicker');
            var dateMin   = prnt.hasClass('minDateCurrent') ? new Date() : null;
            var curr_elem = jQuery(this);
            jQuery('.tfuse_datepicker').datepicker({
                dateFormat: "yy-mm-dd",
                minDate: dateMin,
                beforeShowDay: function (date) {
                    var _with_dependancy = (curr_elem.find('.tfuse_datepicker_from').length > 0 && curr_elem.find('.tfuse_datepicker_to').length > 0) ? true : false;
                    if (_with_dependancy) {
                        var _parent = jQuery(this).closest('.box_content');
                        if (jQuery(this).hasClass('tfuse_datepicker_from')) {
                            var _from_date = _parent.find('.tfuse_datepicker_to').val();
                            if (_from_date == '')
                                return [true, ''];
                            var dates = _from_date.split('-');
                            _from_date = new Date(dates[0], dates[1] - 1, dates[2]);
                            if (date < _from_date)
                                return [true, ''];
                            else
                                return [false, ''];
                        } else if(jQuery(this).hasClass('tfuse_datepicker_to')) {
                            var _to_date = _parent.find('.tfuse_datepicker_from').val();
                            if (_to_date == '')
                                return [true, ''];
                            dates = _to_date.split('-');
                            _to_date = new Date(dates[0], dates[1] - 1, dates[2]);
                            if (date > _to_date)
                                return [true, ''];
                            else
                                return [false, ''];
                        }
                    } else
                        return [true];
                }
            });
        });
    }
}