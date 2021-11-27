<?php

namespace Modules\Company\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Company\Entities\Company;
use Modules\Company\Http\Requests\StoreCompanyRequest;
use Modules\User\Entities\User;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return Company::latest()->paginate(15);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return Company::findOrFail($id);
    }

    /**
     * Display the user's company details
     * @return Response
     */
    public function userCompany()
    {
        return response(User::current()->company);
    }

    /**
     * Update the specified resource in storage.
     * @param \Modules\Company\Http\Requests\StoreCompanyRequest $request
     * @return Response
     */
    public function modify(StoreCompanyRequest $request)
    {
        $company = User::current()->company()->updateOrCreate(
            ['id' => (User::current()->company->id ?? null)],
            [
                'name'        => $request->name,
                'description' => $request->description,
                'location'    => $request->location,
                'industry'    => $request->industry,
                'website'     => $request->website,
                'type'        => $request->type,
                'founded_at'  => Carbon::parse($request->founded_at),
            ]
        );
        return response($company);
    }
}
