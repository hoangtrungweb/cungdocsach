<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {   
       

        $listItem = Book::orderBy('created_at', 'DESC')->paginate(ITEM_PER_PAGE);
        //$listItem = Book::orderBy('created_at', 'DESC')->take(5)->get()->toArray();

        return view('home.home',compact('listItem'));
    }

}
