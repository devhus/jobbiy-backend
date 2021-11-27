<?php

namespace Modules\Job\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Job\Entities\Job;
use Modules\Job\Entities\JobApplication;
use Modules\Job\Enums\JobApplicationStatus;
use Modules\User\Entities\User;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param int $jobId
     * @return Response
     */
    public function index($jobId)
    {
        $applications = JobApplication::withUser()->whereEmployerJob($jobId, User::current()->id);
        return $applications->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $jobId
     * @return Response
     */
    public function updateStatus(Request $request, $jobId, $applicationId)
    {
        $request->validate([
            'status' => [
                'required',
                'string',
                Rule::in(JobApplicationStatus::values()),
            ],
        ]);
        $application = JobApplication::whereEmployerJob($jobId, User::current()->id)->findOrFail($applicationId);
        $application->update([
            'status' => $request->status,
        ]);
        return $application;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
