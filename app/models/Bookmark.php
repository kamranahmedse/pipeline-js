<?php 

/**
 * Bookmark model to handle all the bookmarks related operations
 */ 
class Bookmark extends Eloquent
{
	protected $table = 'bookmarks';

    /**
     * String from which the shortener code will be generated
     */ 
    protected $shuffleData = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Shortener form submission rules
     */ 
    protected $shortenRules = array(
        'long_url' => 'required|url|not_already_shortened'
    );

    /**
     * Save bookmark rules
     */ 
    protected $saveRules = array(
        'title' => 'required',
        'long_url' => 'required|url|not_already_shortened'
    );

    /**
     * Validation messages for the shortener validation
     */ 
    protected $shortenMessages = array(
        'url' => 'Invalid URL provided in :attribute',
        'not_already_shortened' => 'Oh snap! The URL you provided is already shortened.'
    );

    /**
     * Relationship to user : Bookmark belongs to user
     */ 
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * To get the shorten URL validation rules
     * 
     * @return array Array consisting of the Shorten URL validation rules
     */  
    public function getShortValRules()
    {
        return $this->shortenRules;
    }

    /**
     * To get the save bookmark validation rules
     * 
     * @return array Array consisting of the save bookmark validation rules
     */  
    public function getSaveRules()
    {
        return $this->saveRules;
    }

    /**
     * To get the shortener validation messages
     * 
     * @return array Array consisting of the shorten URL form validation messages
     */ 
    public function getShortValMessages()
    {
        return $this->shortenMessages;
    }

    /**
     * Checks if the short code exists or not
     * 
     * @param string $shortCode Shortcode that is to be checked for existence in database
     * @return boolean true if the shortcode is found and false otherwise
     */ 
    public function codeExists( $shortCode )
    {
        return $this->where('shortened_code', '=', $shortCode)->count() !== 0;
    }

    /**
     * Deletes the user's required bookmark
     * 
     * @param int $id ID of the URL that is to be deleted
     * @param int $userId User id whose bookmark it is
     * @return boolean True if the bookmark was successfuly deleted and false otherwise
     */ 
    public function deleteBookmark( $id, $userId )
    {
        $toDelete = $this->find( $id );

        if ( $toDelete && $toDelete->user_id == $userId ) {
            
            if ( $toDelete->delete() ) {
                return true;
            }
        }
     
        return false;
    }

    /**
     * Generates a unique shortcode
     * @return string 6 characters unique shortcode
     */ 
    public function generateShortCode()
    {
        $shortCode = '';

        // Keep generating a shortcode unless a unique one is found
        do {
            
            $shuffled = str_shuffle( $this->shuffleData );
            $shortCode = substr($shuffled, 0, 6);

        } while ( $this->codeExists( $shortCode ) );

        return $shortCode;
    }

    /**
     * Gets the long URL associated with the passed shortcode
     * 
     * @param string $shortCode Shortcode whose associated long URL is required
     * @return object The Bookmark associated with the short code or "falsy" value otherwise
     */ 
    public function getLongUrl( $shortCode )
    {
        return $this->where('shortened_code', $shortCode)->first();
    }

    /**
     * If this URL was already shortened by some anonymous user, returns her shortcode and false otherwise.
     * 
     * @param string $url URL whose shortcode is to be found
     * @return string|false shortcode if the shortcode is found and false otherwise
     */ 
    public function findPotentialShortcode( $url )
    {
        $bookmark = $this->where('url', '=', $url)
                          ->whereNull('user_id')
                          ->select('shortened_code')
                          ->first();

        if ( $bookmark ) {
            return $bookmark->shortened_code;
        }

        return false;
    }

    /**
     * Saves the bookmark against the passed user's id
     * 
     * @param array $bookmark Detail of the bookmark which is to be saved i.e. array consisting of id (if the url is to be updated), title, long_url, shortened_code (optional)
     * @param int $userId ID of the user who is saving this bookmark
     * @param boolean true if the bookmark is succesfuly saved and false otherwise
     */ 
    public function saveBookmark( $bookmark, $userId)
    {
        $toSave = $this;

        if ( isset($bookmark['id']) && !empty($bookmark['id']) ) {
            $toSave = $this->find($bookmark['id']);
        }

        $toSave->description = $bookmark['title'];
        $toSave->url = $bookmark['long_url'];
        $toSave->shortened_code = $bookmark['shortened_code'];
        $toSave->user_id = $userId;

        $result = $toSave->save();

        return $result ? true : false;
    }

    /**
     * Gets the bookmark against the specific bookmark id and the user id
     * 
     * @param integer $id ID of the bookmark
     * @param integer $userId ID of the user whose bookmark it is
     * @return object|boolean Bookmark object if it is found and false otherwise
     */ 
    public function fetch( $id, $userId )
    {
        $bookmark = $this->find( $id );
        
        if ( $bookmark && ( $bookmark->user_id == $userId ) ) {
            return $bookmark;
        }

        return false;
    }

    /**
     * Shortens the passed URL
     * 
     * @param string $longURL Long URL that is to be shortened
     * @param integer $userId Optional ID of the user who is shortening this URL
     * @param boolean $doSave True if the bookmark is to be saved after shortening false otherwise
     * @return boolean|string Shortcode string if the shortening was successful and false otherwise
     */ 
    public function shorten( $longUrl, $userId = false, $doSave )
    {
        // If the user ID is not provided
        // ..we don't need a new entry if the URL provided was
        // ..already shortened by someone else i.e. someone anonymous
        if( !$userId ) {
            
            $shortCode = $this->findPotentialShortcode( $longUrl );
            
            if ( $shortCode ) {
                return $shortCode;
            }
        }

        $shortCode = $this->generateShortCode();

        if( !$doSave ) {
            return $shortCode;
        }

        $this->url = $longUrl;
        $this->shortened_code = $shortCode;
        if ( $userId ) {
            $this->user_id = $userId;  
        }
        $bookmark = $this->save();

        return $bookmark ? $shortCode  : false;
    }
}