(function($){
	$(document).ready(function() {
		mkdInitSelectChange();
        mkdInitRadioChange();
	});

	function mkdInitSelectChange() {
		$(document).on('change', 'select.dependence', function (e) {
			var optionSelected = $("option:selected", this);
			var valueSelected = this.value.replace(/ /g, '');
			$($(this).data('hide-'+valueSelected)).fadeOut();
			$($(this).data('show-'+valueSelected)).fadeIn();
		});
	}

    function mkdInitRadioChange() {
        $(document).on('change', 'input[type="radio"].dependence', function () {
            var dataHide = $(this).data('hide');
            var dataShow = $(this).data('show');
            if(typeof(dataHide)!== 'undefined' && dataHide !== '') {
                var elementsToHide = dataHide.split(',');
                $.each(elementsToHide, function(index, value) {
                    $(value).fadeOut();
                });
            }

            if(typeof(dataShow)!== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');
                $.each(elementsToShow, function(index, value) {
                    $(value).fadeIn();
                });
            }
        });
    }
})(jQuery);
