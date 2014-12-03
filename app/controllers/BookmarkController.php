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
        $bookmarks = $this->user->getBookmarks( $this->userInfo->id, true);

        return View::make('backend.bookmarks', compact('bookmarks'))
                    ->nest('savedBookmarks', 'backend.partials.savedurl-list', compact('bookmarks'));
    }

    public function search()
    {
        $term = Input::get('term', '');
        $bookmarks = $this->user->getBookmarks( $this->userInfo->id, true, array('term' => $term) );

        return View::make('backend.bookmarks', compact('bookmarks'))
                    ->nest('savedBookmarks', 'backend.partials.savedurl-list', compact('bookmarks'));
    }

    public function fetch()
    {
        $id = Input::get('id');
        $bookmark = $this->bookmark->fetch( $id, $this->userInfo->id );

        return Response::json($bookmark);
    }

    public function handleShortcode( $shortCode )
    {
        $bookmark = $this->bookmark->getLongUrl( $shortCode );

        if ( $bookmark ) {

            $bookmark->clicks = ++$bookmark->clicks;
            $bookmark->save();

            return Redirect::to( $bookmark->url );
        } else {
            return App::abort( 404 );
        }
    }

    public function saveBookmark()
    {
        $validator = Validator::make( Input::all(), $this->bookmark->getSaveRules() );

        if ( $validator->passes() ) {
            
            $userId = isset( $this->userInfo->id ) ? $this->userInfo->id : null;

            $saved = $this->bookmark->saveBookmark( Input::all(), $userId );

            $message = $saved ? array('success' => 'Bookmark saved successfully.') : array('error' => 'Unable to save your bookmark. Please try again!');

            if ( Request::ajax() ) {
                Session::flash('message', 'URL successfully saved.');
                return Response::json( $message );
            } else {
                return Redirect::back()->withMessage('URL successfully saved.');
            }

        } else {
            if ( Request::ajax() ) {
                return Response::json( $validator->messages() );
            } else {
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }   
    }

    public function shorten()
    {
        $validator = Validator::make(Input::all(), $this->bookmark->getShortValRules(), $this->bookmark->getShortValMessages());

        if ( $validator->passes() ) {
            
            $userId = isset( $this->userInfo->id ) ? $this->userInfo->id : null;

            $code = $this->bookmark->shorten( Input::get('long_url'), $userId, Input::get('do_save', true) );

            // Put the shortened URL in place of long_url
            // ...so that it may populate in the long URL field
            Input::replace(array( 'long_url' => Config::get('raspis.url') . $code ));

            if ( Request::ajax() ) {
                return Response::json(array('short_url' => Config::get('raspis.url') . $code));
            } else {
                return Redirect::back()->withInput()->withMessage('URL successfully shortened.');
            }

        } else {
            if ( Request::ajax() ) {
                return Response::json( $validator->messages() );
            } else {
                return Redirect::back()->withInput()->withErrors($validator);
            }
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