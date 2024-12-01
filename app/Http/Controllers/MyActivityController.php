<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MyActivityController extends Controller
{
    public function show()
    {
        $activities = Auth::user()->activities()->orderBy('start_time')->get();

        return view('activities.my-activities', compact('activities'));
    }

    public function destroy(Activity $activity)
    {
        abort_if(! Auth::user()->activities->contains($activity), Response::HTTP_FORBIDDEN);

        Auth::user()->activities()->detach($activity);

        return to_route('my-activity.show')->with('success', 'Activity removed.');
    }
}
