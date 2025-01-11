<?php
function calculateLeaveDays($fromDate, $toDate) {

    $fromDateTime = new DateTime($fromDate);
    $toDateTime = new DateTime($toDate);
    $difference = $fromDateTime->diff($toDateTime);
    return $difference->days; 
}
?>