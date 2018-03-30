<script>
    jQuery(function($) {
        
        $('#oneClickInstallSubmit').click(function(){
            $.ajax({
               type: "GET",
               url: "admin.php",
               data: "page=bebelOneClickInstallation&run=install",
               beforeSend: function(){
                 $('#oneClickInstallLoading').fadeIn(200);
                 $('#oneClickInstallSubmit').attr("disabled", "true");
               },
               success: function(msg){
                 $('#oneClickInstallLoading').hide();
                 $('#oneClickInstallSuccess').html('<?php _e('All Clear, You can continue working.', $this->settings->getPrefix()) ?>');
               }
            });
        });
        
    });

</script>
<div class="wrap">
  <h2><?php _e('Administration Panel - One Click Installation', $this->settings->getPrefix()) ?></h2>
  
  
      <p>
         <?php 
                _e('
                    If you have an empty blog, you can run this dummy installation. It will help you 
                    getting to know this theme. Once you installed the dummy data, almost everything will look 
                    like on our demo (but with different pictures). You can either use the installation and 
                    change the contents to fit your homepage, or you can simply think of it as a training.
                   ', $this->settings->getPrefix()) 
         ?>
      </p>
      <p>
         <?php 
                _e('
                    You could, but you should not run this installation on a blog with contents. Problems 
                    can occur and the theme might not be as usable as it is supposed to be. <strong>DO NOT
                    proceed without any backup!</strong> 
                   ', $this->settings->getPrefix()) 
         ?>
      </p>
      <p>
         <?php 
                _e('
                    The installation can take a few minutes. Get a cup of tea or coffee, or grab a beer and 
                    enjoy surfing the web for a while.<br />
                    We said a few minutes. We literally mean like 5 - 10 (even 12 minutes or more are possible). Please do not cancel. Take a nap. Wash your dishes. .. :)
                   ', $this->settings->getPrefix()) 
         ?>
      </p>
      <p style="color: green; display: none;" id="oneClickInstallLoading"><strong>Loading... (working hard, do not cancel until you see another message here)</strong></p>
      <p style="color: green;" id="oneClickInstallSuccess"></p>
      
      <input type="submit" name="submit" id="oneClickInstallSubmit" class="button-primary" style=" float: left; margin-top: 15px; margin-right: 20px;" value="<?php _e('Yes, Import Data!', $this->settings->getPrefix()) ?>" />
      <a href="admin.php?page=bebelAdminTop" style=" float: left; margin-top: 15px;"><?php _e('No thanks, take me to the admin panel', $this->settings->getPrefix()) ?></a>
      
      
      <br class="clear" />
      <p>
         <?php 
                _e('
                    While we are installing you can watch the first video on how to set up the theme.
                   ', $this->settings->getPrefix()) 
         ?>
      </p>
      
      <iframe width="640" height="360" src="https://www.youtube-nocookie.com/embed/KG2meuoAF7M" frameborder="0" allowfullscreen></iframe>
</pre>
</div>