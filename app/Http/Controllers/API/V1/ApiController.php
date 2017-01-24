<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Unirest\Request\Body;
use Dingo\Api\Routing\Helpers;
use Unirest\Request as Unirequest;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use Helpers;

    /**
     * Authenticates with the ORM Core API and returns a JWT
     *
     * @param bool $force
     * @return string
     */
    public function authenticateWithOrm($force = false)
    {
        // Get a JWT from the cache
        $ormJwt = Cache::get('orm:core:asset_verification:jwt', false);
        // If we want to force reauth, the JWT is not there or empty
        if ($force || !$ormJwt || empty($ormJwt)) {
            // Grab the API Secret and API URL from the env file
            $ormKey = env('ORM_API_KEY', '');
            $ormUrl = fixPath(env('ORM_API_URL', ''));
            // Make sure we have the ORM Core url and key
            if (!empty($ormKey) && !empty($ormUrl)) {
                // Finish the URL
                $ormUrl = $ormUrl . 'auth/';
                // Build the Request body and send the request
                $body = Body::form(array('secret' => $ormKey));
                $response = Unirequest::post($ormUrl, array('Accept' => 'application/json'), $body);
                if ($response->code === 200) {
                    // Retrieve the JWT from the response body
                    $ormJwt = $response->body->token;
                    // Store the token in the cache for just under the token's ttl
                    Cache::put('orm:core:asset_verification:jwt', $ormJwt, Carbon::now()->addMinutes(59));
                } else {
                    // If the upstream API did not respond with a nice code, we throw an error.
                    return $this->response->errorInternal('Error communicating with upstream API! API Response Code: ' . $response->code);
                }
            } else {
                // Throw an error if we don't have the ORM URL or Key
                return $this->response->errorInternal('Missing ORM URL or API Key!');
            }
        }
        // Return the JWT session
        return $ormJwt;
    }
}
