<?php
namespace App\Http\Controllers;

use App\Models\Vlog;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class VlogController extends Controller
{
    // ✅ 1. Show All Vlogs
    public function index()
{
    $vlogs = Vlog::with('user')->latest()->get(); // ✅ User data ke sath fetch karein
    return view('vlogs.index', compact('vlogs'));
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/vlogs', 'public');
        }
    
        Vlog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'like' => 0,
            'dislike' => 0,
            'user_id' => auth()->id() // ✅ Logged-in user ki ID store hogi
        ]);
    
        return redirect()->route('vlogs.index')->with('success', 'Vlog Added Successfully');
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


}
