<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{

    public function store(Request $request)
    {
        $title = $request->title;

        Batch::create([
            'title' => $title,
            'status' => 0
        ]);

        return redirect()->back()->with('success', 'Batch saved successfully!');
    }

    public function fetch(Request $request)
    {
        $id = $request->id;
        session(['batch' => $id]);
        Batch::query()->update([
            'status'=>0
        ]);
        Batch::findorFail($id)->update([
            'status'=>1
        ]);
        return redirect()->back()->with('success', 'Batch Fetched successfully!');
    }
}
