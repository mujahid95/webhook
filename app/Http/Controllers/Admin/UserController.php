<?php

namespace App\Http\Controllers\Admin;

use App\HelperModule\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utilities\Constant;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return User::latest()->get();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'string'],
            ]);

            if ($validation->fails()) return Helper::jsonResponse(Constant::fail, $validation->errors()->first());

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return Helper::jsonResponse(Constant::success, 'success', $user);

        } catch (Exception $e) {
            return Helper::jsonResponse(Constant::fail, $e->getMessage());
        }
    }
}
