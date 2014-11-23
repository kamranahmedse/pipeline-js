<?php 

class Bookmark extends Eloquent
{
	protected $table = 'bookmarks';
    protected $shuffleData = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public static $shortenRules = array(
        'long_url' => 'required|url'
    );

    public function user()
    {
        $this->belongsTo('User');
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
            
            str_shuffle( $this->shuffleData );
            $shortCode = substr($shuffleData, 0, 6);

        } while ( $this->codeExists() );

        return $shortCode;
    }

    public function shorten( $longUrl )
    {        
        $this->url = $longUrl;
        $this->shortened_code = $this->generateShortCode();

        $bookmark = $this->save();

        if ( $bookmark ) {
            return $bookmark->shortened_code;
        }

        return false;
    }
}