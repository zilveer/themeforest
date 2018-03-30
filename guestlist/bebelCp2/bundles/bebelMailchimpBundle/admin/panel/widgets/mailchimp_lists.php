<?php

// we have to get the lists from mailchimp to display them.

$api_key = $this->settings->get('mailchimp_apikey');

if($api_key == '')
{
    $error = '<span style="color: #ff0000"><b>Error:</b> You have to insert a valid api key first!</span>';
}

$error = false;

if($api_key == '') 
{
    $error = '<span style="color: #ff0000"><b>Error:</b> You have to insert a valid api key!</span>';
}else {
    $mcapi = new BebelMailchimp($api_key);
    
    
    if($mcapi->check() == "invalid") {
        $error = '<span style="color: #ff0000"><b>Error:</b> You have to insert a valid api key!</span>';
    }else {
        
        $lists = $mcapi->getLists();
        
        $lists = BebelMailchimpUtils::createListforList($lists, $this->settings->get($key));
        
    }
    
}

?>

<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">

    <div class="widget">
        <?php 

        if($error) 
        {
            echo $error;
        }else{
        ?>

        <select name="bSettings[<?php echo $key ?>]">
            <?php echo $lists; ?>
        </select>

            <?php } ?>
      <p class="help"><?php echo $widget['description']?></p>
    </div>
</div>

<br class="clear" />




