<?php
class UTime {
    // public $years;
    // public $months;
    public $days;
    public $hours;
    public $minutes;
    public $seconds;
    public $full;

    public function __construct() {
        $data = @file_get_contents('/proc/uptime');
        
        $number = (int)floatval($data);

        $days = $number / (24 * 60 * 60);
        $number = $number % (24 * 60 * 60);

        $hours = $number / (60 * 60);
        $number = $number % (60 * 60);

        $minutes = $number / (60);
        $number = $number % (60);

        $number = (int)($number);
        $seconds = $number;
        

        $this->days =  (int)$days;
        $this->hours = (int)$hours;
        $this->minutes =(int)$minutes;
        $this->seconds = (int)$seconds;
        $this->full = "$this->days.$this->hours:$this->minutes:$this->seconds";
    }
}
?>