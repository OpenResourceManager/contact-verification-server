<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use OpenResourceManager\Client\ResourceVerification as VerificationClient;


class TokenVerificationController extends ApiController
{
    /**
     * @param Request $request
     * @param null $token
     * @return \Dingo\Api\Http\Response|void
     */
    public function verify(Request $request, $token = null)
    {
        if ($request->isMethod('post') && empty($token)) {
            $data = $request->all();
            $token = $data['token'];
        }
        $orm = getORMConnection();
        $verifyClient = new VerificationClient($orm);
        $response = $verifyClient->postVerification($token);
        if ($response->code == 202) {
            return $this->response->accepted('/', ['message' => $response->body->message, 'code' => $response->code]);
        } elseif ($response->code == 404) {
            return $this->response->accepted('/', ['message' => $response->body->message, 'code' => $response->code]);
        } else {
            return $this->response->errorInternal($response->body->message, $response->code);
        }

    }

}
