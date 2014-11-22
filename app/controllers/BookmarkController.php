<?php 

/**
* BookmarkController that will handle all the processing for bookmarks
*/
class BookmarkController extends BaseController
{
    
    function __construct(Bookmark $bookmark, User $user)
    {
        $this->beforeFilter('csrf', array('on'=>'post'));

        $this->bookmark = $bookmark;
        $this->user = $user;

        $this->userInfo = Auth::user();
    }

    // http://raspis.loc/bookmark?id=3434
    public function getIndex()
    {
        $id = Input::get('id');
        $bookmark = $this->bookmark->find( $id );

        if ( $bookmark ) {
            return $bookmark;
        }

        return Response::json(array(
                'STATUS' => 'FAILURE',
                'MESSAGE' => 'Unable to find bookmark'
            ), 400);
    }

    // http://raspis.loc/bookmark/all
    public function getAll()
    {
        return $this->bookmark->all();
    }

    // http://raspis.loc/bookmark/user?id=12
    public function getUser()
    {
        if ( Input::has('id') || !$this->user->userExists( Input::get('id') ) ) {
            
            $bookmarks = $this->user->getUserBookmarks( Input::get('id') );
            return Response::json( $bookmarks );

        } else {
            return Response::json(array(
                    'STATUS' => 'FAILURE',
                    'MESSAGE' => 'User ID must be provided.'
                ));
        }
    }

    public function deleteIndex()
    {
        if (Input::has('id')) {

            $isDeleted = $this->bookmark->deleteBookmark( Input::get('id'), $this->userInfo->id );
            
            if ( $isDeleted ) {
                return Response::json(array(
                    'status' => 'SUCCESS'
                ), 200);
            }

            return Response::json(array(
                'STATUS' => 'FAILURE',
                'MESSAGE' => 'Unable to delete the bookmark.'
            ), 400);

        } else {
            return Response::json(array(
                    'STATUS' => 'FAILURE',
                    'MESSAGE' => 'ID of the URL to be deleted must be provided.'
                ), 400);
        }
    }

    // http://raspis.loc/bookmark/shorten
    // Params URL => http://somelongurl.com/hardtoremember
    public function postShorten()
    {
        $validator = Validator::make( Input::all(), $this->bookmark->$shortenRules );

        if ( $validator->passes() ) {
            
            $shortBookmark = $this->bookmark->shorten( Input::get($url) );

            if ( !$shortBookmark ) {
                return Response::json(array(
                        'error' => 'Internal error! Unable to shorten URL'
                    ), 400);
            }

            return $shortBookmark;

        } else {
            return Response::json($validation->messages(), 400);
        }
    }

}