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
use App\Models\UserGroup;
use App\Models\UserSubGroup;
use App\Models\Department;
use App\Models\Permission;
use Illuminate\Support\Str;
//use App\Models\LoginActivityLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;
use App\Mail\WelcomeUserMail;
use Illuminate\Support\Facades\Password;
class UserController extends Controller
{
    

    public function showForgotPasswordForm(){


        return view('auth.forgot-password');

    }
     public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }
    public function resetPassword(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
 //dd($request->all());
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );
        //dd($status);
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    public function deleteUserGroup(){

        $data = UserGroup::find($id);

        if (!$data) {
        return response()->json(['success' => false, 'message' => 'data not found!']);
        }

        $data->delete();
        return response()->json(['success' => true, 'message' => 'user group deleted successfully!']);

    }
     public function editUsergroupData(Request $request){
        $data = UserGroup::find($request->userId);
        $data->name = $request->name;
      
        $data->save();

        return response()->json(['success' => true, 'message' => 'User Group updated successfully!']);

     }
     public function updateUserSubGroupData($id){

        $userSubgroupData = UserSubGroup::find($id);
        if (!$userSubgroupData) {
            return response()->json(['success' => false, 'message' => 'UserSubGroup not found!']);
        }
        return response()->json(['success' => true, 'subgroup' => $userSubgroupData]);

     }

     public function editUserSubgroupData(Request $request){

        $subgroup_id = $request->subgroup_id;
        //die();
        $user_group = $request->user_group;
        $subgroup_name = $request->subgroup_name;
        $data = UserSubGroup::find($subgroup_id);
        $data->name = $request->subgroup_name;
        $data->group_id = $request->user_group;
        $data->save();

        return response()->json(['success' => true, 'message' => 'User SubGroup updated successfully!']);

     }
     public function updateUserGroupData($id){

        $userdata = UserGroup::find($id);
        if (!$userdata) {
            return response()->json(['success' => false, 'message' => 'User not found!']);
        }
        return response()->json(['success' => true, 'user' => $userdata]);

    }
    public function users_group(){

        $userData = UserGroup::orderBy('id', 'DESC')->get();
        return view('user_groups',compact('userData'));

    }
    public function users_subgroup(){


        $groupData = UserGroup::orderBy('id', 'DESC')->get();
        //$subgroupData = UserSubGroup::get();
        $subgroupData = UserSubGroup::orderBy('id', 'desc')->get();
        return view('user_subgroups',compact('groupData','subgroupData'));
    }
    public function usersubgroupInsert(Request $request){
        $request->validate([
            'displayname' => 'required|string|max:255',
            'user_group' => 'required',
        ]);

        $user = UserSubGroup::create([
            'name' => $request->displayname,
            'group_id' => $request->user_group,
        ]);
        return redirect()->route('usersubgroups.show')->with('success', 'User SubGroup Inserted Successfully.');
    }
    public function usergroupInsert(Request $request){
        $request->validate([
           
            'displayname' => 'required|string|max:255',
        ]);
        
         $user = UserGroup::create([
            'name' => $request->displayname,
        ]);
         return redirect()->route('usergroups.show')->with('success', 'User Group Inserted Successfully.');

    }

    public function userInsert(Request $request){
         // Validation rules
        $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users',
        'name' => 'required|string|max:255',
        'user_group' => 'required|exists:user_groups,id',
        'sub_group' => 'required|string',
        'department' => 'required|string',
        'designation' => 'required|string',
        'phone_number' => 'required|digits:10|unique:users,phone_number',
        ]);
        $password = Str::random(8);
        //$password = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 8);

        // Create user
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'user_group' => $request->user_group,
            'subgroup' => $request->sub_group,
            'phone_number' => $request->phone_number,
            'department' => $request->department,
            'designation' => $request->designation,
            'password' => $password, // Encrypt password
            'status' => 1,
            'password_status' => 0,
            'genrate_password' => $password
        ]);
         // Send email with the password
         Mail::to($user->email)->send(new UserCreatedMail($user, $password));
        return redirect()->route('users.show')->with('success', 'User Inserted Successfully.');

    }
    public function updateUserData($id){

       // $userdata = User::find($id);
       // $userdata = User::with(['userGroup', 'sub_group'])->where('id',$id)->get();
        $userdata = User::with(['userGroup', 'sub_group'])->where('id', $id)->first();
        //dd($userdata->toArray());
        //dd($userdata);
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

    public function save_permission(Request $request){
        $user_id = $request->user_id;
        //$permissions = $request->permissions;

         $permissions = collect($request->permissions)->mapWithKeys(function ($value, $key) {
         $key = str_replace(['permissions[', ']'], '', $key);
        return [$key => $value];
        })->toArray();
      //  dd($permissions);
        
        // Update permissions in the database
       Permission::updateOrCreate(
        ['user_id' => $user_id],  // Search by user_id
        array_merge($permissions, ['updated_at' => now()])
        );
         return response()->json(['success' => true, 'message' => 'Permissions updated successfully.']);
}

    public function acceptUser($id){

        $data = User::where('id', $id)->update(['status' => 1]);
        //dd($user);
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'data not found!']);
        }
        $user = auth()->user();
        //dd($user);
        // Send welcome email
        
        try {
        Mail::to($user->email)->send(new WelcomeUserMail($user));
        } catch (Exception $e) {
        return response()->json(['error' => 'Email could not be sent: ' . $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'User accepted and welcome email sent!']);
    }
    public function editUserData(Request $request){

        $data = User::find($request->userId);
        //dd($data);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->designation = $request->designation;
        $data->department = $request->department;
        $data->subgroup = $request->sub_group;
        $data->phone_number = $request->phone;
        $data->user_group = $request->user_group;
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

        $data = UploadMaster::where('id', $request->uploadId)->delete(); // Remove old records

        foreach ($request->sub_group as $subgroup) {
        $subgroupData = UserSubGroup::where('id', $subgroup)->first();

        if ($subgroupData) {
            UploadMaster::create([
                'user_group_id' => $subgroupData->group_id, // Correct group_id from database
                'sub_group_id' => $subgroupData->id,
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'priority' => $request->priority,
                'letter_date' => $request->letter_date,
                'letter_number' => $request->letter_number,
                'subject_of_letter' => $request->subject_of_letter,
            ]);
        }
        }
         return response()->json(['success' => true, 'message' => 'data updated successfully!']);

    }

    public function editManualDataold(Request $request){

    $data = Uploadmaster::find($request->uploadId);
    $data->category = $request->category;
    $data->subcategory = $request->subcategory;
    $data->priority = $request->priority;
    $data->letter_date =$request->letter_date;
    $data->letter_number=$request->letter_number;
    $data->subject_of_letter=$request->subject_of_letter;

    $data->user_group_id=$request->user_group;
    $data->sub_group_id=$request->sub_group_id;
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
    //$uploaddata = Uploadmaster::get();
    $groupData = UserGroup::get();
    $subgroupData = UserSubGroup::orderBy('id', 'desc')->get();

    $userId = auth()->id(); // Get logged-in user ID
    $permissions = Permission::where('user_id', $userId)->first();
    //dd($permissions);
    $uploaddata = UploadMaster::where('user_group_id', auth()->user()->user_group)
    ->orderBy('created_at', 'desc')
    ->get();


    return view('upload',compact('uploaddata','permissions','groupData','subgroupData'));
    }
    public function uploadManual(Request $request){

    // Validate input
    $request->validate([
        'user_group' => 'required|array',
        'sub_group' => 'required|array',
        'category' => 'required|string|max:255',
        'subcategory' => 'required|string|max:255',
        'priority' => 'required|string|max:255',
        'letter_date' => 'required',
        'letter_number' => 'required',
        'subject_of_letter'=>'required',
        'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Restrict file types and size
    ]);


 /*   if ($request->hasFile('file')) {
    $file = $request->file('file');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $filePath = $file->storeAs('uploads', $fileName, 'public');
    }*/
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('uploads'); // Path to public/uploads

        // Move the file to public/uploads
        $file->move($destinationPath, $fileName);

        $filePath = 'uploads/' . $fileName; // File path to store in DB
    }

    foreach ($request->sub_group as $subgroup) {
        // Find the associated group for the selected subgroup
        $subgroupData = UserSubGroup::where('id', $subgroup)->first();

        if ($subgroupData) {
            UploadMaster::create([
                'user_group_id' => $subgroupData->group_id, // Use the correct group_id from the database
                'sub_group_id' => $subgroupData->id,
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'priority' => $request->priority,
                'letter_date' => $request->letter_date,
                'letter_number' => $request->letter_number,
                'subject_of_letter' => $request->subject_of_letter,
                'upload_file' => $filePath ?? null,
            ]);
        }
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
    return redirect()->route('upload.show')->with('success', 'File uploaded successfully.');
    return back()->with('success', 'File uploaded successfully.');


    }

    public function home(){

        return view('home');
    }
   public function signup(){

        $userGroupData = UserGroup::orderBy('id', 'DESC')->get();
        $departments = Department::orderBy('id', 'DESC')->get();
        $userSubGroupData = UserSubGroup::orderBy('id', 'DESC')->get();
        return view('signup',compact('userGroupData','departments','userSubGroupData'));

    }

    
    public function get_subgroups(Request $request)
    {

        $subgroups = UserSubGroup::where('group_id', $request->user_group_id)->orderBy('name', 'DESC')->get();
      //  dd($subgroups);
        return response()->json($subgroups);
     /*   $subGroups = UserSubGroup::where('group_id', $request->user_group_id)->get();
        return response()->json($subGroups);*/
    }

    public function get_subgroup_upload(Request $request)
    {

        $subgroups = UserSubGroup::whereIn('group_id', $request->user_group)->orderBy('name', 'DESC')->get();
        //dd($subgroups);
        return response()->json($subgroups);
     /*   $subGroups = UserSubGroup::where('group_id', $request->user_group_id)->get();
        return response()->json($subGroups);*/
    }
    
    public function signupInsert(Request $request){


        // Validation rules
        $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users',
        'name' => 'required|string|max:255',
        'password' => [
        'required',
        'min:8',
        'confirmed', // Ensures password_confirmation field matches password
        'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
        ],
        'user_group' => 'required|exists:user_groups,id',
        'sub_group' => 'required|string',
        'department' => 'required|string',
        'designation' => 'required|string',
        'phone_number' => 'required|digits:10|unique:users,phone_number',
        ], [
        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',

        'name.required' => 'The name field is required.',
        'name.string' => 'The name must be a valid string.',
        'name.max' => 'The name cannot exceed 255 characters.',

        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 8 characters long.',
        'password.regex' => 'The password must include at least one letter, one number, and one special character.',
        'password.confirmed' => 'The password confirmation does not match.',

        'user_group.required' => 'Please select a user group.',
        'user_group.exists' => 'The selected user group is invalid.',

        'sub_group.required' => 'The sub-group field is required.',
        'sub_group.string' => 'The sub-group must be a valid string.',

        'department.required' => 'The department field is required.',
        'department.string' => 'The department must be a valid string.',

        'designation.required' => 'The designation field is required.',
        'designation.string' => 'The designation must be a valid string.',

        'phone_number.required' => 'The phone number field is required.',
        'phone_number.digits' => 'The phone number must be exactly 10 digits long.',
        'phone_number.unique' => 'This phone number is already in use.',
        ]);

        // Return validation errors
        if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
        }
     

    // Create user
    User::create([
        'email' => $request->email,
        'name' => $request->name,
        'user_group' => $request->user_group,
        'subgroup' => $request->sub_group,
        'phone_number' => $request->phone_number,
        'department' => $request->department,
        'designation' => $request->designation,
        'password_status' => 1,
        'password' => Hash::make($request->password), // Encrypt password
    ]);
        return response()->json(['status' => 'success']);
     //return response()->json(['status' => 'success'], 200);
    //return redirect()->route('login')->with('success', 'Signup Successful! Please Login.');
    }
  public function login(Request $request)
 {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // Log wrong email attempt
        LoginActivity::create([
            'email' => $request->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'event_type' => 'failed_login',
            'status' => 'failed',
            'message' => 'Wrong Email',
        ]);
        return back()->withErrors(['email' => 'Email not found.']);
    }

    // Check if user status is 1 (Active)
    if ((int) $user->status !== 1) { 
        // Log inactive user attempt
        LoginActivity::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'event_type' => 'failed_login',
            'status' => 'failed',
            'message' => 'Inactive Account',
        ]);
        return back()->withErrors(['email' => 'Your account is not active.Please contact admin.']);
    }

    // Attempt login
    if (!Auth::attempt($request->only('email', 'password'))) {
        // Log wrong password attempt
        LoginActivity::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'event_type' => 'failed_login',
            'status' => 'failed',
            'message' => 'Wrong Password',
        ]);
        return back()->withErrors(['password' => 'Incorrect password.']);
    }
    if ($user->password_status == 1) {
        return redirect()->route('home'); // Redirect to dashboard
    } else {
        return redirect()->route('password.reset'); // Redirect to reset password page
    }

    return redirect()->route('home'); // Redirect to dashboard
}
    public function password_reset(){

        return view('reset_password');
    }

    
    public function password_update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->password_status = 1; // Mark password as updated
        $user->save();

        return redirect()->route('home')->with('success', 'Password updated successfully!');
    }
    public function login1(Request $request)
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

        $latestMessage = Message::latest()->first();
        return view('scroll_message',compact('latestMessage'));
    }
    public function users_view(){

        //$userData = User::get();
        $userData = User::with(['userGroup', 'sub_group'])->orderBy('id', 'DESC')->get();
        $userGroupData = UserGroup::orderBy('id', 'DESC')->get();
        $departments = Department::orderBy('id', 'DESC')->get();
        $userSubGroupData = UserSubGroup::orderBy('id', 'DESC')->get();
        return view('user_view',compact('userData','userGroupData','userSubGroupData','departments'));
    }

    
   
    public function login_activity(){

  
    
    $logs = LoginActivity::latest()->paginate(10);
    //dd($logs);
        return view('login_activity', compact('logs'));
    }
    public function report_show(){

        $users = User::orderBy('id', 'DESC')->get();

        /*$category = Category::get();
        dd($category);*/
        return view('report',compact('users'));
    }



}
