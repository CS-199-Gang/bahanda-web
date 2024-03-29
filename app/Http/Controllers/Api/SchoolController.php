<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolAddUserRequest;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'data' => School::all()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSchoolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolRequest $request)
    {
        $validated = $request->validated();

        $school = new School($validated);
        $school->save();
        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return [
            'data' => $school
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolRequest  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }

    public function users(School $school)
    {
        return [
            'data' => User::whereSchoolId($school->id)->get()
        ];
    }

    public function add_user(SchoolAddUserRequest $request, School $school)
    {
        $validated = $request->validated();
        $password = Str::random(8);
        $validated['password'] = Hash::make($password);
        $validated['school_id'] = $school->id;
        Log::debug($validated);
        $user = new User($validated);
        $user->save();
        return response()->json(['data' => ['password' => $password]], 201);
    }
}
