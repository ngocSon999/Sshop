<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function contactList(){
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index',compact('contacts'));
    }
    public function index(){
        $categories = Category::WHERE('parent_id',0)->get();
        return view('web.contacts.index',compact('categories'));
    }
    public function addContact(Request $request){
        $data = $request->all();
        Contact::create($data);
        return response()->json([],200);
    }

    public function deleteContact(Request $request){
        $id = $request->contact_id;
        Contact::where('id',$id)->delete();
        return response()->json([],200);
    }
}
