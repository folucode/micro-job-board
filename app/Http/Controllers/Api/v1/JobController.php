<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function store(Request $request)
    {
        return 'Job::create($request->all());';
    }
}
