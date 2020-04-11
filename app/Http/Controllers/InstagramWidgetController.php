<?php

namespace App\Http\Controllers;

use App\Exceptions\Instagram\InstagramWidgetException;
use App\Instagram\InstagramWidgetData;
use App\User;
use Illuminate\Http\Request;

class InstagramWidgetController extends Controller
{
    public function index()
    {
        return view();//TODO: вставить view
    }

    public function getData(InstagramWidgetData $widgetData)
    {
        request()->validate([
            'hash' => 'required'
        ]);
        try {
            return $widgetData->getCachedWidgetData(request('hash'));
        } catch (InstagramWidgetException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
