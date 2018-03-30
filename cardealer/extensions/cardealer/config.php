<?php
global $tmm_config;

if (empty($tmm_config)) {
	$tmm_config = array();
}

$tmm_config['emails']['create_car'] = array(
	'subject' => __('Your car was successfully added', 'cardealer'),
	'message' => __('Thank you for choosing our car market website! <br>
            Your car was successfully added and it\'s already getting viewed by visitors! <br>
            The direct link to your car: __CARLINK__. <br>
            Please be aware you can always adjust the car details in __USERCARSLINK__ section', 'cardealer'),
);

$tmm_config['emails']['create_user'] = array(
	'subject' => __('User registration!', 'cardealer'),
	'message' => __('Hello __USER__! Thank you for choosing us! Your account has been successfully created and your password is: __PASSWORD__', 'cardealer'),
);

$tmm_config['emails']['delete_user'] = array(
	'subject' => __('Account removal notification', 'cardealer'),
	'message' => __('Hello __USER__! Please be aware your account at __SITENAME__ has been deleted.', 'cardealer'),
);

$tmm_config['emails']['update_account'] = array(
	'subject' => __('Account status upgrade', 'cardealer'),
	'message' => __('Hello __USER__! We would like to inform you that your account status successfully upgraded to __PACKET_NAME__', 'cardealer'),
);

$tmm_config['emails']['reset_account'] = array(
	'subject' => __('Account status notification', 'cardealer'),
	'message' => __('Hello __USER__! Your account status has been reverted back to default and your posted cars ads on the website got adjusted in accordance to default account car ads amount and the rest car ads were sent to draft.', 'cardealer'),
);

$tmm_config['emails']['reset_account_before_week'] = array(
	'subject' => __('Account status notification', 'cardealer'),
	'message' => __('Hello __USER__! Please be aware that due to end of your previous account upgrade period in a week your account status (__PACKET_NAME__) will be changed back to default and your posted cars ads on the website will be adjusted in accordance to default account car ads amount and the rest car ads will be sent to draft.', 'cardealer'),
);

$tmm_config['emails']['reset_account_before_day'] = array(
	'subject' => __('Account status notification', 'cardealer'),
	'message' => __('Hello __USER__! Please note that your account status (__PACKET_NAME__) will end in one day and your account plan will be reverted back to default and all your posted cars ads on the website will be adjusted in accordance to default account car ads amount and the rest car ads will be sent to draft.', 'cardealer'),
);

$tmm_config['emails']['purchase_bundle'] = array(
	'subject' => __('Featured cars bundle purchase confirmation', 'cardealer'),
	'message' => __('Hello __USER__! Thank you for  purchasing a bundle with featured points. Now you have __FEATURES_NUM__ featured points!', 'cardealer'),
);

//$tmm_config['emails']['set_car_featured'] = __('Hello__USER__! You just set __CAR__ as featured. So you have __FEATURES_NUM__ featured points now.', 'cardealer');;
//$tmm_config['emails']['reset_featured_cars'] = __('Hello__USER__! Your next featured cars just set __CAR__ as featured. So you have __FEATURES_NUM__ featured points now.', 'cardealer');;

$GLOBALS['tmm_config'] = $tmm_config;