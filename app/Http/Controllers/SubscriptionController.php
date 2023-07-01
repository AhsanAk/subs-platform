<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {

        // Validate the request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'website_id' => 'required|exists:websites,id',
        ]);

        // Create a new subscription
        Subscription::create($validatedData);

        return response()->json(['message' => 'Subscription created successfully']);


    }

    public function subscribe(Request $request, $websiteId)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        $website = Website::findOrFail($websiteId);

        $subscriber = new Subscription([
            'email' => $request->input('email'),
        ]);

        $website->subscribers()->save($subscriber);

        return response()->json(['message' => 'Subscribed successfully'], 201);
    }
}
