<?php
/**
*@author  smooththemes
*@email   sa@smooththemes.com
*@website http://smooththemes.com
*@version 1.0
**/
class STEventsCalendar {   
	
	/**
     * Constructor
     */
	public function __construct(){		
		$this->naviHref = '#';
        $this->current_timestamp  =  current_time('timestamp');
        $this->today_date = date_i18n('Y-m-d',$this->current_timestamp);
        $this->dayLabels = array(
				date_i18n('D', strtotime('Monday')),
				date_i18n('D', strtotime('Tuesday')),
				date_i18n('D', strtotime('Wednesday')),
				date_i18n('D', strtotime('Thursday')),				
				date_i18n('D', strtotime('Friday')),
				date_i18n('D', strtotime('Saturday')),
				date_i18n('D', strtotime('Sunday'))
			);
	}
	
	/********************* PROPERTY ********************/	
	public $cellContent ='';	
	protected $observers = array();
	
    private $dayLabels = null; //  array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
    private $currentYear=0;
    private $currentMonth=0;
    private $currentDay=0;
    private $currentDate=null;
    private $daysInMonth=0;
    private $sundayFirst=false;
	private $naviHref= null;
    public $current_timestamp  =null;
    public $today_date = null;
    
    /********************* PUBLIC **********************/  
	/* @return void
	* @access public
	*/
	public function attachObserver($type,$observer) {
		$this->observers[$type][]=$observer;
	}
	
	/*
	*
	* @return void
	* @access public
	*/
	public function notifyObserver($type) {
		if(isset($this->observers[$type])){
			foreach($this->observers[$type] as $observer ){
				$observer->update($this);
			}
		}
	}
		
	public function getCurrentDate(){
		return $this->currentDate;
	}
	
    /**
    * Set week labels' order. 
    * When it is set to false, 
    * monday will be listed as the first day.
    *
    * @access              public
    * @param               boolean
    * @return              void
    */
	public function setSundayFirst($bool=true){
		$this->sundayFirst=$bool;
	}
	   
    /**
    * print out the calendar 
    * @access              public
    * @param               string
    * @param               string
    * @param               array
    * @return              string
    */
	public function show($month=null,$year=null,$attributes=false){
		if(null==$year&&isset($_GET['year'])){
			$year = $_GET['year'];
		}else if(null==$year){
			$year =  date_i18n('Y'); // date("Y",time());	
		}			
		
		if(null==$month&&isset($_GET['month'])){
			$month = $_GET['month'];
		}else if(null==$month){
			$month =  date_i18n("m", $this->current_timestamp) ;//date("m",time());
		}					
		
		$this->currentYear=$year;
		$this->currentMonth=$month;
		$this->daysInMonth=$this->_daysInMonth($month,$year);

       $sd =  "{$year}-{$month}-01 00:00:00"; //start at begin of this moth
       $ed = "{$year}-{$month}-{$this->daysInMonth} 23:59:59"; //end at begin of this moth
        
        $events = $this->get_events($sd,$ed);
        $events = $this->setUpEventsData($events);
		$content='<div class="evcalendar">'.
						'<div class="box box-header">'.
						$this->_createNavi().
						'</div>'.
						'<div class="box-content">'.
								'<ul class="label">'.$this->_createLabels().'</ul>';	
								$content.='<div class="clear"></div>';		
								$content.='<ul class="dates">';		
								for($i=0;$i<$this->_weeksInMonth($month,$year);$i++){
									for($j=1;$j<=7;$j++){
										$content.=$this->_showDay($i*7+$j,$events);
									}
								}
								$content.='</ul>';
								$content.='<div class="clear"></div>';		
			$content.='</div>';		
		$content.='</div>';
		return $content;	
	}
	
