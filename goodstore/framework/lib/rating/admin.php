<?php


/**
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo check permition for dynamic file 
 */



/**
 * trida rating manazer ma 7 klicovych metod
 * 
 * nastaveni ratingu
 * public function setAllRatings( $postId, $ratings ) // array[oneRating]
 * public function setOneRating( $postId, oneRating $newRating  )
 * 
 * // hlasovani, score znamena hodnota hlasu
 * public function vote( $postId, $ratingId, $score )
 * 
 * // vynulovani hlasovani ( nastavi score a voted na 0 )
 * public function nullVotes( $postId, $ratingId )
 * 
 * 
 * // dostane informace o specifickem ratingu, pomoci ratingID
 * public function getOneRating( $postId, $ratingId ) 
 * 
 * // dostane vsechny ratingy 
 * public function getRatings( $postId )
 * 
 * // !!! umoznuje preddefinovat ratingy z externiho zdroje. To znamena, ze kdyz
 * // neni k danemu postu zadny rating ( hlavne pripade po kliknuti Add New Post),
 * // tak se nactou ratingy odsud
 * _getPredefinedRatingsFromExtern()
 * 
 * 
 * 
 * !! Na spodu stranky jsou objasneny ajax hooky
 * 
 */
class oneRating {

    public $id = null;   // unique identifier
    public $name = null;  // name
    public $type = null;  // type
    public $score = 0;  // average score
    public $voted = 0;  // how many times have been voted ( important to calculate the avg score)
    public $useredit = 0;
}

class ratingManager {

    const RATING_META_NAME          = 'fw_rating';
    const RATING_BEEN_CHANGED       = 'fw_rating_changed';
    const RATING_SHOW_DESC          = 'fw_rating_show_desc';
    const RATING_DESCRIPTION        = 'fw_rating_desc';
    const RATING_OVERALL_SHOW       = 'fw_rating_overal';
    const RATING_OVERALL_TYPE       = 'fw_rating_overal_type';
    const RATING_TITLE              = 'fw_rating_title';
    const RATING_SHOW_USER_RATING   = 'fw_rating_user_edit';

    /**
     * @var ratingManager
     */
    private static $_instance = null;

    /**
     * @var array[oneRating]
     */
    private $_predefinedRatings = null;

    /**
     * @return array[oneRating]
     */
    private function _getPredefinedRatings() {     
        if ($this->_predefinedRatings == null) {
            $this->_predefinedRatings = $this->_getPredefinedRatingsFromExtern();
        } 
        return $this->_predefinedRatings;
    }

    private function _isRatingChangeByUser($postId) {
        $ratingChanged = get_post_meta($postId, self::RATING_BEEN_CHANGED);
        if (!empty($ratingChanged))
            return true;
        else
            return false;
    }

    /**
     * @return array[oneRating]
     */
    private function _getPredefinedRatingsFromExtern() {
        $rating1            = new oneRating();
        $rating1->id        = 'UsersRatings';
        $rating1->name      = __('Users Ratings','jawtemplates');
       
        $rating1->type      = 'stars';
        $rating1->score     = 0;
        $rating1->voted     = 0;
        $rating1->useredit  = 1;



        $predefinedRatings = array($rating1);
        return $predefinedRatings;
    }
    
   
    function getLabelUsersRatings($rating){   
        return   __('Users Ratings','jawtemplates');      
    }
    function getLabelYourRating($rating){   
        return   __('Your Rating','jawtemplates');      
    }
    

    public function setAllRatings($postId, $ratings) {
        $this->_updateRatingsPostMeta($postId, $ratings);
    }

    public function setOneRating($postId, oneRating $newRating) {
        $ratings = $this->getRatings($postId);
        $found = false;
        $newRatingsArray = array();
        foreach ($ratings as $oneRating) {
            if ($oneRating->id == $newRating->id) {
                $newRatingsArray[] = ( $newRating);
                $found = true;
            } else {
                $newRatingsArray[] = ( $oneRating );
            }
        }

        if ($found === false) {
            $newRatingsArray[] = ( $newRating);
        }
        $this->_updateRatingsPostMeta($postId, $newRatingsArray);
    }

    public function __construct() {
        
    }

    public function vote($postId, $ratingId, $score) {
        $rating = $this->getOneRating($postId, $ratingId);

        $totalScoreOld = $rating->score * $rating->voted;
        $totalScoreNew = $totalScoreOld + $score;

        $rating->voted++;
        $rating->score = $totalScoreNew / $rating->voted;
        ;

        $this->setOneRating($postId, $rating);
    }

    public function nullVotes($postId, $ratingId) {
        $rating = $this->getOneRating($postId, $ratingId);

        $rating->voted = 0;
        $rating->score = 0;

        $this->setOneRating($postId, $rating);
    }

    /**
     * 
     * @param unknown $postId
     * @param unknown $ratingId
     * @return oneRating
     */
    public function getOneRating($postId, $ratingId) {
        $ratings = $this->getRatings($postId);
        $foundRating = null;
        foreach ($ratings as $oneRating) {
            if ($oneRating->id == $ratingId) {
                $foundRating = $oneRating;
                break;
            }
        }
        return $foundRating;
    }

