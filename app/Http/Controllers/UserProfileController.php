<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       $countries = Country::pluck('name', 'id');
       $userProfile = UserProfile::where('user_id', Auth::id())->first();
        return \view('backend.modules.profile.user-profile', \compact('countries', 'userProfile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [

            'phone' => 'required',
            'address' => 'required|string|max:255',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'gender' => 'required|string|in:Male,Female,Others',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $porife_data = $request->all();
        $porife_data['user_id'] = Auth::id();

        $existing_profile = UserProfile::where('user_id', Auth::id())->first();

        if ($existing_profile) {

            $existing_profile->update($porife_data);
            return redirect()->route('user-profile.create')->with('success', 'Profile updated successfully');
        }else {
            UserProfile::create($porife_data);
            return redirect()->route('user-profile.create')->with('success', 'Profile created successfully');

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }

       /**
    * @param int $country_id
    * @return JsonResponse
     */

   final public function getStates($country_id)
    {

        $states = State::select('id', 'name')->where('country_id', $country_id)->get();
        return \response()->json($states);
    }
           /**
    * @param int $state_id
    * @return JsonResponse
     */
    public function getCities($state_id)
    {
        $cities = City::select('id', 'name')->where('state_id', $state_id)->get();
        return \response()->json($cities);

    }
}
