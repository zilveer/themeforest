<?php 


// get the code from the database

$userdata = maybe_unserialize($_SESSION[$prefix.'userdata']);
$code = bebelEventsUtils::getUserdetailsByEvent($_SESSION['event_id'], $userdata);
?>

    <h1><?php the_title(); ?></h1>
    <h4><?php _e('Thank you.', $bSettings->getPrefix()) ?></h4>
    
    
    <p>
        <?php _e('You successfully purchased one thicket for the event '.get_the_title().'. We will send you a confirmation mail. Please print it out and bring it to the event.', $bSettings->getPrefix()) ?>
        <?php _e('If you do not have a printer, take a note of the 6 letter code in the email or on this website.', $bSettings->getPrefix()) ?>
    </p>
    <br>
    <div class="details">
        
        <h5><?php _e('Your Data: ', $bSettings->getPrefix()) ?></h5>
        <div class="left">
            <?php _e('First Name: ', $bSettings->getPrefix()) ?>
        </div>
        <div class="right">
            <?php echo $userdata['first_name'] ?>
        </div>
        <div class="left">
            <?php _e('Last Name: ', $bSettings->getPrefix()) ?>
        </div>
        <div class="right">
            <?php echo $userdata['last_name'] ?>
        </div>
        <div class="left">
            <?php _e('Email: ', $bSettings->getPrefix()) ?>
        </div>
        <div class="right">
            <?php echo $userdata['email'] ?>
        </div>
        <div class="left">
            <?php _e('Access Code: ', $bSettings->getPrefix()) ?>
        </div>
        <div class="right">
            <?php echo $code->access_code ?>
        </div>
        
    </div>

    <a href="<?php echo get_permalink() ?>" style="left: 250px; bottom: 30px;" class="submit"><?php _e('Back to Event', $bSettings->getPrefix()) ?></a>
    
    
<?php



// finished.


?>