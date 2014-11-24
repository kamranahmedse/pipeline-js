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
		return $this->hasMany('Bookmark')->whereNotNull('bookmarks.user_id');
	}

	public function userExists($userId)
	{
		return !!$this->find( $userId );
	}

    public function getBookmarks( $userId, $savedOnes = false )
    {
        $query = $this->find( $userId )
                      ->bookmarks();

        if ( $savedOnes ) {
            $query->whereNull('description');
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }
}
