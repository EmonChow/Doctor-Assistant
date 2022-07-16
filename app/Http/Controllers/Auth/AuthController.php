<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\SideNavMenu;
use App\Models\User;
use App\Rules\MatchCurrentPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Jenssegers\Agent\Agent;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $agent = new Agent();
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->firstOrFail();
            // TODO : Store Device Store
            return response()->json($user->createToken("{$agent->platform()} | {$agent->browser()}", ["*"])->plainTextToken);
        }
        return response()->json(['message' => 'The given data was invalid.',
            'errors' => ['email' => ['The provided credentials do not match our records']]], 422);
    }

    /**
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return response()->json(['message' => 'User saved successfully']);
        }
        return response()->json(['error' => 'Bad Request'], 400);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function forgotPassword(Request $request): bool
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT;
    }


    /**
     * @param Request $request
     * @return bool
     */
    public function checkToken(Request $request): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['data' => 'token removed']);
    }

    /**
     * @param Request $request
     * @return mixed
     * TODO : it should return the sidebar as well
     */
    public function currentUser(Request $request)
    {
        $menus = SideNavMenu::where('role_id', $request->user()->roles->first()->id)->first();
        $user = $request->user();
        $user['name'] = $request->user()->name;
        $user['menus'] = json_decode($menus->menu_json);
        return $user;
    }


    public function changeEmailAddress(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:6', 'max:40', new MatchCurrentPassword()],
            'email' => 'required|email',
        ]);
        User::find(auth()->user()->id)->update(['email' => $request->email]);
        return response()->json(['message' => 'Password changed successfully']);
    }
}
