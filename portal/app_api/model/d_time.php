<?php
    class DTime {
        public $years;
        public $months;
        public $days;
        public $hours;
        public $minutes;
        public $seconds;
        public $full;

        public function __construct() {
            $dateTime = new DateTime();
            $this->years = $dateTime->format('Y');;
            $this->months = $dateTime->format('m');;
            $this->days = $dateTime->format('d');;
            $this->hours = $dateTime->format('H');;
            $this->minutes = $dateTime->format('i');;
            $this->seconds = $dateTime->format('s');;
            $this->full = $dateTime->format('Y-m-d H:i:s');
        }
    }
?>