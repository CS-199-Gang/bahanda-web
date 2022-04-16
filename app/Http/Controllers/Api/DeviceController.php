<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\DeviceRegistrationRequest;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'data' => Device::whereSchoolId(Auth::user()->school_id)->get()
        ];
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
    public function show(Device $device)
    {
        return [
            'data' => $device
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function register($id)
    {
        $req = new DeviceRegistrationRequest(['device_id' => $id]);
        do {
            $req->code = $code = Str::random(8);
        } while (DeviceRegistrationRequest::whereCode($code)->exists());
        $expiry = new DateTime();
        $expiry->add(new DateInterval("PT5M"));
        $req->expiry = $expiry;
        $req->save();
        return [
            'data' => $code
        ];
    }

    public function claim($code)
    {
        $req = DeviceRegistrationRequest::whereCode($code)->first();
        $now = new DateTime();

        if ($now > $req->expiry) return response()->json([], 400);

        $device = new Device([
            'id' => $req->device_id,
            'school_id' => Auth::user()->school_id
        ]);
        $device->save();
        DeviceRegistrationRequest::whereDeviceId($req->device_id)->delete();
        return response()->json([], 201);
    }
}
