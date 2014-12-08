<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


/**
 * User model to handle user related operations
 */ 
class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

    /**
     * User registration validation rules
     */ 
	public static $rules = array(
	    'username'=>'required|alpha_num|unique:users',
	    'email'=>'required|email|unique:users',
	    'password'=>'required|alpha_num|between:6,12|confirmed',
	    'password_confirmation'=>'required|alpha_num|between:6,12'
    );

    /**
     * User profile validation rules
     */ 
    public static $profileRules = array(
        'firstname' => 'required',
        'lastname' => 'required',
        'password' => 'is_old_password',
        'newpassword' => 'alpha_num|between:6,12|confirmed'
    );

    /**
     * User profile updation validation rules
     */ 
    public static $profileMessages = array(
        'is_old_password' => 'Old password is not correct.',
        'password.required' => 'Old password is required'
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

    /**
     * User relationship with bookmarks : One to many
     */ 
	public function bookmarks()
	{
		return $this->hasMany('Bookmark');
	}

    /**
     * Checks to see if the user exists or not
     * 
     * @param integer $userId ID of the user whose existence is to be checked
     * @return boolean true if there is some user against the passed id and false otherwise
     */ 
	public function userExists($userId)
	{
        // Convert the value to boolean
		return !!$this->find( $userId );
	}

    /**
     * Get's the bookmarks
     * 
     * @param integer $userId ID of the user whose bookmarks are required
     * @param boolean $savedOnes TRUE if the saved bookmarks are required and false if the shortened ones are required.
     * @param array $params Additional params for getting bookmarks. For now just `term` if there is some specific term that is to be searched
     * @return Array Array of objects consisting of first 10 bookmarks found
     */ 
    public function getBookmarks( $userId, $savedOnes = false, $params = array() )
    {
        $query = $this->find( $userId )
                      ->bookmarks();

        if ( $savedOnes ) {
            $query->whereNotNull('description');
        } else {
            $query->whereNotNull('shortened_code');
        }

        $query->orderBy('created_at', 'desc');

        if ( isset($params['term']) ) {
            $query->where('description', 'like', '%' . $params['term'] . '%');
        }
        
        return $query->paginate(10);
    }
}
