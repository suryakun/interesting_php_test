<?php        
class Restaurant {
    public $weekdays = [
        'Sun',
        'Mon',
        'Tue',
        'Wed',
        'Thu',
        'Fri',
        'Sat',
    ];
    
    public $opening_hours = array();

    public function __construct($opening_hours = array()) {
        if(count($opening_hours) > 0){
          foreach($opening_hours as $op){
              array_push($this->opening_hours, $op->to_string());
          }
        }
    }
    
    public function get_opening_hours() {
        $all = '';
        if(count($this->opening_hours) == 0) return '';
        $result = array();
        
        $unique = array_unique($this->opening_hours);
        foreach($unique as $key){
          $indexs = array_filter($this->opening_hours, function($item) use($key){
            return $item == $key;
          });
          array_push($result, $indexs);
        }
        var_dump($result);die();
        for($i=0;$i<count($this->opening_hours);$i++){
          $all = $all . $this->weekdays[$i] .": " . $this->opening_hours[$i]. ", ";   
        }
        return substr($all, 0, strlen($all)-2);
    }
}

class OpeningHour {

    public function __construct($opening_hour, $closing_hour) {
        $this->opening_hour = $opening_hour;
        $this->closing_hour = $closing_hour;
    }

    public function to_string() {
        return $this->opening_hour . '-' . $this->closing_hour;
    }
}
?>
