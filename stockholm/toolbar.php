<?php

$example_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] .'/';
if (strpos($example_url,'hazel1/') || strpos($example_url,'hazel7/') || strpos($example_url,'hazel9/')){
    $position = 'right';
}else{
    $position = 'left';
}

?>
    <div id="panel" class="default <?php echo esc_attr($position); ?>" style="margin-<?php echo esc_attr($position); ?>: -245px;">
        <div id="panel-admin">
            <h6>Theme Options</h6>
            <div class="panel-admin-box">
                <div class="accordion_toolbar">
                    <?php if($position == 'left'){ ?>
                    <p class="accordion_toolbar_header">Header Type <i class="fa fa-angle-down"></i></p>
                    <div class="accordion_toolbar_content">
                        <ul id="tootlbar_header_type" class="choose_option">
                            <li data-value="normal">Normal</li>
                            <li data-value="big">Big</li>
                        </ul>
                    </div>
                    <p class="accordion_toolbar_header">Header Top Menu <i class="fa fa-angle-down"></i></p>
                    <div class="accordion_toolbar_content">
                        <ul id="tootlbar_header_top_menu" class="choose_option">
                            <li data-value="yes">Yes</li>
                            <li data-value="no">No</li>
                        </ul>
                    </div>
                    <?php } ?>
                    <p class="accordion_toolbar_header">Ajax Animation<i class="fa fa-angle-down"></i></p>
                    <div class="accordion_toolbar_content">
                        <ul id="tootlbar_page_transitions" class="choose_option">
                            <li data-value="no">No</li>
                            <li data-value="2">Yes</li>
                        </ul>
                    </div>
                    <p class="accordion_toolbar_header">Boxed Layout <i class="fa fa-angle-down"></i></p>
                    <div class="accordion_toolbar_content">
                        <ul id="tootlbar_boxed" class="choose_option">
                            <li data-value="boxed">Yes</li>
                            <li data-value="">No</li>
                        </ul>
                    </div>
                    <p class="accordion_toolbar_header">Choose Background <i class="fa fa-angle-down"></i></p>
                    <div class="accordion_toolbar_content">
                        <ul id="tootlbar_background">
                            <li data-value="background1">Background 1</li>
                            <li data-value="background2">Background 2</li>
                            <li data-value="background3">Background 3</li>
                        </ul>
                    </div>
                    <p class="accordion_toolbar_header">Choose Pattern <i class="fa fa-angle-down"></i></p>
                    <div class="accordion_toolbar_content">
                        <ul id="tootlbar_pattern">
                            <li data-value="pattern11">Retina Wood</li>
                            <li data-value="pattern12">Retina Wood Grey</li>
                            <li data-value="pattern1">Transparent</li>
                            <li data-value="pattern3">Cubes</li>
                            <li data-value="pattern4">Diamond</li>
                            <li data-value="pattern5">Escheresque</li>
                            <li data-value="pattern10">Whitediamond</li>
                        </ul>
                    </div>
                    <p class="accordion_toolbar_header">Pick a Color <i class="fa fa-angle-down"></i></p>
                    <div class="accordion_toolbar_content">
                        <div id="tootlbar_colors">
                            <ul>
                                <li><div class="color active color1" data-color="#ecad81" style="background-color:#ecad81;"></div></li>
                                <li><div class="color color2" data-color="#79bc90" style="background-color:#79bc90;"></div></li>
                                <li><div class="color color3" data-color="#63a69f" style="background-color:#63a69f;"></div></li>
                                <li><div class="color color4" data-color="#7e8aa2" style="background-color:#7e8aa2;"></div></li>
                                <li><div class="color color5" data-color="#c84564" style="background-color:#c84564;"></div></li>
                                <li><div class="color color6" data-color="#363f46" style="background-color:#363f46;"></div></li>

                            </ul>
                        </div>
                    </div>
                    <p class="accordion_toolbar_header">Footer type <i class="fa fa-angle-right"></i></p>
                    <div class="accordion_toolbar_content">
                        <ul id="tootlbar_footer_type" class="choose_option">
                            <li data-value="regular">Regular</li>
                            <li data-value="unfold">Unfold</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <a class="open" href="#"><span><i class="fa fa-cog"></i></span></a>
    </div>