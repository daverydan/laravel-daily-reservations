<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Notifications\RegisteredToActivityNotification;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ActivityRegisterController extends Controller
{
    public function store(Activity $activity)
    {
        if (! Auth::check()) {
            return to_route('register', ['activity' => $activity->id]);
        }

        abort_if(Auth::user()->activities()->where('id', $activity->id)->exists(), Response::HTTP_CONFLICT);

        Auth::user()->activities()->attach($activity->id);

        Auth::user()->notify(new RegisteredToActivityNotification($activity));

        return to_route('my-activity.show')->with('success', 'You have successfully registered.');
    }
}
