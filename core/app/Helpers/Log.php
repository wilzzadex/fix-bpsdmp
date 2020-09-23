<?php
namespace App\Helpers;
// use App\Log;
use Illuminate\Support\Facades\DB;

class Log {
    public static function createLog($user_id,$action,$page) {
        $log = new \App\Log();
        $log->user_id = $user_id;
        $log->action = $action;
        $log->page = $page;
        $log->save();
    }
}