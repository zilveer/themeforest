jQuery(document).ready(function($){

	$("div[id^=theme2035-blogmeta-]").hide();

	var selectedbox = $('#post-formats-select input:checked').attr('value');

	$("#theme2035-blogmeta-" + selectedbox).stop(true,true).fadeIn(500);

    $("#post-formats-select input[type=radio]").change(function()
    {
        var diValue = $(this).attr("value");
        $("div[id^=theme2035-blogmeta-]").hide();
        $("#theme2035-blogmeta-" + diValue).fadeIn(1000);
    });

});