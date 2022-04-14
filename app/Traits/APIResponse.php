<?php

namespace App\Traits;

use Lang;

trait APIResponse
{
    /**
     * Response success by json.
     *
     * @param $data data
     * @param $code code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function responseData($data = null, $code = 200)
    {
        return response()->json($data, $code);
    }

    /**
     * Response success by json.
     *
     * @param $data    data
     * @param $message message
     * @param $code    code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data = null, $message = null, $code = 200)
    {
        if (is_null($data)) {
            return response()->json([
                'message'   => $message ?? Lang::get('common.successfully')
            ], $code);
        }
        return response()->json([
            'message'   => $message ?? Lang::get('common.successfully'),
            'data'      => $data,
        ], $code);
    }

    /**
     * Response error(s) by json.
     *
     * @param $errors  errors
     * @param $message message
     * @param $code    code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($errors = [], $message = null, $code = 400)
    {
        $response = [
            'message'   => $message ?? Lang::get('common.error'),
            'errors'    => $errors,
        ];

        return response()->json($response, $code);
    }

    /**
     * Response error(s) validate by json.
     *
     * @param $errors  errors
     * @param $message message
     * @param $code    code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function validateErrorResponse($errors, $message = null, $code = 422)
    {
        $response = [
            'message'   => $message ?? Lang::get('common.validation_error'),
            'errors'    => $errors,
        ];

        return $this->responseData($response, $code);
    }
}