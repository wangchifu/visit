<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorDataRequest;
use App\User;
use App\VendorData;
use Illuminate\Http\Request;

class VendorDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();
        $vendor_data = VendorData::where('user_id',auth()->user()->id)->first();
        //dd($vendor_data);
        $groups = config('app.groups');
        $data = [
            'user'=>$user,
            'vendor_data'=>$vendor_data,
            'groups'=>$groups,
        ];
        return view('vendor_datas.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorDataRequest $request,User $user)
    {
        $att['name'] = $request->input('name');
        $att['address'] = $request->input('address');
        $att['township'] = $request->input('township');
        $att['address'] = $request->input('address');
        $att['telephone_number'] = $request->input('telephone_number');
        $att['email'] = $request->input('email');
        $att['website'] = $request->input('website');
        $att['line_id'] = $request->input('line_id');
        $user->update($att);

        $att2['about'] = $request->input('about');
        $att2['vendor_name'] = $request->input('vendor_name');
        $att2['user_id'] =auth()->user()->id;
        $user->vendor_data->update($att2);

        return redirect()->route('vendor_datas.show');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
