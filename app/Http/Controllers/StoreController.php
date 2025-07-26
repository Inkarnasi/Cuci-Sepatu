<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    private function authorizeSuperAdmin()
    {
        $login = auth()->user();
        if ($login == null) {
            return redirect()->route('login');
        }
        if (auth()->user()->role != 'superadmin') {
            return redirect()->route('store.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit store.');
        }
    }

    private function findStoreByUuid($uuid)
    {
        try {
            $store = Store::where('uuid', $uuid)->first();
            if (!$store) {
                return redirect()->route('store.index')->with('error', 'Store not found.');
            }
            return $store;
        } catch (Exception $e) {
            Log::error('Error finding store by UUID: ' . $e->getMessage());
            return redirect()->route('store.index')->with('error', 'An error occurred while fetching the store.');
        }
    }

    public function index()
    {
        $this->authorizeSuperAdmin();
        $dataStore = Store::select("uuid", "name", "description", "address", "longitude", "latitude", "phone", "email", "opening_time", "closing_time", "facebook_url", "instagram_url", "twitter_url", "tiktok_url")->first();
        return view('store.index', compact('dataStore'));
    }


    public function viewEditInformation($uuid)
    {
        $this->authorizeSuperAdmin();

        $dataStore = $this->findStoreByUuid($uuid);
        return view('store.edit-informasi', compact('dataStore'));
    }

    public function viewEditSocialMedia($uuid)
    {
        $this->authorizeSuperAdmin();

        $dataStore = $this->findStoreByUuid($uuid);
        return view('store.edit-social-media', compact('dataStore'));
    }


    public function updateStoreInformation(Request $request, $uuid)
    {
        $this->authorizeSuperAdmin();

        try {
            $store = $this->findStoreByUuid($uuid);

            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'address' => 'required|string',
                'longitude' => 'required|numeric',
                'latitude' => 'required|numeric',
                'phone' => 'required|string',
                'email' => 'required|email',
                'opening_time' => 'required|date_format:H:i:s',
                'closing_time' => 'required|date_format:H:i:s',
            ]);

            $store->update($request->only([
                'name',
                'description',
                'address',
                'longitude',
                'latitude',
                'phone',
                'email',
                'opening_time',
                'closing_time'
            ]));

            return redirect()->route('store.index')->with('success', 'Store information updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating store information: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the store information.');
        }
    }

    public function updateSocialMedia(Request $request, $uuid)
    {
        $this->authorizeSuperAdmin();

        try {
            $store = $this->findStoreByUuid($uuid);

            $request->validate([
                'facebook_url' => 'nullable|url',
                'instagram_url' => 'nullable|url',
                'twitter_url' => 'nullable|url',
                'tiktok_url' => 'nullable|url',
            ]);

            $store->update([
                'facebook_url' => $request->input('facebook_url'),
                'instagram_url' => $request->input('instagram_url'),
                'twitter_url' => $request->input('twitter_url'),
                'tiktok_url' => $request->input('tiktok_url')
            ]);

            return redirect()->route('store.index')->with('success', 'Social media links updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating social media links: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the social media links.');
        }
    }
}
