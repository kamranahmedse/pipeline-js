<?php 

/**
* Messages class containing all the messages i.e. success, failure etc
* 
* Will get back to it later during refactorization
*/
class Message
{
    /**
     * NOTE:
     * 
     * <placeholder> must remain intact as it will be replaced with whatever that is not found
     * e.g. Bookmark, User etc 
     * 
     * <Placeholder> if the first letter is to be capitalized
     * <placeholder> if all lower case letters are required
     */
    
    public const NOT_FOUND = "<placeholder> not found";


    public function getNotFoundMsg( $placeholder )
    {
        return str_replace( '<placeholder>', $placeholder, self::NOT_FOUND );
    }
        
}