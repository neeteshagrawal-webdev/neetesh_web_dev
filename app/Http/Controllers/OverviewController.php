<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overview;
class OverviewController extends Controller
{
    //

    public function index()
    {
        $overviews = Overview::all(); // Get all sections

     
        return view('overview_index', compact('overviews'));
    }

    public function create()
    {
        return view('overview_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'media' => 'nullable|mimes:jpg,jpeg,png,mp4|max:20480'
        ]);

        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('overviews', 'public');
            $mediaType = $request->file('media')->getClientMimeType() === 'video/mp4' ? 'video' : 'image';
        }

        Overview::create([
            'title' => $request->title,
            'content' => $request->content,
            'media' => $mediaPath,
            'media_type' => $mediaType,
            'type' => $request->page_type
        ]);
        return redirect()->route('overview.index')->with('success', 'Overview section added successfully!');
        //return redirect()->route('overview.index')->with('success', 'Overview section added successfully.');
    }

    public function destroy($id)
    {
        $overview = Overview::findOrFail($id);

        if ($overview->media) {
            \Storage::delete('public/' . $overview->media);
        }

        $overview->delete();

        return redirect()->route('overview.index')->with('success', 'Section deleted successfully.');
    }
}
