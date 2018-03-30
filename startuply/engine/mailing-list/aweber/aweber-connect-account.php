<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] ); // hmm maibe not wp-content
require_once( $parse_uri[0] . 'wp-load.php' );

//require_once get_template_directory_uri() . '/engine/options-framework/inc/options-framework.php';

require dirname(__FILE__) . '/inc/aweber_api.php';

// assign these values from https://labs.aweber.com/apps
$consumerKey    = startuply_option("vivaco_aweber_consumer_key", ''); # put your credentials here
$consumerSecret = startuply_option("vivaco_aweber_consumer_secret", ''); # put your credentials here

$list_id = '';

$aweber = new AWeberAPI($consumerKey, $consumerSecret);

try {
    display_access_tokens($aweber);

    if (isset($_SESSION['accessKey']) && $_SESSION['accessSecret']) {
        $account = $aweber->getAccount($_SESSION['accessKey'], $_SESSION['accessSecret']);
        $account_id = $account->id;

        display_available_lists($account);
        exit;
    }
} catch(AWeberAPIException $exc) {
    print "<h3>AWeberAPIException:</h3>";
    print " <li> Type: $exc->type <br>";
    print " <li> Msg : $exc->message <br>";
    print " <li> Docs: $exc->documentation_url <br>";
    print "<hr>";
    exit(1);
}

function get_self(){
    return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function display_available_lists($account){
    if (isset($_SESSION['accessKey']) && $_SESSION['accessSecret']) {
        // print "Please add one for the lines of PHP Code below to the top of your script for the proper list<br>" .
        //         "then click <a href='" . get_self() . "'>here</a> to continue<p>";

        $listURL ="/accounts/{$account->id}/lists/";
        $lists = $account->loadFromUrl($listURL);
        foreach($lists->data['entries'] as $list ){
            print "<pre>\$list_id = '{$list['id']}'; // list name:{$list['name']}\n</pre>";
        }
    }
}

function display_access_tokens($aweber){
    if (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])){

        $aweber->user->requestToken = $_GET['oauth_token'];
        $aweber->user->verifier = $_GET['oauth_verifier'];
        $aweber->user->tokenSecret = $_COOKIE['secret'];

        list($accessTokenKey, $accessTokenSecret) = $aweber->getAccessToken();

        $_SESSION['accessKey'] = $accessTokenKey;
        $_SESSION['accessSecret'] = $accessTokenSecret;

        print "Please add these lines of code to the top of your settings:<br>" .
                "<pre>" .
                "\$accessKey = '{$accessTokenKey}';\n" .
                "\$accessSecret = '{$accessTokenSecret}';\n" .
                "</pre>";
        return;
    }

    if(!isset($_SERVER['HTTP_USER_AGENT'])){
        print "This request must be made from a web browser\n";
        return;
    }

    $callbackURL = get_self();
    list($key, $secret) = $aweber->getRequestToken($callbackURL);
    $authorizationURL = $aweber->getAuthorizeUrl();

    setcookie('secret', $secret);

    header("Location: $authorizationURL");

    if (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])){
        exit();
    } else {
        return;
    }
}

?>