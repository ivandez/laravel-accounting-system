<?php

use Carbon\Carbon;

if( !function_exists('formatDatePls')){

    function formatDatePls($date)
    {
        return Carbon::parse($date)->format('d-m-Y');
    }

}
