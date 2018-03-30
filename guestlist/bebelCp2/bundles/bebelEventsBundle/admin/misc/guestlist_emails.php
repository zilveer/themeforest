<?php

/*
 * shows a simple list for all the email addresses that want to get emails.
 */

global $bebel;
if($bebel['disable_double_opt']) {
    $emails = bebelEventsUtils::getAllEmailsWithoutDoubleOpt();
}else {
    $emails = bebelEventsUtils::getAllEmailsThatWantNewsletter();
}

?>

<p><?php echo __('If you do not use mailchimp and want to send out a newsletter, you can copy and paste the email addresses here.', $this->settings->getPrefix()) ?></p>


<p><?php echo __('We offer 3 formats for various usage purposes. ', $this->settings->getPrefix()) ?></p>

<h2><?php echo __('Mailchimp Import', $this->settings->getPrefix()) ?></h2>

<p><?php echo __('One is for import into mailchimp, in case you activated it after you got users in your database. To import the mails, go to mailchimp and select the list you want to add the emails to. Choose "Excel" and paste the emails into the field there.', $this->settings->getPrefix()) ?></p>

<textarea style="width: 500px; height: 300px;">
<?php 
        
        foreach($emails as $email)
        {
echo $email->email."\t".$email->first_name."\t".$email->last_name."\n";
        }
    
?>
</textarea>


<h2><?php echo __('Email Client', $this->settings->getPrefix()) ?></h2>

<p><?php echo __('The other one is a simple list, in case you do it old school and send your newsletters through your email client.', $this->settings->getPrefix()) ?></p>

<textarea style="width: 500px; height: 300px;">
<?php 
        
        foreach($emails as $email)
        {
echo $email->email.", ";
        }
    
?>
</textarea>


<h2><?php echo __('CSV Format', $this->settings->getPrefix()) ?></h2>

<p><?php echo __('And finally there is the csv format to import into almost anything.', $this->settings->getPrefix()) ?></p>

<textarea style="width: 500px; height: 300px;">
<?php 
        
        foreach($emails as $email)
        {
echo $email->email."; ".$email->first_name."; ".$email->last_name."\n";
        }
    
?>
</textarea>