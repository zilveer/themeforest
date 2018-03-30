<?php
$color     = of_get_option('color_picker');
$radio_ip  = of_get_option('radio_ip');
$radioplay = of_get_option('radio_autoplay');

echo '
<script type="text/javascript">
jQuery(document).ready(function($) {

    $("#radio").flashradio({
        themecolor: "' . esc_js($color) . '",
        channelurls: "' . esc_js($radio_ip) . '",
        scroll: "AUTO",
        autoplay: "' . esc_js($radioplay) . '",
        html5chrome: "TRUE",
        debug: "TRUE",
        startvolume: "100"
    });

    $(".radio-wz-open-hidden").click(function() {
        $("#radio-wz #radio-wz-col").slideToggle({
            direction: "up"
        }, 100);
        $(this).toggleClass("clientsClose");
    });
    $("#radio-wz-col").show();

    function mouseHandler(e) {
        if ($(this).hasClass("radio-wz-hidden-open")) {
            $(this).removeClass("radio-wz-hidden-open");
        } else {
            $(".radio-wz-hidden-open").removeClass("radio-wz-hidden-open");
            $(this).addClass("radio-wz-hidden-open");
        }
    }
	
    function start() {
        $(".radio-wz-open-hidden").bind("click", mouseHandler);
    }
    $(document).ready(start);

});
</script>

<div id="radio-wz">
    <div id="radio-wz-hide">
		<div class="radio-wz-open-hidden"></div>	
	</div><!-- end #radio-wz-hide -->
    <div id="radio-wz-col">
		<div id="radio-wz-source">
			<div id="radio" style="height:54px; width:1190px;"></div>
		</div><!-- end #radio-wz-source -->
    </div><!-- end #radio-wz-col -->
</div><!-- end #radio-wz -->
';
