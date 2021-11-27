<?php

namespace Modules\Account\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        return User::current()->companies()->latest()->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Modules\Company\Http\Requests\StoreCompanyRequest $request
     * @return Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = User::current()->companies()->create([
            'name'        => $request->name,
            'description' => $request->description,
            'location'    => $request->location,
            'industry'    => $request->industry,
            'website'     => $request->website,
            'type'        => $request->type,
            'founded_at'  => $request->founded_at,
        ]);
        return $company;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return User::current()->companies()->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     * @param \Modules\Company\Http\Requests\StoreCompanyRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StoreCompanyRequest $request, $id)
    {
        return User::current()->companies()->findOrFail($id)->update([
            'name'        => $request->name,
            'description' => $request->description,
            'location'    => $request->location,
            'industry'    => $request->industry,
            'website'     => $request->website,
            'type'        => $request->type,
            'founded_at'  => $request->founded_at,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::current()->companies()->findOrFail($id)->delete();
        return res()->success();
    }
}
