<?php

// Translation
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_search = $of_option[$prefix.'tr_search'];
}else{			
	$tr_search = __('Search..', 'spacing');
}

?>

<div class="searchform">
	<div class="search-border"></div>	
	<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
        <input class="search-submit" id="searchsubmit" value="" type="submit"> 
        <input class="search-box" name="s" id="s" type="text" value="<?php echo $tr_search ?>" onfocus="if (this.value == '<?php echo $tr_search ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $tr_search ?>';}">  
    </form>     
</div>