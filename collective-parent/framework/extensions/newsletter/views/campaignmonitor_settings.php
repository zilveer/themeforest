<?php
$clients_select = array(
    'name' => '',
    'desc' => '',
    'id' => 'tfuse_campaignmonitor_client',
    'value' => $cm_client_id,
    'type' => 'select',
    'options' => $clients
);
$lists_select = array(
    'name' => '',
    'desc' => '',
    'id' => 'tfuse_campaignmonitor_list',
    'value' => $cm_list_id,
    'type' => 'select',
    'options' => $lists
);
?>
<?php
if (!empty($cm_key)) {
    ?>
    <br /><br />
    Choose your client:
    <?php
    echo $this->optigen->select($clients_select);
    ?> 
    <a id="tfuse_newsletter_save_client" class="button"><?php _e('Save Client', 'tfuse') ?></a>
    <?php
    if (!empty($cm_client_id)) {
        ?>
        <br/><br/>
        <?php _e('Choose list that new subscribers will be added in:', 'tfuse') ?>
        <?php
        echo $this->optigen->select($lists_select);
        ?> 
        <a id="tfuse_newsletter_save_list" class="button"><?php _e('Save List', 'tfuse') ?></a>
        <?php
        if (!empty($cm_list_id)) {
            ?>
            <br/><br/>
            <textarea style="width:600px;height:300px" id="output_field"></textarea><br/>
            <a id="tfuse_newsletter_fetch_emails_subscribed" class="button"><?php _e('Fetch Emails', 'tfuse') ?></a>
            <span id="tfuse_newsletter_total_emails">
                <?php _e('Total subscribers:', 'tfuse') ?> <span></span>
            </span>
            <?php
        }
    }
}
?>
