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
    public function deleteUploaddata($id){

        $data = Uploadmaster::find($id);

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'data not found!']);
        }

        $data->delete();

        return response()->json(['success' => true, 'message' => 'data deleted successfully!']);


    }

    public function editManualData(Request $request){

        $data = Uploadmaster::find($request->uploadId);
        $data->category = $request->category;
        $data->subcategory = $request->subcategory;
        $data->priority = $request->priority;
        $data->letter_date =$request->letter_date;
        $data->letter_number=$request->letter_number;
        $data->subject_of_letter=$request->subject_of_letter;
        $data->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully!']);


    }

    public function updateManualData($id){
        
        $uploaddata = Uploadmaster::find($id);
        //dd($uploaddata);
        if (!$uploaddata) {
            return response()->json(['success' => false, 'message' => 'User not found!']);
        }

        return response()->json(['success' => true, 'upload' => $uploaddata]);

    }
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

        $userData = User::get();

    	return view('user_view',compact('userData'));
    }
    public function login_activity(){

        $loginActivities = User::where('id', Auth::id())->latest()->get();
        //dd($loginActivities);
    	return view('login_activity',compact('loginActivities'));
    }
    public function report_show(){


        /*$category = Category::get();
        dd($category);*/
        return view('report');
    }
}
