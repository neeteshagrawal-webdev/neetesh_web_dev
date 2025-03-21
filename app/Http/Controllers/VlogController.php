<?php
namespace App\Http\Controllers;

use App\Models\Vlog;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Comment;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BlogSharedMail;
use App\Mail\NotifyUsers;
class VlogController extends Controller
{
    // ✅ 1. Show All Vlogs
    public function index()
    {
        $vlogs = Vlog::with('user')->latest()->where('status', 0)->get(); 
        $user = User::get();
        foreach ($vlogs as $vlog) {
            if (!empty($vlog->share_user_ids)) {
                // Decode JSON or convert comma-separated string into an array
                $mentionedUserIds = is_string($vlog->share_user_ids) 
                ? explode(',', $vlog->share_user_ids) 
                : json_decode($vlog->share_user_ids, true);

                // Fetch usernames based on IDs
                //$vlog->mentioned_users_names = User::whereIn('id', $mentionedUserIds)->pluck('name')->toArray();
                $vlog->mentioned_users_data = User::whereIn('id', $mentionedUserIds)
                ->get(['id', 'name', 'designation']);
            } else {
                $vlog->mentioned_users_names = [];
            }
        }
        //dd($vlogs);
        return view('vlogs.index', compact('vlogs','user'));
    }

    

    // ✅ 2. Show Create Form
    public function create()
    {
        return view('vlogs.create');
    }

    // ✅ 3. Store Vlog (Insert Data)
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'share_user_ids' => 'nullable|array',  // Shared users
            'share_user_ids.*' => 'exists:users,id', // Validate each selected user ID
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov|max:10240', // 10MB limit
        ]);

        // Convert selected user IDs to a comma-separated string
        $sharedUsers = $request->share_user_ids ? implode(',', $request->share_user_ids) : null;

        $data = [
            'title' => $request->title,
            'message' => $request->message,
        ];
        $imagePath = null;
         $pdfpath = null;
         $videopath = null;
        if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName(); // Unique file name
    $image->move(public_path('uploads/vlogs'), $imageName); // Save in public/uploads/vlogs
    $imagePath = 'uploads/vlogs/' . $imageName; // Store path in DB
}

if ($request->hasFile('pdf')) {
    $pdf = $request->file('pdf');
    $pdfName = time() . '_' . $pdf->getClientOriginalName();
    $pdf->move(public_path('uploads/pdfs'), $pdfName);
    $pdfPath = 'uploads/pdfs/' . $pdfName;
}

if ($request->hasFile('video')) {
    $video = $request->file('video');
    $videoName = time() . '_' . $video->getClientOriginalName();
    $video->move(public_path('uploads/videos'), $videoName);
    $videoPath = 'uploads/videos/' . $videoName;
}
        $blog = Vlog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'pdf' => $pdfpath,
            'video' => $videopath,
            'like' => 0,
            'dislike' => 0,
            'share_user_ids' => $sharedUsers,
            'user_id' => auth()->id() // ✅ Logged-in user ki ID store hogi
        ]);

        $users = User::all(); // Get all users
        $details = ['message' => 'A new post has been published!'];

        // Send email to each mentioned user
        if ($request->share_user_ids) {
            $users = User::whereIn('id', $request->share_user_ids)->get();
                foreach ($users as $user) {
                Mail::to($user->email)->send(new BlogSharedMail($blog, $user));
            }
        }
       foreach ($users as $user) {
            $result = Mail::to($user->email)->send(new NotifyUsers($data));
           // dd($result);
        }
       /* foreach ($users as $user) {
            dispatch(new NotifyUsers($details));
        }*/
        return response()->json([
            'success' => true,
            'message' => 'Vlog Added Successfully',
            'data' => $data
        ]);

    }
    
    public function addComment(Request $request)
{
    $request->validate([
        'vlog_id' => 'required|exists:vlogs,id',
        'comment' => 'required|string|max:1000',
    ]);

    $comment = Comment::create([
        'vlog_id' => $request->vlog_id,
        'user_id' => Auth::id(),
        'comment' => $request->comment,
    ]);

    return response()->json([
        'success' => true,
        'comment' => [
            'id' => $comment->id,
            'user_name' => Auth::user()->name,
            'comment' => $comment->comment,
        ]
    ]);
}

