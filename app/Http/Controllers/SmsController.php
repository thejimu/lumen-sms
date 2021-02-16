<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller {

    /**
     * Send a text message via gammu command line
     *
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request) {
        $data = $request->all();
        unset($data['token']);

        try {
            $output = exec('echo "'.$data['text'].'" | gammu-smsd-inject TEXT '.$data['number']);
        } catch(\Exception $e) {
            return response($e->getMessage(), '500');
        }

        return response($output, '200');

    }

    /**
     * Get data from Gammu tables
     *
     * @param Request $request
     * @param $table
     * @return mixed
     */
    public function getLog(Request $request, $table) {
        try {
            $result = DB::table($table)->get()->all();
        } catch (\Exception $e) {
            return response($e->getMessage(), '500');
        }

        return response($result, '200');
    }



}
