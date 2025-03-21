<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Uploadmaster;
use App\Models\User;
use App\Models\DownloadHistory;
use App\Models\Overview;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    //

    public function updateProfileimage(Request $request){

    $user = auth()->user();

    // Validate the request
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
    ]);

    // Handle file upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Rename the image
        $imagePath = 'profile_images/' . $imageName; // Define image path

        // Move the uploaded file to the public/profile_images directory
        $image->move(public_path('profile_images'), $imageName);

        // Delete old image if exists (except default one)
        if ($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }

        // Save new image path in database
        $user->image = $imagePath;
    }

    $user->save();

    return back()->with('success', 'Profile Image updated successfully!');
        
    }

    Public function change_password(Request $request){

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
    public function profile(){
        
        $user_id = Auth::id();
        $userData = User::with(['userGroup', 'sub_group'])->where('id',$user_id)->first();

        $user_id = Auth::id(); // Get the authenticated user ID
        if ($user_id) { 
            $userData = User::with(['userGroup', 'sub_group'])->find($user_id); 
        } else {
            $userData = null; // No user logged in
        }
        //dd($userData);
        return view('user_profile',compact('userData'));
    }
    public function kavach_index(){

        return view('kavach.kavach');
    }
    public function kavach_overview(){

        $overviews = Overview::where('type', 'Kavach')->get();
        return view('kavach.overview', compact('overviews'));
    }
    public function kavach_multimedia(){

        return view('kavach.multimedia');
    }
    public function kavach_brochure(Request $request)
    {
        $segments = $request->segments();
     $kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('kavach')])
               ->whereRaw('LOWER(subcategory) = ?', [strtolower('Brochure')])
               ->orderBy('created_at', 'desc') // Order by newest first
               ->get();
      /*  $kavachdata = Uploadmaster::join('downloadhistory', 'uploadmasters.id', '=', 'downloadhistory.upload_id')
        ->whereRaw('LOWER(uploadmasters.category) = ?', [strtolower('kavach')])
        ->whereRaw('LOWER(uploadmasters.subcategory) = ?', [strtolower('Brochure')])
        ->select('uploadmasters.*', 'downloadhistory.*') // Adjust as per required columns
        ->get();*/
        //dd($kavachdata);
        return view('kavach.brochure',compact('kavachdata'));
    }
    public function kavach_advisories(Request $request)
    {

        $segments = $request->segments();
        //$kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('kavach')])
              // ->whereRaw('LOWER(subcategory) = ?', [strtolower('advisories')])
              // ->get();
        $kavachdata = Uploadmaster::join('downloadhistory', 'uploadmasters.id', '=', 'downloadhistory.upload_id')
        ->whereRaw('LOWER(uploadmasters.category) = ?', [strtolower('kavach')])
        ->whereRaw('LOWER(uploadmasters.subcategory) = ?', [strtolower('Brochure')])
        ->select('uploadmasters.*', 'downloadhistory.*') // Adjust as per required columns
        ->orderBy('uploadmasters.id', 'DESC') // Add DESC order
        ->get();
        //dd($kavachdata);
        return view('kavach.advisories',compact('kavachdata'));
    }

    public function history_data($id)
    {

        $userId = Auth::id();
        $kavachdata = Uploadmaster::where('id',$id)->first();
        $historydata = DownloadHistory::updateOrCreate(
            ['upload_id' => $id, 'user_id' => $userId], // Search condition
            [
                'seen_status' => '1',
                'updated_at' => now()             
            ]
        );
        $users = DB::table('users')
                ->leftJoin('downloadhistory', function($join) use ($id) {
                $join->on('users.id', '=', 'downloadhistory.user_id')
                ->where('downloadhistory.upload_id', '=', $id);
            })
            ->select('users.name', 'downloadhistory.*')
            ->get();
        return view('kavach.history',compact('kavachdata','historydata','users'));
    }
    public function remark_add(Request $request)
    {

        $userId = Auth::id();
        $uploadId = $request->upload_id;
        $date_of_action = $request->date_of_action;
        $remark = $request->remark;
        $status = $request->status;
        $historydata = DownloadHistory::updateOrCreate(
            ['upload_id' => $uploadId, 'user_id' => $userId], // Search condition
            [
                'date_for_action' => $date_of_action,
                'remarks' => $remark,
                'status' => $status,
                'updated_at' => now()             
            ]
        );
        $uploaddata = Uploadmaster::where('id',$uploadId)->first();
        //dd($uploaddata->subcategory);
        
        if($uploaddata->subcategory == 'Brochure'){

           return redirect()->route('kavach.brochure')->with('success', 'Updated Successfully.');
        }elseif($uploaddata->subcategory == 'Advisories'){
            return redirect()->route('kavach.advisories')->with('success', 'Updated Successfully.');
        }else{
            return redirect()->route('kavach.brochure')->with('success', 'Updated Successfully.');
        }
    }
    public function timeline($id){

        $userId = Auth::id();
        $timelinedata = DownloadHistory::where('upload_id',$id )->where('user_id',$userId)->first();
        $user = User::where('id',$timelinedata->user_id)->first();
        return view('kavach.timeline',compact('timelinedata','user'));
    }
    public function remark($id){
        
        $userId = Auth::id();

        $kavachdata = DB::table('uploadmasters')
        ->leftJoin ('downloadhistory', function($join) use ($id) {
        $join->on('uploadmasters.id', '=', 'downloadhistory.upload_id')
       ->where('downloadhistory.upload_id', '=', $id);
        })
        ->select('uploadmasters.*', 'downloadhistory.*')
        ->first();
       // dd($kavachdata);
        return view('kavach.edit',compact('kavachdata','id'));
    }
    public function search_data(Request $request){

        $userId = Auth::id();
        $kavachdata = DB::table('uploadmasters')
        ->join('downloadhistory', function($join) use ($userId) {
        $join->on('uploadmasters.id', '=', 'downloadhistory.upload_id')
        ->where('downloadhistory.user_id', '=', $userId);
        });
        if (!empty($request->category)) {
            $kavachdata->where('uploadmasters.category', 'LIKE', '%' . $request->category . '%');
        }

        if (!empty($request->subcategory)) {
            $kavachdata->where('uploadmasters.subcategory', 'LIKE', '%' . $request->subcategory . '%');
        }

        if (!empty($request->from_date) && !empty($request->to_date)) {
            $kavachdata->whereBetween('downloadhistory.created_at', [$request->from_date, $request->to_date]);
        }

        $kavachdata = $kavachdata->select('uploadmasters.*', 'downloadhistory.*')->first();
        //dd($kavachdata);
        return response()->json([$kavachdata]); // Return JSON response
       // dd($kavachdata);

    }

    public function lte_index(){
        return view('lte.index');
    }
    public function lte_overview(){

        $overviews = Overview::where('type', 'Lte')->get();
        return view('lte.overview', compact('overviews'));
        //return view('lte.overview');
    }
    public function lte_brochure(Request $request){

        $segments = $request->segments();
        $kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('lte')])
    ->whereRaw('LOWER(subcategory) = ?', [strtolower('Brochure')])
    ->orderBy('id', 'DESC') // Add DESC order
    ->get();
        return view('lte.brochure',compact('kavachdata'));
    }
    public function lte_advisories(Request $request){

        $segments = $request->segments();
        $kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('lte')])
               ->whereRaw('LOWER(subcategory) = ?', [strtolower('advisories')])
               ->get();
        
        return view('lte.advisories',compact('kavachdata'));
    }
    public function lte_multimedia(){
        return view('lte.multimedia');
    }
    public function organisation_index(){
        return view('organisation.index');

    }
    public function _5G_index(){

        return view('5g.index');
    }
    public function _5G_overview(){

        $overviews = Overview::where('type', '5G')->get();
        //return view('lte.overview', compact('overviews'));
        return view('5g.overview', compact('overviews'));

    }
    public function _5G_brochure(Request $request){

        $segments = $request->segments();
        $kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('5g')])
               ->whereRaw('LOWER(subcategory) = ?', [strtolower('advisories')])
               ->get();
        return view('5g.multimedia',compact('kavachdata'));

        return view('5g.brochure');
    }
    public function _5G_advisories(Request $request){

        $segments = $request->segments();
        $kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('5g')])
               ->whereRaw('LOWER(subcategory) = ?', [strtolower('advisories')])
               ->get();
        return view('5g.advisories',compact('kavachdata'));
    }
    public function _5G_multimedia(Request $request)
    {
        
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }











}
