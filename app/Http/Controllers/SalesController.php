<?php

namespace App\Http\Controllers;

use App\Jobs\SalesCsvProcess;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        return view('upload-file');
    }
    public function upload()
    {
        if (request()->has('mycsv')) {
            $ext = request()->file('mycsv')->getClientOriginalExtension();
            if ($ext == 'CSV' or $ext == 'csv') {


                $data   =   file(request()->mycsv);
                // Chunking file
                $chunks = array_chunk($data, 300);

                $header = [];
                $batch  = Bus::batch([])->dispatch();

                $i = 0;
                foreach ($chunks as $key => $chunk) {
                    $data = array_map('str_getcsv', $chunk);

                    if ($key === 0) {
                        $header = $data[0];
                        unset($data[0]);
                    }

                    // SalesCsvProcess::dispatch($data, $header);
                    $batch->add(new SalesCsvProcess($data, $header));
                    if ($i == 10) {
                        return "Data Stored";
                    } else {
                        $i++;
                    }
                }


                return $batch;
            }else{
                return "Please Upload CSV file only";
            }
        }

        return 'please upload file';
    }
    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }
}
