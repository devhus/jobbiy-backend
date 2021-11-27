<?php

namespace Modules\Job\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Job\Entities\Job;
use Modules\Job\Http\Requests\StoreApplicationRequest;
use Modules\User\Entities\User;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return Job::paginate(10);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return Job::withCompany()->find($id)->append('has_applied');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @param \Modules\Job\Http\Requests\StoreApplicationRequest $request
     * @return Response
     */
    public function apply(StoreApplicationRequest $request, int $id)
    {
        $application = User::current()->jobApplications()->where('job_id', $id)->first();
        if ($application) {
            return res()->error("You have already applied for this job");
        }
        return User::current()->jobApplications()->create([
            'job_id' => $id,
        ]);
    }
}
