<?php
$service_option = array(
    'name' => __('Newsletter service', 'tfuse'),
    'desc' => __('Please select the newsletter service you would like to use.', 'tfuse'),
    'id' => TF_THEME_PREFIX . '_newsletter_service',
    'value' => $newsletter_service,
    'type' => 'select',
    'options' => array(
        'none' => __('Disabled', 'tfuse'),
        'mailchimp' => __('MailChimp', 'tfuse'),
        'campaignmonitor' => __('CampaignMonitor', 'tfuse')
    )
);
$api_option_campaignmonitor = array(
    'name' => '',
    'desc' => '',
    'id' => 'tfuse_campaignmonitor_api_key',
    'value' => $cm_key,
    'type' => 'text',
    'properties' => array(
        'style' => 'width:260px'
    )
);
$api_option_mailchimp = array(
    'name' => '',
    'desc' => '',
    'id' => 'tfuse_mailchimp_api_key',
    'value' => $mc_key,
    'type' => 'text',
    'properties' => array(
        'style' => 'width:260px'
    )
);
?>
<h3><?php _e('Newsletter', 'tfuse') ?></h3>
<?php _e('Choose your preferred newsletter service:', 'tfuse') ?>
<?php
echo $this->optigen->_auto($service_option);
?>
&nbsp&nbsp
<a id="tfuse_newsletter_save_api_key" class="button"><?php _e('Save', 'tfuse') ?></a>
<br /><br />
<span class="newsletter_apikey_holder mailchimp_apikey">
    <?php _e('MailChimp API key:', 'tfuse') ?>
    <?php
    echo $this->optigen->{$api_option_mailchimp['type']}($api_option_mailchimp);
    ?> 
</span>
<span class="newsletter_apikey_holder campaignmonitor_apikey">
    <?php _e('CampaignMonitor API key:', 'tfuse') ?>
    <?php
    echo $this->optigen->{$api_option_campaignmonitor['type']}($api_option_campaignmonitor);
    ?> 
</span>
