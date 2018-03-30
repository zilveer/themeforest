<div id="qode_shortcode_form_wrapper">
    <form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
        <div class="input">
            <label>Type</label>
            <select name="type" id="type">
                <option value=""></option>
                <option value="standard">Standard</option>
                <option value="standard_no_space">Standard No Space</option>
                <option value="hover_text">Hover Text</option>
                <option value="hover_text_no_space">Hover Text No Space</option>
                <option value="masonry">Masonry Without Space</option>
                <option value="masonry_with_space">Pinterest</option>
                <option value="justified_gallery">Justified gallery</option>
            </select>
        </div>
        <div class="input">
            <label>Space Between Masonry</label>
            <select name="masonry_space" id="masonry_space">
                <option value="no">no</option>
                <option value="yes">yes</option>
            </select>
        </div>
        <div class="input">
            <label>Space Between Pinterest</label>
            <select name="pinterest_space" id="pinterest_space">
                <option value="no">no</option>
                <option value="yes">yes</option>
            </select>
        </div>
        <div class="input">
            <label>Hover Type</label>
            <select name="hover_type" id="hover_type">
                <option value="default_hover">Default</option>
                <option value="standard_hover">Standard</option>
                <option value="elegant_hover">Elegant Without Icons</option>
            </select>
        </div>
        <div class="input">
            <label>Pinterest Hover Type</label>
            <select name="pinterest_hover_type" id="pinterest_hover_type">
                <option value="">Default</option>
                <option value="info_on_hover">Info on Hover</option>
            </select>
        </div>
        <div class="input">
            <label>Box Background Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input name="box_background_color" id="box_background_color" value="" maxlength="12" size="12" />
        </div>
        <div class="input">
            <label>Box Border</label>
            <select name="box_border" id="box_border">
                <option value="">Default</option>
                <option value="yes">yes</option>
                <option value="no">no</option>
            </select>
        </div>
            <div class="input">
            <label>Box Border Width</label>
            <input name="box_border_width" id="box_border_width" value="" size="5" />
        </div>
        <div class="input">
            <label>Box Border Color</label>
            <div class="colorSelector"><div style=""></div></div>
            <input type="text" name="box_border_color" id="box_border_color" value="" size="12" maxlength="12" />
        </div>
        <div class="input">
            <label>Filter</label>
            <select name="filter" id="filter">
                <option value=""></option>
                <option value="yes">yes</option>
                <option value="no">no</option>
            </select>
        </div>
        <div class="input">
            <label>Filter Order By</label>
            <select name="filter_order_by" id="filter_order_by">
                <option value="name">Name</option>
                <option value="count">Count</option>
                <option value="id">Id</option>
                <option value="slug">Slug</option>
            </select>
        </div>
        <div class="input">
            <label>Disable Filter Title</label>
            <select name="disable_filter_title" id="disable_filter_title">
                <option value=""></option>
                <option value="yes">yes</option>
                <option value="no">no</option>
            </select>
        </div>
        <div class="input">
            <label>Filter Align</label>
            <select name="filter_align" id="filter_align">
                <option value="left_align">Left</option>
                <option value="center_align">Center</option>
                <option value="right_align">Right</option>
            </select>
        </div>
        <div class="input">
            <label>Disable Portfolio Link</label>
            <select name="disable_link" id="disable_link">
                <option value=""></option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="input">
            <label>Lightbox</label>
            <select name="lightbox" id="lightbox">
                <option value=""></option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="input">
            <label>Show Like</label>
            <select name="show_like" id="show_like">
                <option value=""></option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="input">
            <label>Columns</label>
            <select name="columns" id="columns">
                <option value=""></option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>
        <div class="input">
            <label>Image Size</label>
            <select name="image_size" id="image_size">
                <option value="">Default</option>
                <option value="full">Original Size</option>
                <option value="square">Square</option>
                <option value="landscape">Landscape</option>
                <option value="portrait">Portrait</option>
            </select>
        </div>
        <div class="input">
            <label>Order By</label>
            <select name="order_by" id="order_by">
                <option value=""></option>
                <option value="menu_order">Menu Order</option>
                <option value="title">Title</option>
                <option value="date">Date</option>
            </select>
        </div>
        <div class="input">
            <label>Order</label>
            <select name="order" id="order">
                <option value="ASC">ASC</option>
                <option value="DESC">DESC</option>
            </select>
        </div>
        <div class="input">
            <label>Number of portolios on page (-1 is all)</label>
            <input name="number" id="number" value="" size="5" />
        </div>
        <div class="input">
            <label>Category Slug (leave empty for all)</label>
            <input name="category" id="category" value="" size="5" />
        </div>
        <div class="input">
            <label>Selected Projects (leave empty for all, delimit by comma)</label>
            <input name="selected_projects" id="selected_projects" value="" size="40" />
        </div>
        <div class="input">
            <label>Show Load More</label>
            <select name="show_load_more" id="show_load_more">
                <option value=""></option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="input">
            <label>Title Tag</label>
            <select name="title_tag" id="title_tag">
                <option value=""></option>
                <option value="h2">h2</option>
                <option value="h3">h3</option>
                <option value="h4">h4</option>
                <option value="h5">h5</option>
                <option value="h6">h6</option>
            </select>
        </div>
        <div class="input">
            <label>Title Font Size (px)</label>
            <input name="title_font_size" id="title_font_size" value="" size="5" />
        </div>
        <div class="input">
            <label>Text Align</label>
            <select name="text_align" id="text_align">
               	<option value=""></option>
                <option value="left">Left</option>
                <option value="center">Center</option>
                <option value="right">Right</option>
            </select>
        </div>
        <div class="input">
            <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
        </div>

    </form>
</div>
