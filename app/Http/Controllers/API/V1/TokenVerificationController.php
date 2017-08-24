<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use OpenResourceManager\Client\ResourceVerification as VerificationClient;


class TokenVerificationController extends ApiController
{
    /**
     * @param Request $request
     * @param null $token
     * @return \Dingo\Api\Http\Response
     */
    public function verify(Request $request, $token = null)
    {
        $valid_codes = [200, 202, 404];
        if ($request->isMethod('post') && empty($token)) {
            $data = $request->all();
            $token = $data['token'];
        }
        $orm = getORMConnection();
        $verifyClient = new VerificationClient($orm);
        $response = $verifyClient->postVerification($token);
        if (in_array($response->code, $valid_codes)) {
            return $this->response->accepted('/', ['message' => $response->body->message, 'code' => $response->code, 'verification_callback' => $response->body->verification_callback, 'upstream_app_name' => $response->body->upstream_app_name]);
        } else {
            return $this->response->errorNotFound($response->body->message, $response->code);
        }
    }
}
