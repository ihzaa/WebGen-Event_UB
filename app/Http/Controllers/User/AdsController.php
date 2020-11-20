<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ad;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function getLatesAd()
    {
        $ad = ad::orderBy('updated_at', 'asc')->first();
        if ($ad == []) {
            return response()->json([]);
        } else {
            $ad->updated_at = Carbon::now();
            $ad->save();
            return response()->json(["image" => $ad->image, "desc" => $ad->desc]);
        }
    }
}
