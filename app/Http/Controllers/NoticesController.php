<?php

namespace App\Http\Controllers;

use App\Models\Notices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoticesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notice = Notices::all();

        return Inertia::render(
            'Notices/Index',
            [
                'notice' => $notice
            ]
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Notices/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'string|max:50',
            'content' => 'required|string|max:255',
            'created_by_id' => 'string',
            'status' => 'integer'
        ]);
        Blog::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'created_by_id' => $request->created_by_id,
            'status' => $request->status
        ]);
        sleep(1);

        return redirect()->route('notices.index')->with('message', 'Notice Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notices $notices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notices $notices)
    {
        return Inertia::render(
            'Notices/Edit',
            [
                'notices' => $notices
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notices $notices)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'string|max:50',
            'content' => 'required|string|max:255',
            'created_by_id' => 'string',
            'status' => 'integer'
        ]);

        $notices->title = $request->title;
        $notices->excerpt = $request->excerpt;
        $notices->content = $request->content;
        $notices->created_by_id = $request->created_by_id;
        $notices->status = $request->status;
        $notices->save();
        sleep(1);

        return redirect()->route('notices.index')->with('message', 'Notice Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notices $notices)
    {
        $notices->delete();
        sleep(1);

        return redirect()->route('notices.index')->with('message', 'Notice Deleted Successfully');
    }
}
