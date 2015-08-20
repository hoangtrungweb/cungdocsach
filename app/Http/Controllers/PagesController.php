<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function aboutme(){
		
		$name = 'My name is Hieu';
		$age = '24';
		$data = [];
		$data['name'] = $name;
		$data['age'] = $age;
		return view("pages.aboutme",$data);
	}
	public function about(){
		return view('pages.about');
	}
	public function contact(){
		return view('pages.contact');
	}
}
