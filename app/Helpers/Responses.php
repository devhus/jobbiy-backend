<?php
namespace App\Helpers;

class Responses
{
    public function error(
        string $message = null,
        $errors = null,
        int $httpStatus = 403
    ) {
        if (!$message) {
            $message = "Something went wrong.";
        }
        $response = [
            'status' => 'error',
            'message' => $message,
        ];
        if ($errors !== null) {
            $response['errors'] = is_array($errors) ? $errors : [$errors];
        }
        return response($response, $httpStatus);
    }

    public function success(
        string $message = null,
        $data = null,
        int $httpStatus = 200
    ) {
        if (!$message) {
            $message = "Process Succeed.";
        }
        $response = [
            'status' => 'success',
            'message' => $message,
        ];
        if ($data !== null) {
            $response['data'] = $data;
        }
        return response($response, $httpStatus);
    }
}
