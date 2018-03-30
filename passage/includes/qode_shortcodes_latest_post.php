<div id="qode_shortcode_form_wrapper">
<form id="qode_shortcode_form" name="qode_shortcode_form" method="post" action="">
  <div class="input">
    <label>Number of Posts</label>
      <select name="post_number" id="post_number">
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
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
    <label>Category Slug (leave empty for all)</label>
    <input name="category" id="category" value="" size="15" />
  </div>
  <div class="input">
    <label>Text length (number of caracters)</label>
    <input name="text_length" id="text_length" value="" maxlength="10" size="10" />
  </div>
  <div class="input">
      <input type="submit" name="Insert" id="qode_insert_shortcode_button" value="Submit" />
  </div>
</form>
</div>