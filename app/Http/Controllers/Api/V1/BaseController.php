<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller as Controller;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


/**
 * @method __construct()
 */
class BaseController extends Controller
{
    /**
     * success response method.
     * @result mixed the returned result
     * @message string
     * @responseCode \Illuminate\Http\Response
     *
     * @param $result
     * @param $message
     * @param int $responseCode
     * @return JsonResponse
     */
    public function sendResponse($result, $message, int $responseCode = ResponseAlias::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, $responseCode);
    }


    /**
     * return error response.
     * @param string $error error message
     * @param array $errorMessages array of messages
     *
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error,  $errorMessages = [], int $code = ResponseAlias::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            if ($errorMessages instanceof MessageBag) {

                $errorMessages->add('error', $errorMessages->first());
                $response['message'] = $errorMessages->first(); //put the first error inside message
            }
            $response['data'] = $errorMessages;
        } else {
            $response['data'] = ['error' => "$error"];
        }


        return response()->json($response, $code);
    }


}
