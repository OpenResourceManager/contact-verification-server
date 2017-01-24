<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyFrontEndController extends Controller
{

    public function verify(Request $request, $token = null)
    {
        if ($request->isMethod('post') && empty($token)) {
            $data = $request->all();
            $token = $data['token'];
        }

        if (!empty($token)) {
            // Internally consume our own API, send the token verification request
            $dispatcher = app('Dingo\Api\Dispatcher');
            $response = $dispatcher->post('v1/verify', ['token' => $token]);
            if ($response['code'] == 202) {
                $request->session()->flash('alert-success', $response['message']);
            } elseif ($response['code'] == 404) {
                $request->session()->flash('alert-warning', 'That token could not be found!');
            } else {
                $request->session()->flash('alert-danger', $response['message'] . ' Error: ' . strval($response['code']));
            }
        }

        return view('verify');
    }
}
