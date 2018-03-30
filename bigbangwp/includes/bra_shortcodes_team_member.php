<div id="brankic_shortcode_form_wrapper">
<form id="brankic_shortcode_form" name="brankic_shortcode_form" method="post" action="">
  <p>
    <label>Member name</label>
      <input type="text" name="member_name" id="member_name" value="John Doe" size="50"/>    
  </p>
  <p>
    <label>Position</label>
      <input type="text" name="member_position" id="member_position" value="Developer" size="50"/>    
  </p>
  <p>
    <label>How many members per row</label>
      <select name="member_columns" id="member_columns">
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
  </p>
  <p>
    <label>Image SRC</label>
      <input type="text" name="member_img_src" id="member_img_src" value="" size="50"/>   
  </p>
  
  <p>
    <label>Text, URL, Text, URL...</label>
    <textarea name="member_social_list" cols="50" id="member_social_list">Facebook, http://www.facebook.com, Twitter, http://twitter.com, Email, mailto:email@email.com</textarea>   
  </p>

  <p>
    <label>About</label>
    <textarea name="about" cols="50" id="about">Seded ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</textarea>   
  </p>  
  <p>
      <input type="submit" name="Insert" id="bra_insert_shortcode_button" value="Submit" />
  </p>
</form>
</div>
