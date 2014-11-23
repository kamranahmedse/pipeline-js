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
}