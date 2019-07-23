<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Application;
use App\Setting;

class DeployController extends Controller
{
    public function index()
    {
        $data['app'] = Application::where('status', 'Running')->first();
        $data['ip'] = Setting::find('leader_ip')->value;

        return view('pages.admin.deploy.index', $data);
    }

    public function deploy(Request $request)
    {
        try {
            // var_dump($request->all()); die();
            $ip = Setting::find('leader_ip')->value;
    
            $file = $request->file('yml');
            $app_name_cleaned = preg_replace('/[^\da-z._-]/i', '', $request->input('app_name'));
            $filename = $app_name_cleaned.'.'.$file->getClientOriginalExtension();
            $file->move(base_path('/scripts/app'), $filename);
            $endpoint = 'http://'.$ip.'/'.$request->input('endpoint');
            
            $args = [
                base_path('scripts/deploy_app.sh'),
                # args: [/full/path/to/app_docker_compose.yml] [app_name] [docker-swarm-ip] [/full/path/to/stack/definition] [http://app_service_target]
                base_path('scripts/app/'.$filename),
                $ip,
                base_path('scripts/stacks'),
                $endpoint
            ];
    
            // var_dump($args); die();
            
            $this->execute_command($args);
            
            $create_data = [
                'app_name' => $app_name_cleaned,
                'endpoint' => $endpoint,
                'status' => 'Running'
            ];
    
            Application::create($create_data);
    
            return response()->json('ok');
        } catch (\Exception $e) {
            $this->writeLog('error.log', 'deploy', $e);
            throw $e;
        }
    }

    public function writeLog($file = 'deploy.log', $process, $message)
    {
        $format = "-----------------------------------\n";
        $format .= Carbon::now()." | $process\n";
        $format .= "-----------------------------------\n";

        Storage::append("logs/$file", $format.$message);
    }

    public function execute_command($args)
    {
        //do deploy script
        $process = new Process($args);
        $process->setTimeout(300); //5mins timeout
        $process->run();
        
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            $exception = new ProcessFailedException($process);
            $this->writeLog('error.log', 'deploy', $exception->getMessage());
            throw $exception;
        }

        $this->writeLog('deploy.log', 'deploy', $process->getOutput());
    }

    public function deactive()
    {
        $app = Application::where('status', 'Running')->firstOrFail();

        $args = [
            base_path('scripts/remove_stack.sh'),
            'app'
        ];

        $this->execute_command($args);

        $update_data = [
            'status' => 'Deactived'
        ];

        $app->update($update_data);

        return back()->with('Service Deactived');
    }
}
