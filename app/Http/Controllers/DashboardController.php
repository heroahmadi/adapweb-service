<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class DashboardController extends Controller
{
    public function index() //default dashboard: grafana
    {
        $ip = Setting::find('leader_ip')->value;
        
        $apps = [
            'grafana' => 'http://'.$ip.':3000',
            'prometheus' => 'http://'.$ip.':9090',
            'jenkins' => 'http://'.$ip.':8080/blue/organizations/jenkins/pipelines',
            'traefik' => 'http://'.$ip.':8888'
        ];
        $data = [
            'apps' => $apps,
        ];
        
        return view('pages.admin.dashboard.index', $data);
    }
}
