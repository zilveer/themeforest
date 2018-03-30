
<?php
$name = $_GET["name"];
$fields = $_GET["fields"];
$defaults = $_GET["defaults"];
$types = $_GET["types"];
$descriptions = $_GET["descriptions"];  
$submit = $_GET["submit"];


$count = count($fields);
?>

<div id="shortcodes_<?php echo $name; ?>-form">

<table id="shortcodes_<?php echo $name; ?>-table" class="form-table">
<?php
for ($i = 0 ; $i < $count ; $i++)
{
    $field = $fields[$i];
    //$field_ = str_replace(" ", "_", strtolower($field));
    $field_ = str_replace(" ", "_", $field);
    $type = $types[$i];
    $description = $descriptions[$i];
    $default = $defaults[$i]; 
    if ($type == "text")
    {
    ?>
    <tr>
        <th><label for="shortcodes_<?php echo $name; ?>-<?php echo $field_; ?>"><?php echo $field; ?></label></th>
        <td><input style="width:400px" type="text" id="shortcodes_<?php echo $name; ?>-<?php echo $field_; ?>" name="<?php echo $field; ?>" value="<?php echo $default; ?>" /><br />
        <small><?php echo $description; ?></small></td>
    </tr>
    <?php
    }
    if ($type == "textarea")
    {
    ?>
    <tr>
        <th><label for="shortcodes_<?php echo $name; ?>-<?php echo $field_; ?>"><?php echo $field; ?></label></th>
        <td><textarea style="width:400px" name="<?php echo $field; ?>" id="shortcodes_<?php echo $name; ?>-<?php echo $field_; ?>"><?php echo $default; ?></textarea>
        <br />
        <small><?php echo $description; ?></small></td>
    </tr>
    <?php
    }
}
?>
                       
	</table>
<p class="submit">
	<input type="button" id="shortcodes_<?php echo $name; ?>-submit" class="button-primary" value="<?php echo $submit; ?>" name="submit" />
</p>

</div>