public function deleteComment($id)
{
    $comment = Comment::findOrFail($id);

    if (Auth::id() !== $comment->user_id) {
        return response()->json(['success' => false, 'error' => 'Unauthorized action.']);
    }

    $comment->delete();

    return response()->json(['success' => true]);
}



    // ✅ 4. Show Edit Form
    public function edit($id)
    {
        $vlog = Vlog::findOrFail($id);
        return view('vlogs.edit', compact('vlog'));
    }

    // ✅ 5. Update Vlog
    public function update(Request $request, $id)
    {
        $vlog = Vlog::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $vlog->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        $vlog->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return redirect()->route('vlogs.index')->with('success', 'Vlog Updated Successfully');
    }

    // ✅ 6. Delete Vlog
    public function destroy($id)
    {
        $vlog = Vlog::findOrFail($id);
        if ($vlog->image) {
            \Storage::delete('public/' . $vlog->image);
        }
        $vlog->delete();
        
        return redirect()->route('vlogs.index')->with('success', 'Vlog Deleted Successfully');
    }
    public function like($id)
    {
        $vlog = Vlog::findOrFail($id);
        $userId = Auth::id();
    
        // Check if user has already liked or disliked
        $existingLike = Like::where('user_id', $userId)->where('vlog_id', $id)->first();
    
        if ($existingLike) {
            if ($existingLike->type == 'like') {
                // If already liked, remove like
                $vlog->decrement('like');
                $existingLike->delete();
                return response()->json(['status' => 'unliked', 'likes' => $vlog->like, 'dislikes' => $vlog->dislike]);
            } else {
                // If previously disliked, remove dislike and add like
                $vlog->decrement('dislike');
                $vlog->increment('like');
                $existingLike->update(['type' => 'like']);
                return response()->json(['status' => 'liked', 'likes' => $vlog->like, 'dislikes' => $vlog->dislike]);
            }
        }
    
        // Add new like
        Like::create(['user_id' => $userId, 'vlog_id' => $id, 'type' => 'like']);
        $vlog->increment('like');
    
        return response()->json(['status' => 'liked', 'likes' => $vlog->like, 'dislikes' => $vlog->dislike]);
    }
    
    public function dislike($id)
    {
        $vlog = Vlog::findOrFail($id);
        $userId = Auth::id();
    
        // Check if user has already liked or disliked
        $existingLike = Like::where('user_id', $userId)->where('vlog_id', $id)->first();
    
        if ($existingLike) {
            if ($existingLike->type == 'dislike') {
                // If already disliked, remove dislike
                $vlog->decrement('dislike');
                $existingLike->delete();
                return response()->json(['status' => 'undisliked', 'likes' => $vlog->like, 'dislikes' => $vlog->dislike]);
            } else {
                // If previously liked, remove like and add dislike
                $vlog->decrement('like');
                $vlog->increment('dislike');
                $existingLike->update(['type' => 'dislike']);
                return response()->json(['status' => 'disliked', 'likes' => $vlog->like, 'dislikes' => $vlog->dislike]);
            }
        }
    
        // Add new dislike
        Like::create(['user_id' => $userId, 'vlog_id' => $id, 'type' => 'dislike']);
        $vlog->increment('dislike');
    
        return response()->json(['status' => 'disliked', 'likes' => $vlog->like, 'dislikes' => $vlog->dislike]);
    }


    public function toggleStatus($id)
    {
        $vlog = Vlog::findOrFail($id);
        $vlog->status = !$vlog->status; // Toggle between 1 and 0
        $vlog->save();

    return redirect()->back()->with('success', 'Blog Post Hide Successfully.');
    }

    public function blogShow(){
        $vlogs = Vlog::with('user')->latest()->where('status', 1)->get();
        //$vlogs = Vlog::all(); // Show all posts for admin
        return view('vlogs.admin_view', compact('vlogs'));
    }
    public function change_blog_status($id){

        $vlog = Vlog::findOrFail($id);
        $vlog->status = !$vlog->status; // Toggle between 1 and 0
        $vlog->save();
        return response()->json(['success' => true, 'message' => 'blog Status Change successfully!']);

    }

}
