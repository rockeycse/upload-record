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

            $data = array_map('str_getcsv', file(request()->mycsv));
            $header = $data[0];
            $chunks = array_chunk($data, 1000);

            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                $name = '';
                file_put_contents();
                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
            }


            return 'Done';
        }
        return "please upload file";
    }
}