    /********************* PRIVATE **********************/  
    /**
    * create the li element for ul
    * @access              private
    * @param               string
    * @param               array
    * @return              string
    */
	private function _showDay($cellNumber,$events=array()){ 
		if($this->currentDay==0){
			//1 (for Monday) through 7 (for Sunday)
			$firstDayOfTheWeek = date_i18n('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
			if($this->sundayFirst){
				if($firstDayOfTheWeek==7){
					$firstDayOfTheWeek=1;
				}else{
					$firstDayOfTheWeek++;
				}
			}			
			if(intval($cellNumber) == intval($firstDayOfTheWeek)){
				$this->currentDay=1;
			}
		}
        
        $has_events=  false;
		
	    if(($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth)){
	    	$this->currentDate = date_i18n('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
            
            // for events 
            $event_content ='';
            if(isset($events[$this->currentDate])  && !empty($events[$this->currentDate])){
                   if(is_array($events[$this->currentDate])){
                        $event_content = join(' ',$events[$this->currentDate]);
                   }else{
                        $event_content = $events[$this->currentDate];
                   }
                   $has_events = true;
            }
            
            
			$cellContent = $this->_createCellContent($event_content);
            
			$this->currentDay++;	
		}else{
			$this->currentDate =null;
			$cellContent=null;
		}
        
        $html_class = array('day');
        $html_class[]= ($cellNumber%7==1?'start' : ($cellNumber%7==0?'end':'mid')) ;
        
        if($this->currentDate== $this->today_date){
              $html_class[]='today';
        }
        
        if($has_events){
            $html_class[] = 'has_events'; 
        }
			
		
		return '<li id="li-'.$this->currentDate.'" class="'.join(' ',$html_class).
				($cellContent==null?'mask':'').($this->currentDate!='' ? '' : ' no-day').'"><div class="in-d">'.$cellContent.'</div></li>';
	}
	
	/**
    * create navigation 
    *
    * @access              private
    * @return              string
    */
	private function _createNavi(){
		$nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
		$nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
		
		$preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
		$preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
        
		return 
			'<div class="header">'.
				'<a class="prev e-action btn color"  data="'.'month='.sprintf('%02d',$preMonth).'&year='.$preYear.'" href="#"><i class="icon-angle-left"></i> '.date_i18n('F',strtotime("{$this->currentYear}-{$this->currentMonth}-1 -1 month") ).'</a>'.
					'<span class="title">'.date_i18n('F Y',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
				'<a class="next e-action btn color"  data="'.'month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'" href="#">'.date_i18n('F',strtotime( "{$this->currentYear}-{$this->currentMonth}-1 +1 month") ).' <i class="icon-angle-right"></i></a>'.
			'</div>';
	}
		
	/**
    * create calendar week labels
    * @access              private
    * @return              string
    */
	private function _createLabels(){		
		if($this->sundayFirst){
			$temp = $this->dayLabels[0];
			for($i=1;$i<sizeof($this->dayLabels);$i++){
				$tmp = $this->dayLabels[$i];
				$this->dayLabels[$i]=$temp;
				$temp=$tmp;
			}
			$this->dayLabels[0]=$temp;
		}
		
				
		$content='';
		foreach($this->dayLabels as $index=>$label){
			$content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
		}
		
		return $content;
	}
	
    /**
    * create content for li element
    *
    * @access              private
    * @param               string
    * @return              string
    */	
	private function _createCellContent($more_content= ''){
		$this->cellContent='';	
        	
		$this->cellContent= '<span class="day-num">'.$this->currentDay.'</span>'.$more_content;
		
		//observer
		$this->notifyObserver('showCell');
		
		return $this->cellContent;
	}
	
    /**
    * calculate number of weeks in a particular month
    *
    * @access              private
    * @param               number
    * @param               number
    * @return              number
    */
	private function _weeksInMonth($month=null,$year=null){
		if(null==($year))
			$year =  date_i18n("Y",$this->current_timestamp);	

		if(null==($month))
			$month = date_i18n("m",$this->current_timestamp);
						
		// find number of weeks in this month
		$daysInMonths = $this->_daysInMonth($month,$year);
		
		$numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
		$monthEndingDay= date_i18n('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

		$monthStartDay = date_i18n('N',strtotime($year.'-'.$month.'-01'));
		$monthEndingDay==6?$monthEndingDay=0:'';
		$monthStartDay==6 ?$monthStartDay=0:'';
		
		if($monthEndingDay<$monthStartDay){
			$numOfweeks++;
		}

        if($monthStartDay==0 && $monthEndingDay>0){
            $numOfweeks++;
        }

		return $numOfweeks;
		
	}

	/**
    * calculate number of days in a particular month
    *
    * @access              private
    * @param               number
    * @param               number
    * @return              number
    */
	private function _daysInMonth($month=null,$year=null){
		if(null==($year))
			$year =  date_i18n("Y",$this->current_timestamp);	

		if(null==($month))
			$month = date_i18n("m",$this->current_timestamp);


		return date_i18n('t',strtotime($year.'-'.$month.'-01'));
	}
    
    
    function setUpEventsData($list_events){
        $moth_events=  array();
        foreach($list_events as $event){
            $start = get_post_meta($event->ID,'_st_event_start_date',true);
            if($start!=''){
                $start = strtotime($start);
                 $key =  date_i18n('Y-m-d',$start);
                 $title = apply_filters('the_title',$event->post_title);
                 $link =  get_permalink($event->ID);
                 
                 // <span class="e-time">'.date_i18n('H:i',$start).'</span>
                 $html = '<div class="event">';
                 $html.='<a href="'.$link.'" ><span clas="e-title">'.$title.'</span></a>';
                 $html .='</div>';
                 
                 $moth_events[$key][] =  $html;
            }
            
        }
        return $moth_events;
    }
    
    
    
    /**
    * Get events BETWEEN datetime
    *
    * @param                 mysql date titme  Y-m-d H:i:s 
    * @param                 mysql date titme  Y-m-d H:i:s 
    */
    function get_events($from='',$to=''){
         $args = array( 'posts_per_page' => '-1' );
        $args['meta_key']	 =  '_st_event_start_date';
        
        $args['meta_query'] = array(
    		array(
    			'key' => '_st_event_start_date',
                'value'=>array($from,$to),
                'compare'=>'BETWEEN',
    			'type' => 'DATETIME',
    		)
    	);
        
        $args['orderby'] = 'meta_value';
        $args['order'] = 'ASC';
        $args['post_type'] = 'event';
        
        // added in ver 1.3
        if(st_is_wpml()){
              $args['sippress_filters'] = true;
              $args['language'] = get_bloginfo('language');
         }

     $new_query = new WP_Query($args);
     $myposts =  $new_query->posts;
      wp_reset_query();
     return $myposts;
    }
	
}
