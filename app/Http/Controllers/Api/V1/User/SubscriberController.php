<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class SubscriberController extends BaseController
{
    /**
     * @throws ValidationException
     */
    public function receiveMessage(Request $request): \Illuminate\Http\JsonResponse
    {

        //validate requests
        $validator = Validator::make($request->all(), [
            'message' => ['required', 'string', 'max:1000'],
            'created_at' => ['required', 'date']
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->messages());
        }
        $validated = $validator->validated();

        //print message to
        $random = rand(1, 100).date('YmdHis');
        $file = fopen('message_'.$random.'.txt', 'a');
        fwrite($file, $validated['message'] . ' ' . $validated['created_at'] . PHP_EOL);
        fclose($file);

        //print message to console for testing
        //echo $validated['message'] . ' ' . $validated['created_at'] . PHP_EOL;


        $data = [
            'message' => $validated['message'],
            'created_at' => $validated['created_at']
        ];
        return $this->sendResponse($data, 'Message received successfully');
    }
}
