<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static $rules = array(
	    'username'=>'required|alpha_num|unique:users',
	    'email'=>'required|email|unique:users',
	    'password'=>'required|alpha_num|between:6,12|confirmed',
	    'password_confirmation'=>'required|alpha_num|between:6,12'
    );

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function bookmarks()
	{
		$this->hasMany('Bookmark')->whereNotNull('bookmarks.user_id');
	}

	public function userExists($userId)
	{
		return !!$this->find( $userId );
	}

    public function getUserBookmarks( $userId, $shortened = false )
    {
    	$query = $this->with('bookmarks');

    	if ( !$shortened ) {
    		$query->where('description', '=', '');
    	} else {
    		$query->where('description', '!=', '');
    	}

    	return $query->where('id', '=', $userId)->get();
    }
}
