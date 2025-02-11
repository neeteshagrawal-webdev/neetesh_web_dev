<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Uploadmaster;
use App\Models\User;
use App\Models\DownloadHistory;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    //
    public function kavach_index(){

        return view('kavach.kavach');
    }
    public function kavach_overview(){

        return view('kavach.overview');
    }
    public function kavach_multimedia(){

        return view('kavach.multimedia');
    }
    public function kavach_brochure(Request $request)
    {
        $segments = $request->segments();
        $kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('kavach')])
               ->whereRaw('LOWER(subcategory) = ?', [strtolower('Brochure')])
               ->get();
        return view('kavach.brochure',compact('kavachdata'));
    }
    public function kavach_advisories(Request $request)
    {

        $segments = $request->segments();
        $kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('kavach')])
               ->whereRaw('LOWER(subcategory) = ?', [strtolower('advisories')])
               ->get();
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
        return redirect()->route('kavach.brochure')->with('success', 'Updated Successfully.');
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
        ->join('downloadhistory', function($join) use ($userId, $id) {
        $join->on('uploadmasters.id', '=', 'downloadhistory.upload_id')
        ->where('downloadhistory.user_id', '=', $userId)
        ->where('downloadhistory.upload_id', '=', $id);
        })
        ->select('uploadmasters.*', 'downloadhistory.*')
        ->first();
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
        return view('lte.overview');
    }
    public function lte_brochure(Request $request){

        $segments = $request->segments();
        $kavachdata = Uploadmaster::whereRaw('LOWER(category) = ?', [strtolower('lte')])
               ->whereRaw('LOWER(subcategory) = ?', [strtolower('Brochure')])
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
        return view('5g.overview');

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











}
