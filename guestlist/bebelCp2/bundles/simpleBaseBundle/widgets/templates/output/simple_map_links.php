<script>
jQuery(document).ready(function() {
    
  
  
  jQuery('.bebel_widget_map .links a').hover(
    function () {
      jQuery(this).stop().animate({paddingLeft: 10}, 300);
    },
    function () {
      jQuery(this).stop().animate({paddingLeft: 0}, 200);
    }
  );
      
});



</script>
<div class="bebel_widget_map">
    <h2><?php echo $values['title']; ?></h2>
    <div class="map">
        <img src="<?php echo $values['map'] ?>" alt="<?php echo $values['title']; ?>" />
    </div>
    <ul class="links">
        <?php for($i=1;$i<7;$i++): ?>
        <li>
            <a href="<?php echo $values['link_'.$i]; ?>"><?php echo $values['title_'.$i]; ?></a>
        </li>
        <?php endfor; ?>
    </ul>
    <br class="clear" />
</div>