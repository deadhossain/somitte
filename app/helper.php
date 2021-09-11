<?php

    function insertDateFormat($date, $format = 'Y-m-d')
    {
        if(empty($date)) return null;
        return date($format,strtotime($date));
    }

    function showDateFormat($date, $format = 'd-m-Y')
    {
        if(empty($date)) return '';
        return date($format,strtotime($date));
    }

?>
