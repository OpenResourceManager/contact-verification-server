<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifyFrontEndController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('welcome');
    }

    /**
     * @param Request $request
     * @param null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verify(Request $request, $token = null)
    {
        $valid_codes = [200, 202];

        if ($request->isMethod('post') && empty($token)) {
            $data = $request->all();
            $token = $data['token'];
        }

        if (!empty($token)) {
            // Internally consume our own API, send the token verification request
            $dispatcher = app('Dingo\Api\Dispatcher');
            $response = $dispatcher->post('v1/verify', ['token' => $token]);

            if (in_array($response['code'], $valid_codes)) {
                $request->session()->flash('alert-success', $response['message']);
            } elseif ($response['code'] == 404) {
                $request->session()->flash('alert-warning', 'That token could not be found!');
            } else {
                $request->session()->flash('alert-danger', $response['message'] . ' Error: ' . strval($response['code']));
            }

            $validator = Validator::make($response, [
                'verification_callback' => 'required|url'
            ]);

            if ($validator->validate()) {
                return redirect($response['verification_callback']);
            }
        }

        return view('verify');
    }
}
