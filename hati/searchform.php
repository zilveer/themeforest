
<!-- BEGIN #searchform -->
<?php $sMsg = __('Type keywords to find', A_DOMAIN) ?>
<form id="searchform" method="get" action="<?php echo site_url() ?>">
  <input type="text" name="s" id="s" value="<?php echo ( $s=get_query_var('s') ) ? $s : $sMsg ?>" onfocus="if(this.value=='<?php echo $sMsg ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo $sMsg ?>';">
</form>
<!-- END #searchform -->
