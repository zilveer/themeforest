<?php
$lang = array();
function get_lang($value)
{
	global $lang;
	if (array_key_exists($value, $lang)) 
	{
    	return $lang[$value];
	}
	else
	{
		return $value;	
	}
}
function lang($value)
{
	global $lang;
	if (array_key_exists($value, $lang)) 
	{
    	echo $lang[$value];
	}
	else
	{
		echo $value;	
	}
}
?>
<?php
$lang['Homepage Slide Settings'] = 'Homepage Slide Settings!';
$lang['Menu Title'] = 'IT Admin!';
$lang['Add'] = 'Add';
?>