<?php 

/**
* BookmarkController that will handle all the bookmark related actions
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

    /**
     * Bookmarks page that shows a list of bookmarks that user has saved
     */ 
    public function index()
    {
        $bookmarks = $this->user->getBookmarks( $this->userInfo->id, true);

        return View::make('backend.bookmarks', compact('bookmarks'))
                    ->nest('savedBookmarks', 'backend.partials.savedurl-list', compact('bookmarks'));
    }

    /**
     * Search page - Searches for the specific term and shows the records to the user 
     */ 
    public function search()
    {
        $term = Input::get('term', '');
        $bookmarks = $this->user->getBookmarks( $this->userInfo->id, true, array('term' => $term) );

        return View::make('backend.bookmarks', compact('bookmarks'))
                    ->nest('savedBookmarks', 'backend.partials.savedurl-list', compact('bookmarks'));
    }

    /**
     * Fetches a specific saved bookmark
     * 
     * @return string JSON for the bookmark
     */ 
    public function fetch()
    {
        $id = Input::get('id');
        $bookmark = $this->bookmark->fetch( $id, $this->userInfo->id );

        return Response::json($bookmark);
    }

    /**
     * Handles the shortcode and redirects the user to the actual associated URL
     * 
     * @param string $shortCode Short code i.e. of the shortened URL
     * @return HTTP-Redirect 404 HTTP Redirect if the URL is not found or 302 redirect to the actual associated URL
     */ 
    public function handleShortcode( $shortCode )
    {
        // Find the bookmark against the passed shortcode
        $bookmark = $this->bookmark->getLongUrl( $shortCode );

        if ( $bookmark ) {

            $bookmark->clicks = ++$bookmark->clicks;
            $bookmark->save();

            return Redirect::to( $bookmark->url, 302 );
        } else {
            return App::abort( 404 );
        }
    }

    /**
     * Saves/Updates the bookmark to database.
     * @return HTTP-Redirect HTTP Redirect to the initiator with success/failure messages
     */ 
    public function saveBookmark()
    {
        $validator = Validator::make( Input::all(), $this->bookmark->getSaveRules() );

        // Validation passed
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
            
            // Validation failed

            if ( Request::ajax() ) {
                return Response::json( $validator->messages() );
            } else {
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }   
    }

    /**
     * Shortens the passed URL and redirects back with the short URL if shortening was succesful and with errors otherwise
     */ 
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
                return Redirect::back()->withInput()->with(array('message' => 'URL successfully shortened.', 'status' => 'URL_SHORTENED'));
            }

        } else {
            if ( Request::ajax() ) {
                return Response::json( $validator->messages() );
            } else {
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }
    }

    /**
     * Deletes the saved bookmark or the shortened URL found against the passed ID
     */     
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