<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }
    public function login()
    {
        return view('frontend.login');
    }
    public function sub_login()
    {
        return view('frontend.sub-login');
    }
    public function sign_up_mediaowner()
    {
        return view('frontend.sign-up-mediaowner');
    }
    public function production_popup()
    {
        return view('frontend.production-popup');
    }
    public function sign_up_step2()
    {
        return view('frontend.sign-up-step2');
    }
    public function sign_up_step3()
    {
        return view('frontend.sign-up-step3');
    }
    public function sign_up_step4()
    {
        return view('frontend.sign-up-step4');
    }
    public function otp_mobile()
    {
        return view('frontend.otp-mobile');
    }
    public function otp_message()
    {
        return view('frontend.otp-message');
    }
    public function location_selection()
    {
        return view('frontend.location-selection');
    }
    public function location_map()
    {
        return view('frontend.location-map');
    }


   
}

