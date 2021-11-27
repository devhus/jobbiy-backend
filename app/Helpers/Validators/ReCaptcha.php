<?php
namespace App\Helpers\Validators;

use GuzzleHttp\Client;
use Log;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $client   = new Client;
        logger([config('services.recaptcha.secret'), request()->ip() ?? null, $value]);
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                [
                    'secret'   => config('services.recaptcha.secret'),
                    'response' => $value,
                    'remoteip' => request()->ip() ?? null,
                ],
            ]
        );
        $body = json_decode((string) $response->getBody());
        return $body->success;
    }
}
