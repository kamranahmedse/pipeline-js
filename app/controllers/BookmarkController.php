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

    public function index()
    {
        return View::make('backend.bookmarks');
    }

    public function shorten()
    {
        $validator = Validator::make(Input::all(), $this->bookmark->getShortValRules(), $this->bookmark->getShortValMessages());

        if ( $validator->passes() ) {
            
            $userId = isset( $this->userInfo->id ) ? $this->userInfo->id : null;

            $code = $this->bookmark->shorten( Input::get('long_url'), $userId );

            // Put the shortened URL in place of long_url
            // ...so that it may populate in the long URL field
            Input::replace(array( 'long_url' => Config::get('raspis.url') . $code ));

            return Redirect::back()->withInput()->withMessage('URL successfully shortened.');

        } else {
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    public function delete()
    {
        $urlId = Input::get('id');

        if ( $urlId ) {

            $result = $this->bookmark->deleteBookmark( $urlId, $this->userInfo->id );

            if ( $result ) {
                return Redirect::back()->withMessage('URL successfully removed!');
            } else {
                return Redirect::back()->withMessage('Error! Problem occured while deleting your URL.');
            }
        }

        return App::abort(404);
    }
}