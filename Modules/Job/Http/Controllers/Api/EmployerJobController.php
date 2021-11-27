<?php

namespace Modules\Job\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Job\Entities\Job;
use Modules\User\Entities\User;

class EmployerJobController extends Controller
{
    /**
     * @var \Modules\Company\Entities\Company|null $company
     */
    private $company;

    public function __construct()
    {
        if (!($this->company = User::current()->company)) {
            return abort(403, "User did not setup their company yet.");
        }
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->company->jobs()->latest()->paginate(15);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return response($this->company->jobs()->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int|null $id
     * @return Response
     */
    public function updateOrCreate(Request $request, $id = null)
    {
        $job = $this->company->jobs()->updateOrCreate([
            'id'         => $id,
            'company_id' => $this->company->id,
        ], [
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'enabled'     => $request->enabled ?? true,
        ]);
        return response($job);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $job = User::current()->company->jobs->find($id);
        if (!$job) {
            return res()->error('Job was not found.');
        }
        $job->delete();
        return res()->success();
    }
}
