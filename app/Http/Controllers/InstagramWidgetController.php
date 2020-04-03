<?php

namespace App\Http\Controllers;

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
        return $widgetData->getCachedWidgetData(request('hash'));
    }
}
