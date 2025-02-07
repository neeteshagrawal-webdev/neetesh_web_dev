<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Uploadmaster;
class UserController extends Controller
{
    //



    public function upload_data(){

        $category = Category::get();
        $category = Subcategory::get();
        $uploaddata = Uploadmaster::get();
        //dd($category);
        return view('upload',compact('uploaddata'));
    }
    public function uploadManual(Request $request){




        // Validate input
        $request->validate([
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
            'priority' => 'required|string|max:255',
            'letter_date' => 'required',
            'letter_number' => 'required',
            'subject_of_letter'=>'required',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Restrict file types and size
        ]);


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        }

         // Save file details to database
            Uploadmaster::create([
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'priority' => $request->priority,
                'letter_date' => $request->letter_date,
                'letter_number' => $request->letter_number,
                'subject_of_letter' => $request->subject_of_letter,
                'upload_file' => $filePath,
          
            ]);
            return redirect()->route('uploads.show')->with('success', 'File uploaded successfully.');
        return back()->with('success', 'File uploaded successfully.');
      

    }

    public function home(){

        return view('home');
    }

	public function login(Request $request)
    {

        //dd($request->all());
        // Validate the form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            ], $request->remember)){
            return view('home');
        }
         echo "login failed"; die(); 
        //dd($request->all());
        
    }
 
    public function scroll_message(){
    	return view('scroll_message');
    }
    public function users_view(){
    	return view('user_view');
    }
    public function login_activity(){

    	return view('login_activity');
    }
    public function report_show(){


        $category = Category::get();
        dd($category);
        return view('report');
    }
}
