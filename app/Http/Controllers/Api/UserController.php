<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as ResourcesUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function users(){
        return ResourcesUser::collection(User::orderBy('id', 'desc')->get());
    }

    public function show(User $user)
    {
        return new ResourcesUser($user);
    }

    public function update(Request $request, $userId)
    {
        try{
            $user = User::find($userId);

            $request->validate([
                'lastname' => 'required|string',
                'firstname' => 'required|string',
            ]);

            $user->update([
                'lastname' => ucwords(strtolower(trim($request['lastname']))),
                'firstname' => ucwords(strtolower(trim($request['firstname']))),
            ]);

            if ($request->password and !empty(trim($request->password))) {
                $user->update([
                    'password' => bcrypt(trim($request->password)),
                ]);

                $data = ['name' => 'BPCE INFOGERANCE TECHNOLOGIES', 'title' => 'Votre mot de passe a ete modifié avec succes' , 'data' => 'nouveau mot de passe : '.trim($request->password)];

                $user['to'] = $user->email;

                Mail::send('mail', $data, function ($message) use ($user) {
                    $message->from('work@kokitechgroup.cm', 'BPCE Infos');
                    $message->to($user['to']);
                    $message->subject('MODIFICATION DU MOT DE PASSE');
                });
            }

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $currentDateTime = now()->format('Y-m-d_H-i-s');
                $milliseconds = round(microtime(true) * 1000);
                $filename = "IMG-{$currentDateTime}-{$milliseconds}.{$file->getClientOriginalExtension()}";
                $file->storeAs('avatars', $filename, 'public');
                $user->update([
                    'img' => $filename,
                ]);
            }

            return response()->json(['message' => 'User updated successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    public function setstate($id,$newState){
        try {
            $user = User::find($id);

            $user->update([
                'state' => $newState
            ]);

            if ($newState == "asset") {
                $header = "ACTIVATION DU COMPTE";
                $data = ['name' => 'BPCE INFOGERANCE TECHNOLOGIES', 'title' => 'Votre compte a été activé avec succès' , 'data' => 'Connectez vous pour acceder aux differents modules'];
            }else{
                $header = "DESACTIVATION DU COMPTE";
                $data = ['name' => 'BPCE INFOGERANCE TECHNOLOGIES', 'title' => 'Votre compte a été desactivé avec succès' , 'data' => ''];
            }

            $user['to'] = $user->email;

            Mail::send('mail', $data, function ($message) use ($user,$header) {
                $message->from('work@kokitechgroup.cm', 'BPCE Infos');
                $message->to($user['to']);
                $message->subject($header);
            });

            return response()->json(['message' => 'User state updated success'], Response::HTTP_OK);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }
}
