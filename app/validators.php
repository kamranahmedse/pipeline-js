<?php 


Validator::extend('not_already_shortened', function ( $attribute, $value, $parameters )
{
    if ( !preg_match("#^" . Config::get('raspis.url') . ".*$#", $value) ) {
        return true;
    }

    return false;
});

Validator::extend('is_old_password', function ( $attribute, $value, $parameters ) {
    return Hash::check($value, Auth::user()->getAuthPassword());
});