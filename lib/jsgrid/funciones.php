<?php
function is_date($str) {
        $stamp = strtotime($str);
        if(strlen($str)<2) return FALSE;
        if (!is_numeric($stamp)) {
            return FALSE;
        }
        $month = date('m', $stamp);
        $day = date('d', $stamp);
        $year = date('Y', $stamp);
        
        if (checkdate($month, $day, $year)) {
            return TRUE;
        }

        return FALSE;
    }
    function es_numero($var,$campo){
        return is_numeric($var);
    }
?>
