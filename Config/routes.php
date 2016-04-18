<?php

Route::match(array('GET', 'POST'), 'languara/pull',
    array('uses' => 'Languara\Laravel\Controllers\LanguaraController@pull'));
Route::match(array('GET', 'POST'), 'languara/push',
    array('uses' => 'Languara\Laravel\Controllers\LanguaraController@push'));
