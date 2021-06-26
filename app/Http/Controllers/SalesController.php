<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view('upload-file');
    }
    public function upload()
    {
        if (request()->has('mycsv')) {

            $data = file(request()->mycsv);
            $header = $data[0];
            $chunks = array_chunk($data, 100);

            foreach ($chunks as $key => $chunk) {
                // $data = array_map('str_getcsv', $chunk);
                $name = "/temp{$key}.CSV";
                $path = resource_path('temp');
                file_put_contents($path . $name, $chunk);

                // return $path . $name;
                // if ($key === 0) {
                //     $header = $data[0];
                //     unset($data[0]);
                // }
            }


            return 'Done';
        }
        return "please upload file";
    }
}
