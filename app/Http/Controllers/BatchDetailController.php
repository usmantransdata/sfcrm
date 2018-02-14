<?php

namespace App\Http\Controllers;

use App\BatchDetail;
use App\BatchStatus;
use App\OrderBatch;
use App\CompanyManager;
use App\BatchLog;
use Illuminate\Http\Request;
use DB;
use Auth;

class BatchDetailController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()){
           // print_r(Auth::user()->role_id);dd();
            if(Auth::user()->role_id==2 || Auth::user()->role_id==5 || Auth::user()->role_id==4){

        $orderBatch = BatchDetail::with('client')->with('batchStatus')->get();
        return view('data.view', compact('orderBatch'));
                     }else{

                        return redirect()->back();
                     }

     }
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $validatoin =  $this->validate($request,[
          'dataToggle' => 'required|string|max:255',
            ]); 
        print_r($request->all());dd();
            if($request->has('dataToggle')){
               echo "string";dd();
            }
            else{
                echo "dd";dd();
            }
        //print_r($request->all());dd();
    }

    public function statusChanged(Request $request){
       // print_r($request->all());dd();
         if(isset($request['inProcess_staus'])){
           // echo "string";dd();

             $status = BatchStatus::find($request['inProcess_staus']);
             $batchLog = new BatchLog();
           $batchLog->batch_status_id = $status->id;
           $batchLog->status_change_date = \Carbon\Carbon::now()->format('Y-m-d');
           $batchLog->updated_by = Auth::user()->id;
           $batchLog->save();
            BatchDetail::where('id', '=', $request['client_id'])->update(['status_id'=>$request['inProcess_staus']]);
           
        }    
        if(isset($request['startQa_status'])){
           // echo "string";dd();
           // print_r($request['client_id']);dd();

            $status = BatchStatus::find($request['startQa_status']);
             $batchLog = new BatchLog();
           $batchLog->batch_status_id = $status->id;
           $batchLog->status_change_date = \Carbon\Carbon::now()->format('Y-m-d');
           $batchLog->updated_by = Auth::user()->id;
           $batchLog->save();
            BatchDetail::where('id', '=', $request['client_id'])->update(['status_id'=>$request['startQa_status']]);
            // return redirect()->route('viewData');
        }    

         if(isset($request['pendindStatus'])){
           // echo "string";dd();
            //print_r($request['pendindStatus']);dd();
            $status = BatchStatus::find($request['pendindStatus']);
            //print_r($status->id);dd();
           $batchLog = new BatchLog();
           $batchLog->batch_status_id = $status->id;
           $batchLog->status_change_date = \Carbon\Carbon::now()->format('Y-m-d');
           $batchLog->updated_by = Auth::user()->id;
           $batchLog->save();

            BatchDetail::where('id', '=', $request['client_id'])->update(['status_id'=>$request['pendindStatus']]);
             }        
      return redirect()->route('viewData');
    }

     public function statusChangedManager($id){

        $changeStatus = BatchDetail::where('id', '=', $id)->update(['status_id'=>3]);

     
      return redirect()->route('viewData');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BatchDetail  $batchDetail
     * @return \Illuminate\Http\Response
     */
    public function show(BatchDetail $batchDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BatchDetail  $batchDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(BatchDetail $batchDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BatchDetail  $batchDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BatchDetail $batchDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BatchDetail  $batchDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BatchDetail $batchDetail)
    {
        //
    }
}
