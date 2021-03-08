<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();

        return response()->json(['data' => $jobs->toArray()], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = $request->user()->id;
        $data = Job::create($input);
        return response()->json([
            'status' => 'success',
            'message' => 'Job Successfully Created!', 'data' => $data->toArray()
        ], 200);
    }

    public function show($id)
    {
        $data = Job::findOrFail($id);
        return response()->json(['data' => $data->toArray()], 200);
    }

    public function delete(Request $request, $id)
    {
        $article = Job::findOrFail($id);
        $article->delete();

        return 204;
    }
}
