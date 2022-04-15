<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SchoolController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('School/Index');
    }

    public function show(Request $request, School $school)
    {
        if (Auth::user()->user_type === UserType::SCHOOL_ADMIN) {
            $school = School::whereId(Auth::user()->school_id)->first();
        }
        return Inertia::render('School/Show', [
            'entity' => $school
        ]);
    }
}
