<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function __construct()
    {

    }

    public function handle(Request $request)
    {
        try {
            Log::info('request', [$request->all()]);
        } catch (Exception $exception) {
            Log::error('in webhook catch => ', [$exception->getMessage()]);
        }
    }
}
