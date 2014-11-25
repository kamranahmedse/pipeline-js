<?php 


Validator::extend('not_already_shortened', function ( $attribute, $value, $parameters )
{
    if ( !preg_match("#^" . Config::get('raspis.url') . ".*$#", $value) ) {
        return true;
    }

    return false;
});