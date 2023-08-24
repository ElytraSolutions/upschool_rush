<?php

namespace App\CustomErrors;

class Errors {
    public static function missing($missing) {
        return function ($exception) use ($missing) {
            return response()->json([
                'success' => false,
                'message' => $missing
            ], 404);
        };
    }
}
