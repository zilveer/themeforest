<?php
if (!defined('ABSPATH'))
	exit;
?>
<input type=submit id="system_phpinfo" class="system_phpinfo send_system_check" value="phpinfo()">
<form method="post" action="">
	<input type=hidden name=start_test value="Y">
	<input type=submit value="Start testing" id="send_system_check" class="send_system_check">
</form>
<img class="sysinfo_img_ajax" src="<?php echo $this->extension_obj->assets_dir . "image/ajax.GIF" ?>">
<div class="separator_sysinfo"></div>
<div class="sysinfo_result">

</div>