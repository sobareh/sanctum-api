<?php

    namespace App\Traits;

    trait ResponseAPI {

        public function coreResponse(
            $message,
            $data = null,
            $statusCode,
            $isSuccess = true
        ) {
            !$message && response()->json([
                'message' => 'Message is required'
            ], 500);

            if ($isSuccess) {
                return response()->json([
                    'meta' => [
                        'message' => $message,
                        'success' => true,
                        'status_code' => $statusCode,
                    ],
                    'data' => $data
                ], $statusCode);
            } 
            
            if(!$isSuccess){
                return response()->json([
                    'message' => $message,
                    'success' => false,
                    'status_code' => $statusCode
                ], $statusCode);
            }
        }

        public function success($message, $data = null, $statusCode = 200) {
            return $this->coreResponse($message,$data,$statusCode);
        }

        public function error($message, $statuscode = 500) {
            return $this->coreResponse($message, null,$statuscode, false);
        }
    }
