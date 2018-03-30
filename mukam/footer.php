<?php if ( function_exists( 'get_option_tree') ) {
              $theme_options = get_option('option_tree');  
              } ?>
<footer>
  <?php $footer_style = get_option_tree('footer_style', $theme_options);
        $footer_content = get_option_tree('footer12_content', $theme_options);
        $footer_content2 = get_option_tree('footer3_content', $theme_options);
  if ( $footer_style == "footer_style_1" ) {
  ?>    <div class="facts"><div class="container"><div class="row">
            <?php echo $footer_content; ?>
        </div></div></div>
  <?php }

  else if ( $footer_style == "footer_style_2") {
  ?>    <div class="facts-2"><div class="container"><div class="row">
             <?php echo $footer_content; ?>
        </div></div></div>
  <?php } 

  else if ( $footer_style == "footer_style_3") {
  ?>    <div class="bottom-section"><div class="container"><div class="row">
             <?php echo $footer_content2; ?>
        </div></div></div>
  <?php } 

  else {

  } ?>

  <?php $show_widget = get_option_tree('show_widget', $theme_options); 
        if ( $show_widget == 'Yes') {?>
      <div class="container">
        <div class="row">
          <div class="widgetscontainer">
          <!-- Widget Area 1 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer First") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 2 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Second") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 3 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Third") ) : ?>
            <?php endif; ?>
          </div>
          <!-- Widget Area 4 -->
          <div class="col-md-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Fourth") ) : ?>
            <?php endif; ?>
          </div>
          </div>

        </div>
      </div>
        <?php } ?>
        <?php $show_copyright = get_option_tree('show_copyright', $theme_options); 
        if ( $show_copyright == 'Yes') {?>
      <div class="bg-color black fixed-padding nobordermore">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="copyright-section"><p><?php echo $copyright_text = get_option_tree('copyright_text', $theme_options); ?></div>
            </div>
          </div>
        </div>
      </div>
        <?php } ?>
    </footer>
</div>
<?php $analytics = get_option_tree('analytics', $theme_options);
	if ( $analytics != "") {
		echo $analytics;
	}
	?>

    <?php wp_footer() ?> 
  </body>
</html>