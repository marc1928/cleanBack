<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' => 'required|string|email|regex:/@bpce-it\.fr$/i|exists:users,email',
            'password' => 'required|string',
        ]);

        $credentials = $request->all();

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'your password is incorrect'
            ],422);
        }

        /** @var User $user */
        $user = Auth::user();

        if ($user->state == 'waiting_for') {
            return response([
                'message' => 'account waiting for validation',
                'state' => $user->state
            ],500);
        }

        if ($user->state == 'idle') {
            return response([
                'message' => 'account waiting for validation',
                'state' => $user->state
            ],500);
        }

        $token = $user->createToken('main')->plainTextToken;

        return response(compact('user','token'));
    }

    public function forgetPassword($email = null)
    {
        $user = User::where('email', $email)->first();

        if ($user === null) {
            return response([
                'errormessage' => 'User not found'
            ],422);
        }

        $newPassword = strtolower(Str::random(7));

        $user->update([
            'password' => bcrypt($newPassword),
        ]);

        $data = ['name' => 'BPCE INFOGERANCE TECHNOLOGIES', 'title' => 'Votre mot de passe a ete modifié avec succes' , 'data' => 'nouveau mot de passe : '.$newPassword];

        $user['to'] = $user->email;

        Mail::send('mail', $data, function ($message) use ($user) {
            $message->from('work@kokitechgroup.cm', 'BPCE Infos');
            $message->to($user['to']);
            $message->subject('RENITIALISATION DU MOT DE PASSE');
        });

        return response()->json(['message' => 'Password renitialisation success'], Response::HTTP_OK);

    }

    public function signup(Request $request){

        try {
            $request->validate([
                'lastname' => 'required|string',
                'firstname' => 'required|string',
                'email' => 'required|string|email|regex:/@bpce-it\.fr$/i|unique:users,email',
                'matricule' => 'required|string|starts_with:B|unique:users,matricule',
                'password' => 'required|string|min:7',
                'state' => 'required|string',
                'role' => 'required|string',
            ]);

            $user = User::create([
                'lastname' => ucwords(strtolower(trim($request['lastname']))),
                'firstname' => ucwords(strtolower(trim($request['firstname']))),
                'email' => trim($request['email']),
                'matricule' => trim($request['matricule']),
                'password' => bcrypt(trim($request['password'])),
                'img' => null,
                'state' => trim($request['state']),
                'role' => trim($request['role']),
            ]);

            // $data = ['name' => 'BPCE INFOGERANCE TECHNOLOGIES', 'title' => 'Votre compte a ete crée avec succès' , 'data' => 'Patientez quelques instants afin qu\'il soit activé. s\'il ne l\'est pas dans les 5 minutes suivantes, veillez contacter le service informatique'];

            // $user['to'] = $user->email;

            // Mail::send('mail', $data, function ($message) use ($user) {
            //     $message->from('work@kokitechgroup.cm', 'BPCE Infos');
            //     $message->to($user['to']);
            //     $message->subject('CREATION DU COMPTE');
            // });

            $token = $user->createToken('main')->plainTextToken;

            return response(compact('user','token'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    public function logout(Request $request){
      $user = $request->user();
      $user->currentAccessToken()->delete();
      return response('',204);
    }
}
