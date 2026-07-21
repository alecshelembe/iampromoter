<?php

namespace App\Http\Controllers;

use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Show notification form.
     */
    public function index()
    {
        $devices = UserLocation::whereNotNull('expo_push_token')
            ->orderBy('updated_at', 'desc')
            ->get()
	    ->unique('expo_push_token');

        return view('mobile.notify', compact('devices'));
    }

    /**
     * Send notifications.
     */
    public function sendBulk(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'device' => 'required'
        ]);

        if ($request->device === 'All') {
            $expoTokens = UserLocation::whereNotNull('expo_push_token')
                ->pluck('expo_push_token')
		->unique('expo_push_token');

        } else {
            $expoTokens = UserLocation::where('expo_push_token', $request->device)
                ->pluck('expo_push_token')
		->unique('expo_push_token');
        }

        if ($expoTokens->isEmpty()) {
            return back()->with('error', 'No Expo tokens found.');
        }

        foreach ($expoTokens as $expoToken) {

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post('https://exp.host/--/api/v2/push/send', [
                'to'    => $expoToken,
                'title' => $request->title,
                'body'  => $request->description,
            ]);

            Log::info('Bulk Notification Sent', [
                'token' => $expoToken,
                'status' => $response->status(),
                'response' => $response->json(),
            ]);
        }

        return back()->with('success', 'Notification sent to '.$expoTokens->count().' device(s).');
    }
}
