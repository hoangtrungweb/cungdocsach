<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Site\BookRequest;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Query\Builder;
use App\Book_Request;
use DB;
class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    protected $_user_id = null;
    public function __construct(){
        $this->user_id = Auth::id();
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $listCategories = Category::all();
        return view('book.create',compact('listCategories'));
    }

    public function postCreate(BookRequest $request)
    {
       
        $book = new Book();
        $book -> user_id = Auth::id();
        $book -> title = $request->title;
        $book -> cate_id = $request->category;
        $book -> description = $request->description;
        $book -> detailinfo = $request->detailinfo;
        $book -> alias =  str_slug($request->title,'-'); //str_slug method sames as convertToAlias method
        // if(empty($request->alias) || $request->alias='') {
        //    //$book -> alias =  $this->convertToAlias($request->title);
        //     $book -> alias =  str_slug($request->title,'-');
        // }
        // else {
        //     $book -> alias = $request->alias;
        // }
        $book -> author = $request->author;

        $book -> status = ($request->status=="on")? 1 : 0;

        
    
        $thumbnail = "";
        if(Input::hasFile('thumbnail'))
        {
            $file = Input::file('thumbnail');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $thumbnail =  $book -> alias . time() . '.' . $extension;
        }
        if($thumbnail!="")
            $book -> thumbnail = $thumbnail;
        else   $book -> thumbnail = 'default.jpg';
        
        $book -> save();
        $affectedRows = Book::where('id', '=', $book->id )->update(array('alias' => $book -> alias.'-'.$book->id));

        if(Input::hasFile('thumbnail'))
        {
            $destinationPath = public_path() . '/uploads/products/images/';
            Input::file('thumbnail')->move($destinationPath, $thumbnail);
        }

        //\Flash::success('Thao tác thành công!');
         \Session::flash('edit_message','Thêm thành công!');

       
        return $this->getCreate();
        // return view('book.create');
    }

    public function getItemByCategory($alias){
        $itemCategory = Category::where('alias','=',$alias)->orderBy('created_at', 'DESC')->first();
        $id = $itemCategory->id;
        $total = Book::where('cate_id','=',$id)->count();
        $listItem =  Book::where('cate_id','=',$id)->orderBy('created_at', 'DESC')->paginate(ITEM_PER_PAGE);
        return view("book.list",compact('listItem','total'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($alias)
    {
        $temp = explode('-', $alias);
        $id = end($temp);
        $item = null;
        if(is_numeric($id)) {
            $item = Book::find($id);
            $nameCate = $item->category->name;
            $idCate = $item->category->id;
            $statusRequest=STATUS_DONE;
            if(Auth::check()) {
                // lỗi show trạng thái của sách
                $bookrequestItem = Book_Request::where('status','=',STATUS_ACCEPT)
                                                ->where('book_id','=',$item->id)
                                                ->get();
                if(count($bookrequestItem) > 0){
                    $statusRequest =  STATUS_ACCEPT;
                }
                else {
                     $bookrequestItem = Book_Request::where('user_id','=',$this->user_id)
                                                ->where('book_id','=',$item->id)
                                                ->orderBy('created_at', 'DESC')
                                                ->first();
                   // $bookrequestItem = Book_Request::whereRaw('user_id ='.$this->user_id.' AND book_id ='.$item->id)->orderBy('created_at', 'DESC')->first();
                    if(count($bookrequestItem) > 0){
                        $statusRequest = $bookrequestItem->status;
                    }
                }           
            }
 
        }
        return view('book.detail',compact('item','nameCate','idCate','statusRequest'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function getfind()
    {
        if (Input::has('q'))
        {
            $title = Input::get('q');
            $total = Book::whereRaw('title like "%'.$title.'%" or author like "%'.$title.'%"')->count();
            $listItem =  Book::whereRaw('title like "%'.$title.'%" or author like "%'.$title.'%"')->paginate(ITEM_PER_PAGE);
            // $total = Book::whereRaw('title like "%'.$title.'%"')->count();
            // $listItem =  Book::whereRaw('title like "%'.$title.'%"')->paginate(4);
            return view('book.find',compact('listItem','total'));
        }  
        else redirect()->route('home');

    }


    /**
     * 
    **/
    public function borrowpaydetail(){

        //Sách yêu cầu mượn
        $borrowingBooks = Book_Request::where('user_id','=',$this->user_id)->where('status','=',STATUS_WAITING)->orderBy('created_at', 'DESC')->paginate(ITEM_PER_PAGE);

        $listborrowingBooks = array();
        foreach ($borrowingBooks as $value) {
            $listborrowingBooks[] = Book::find($value->book_id);
        }

        //sách được yêu cầu mượn cần duyệt

        $berequestingBooks = DB::table('books') 
                            ->join('book_requests', 'book_requests.book_id', '=', 'books.id')
                            ->join('users', 'users.id', '=', 'book_requests.user_id')
                            ->whereRaw("book_requests.owner_id = '".$this->user_id."' AND book_requests.status= '".STATUS_WAITING."'")
                            ->orderBy('created_at', 'DESC')
                            ->select('books.*','book_requests.created_at as request_date','users.name','users.id as userid')
                            ->get();
                     


        // Sách đang được mượn
        $borrowingBooks = DB::table('books') 
                            ->join('book_requests', 'book_requests.book_id', '=', 'books.id')
                            ->join('users', 'users.id', '=', 'book_requests.owner_id')
                            ->whereRaw("book_requests.user_id = '".$this->user_id."' AND book_requests.status= '".STATUS_ACCEPT."'")
                            ->orderBy('return_at', 'DESC')
                            ->select('books.*','book_requests.borrow_at','book_requests.return_at','users.name as owner_name','users.facebook as owner_facebook')
                            ->get();

        //Sách người khác đang mượn
           $lendingBooks = DB::table('books') 
                            ->join('book_requests', 'book_requests.book_id', '=', 'books.id')
                            ->join('users', 'users.id', '=', 'book_requests.user_id')
                            ->whereRaw("book_requests.owner_id = '".$this->user_id."' AND book_requests.status= '".STATUS_ACCEPT."'")
                            ->orderBy('created_at', 'DESC')
                            ->select('books.*','book_requests.created_at as request_date','users.name','users.id as userid')
                            ->get();
                  

        return view("book.borrowpaydetail",compact('listborrowingBooks','berequestingBooks','borrowingBooks','lendingBooks'));
    }

    public function handleborrow(Request $request){
        if ($request->ajax()) {
            $user_id = $_POST['user_id'];
            $book_id =  $_POST['book_id'];

            if($_POST['status'] == 'accept'){

                // $bookrequest = Book_Request::whereRaw('user_id = "'.$user_id.'" AND status= "'.STATUS_WAITING.'" AND book_id = "'.$book_id.'"')
                //                       ->update(['status' => STATUS_ACCEPT]);
            }
            else {
                $bookrequest = Book_Request::whereRaw("user_id = '".$user_id."' AND status= '".STATUS_WAITING."' AND book_id = '".$book_id."'")
                                        ->update(['status' => STATUS_REFUSE]);
                                
            }
            //if($bookrequest) die('success');
        }
    }

    public function handleborrowload(Request $request){
        
            $user_id =  $request->user_id;
            $book_id =  $request->book_id;
            $action  =  $request->action;

            if( $action == 'accept'){

                $bookrequest = Book_Request::whereRaw('user_id = "'.$user_id.'" AND status= "'.STATUS_WAITING.'" AND book_id = "'.$book_id.'"')
                                      ->update([
                                        'status' => STATUS_ACCEPT,
                                        'borrow_at' => date('Y-m-d')
                                        ]);
                $book = Book::find($book_id)->update(['status' => LENDING]);
            }
            else if( $action == 'refuse'){
                $bookrequest = Book_Request::whereRaw("user_id = '".$user_id."' AND status= '".STATUS_WAITING."' AND book_id = '".$book_id."'")
                                        ->update(['status' => STATUS_REFUSE]);
                                
            }
            else {
                $bookrequest = Book_Request::whereRaw("user_id = '".$user_id."' AND status= '".STATUS_ACCEPT."' AND book_id = '".$book_id."'")
                                        ->update([
                                            'status' => STATUS_DONE,
                                            'return_at' => date('Y-m-d')
                                        ]);
                   $book = Book::find($book_id)->update(['status' => AVAILABLE]);
            }
            \Session::flash('edit_message','Thao tác thành công!');
            if($bookrequest) return redirect()->route('book.borrowpaydetail');;
    }

    public function bookrequest(Request $request){
        if ($request->ajax()) {
            $bookrequest = new Book_Request();
            $bookrequest->user_id = $_POST['user_id'];
            $bookrequest->book_id = $_POST['book_id'];
            $bookrequest->owner_id = $_POST['owner_id'];
            $bookrequest->status = STATUS_WAITING;
            $bookrequest->save();
            $linkFacebook = User::find($bookrequest->user_id)->facebook;
            $id = $bookrequest->id;

            if($id) die($linkFacebook);
        }

    }


    /**
     * Quản lý tủ sách của tôi
    **/
    public function mycloset(){
        $user_id = Auth::id();
        $listItem = Book::where('user_id','=',$user_id)->orderBy('created_at', 'DESC')->paginate(ITEM_PER_PAGE);
        return view('book.mycloset',compact('listItem'));
    }

     /**
     * Hiá»ƒn thá»‹ thÃ´ng tin sÃ¡ch cáº§n chá»‰nh sá»­a
    **/
    public function getedit($id){
        $item = Book::find($id);
        $listCategories = Category::all();
        $itemCategory = $item->cate_id;

        return view('book.create',compact('item','listCategories','itemCategory'));
    }
    /**
     * Cập nhật sách
    **/
    public function postedit(BookRequest $request,$id){

        $book = Book::find($id);
        $book -> user_id = Auth::id();
        $book -> title = $request->title;
        $book -> cate_id = $request->category;
        $book -> description = $request->description;
        $book -> detailinfo = $request->detailinfo;
        $book -> alias =  str_slug($request->title,'-'); //str_slug method sames as convertToAlias method
        $book -> author = $request->author;
        $book -> status = ($request->status=="on")? 1 : 0;
        $thumbnail = "";
        if(Input::hasFile('thumbnail'))
        {
            $file = Input::file('thumbnail');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $thumbnail =  $book -> alias . time() . '.' . $extension;
        }
        if($thumbnail!="")
            $book -> thumbnail = $thumbnail;
        else   $book -> thumbnail = 'default.jpg';
        
        $book -> save();
        $affectedRows = Book::where('id', '=', $book->id )->update(array('alias' => $book -> alias.'-'.$book->id));

        if(Input::hasFile('thumbnail'))
        {
            $destinationPath = public_path() . '/uploads/products/images/';
            Input::file('thumbnail')->move($destinationPath, $thumbnail);
        }

        //\Flash::success('Cáº­p nháº­t thÃ´ng tin thÃ nh cÃ´ng!');
        \Session::flash('edit_message','Cập nhật dữ liệu thành công!');

        return $this->mycloset();
    }

}
