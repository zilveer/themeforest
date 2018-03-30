<?php


class bebelEventsPayPal extends bebelPayPal
{
    
    /**
     * contains the current event's details
     *
     * @var object 
     */
    protected $event_object;
    
    /**
     * Contains all the validated data we get from the user, such as
     * first and last name, email
     *
     * @var array 
     */
    protected $validated_data;
    
    
    /**
     * Method to gather all the required information for the event payment
     */
    public function gatherData()
    {
        //get object
        //$this->event_object->the_post();
        
        
        
        // check event date and registration period
        $startdate  = strtotime(BebelUtils::getCustomMeta('event_registration_start', '', get_the_ID()));
        $enddate    = strtotime(BebelUtils::getCustomMeta('event_registration_end', '', get_the_ID()));
        $eventdate  = strtotime(BebelUtils::getCustomMeta('event_date', '', get_the_ID()));

        if($startdate >= time() || $enddate <= time() && $eventdate <= time()) 
        {
            throw new BebelException("Impossible. You cannot book an event that is already past.");
        }
        
        // get price
        $eventprice = BebelUtils::getCustomMeta('event_price', '', get_the_ID());
        $eventprice = number_format($eventprice, 2, '.', '');
        
        // clean up currency
        $eventcurrency = strtolower(BebelUtils::getCustomMeta('event_currency', '', get_the_ID()));
        $replace = array('.jpg', '.png', '.gif', '.jpeg');
        $eventcurrency = str_replace($replace, '', $eventcurrency);
        $eventcurrency = strtoupper(($eventcurrency));
        
        // build up array
        
        $paypal_array = array(
            'EMAIL' => $this->validated_data['email'],
            'REQCONFIRMSHIPPING' => '0',
            'NOSHIPPING' => '1',
            'MAXAMT' => $eventprice,
            'AMT' => $eventprice,
            'ITEMAMT' => $eventprice,
            'PAYMENTREQUEST_0_AMT' => $eventprice,
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale'
            
        );
        
        // set array
        $this->setFromArray($paypal_array);
        
        // set currency
        $this->setCurrency($eventcurrency);
        
    }
    
    
    public function setEvent($object)
    {
        $this->event_object = $object;
    }
    
    
    public function setValidatedData($data)
    {
       $this->validated_data = $data; 
    }
}