<?php 
    global $pagemedia;
?>
<section id='heading-box-container'>
  <div class='container' id='heading-box'>
    <?php 
        global $post;
        if (is_object($pagemedia)) {
            $pagemedia->width = 1020;
            echo $pagemedia->getBody(); 
        }
    ?>
  </div>
</section>
