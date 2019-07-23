<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $data['settings'] = Setting::pluck('value', 'id');
        return view('pages.admin.settings.index', $data);
    }

    public function save(Request $request)
    {
        $data = $request->except(['_token']);
        foreach ($data as $key => $value) {
            $id = ['id' => $key];
            $value = ['value' => $value];
            Setting::updateOrCreate($id, $value);
        }

        return back();
    }
}
