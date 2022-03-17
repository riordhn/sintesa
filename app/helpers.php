<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('auth_data')) {
    /**
     * get auth data from session
     * @return auth_data
     */
    function auth_data()
    {
        return Session::get('auth_data');
    }
}

if (!function_exists('check_admin')) {
    /**
     * get auth data from session
     * @return auth_data
     */
    function check_admin()
    {
        return Session::get('status_user') == 1? true : false;
    }
}

if (!function_exists('success_response')) {
    /**
     * return success response of web operation
     * @param any $message ,
     * @param int $status_code,
     * @return array
     */
    function success_response($message, $payload_data = [], $status_code = 200)
    {
        $return_array = [
            'status' => 'Success',
            'status_code' => $status_code,
            'message' => $message,
        ];

        if(!empty($payload_data)){
            $return_array['data'] = $payload_data;
        }

        return response()->json($return_array);
    }
}

if (!function_exists('error_response')) {
    /**
     * return error response of web operation
     * @param any $message ,
     * @param int $status_code,
     * @return array
     */
    function error_response($message, $payload_data = [], $status_code = 300)
    {
        if ($message instanceof Exception) {
            $message = isDebugMode() ? $message->getMessage() : 'Failed code ' . $message->getLine();
        }

        $return_array = [
            'status' => 'Failed',
            'status_code' => $status_code,
            'message' => $message,
        ];

        if(!empty($payload_data)){
            $return_array['data'] = $payload_data;
        }

        return response()->json($return_array);
    }
}

if (!function_exists('isDebugMode')) {
    /**
     * check is debug mode of the system active
     * @return array
     */
    function isDebugMode()
    {
        return env('APP_DEBUG', 'true') == 'true';
    }
}