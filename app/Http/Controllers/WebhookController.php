<?php

namespace App\Http\Controllers;

use App\Utilities\Constant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected string $webHookSecretKey;

    public function __construct()
    {
        $this->webHookSecretKey = env('GITHUB_WEBHOOK_SECRET');
    }

    public function handle(Request $request)
    {
        try {
            // Get the X-Hub-Signature header
            $signature = $request->header('X-Hub-Signature');
//
//            // Compute the HMAC hex digest
            $payload = $request->getContent();
            Log::info('sig', [$signature]);
            // Compute the expected HMAC signature
            $computedSignature = 'sha1=' . hash_hmac('sha1', $payload, $this->webHookSecretKey);

            // Verify if the signature matches
            if (!hash_equals($computedSignature, $signature)) {
                Log::warning('Invalid signature', ['signature' => $signature, 'computed' => $computedSignature]);
                return response()->json(['error' => 'Invalid signature'], 403);
            }
//
//            // Handle the webhook payload
//            $payload = $request->all();
//
//            // Log the payload for debugging
//            Log::info('Webhook payload received:', $payload);
//
//            if ($request->header('X-GitHub-Event') === Constant::PRType['open']) {
//                $action = $payload['action'] ?? null;
//
//                // If the PR is opened
//                if ($action === Constant::PRAction['opened']) {
//                    Log::info('PR opened:', [
//                        'repository' => $payload['repository']['full_name'],
//                        'pull_request' => $payload['pull_request']
//                    ]);
//                }
//            }


        } catch (Exception $exception) {
            Log::error('in webhook catch => ', [$exception->getMessage()]);
        }
    }
}
