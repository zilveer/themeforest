<?php

// we have to get the lists from mailchimp to display them.

$api_key = $this->settings->get('mailchimp_apikey');
$show_lists = false;

if($api_key == '') {
    echo '<span style="color: #ff0000"><b>Error:</b> You have to insert a valid api key!</span>';
}else {
    $mcapi = new BebelMailchimp($api_key);
    
    
    if($mcapi->check() == "invalid") {
        echo '<span style="color: #ff0000"><b>Error:</b> You have to insert a valid api key!</span>';
    }else {
        
        $lists = $mcapi->getLists();
        
        $lists = BebelMailchimpUtils::createListforList($lists, $this->getOption($key));
        
        
        
        $show_lists = true;
        
    }
    
}
if($show_lists):
?>

<div class="widget_title">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="widget_widget">
  <select name="<?php echo $this->settings->getPrefix().'_'.$key ?>">
    <?php echo $lists; ?>
  </select>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<br class="clear" />



<?php endif; ?>
