<?php 

class Bookmark extends Eloquent
{
	protected $table = 'bookmarks';
    protected $shuffleData = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    protected $shortenRules = array(
        'long_url' => 'required|url'
    );

    protected $shortenMessages = array(
        'url' => 'Invalid URL provided in :attribute'
    );

    public function user()
    {
        $this->belongsTo('User');
    }

    public function getShortValRules()
    {
        return $this->shortenRules;
    }

    public function getShortValMessages()
    {
        return $this->shortenMessages;
    }

    public function codeExists( $shortCode )
    {
        return $this->where('shortened_code', '=', $shortCode)->count() !== 0;
    }

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

    public function generateShortCode()
    {
        $shortCode = '';

        do {
            
            $shuffled = str_shuffle( $this->shuffleData );
            $shortCode = substr($shuffled, 0, 6);

        } while ( $this->codeExists( $shortCode ) );

        return $shortCode;
    }

    public function shorten( $longUrl, $userId = false )
    {        
        $shortCode = $this->generateShortCode();

        $this->url = $longUrl;
        $this->shortened_code = $shortCode;

        if ( $userId ) {
            $this->user_id = $userId;  
        } 

        $bookmark = $this->save();

        if ( $bookmark ) {
            return $shortCode;
        }

        return false;
    }
}