    /**
     * @param array[oneRating]
     */
    public function getRatings($postId) {
        $savedRatings = get_post_meta($postId, self::RATING_META_NAME);
        if (!empty($savedRatings))
            return get_post_meta($postId, self::RATING_META_NAME);
        else
            return $this->_getPredefinedRatings();
    }
    
    public function getRatingsScore($ratings) {
        
        $totalScore = 0;
        $totalCount = 0;        
        
        foreach ($ratings as $rating) {
            $count_ur = get_post_meta(get_the_ID(),'fw_rating_user_count',true);
            if(isset($count_ur) && $count_ur == '1'){
                 if(isset($rating->score) && $rating->voted > 0){
                     if($rating->id == 'UsersRatings'){
                        $totalCount += 1;
                        $totalScore += $rating->score;
                     }else{
                         $totalCount += $rating->voted;
                         $totalScore += $rating->score*$rating->voted;
                     }
                    
                }
            }else{
                if($rating->id != 'UsersRatings'){
                    if(isset($rating->score) && $rating->voted > 0){
                        $totalCount += $rating->voted;
                        $totalScore += $rating->score*$rating->voted;
                    }
                }
               
            }
        }

        if ( $totalCount == 0 ) {
            return -1;
        } else if ( $totalCount > 0 ) {
            
            return $totalScore / $totalCount;
        } else {
           return 0;
        }
    }
    
    public function getRatignsShowDesc($postId) {
        $ratingsShwoDesc = get_post_meta($postId, self::RATING_SHOW_DESC);
        if (!empty($ratingsShwoDesc))
            return $ratingsShwoDesc[0];
        else
            return 0;
    }
    
    public function getRatignsDesc($postId) {
        $ratingsDesc = get_post_meta($postId, self::RATING_DESCRIPTION);
        if (!empty($ratingsDesc))
            return $ratingsDesc[0];
        else
            return null;
    }
    
    public function getRatignsTitle($postId) {
        $ratingsTitle = get_post_meta($postId, self::RATING_TITLE);
        if (!empty($ratingsTitle))
            return $ratingsTitle[0];
        else
            return null;
    }
    
    public function getRatignsShowOverall($postId) {
        $ratingsShwoOverall = get_post_meta($postId, self::RATING_OVERALL_SHOW);
        if (!empty($ratingsShwoOverall))
            return $ratingsShwoOverall[0];
        else
            return 0;
    }
    
    public function getOverllRatignType($postId) {
        $overallRatingType = get_post_meta($postId, self::RATING_OVERALL_TYPE);
        if (!empty($overallRatingType))
            return $overallRatingType[0];
        else
            return 'stars';
    }
    
    public function getRatignsShowUserRating($postId) {
        $ratingsShowUserRating = get_post_meta($postId, self::RATING_SHOW_USER_RATING);
        if (!empty($ratingsShowUserRating))
            return $ratingsShowUserRating[0];
        else
            return 0;
    }
    
    private function _updateRatingsPostMeta($postId, $ratings) {
        delete_post_meta($postId, self::RATING_META_NAME);
        foreach ($ratings as $oneRating) {
            add_post_meta($postId, self::RATING_META_NAME, $oneRating);
        }
    }

    /**
     * @return ratingManager
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new ratingManager();
        }
        return self::$_instance;
    }

}

/* * ***************************************************************************
 * 		
 * 		AJAX
 * 
 */

/**
 * Ajax requesty. 
 * 
 * Get -> doda jeden konkretni rating a jeho hodnotu, zakoduje do
 * JSONu
 * 
 * Vote -> zmeni hodnotu ratingu a navraci cely rating ( score, voted, name ...)
 * v JSONu
 */
/*
  var data = {
  postId:16,
  ratingId:'tworating2',
  score:5,
  }

  jQuery(document).ready(function($) {
  $.post(
  '<?php echo admin_url('admin-ajax.php');?>',
  {
  'action':'wp_ajax_jwrating_vote',   // nebo jwrating_get
  'data':data
  },
  function(response){
  
  }
  );
  });
 */


add_action('wp_ajax_jwrating_get', 'jwrating_get');
add_action('wp_ajax_nopriv_jwrating_get', 'jwrating_get');

function jwrating_get() {
    if (!isset($_POST['data']['postId']))
        die();

    $postId = $_POST['data']['postId'];

    $manager = ratingManager::getInstance();

    $ratings = $manager->getRatings($postId);
    $ratingsArray = array();
    foreach ($ratings as $oneRating) {
        $ratingsArray[] = get_object_vars($oneRating);
    }

    echo json_encode($ratingsArray);
    die();  // must be used, by wordpress
}

add_action('wp_ajax_jwrating_vote', 'jwrating_vote');
add_action('wp_ajax_nopriv_jwrating_vote', 'jwrating_vote');

function jwrating_vote() {
    if (!isset($_POST['data']['postId']) || !isset($_POST['data']['ratingId']) || !isset($_POST['data']['score']))
        die();

    $postId = $_POST['data']['postId'];
    $ratingId = $_POST['data']['ratingId'];
    $score = $_POST['data']['score'];

    $manager = ratingManager::getInstance();
    $manager->vote($postId, $ratingId, $score);

    $ratingNew = $manager->getOneRating($postId, $ratingId);
    $ratingNewArray = get_object_vars($ratingNew);
    echo json_encode($ratingNewArray);

    die();  // must be used, by wordpress
}