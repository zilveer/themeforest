<!-- theme_color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">THEME ACCENT COLOR</span>
        <p>Select theme accent color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_theme_color',
            'default_color' => '#4db2ec'
        ));
        ?>
    </div>
</div>


<!-- BACKGROUND COLOR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BACKGROUND COLOR</span>
        <p>Select theme background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_site_background_color',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<!-- GRIG COLOR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">GRID LINE COLOR</span>
        <p>Select grid line color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_grid_line_color',
            'default_color' => 'e6e6e6'
        ));
        ?>
    </div>
</div>