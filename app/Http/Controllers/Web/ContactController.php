<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $categories = Category::WHERE('parent_id',0)->get();
        return view('web.contacts.index',compact('categories'));
    }
}
