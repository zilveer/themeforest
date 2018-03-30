<?php 
    get_header();
?>
<div class='content'>
  <div class='container'>
    <div class='sixteen columns'>
      <div class='amplus_panel'>
        <div>
          <h1><?php _e("Oops! Error 404", BFI_I18NDOMAIN); ?></h1>
          <h4><?php _e("Page Cannot be Found", BFI_I18NDOMAIN); ?></h4>
          <div>
            <p><?php _e('There may be a problem with your URL. Try searching the site.', BFI_I18NDOMAIN) ?></p>
            <?php echo do_shortcode("[searchbar]"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
    get_footer();
?>
