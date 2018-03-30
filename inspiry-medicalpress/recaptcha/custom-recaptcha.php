<?php
global $theme_options;
$reCAPTCHA_public_key = $theme_options['recaptcha_public_key'];
$reCAPTCHA_private_key = $theme_options['recaptcha_private_key'];

if( !empty($reCAPTCHA_public_key) && !empty($reCAPTCHA_private_key) ){
    ?>
    <div id="recaptcha_widget" style="display:none" class="recaptcha_widget">
        <div id="recaptcha_image"></div>
        <div class="recaptcha_only_if_incorrect_sol" style="color:red"><?php _e('Incorrect. Please try again.','framework'); ?></div>

        <div class="recaptcha_input">
            <label class="recaptcha_only_if_image" for="recaptcha_response_field"><?php _e('Enter the words above:','framework'); ?></label>
            <label class="recaptcha_only_if_audio" for="recaptcha_response_field"><?php _e('Enter the numbers you hear:','framework'); ?></label>

            <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="required" title="<?php _e('* Please provide CAPTCHA words', 'framework'); ?>" >
        </div>

        <ul class="recaptcha_options">
            <li>
                <a href="javascript:Recaptcha.reload()">
                    <i class="fa fa-refresh"></i>
                    <span class="captcha_hide"><?php _e('Get another CAPTCHA','framework'); ?></span>
                </a>
            </li>
            <li class="recaptcha_only_if_image">
                <a href="javascript:Recaptcha.switch_type('audio')">
                    <i class="fa fa-volume-up"></i>
                    <span class="captcha_hide"> <?php _e('Get an audio CAPTCHA','framework'); ?></span>
                </a>
            </li>
            <li class="recaptcha_only_if_audio">
                <a href="javascript:Recaptcha.switch_type('image')">
                    <i class="fa fa-picture-o"></i>
                    <span class="captcha_hide"> <?php _e('Get an image CAPTCHA','framework'); ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:Recaptcha.showhelp()">
                    <i class="fa fa-question-circle"></i>
                    <span class="captcha_hide"> <?php _e('Help','framework'); ?></span>
                </a>
            </li>
        </ul>
    </div>

    <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $reCAPTCHA_public_key; ?>"></script>
    <noscript>
        <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $reCAPTCHA_public_key; ?>" height="300" width="220" frameborder="0"></iframe><br>
        <textarea name="recaptcha_challenge_field"></textarea>
        <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
    </noscript>
    <?php
}
?>