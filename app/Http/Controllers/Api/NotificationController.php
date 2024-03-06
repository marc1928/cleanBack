<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification as ResourcesNotification;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public function getNotification($userId = null)
    {
        return ResourcesNotification::collection(Notification::with('user')->where('user_id', $userId)->orderBy('id', 'desc')->get());
    }

    public function getNotificationUnRead($userId = null)
    {
        return ResourcesNotification::collection(Notification::with('user')->where('user_id', $userId)->where('state', 'unread')->orderBy('id', 'desc')->get());
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'content' => 'required',
                'state' => 'required|string',
                'type' => 'required|string',
            ]);

            Notification::create([
                'user_id' => trim($request['user_id']),
                'content' => trim($request['content']),
                'state' => trim($request['state']),
                'type' => trim($request['type']),
            ]);

            return response()->json(['message' => 'Notification added sucess']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    public function update($id,$newState)
    {
        try {
            $notification = Notification::find($id);

            $notification->update([
                'state' => $newState
            ]);

            return response()->json(['message' => 'Notification state updated success'], Response::HTTP_OK);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }
}
