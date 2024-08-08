<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $response =  Http::withHeaders([
                "api-token" => "pEUPenF_ej_aNTiZv5IQB73UqJWAJcRhYTvEkm3MEfV4GRV6SGRsUyuKx6UWyGfK-B0",
                "user-email" => "saikatwebdeveloper@gmail.com"
            ])->get('https://www.universal-tutorial.com/api/getaccesstoken');

         $data = (array)\json_decode($response->body());

        $auth_token = $data['auth_token'];

        $countryResponse =  Http::withHeaders([
            "Authorization" => "Bearer ".$auth_token,
        ])->get('https://www.universal-tutorial.com/api/countries');


       $countries = (array)json_decode($countryResponse->body());

        return \view('backend.modules.profile.user-profile', [ "token" => $auth_token, "countries" => $countries]);

    }

    public function getStates(Request $request){

        $stateResponse =  Http::withHeaders([
            "Authorization" => "Bearer ".$request->token,
        ])->get('https://www.universal-tutorial.com/api/states/'.$request->country);


        $states = json_decode($stateResponse->body(), true);

        return response()->json($states);
    }
    public function getCities(Request $request){

        $cityResponse =  Http::withHeaders([
            "Authorization" => "Bearer ".$request->token,
        ])->get('https://www.universal-tutorial.com/api/cities/'.$request->state);


        $cities = json_decode($cityResponse->body(), true);

        return response()->json($cities);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
