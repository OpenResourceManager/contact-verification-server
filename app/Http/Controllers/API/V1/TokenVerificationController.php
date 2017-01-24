<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Unirest\Request\Body;
use Unirest\Request as Unirequest;

class TokenVerificationController extends ApiController
{

    public function verify(Request $request, $token = null)
    {
        if ($request->isMethod('post') && empty($token)) {
            $data = $request->all();
            $token = $data['token'];
        }
        $ormUrl = fixPath(env('ORM_API_URL', ''));
        if (!empty($ormUrl)) {
            $jwt = $this->authenticateWithOrm();
            $ormUrl = $ormUrl . 'verify/';
            $body = Body::form(array('token' => $token));
            $headers = array('Accept' => 'application/json', 'Authorization' => 'Bearer ' . $jwt);
            $response = Unirequest::post($ormUrl, $headers, $body);
            if ($response->code == 202) {
                return $this->response->accepted('/', ['message' => $response->body->message, 'code' => $response->code]);
            } elseif ($response->code == 404) {
                return $this->response->accepted('/', ['message' => $response->body->message, 'code' => $response->code]);
            } else {
                return $this->response->errorInternal($response->body->message, $response->code);
            }
        } else {
            // Throw an error if we don't have the ORM URL or Key
            return $this->response->errorInternal('Missing ORM URL!');
        }
    }

}
