<div id="qode_shortcode_form_wrapper">
    <form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
         <div class="input">
            <label>Type</label>
            <select name="type" id="type">
                <option value="image_in_box">Image in left box</option>
                <option value="boxes">Boxes</option>
            </select>
        </div>
		<div class="input">
            <label>Number of Posts(for 'With date in left box', 'Image in left box', 'Minimal' types)</label>
            <input name="number_of_posts" id="number_of_posts" value="" size="15" />
        </div>
		<div class="input">
            <label>Number of Columns(only for Boxes type)</label>
            <select name="number_of_columns" id="number_of_columns">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                <option value="4">Four</option>
            </select>
        </div>
        <div class="input">
            <label>Number of Rows(only for Boxes type)</label>
            <select name="number_of_rows" id="number_of_rows">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                <option value="4">Four</option>
                <option value="5">Five</option>
            </select>
        </div>
        <div class="input">
            <label>Order By</label>
            <select name="order_by" id="order_by">
                <option value="menu_order">Order</option>
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
            <label>Category Slug (leave empty for all or use comma for list)</label>
            <input name="category" id="category" value="" size="15" />
        </div>
        <div class="input">
            <label>Text length (number of caracters)</label>
            <input name="text_length" id="text_length" value="" maxlength="10" size="10" />
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
            <label>Display category</label>
            <select name="display_category" id="display_category">
               <option value="">Default</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
		 <div class="input">
            <label>Display date</label>
            <select name="display_date" id="display_date">
               <option value="">Default</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="input">
            <label>Display author</label>
            <select name="display_author" id="display_author">
            	<option value="">Default</option>
				<option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="input">
            <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
        </div>
    </form>
</div>