<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Uploadmaster;
use App\Models\Message;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    


    public function userInsert(Request $request){

        $request->validate([
            'email' => 'required|string|max:255',
            'displayname' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone_number' => 'required',
            'zone' => 'required',
            'role_id'=>'required',
        ]);
        // Save file details to database
        $user = User::create([
            'email' => $request->email,
            'name' => $request->displayname,
            'designation' => $request->designation,
            'phone_number' => $request->phone_number,
            'zone' => $request->zone,
            'role' => $request->role_id,
            'password' => Hash::make('123456'),
        ]);
        //dd($user);
        return redirect()->route('users.show')->with('success', 'User Inserted Successfully.');

    }
    public function updateUserData($id){

        $userdata = User::find($id);
        //dd($uploaddata);
        if (!$userdata) {
            return response()->json(['success' => false, 'message' => 'User not found!']);
        }

        return response()->json(['success' => true, 'user' => $userdata]);


    }
    public function deleteUserddata($id){

        $data = User::find($id);

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'data not found!']);
        }

        $data->delete();
        return response()->json(['success' => true, 'message' => 'user deleted successfully!']);


    }
    public function editUserData(Request $request){

        $data = User::find($request->userId);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->designation = $request->designation;
        $data->zone = $request->zone;
        $data->role = $request->role;
        $data->phone_number = $request->phone;
        $data->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully!']);
    }
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

    return response()->json(['success' => true, 'message' => 'data updated successfully!']);


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


        // Validate the form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);
        if(Auth::attempt([
          'email' => $request->email,
          'password' => $request->password,
        ], $request->remember)){

         // Store login activity
        LoginActivity::create([
            'user_id' => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'login_time' => now(),
        ]);

        return view('home');
    }
    echo "login failed"; die(); 
    //dd($request->all());

    }
    public function messageInsert(Request $request){

        $message = Message::create([
            'message' => $request->message,
        ]);
        return redirect()->back()->with('success', 'Notice added successfully.');
    }
    public function scroll_message(){
    return view('scroll_message');
    }
    public function users_view(){

    $userData = User::get();

    return view('user_view',compact('userData'));
    }
    public function login_activity(){

    //$loginActivities = User::where('id', Auth::id())->latest()->get();

    $loginActivities = LoginActivity::with('user')->orderBy('login_time', 'desc')->get();
       // return view('login_activity', compact('activities'));
    //dd($loginActivities);
    return view('login_activity',compact('loginActivities'));
    }
    public function report_show(){


    /*$category = Category::get();
    dd($category);*/
    return view('report');
    }



}
