<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    /**
     * Show all jobs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();

        if (count($jobs) > 0) {
            return response()->json(['data' => $jobs->toArray()], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'No Jobs Available!'
        ], 200);
    }

    /**
     * Attempt storing a job
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show specific job
     * 
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Job::find($id);

        if ($data) {
            return response()->json(['data' => $data->toArray()], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Job Not Found!'
        ], 404);
    }

    /**
     * Delete a job
     
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $article = Job::where('user_id', $request->user()->id)->where('id', $id);
        if ($article->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Job Successfully Deleted!'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Job Not Found!'
        ], 404);
    }

    /**
     * Show jobs posted by authenticated user
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function showMyJobs(Request $request)
    {
        $data = Job::where('user_id', $request->user()->id)->get();

        if (count($data) > 0) {
            return response()->json(['data' => $data->toArray()], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'No Jobs Available!'
        ], 200);
    }

    /**
     * Attempt updating a job
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $job = Job::find($id);

        if ($job && $job->update($request->all())) {
            return response()->json([
                'status' => 'success',
                'message' => 'Job Successfully Updated!', 'data' => $job
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Job Not Found!'
        ], 404);
    }

    /**
     * Attempt search
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Using this method because it's not a robust search. 
        // If it was, Algolia search with laravel scout would be used.

        $search_term = $request->query('q');

        $data = Job::where('title', 'like', '%' . $search_term . '%')
            ->orWhere('description', 'like', '%' . $search_term . '%')
            ->orWhere('type', 'like', '%' . $search_term . '%')->get();

        if (count($data) > 0) {
            return response()->json([
                'data' => $data
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No Job Found!'
        ], 404);
    }
}
