<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    
    /**
     * Attempt storing an application
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $id)
    {

        $name = $request->file('cv')->getClientOriginalName();
        $cv_path = $request->file('cv')->storeAs(
            'cv', $name
        );

        $input = $request->all();
        $input['job_id'] = $id;
        $input['cv'] = $cv_path;

        $data = Application::create($input);

        return response()->json([
            'status' => 'success',
            'message' => 'Application Successfully Submitted!', 'data' => $data->toArray()
        ], 200);
    }
}
