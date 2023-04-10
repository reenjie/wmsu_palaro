<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\College;
use App\Models\Sportevent;
use App\Models\Videolink;
use Illuminate\Http\Request;

use Spatie\Backup\Tasks\Backup\BackupJob;
use Spatie\Backup\Tasks\Backup\DbDumperFactory;

use Spatie\DbDumper\Databases\MySql;

use Spatie\Backup\Tasks\Backup\BackupDestination\BackupName;
use Spatie\Backup\Tasks\Backup\BackupDestination\BackupDestination;


use App\Services\DatabaseBackupService;

class ajax extends Controller
{
    public function validate_email(Request $request)
    {
        $email =  $request->val;
        $eventid =  $request->id;
        try {
            $user = User::where('email', $email)->where('user_type', 'student')->get();
            $sport = Sportevent::where('id', $eventid)->where('batch',session()->get('batch'))->get();

            foreach ($sport as $row) {
                $sports_col = $row->CollegeId;
            }

            foreach ($user as $row) {
                $col =  $row->CollegeId;
            }

            if ($sports_col == $col) {
                echo "join";
            } else {
                echo "cantjoin";
            }
        } catch (\Throwable $th) {
            echo "error";
        }
    }

    public function change_video(Request $request)
    {
        $vlink =  $request->id;

        $mlink = Videolink::where('id', $vlink)->where('batch',session()->get('batch'))->get();

        foreach ($mlink as $row) {
            $link = $row->video;
            $vtype = $row->videotype;
        }

        if ($vtype == 'youtube') {
            echo ' <iframe id="ycvideo"  width="400" height="315" src="' . $link . '" frameborder="0" allowfullscreen></iframe> ';
        } else if ($vtype == 'facebook') {
            echo $link;
        }
    }


    public function fetchtally(Request $request)
    {
        $types = $request->types;

        $college = College::all();
        $sportevent = Sportevent::where('batch',session()->get('batch'));
        return view('fetchtally', compact('college', 'types', 'sportevent'));
    }

    public function reset(Request $request)
    {
        // $databaseName = env('DB_DATABASE');
        // $databaseUsername = env('DB_DATABASE');
        // $databasePassword = env('DB_DATABASE');
        // $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        // $backupFilePath = resource_path('backup/' . $backupFileName);

        // $command = "mysqldump --opt -h " . env('DB_HOST') . " -u $databaseUsername -p$databasePassword $databaseName > $backupFilePath";

        // exec($command);

        // return $backupFilePath;

        $backupService = new DatabaseBackupService();
        $backupFilePath = $backupService->createBackup();

        return response()->download($backupFilePath);
    }
}
