<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\DeviceSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DeviceSettingController extends Controller
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
    public function show($id)
    {
        //
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

    public function apply(Request $request)
    {
        Log::debug($request->input());

        $scenario_one_time = $request->input('scenario_one_time');
        $scenario_two_time = $request->input('scenario_two_time');
        $device_ids = $request->input('selected_devices');

        $set_devices = [];

        foreach ($device_ids as $device_id) {
            $device = Device::whereId($device_id)->first();
            if (Auth::user()->school_id !== $device->school_id) continue;

            $setting = DeviceSettings::updateOrCreate([
                'device_id' => $device->id,
            ], [
                'scenario_one_time' => $scenario_one_time,
                'scenario_two_time' => $scenario_two_time,
            ]);

            $setting->save();
            $set_devices[] = $device->id;
        }

        return response()->json(['data' => $set_devices]);
    }

    public function device(Request $request, Device $device)
    {
        $device_settings = DeviceSettings::query()->where('device_id', '=', $device->id)->first();
        if (!$device_settings) return ['data' => []];
        return ['data' => $device_settings];
    }
}
