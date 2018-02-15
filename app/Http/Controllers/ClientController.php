<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CsvImportRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Client;
use App\User;
use App\OrderBatch;
use App\BatchDetail;
use App\CotentBatch;
use App\CompanyManager;
use Excel;
use Session;  
use Auth;
use DB;
use Mail;
use App\Mail\VerifyMail;
use App\VerifyUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ClientController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::check()){
            if(Auth::user()->role_id == 1){
               $CompanyManager = User::where('role_id', '=', 2)->get();
                return view('clients.create', compact('CompanyManager'));
            }
                else{
                  return redirect()->back();
                }
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processImport(Request $request)
    {
      $input = $request->all(); 
      
       $path = "storage/app/".$input['filename'];
       $data = Excel::load($path, function($reader) {})->get()->toArray();
       $id = Auth::user()->id; 
                
                $batch_detail = new  BatchDetail();
                $batch_detail->uploader_id = $id;
                $batch_detail->client_id = $input['company'];
                $batch_detail->batch_name = $input['batch_name'];
                $batch_detail->status_id = 1;
                $batch_detail->instructions = $input['instructions'];
              //  $batch_detail->total_record_count = count();
               // $batch_detail->total_record_count = count();
              //  dd($batch_detail);
               $batch_detail->save();
               $cols = array();
               $count = 0; 
               //echo "<pre>";
               //print_r($input['first_name']);
               //print_r($data);
               //echo $input['firstname'];
               echo $batch_detail->id;
               //dd();
              

               foreach ($data as $key => $value) {
                   // print_r($row);dd();
                   /*foreach ($row as $value) {*/
                   // print_r($value);dd();
                    $count++;
                    //$firstname=$value[];
                    $cols['batch_id'] = $batch_detail->id;
                    $cols['first_name'] =$value[$input['first_name']];
                    $cols['last_name'] =$value[$input['last_name']];
                     $cols['title'] =$value[$input['title']];
                    $cols['company_name'] =$value[$input['company_name']];
                    $cols['email1'] =$value[$input['email1']];
                    $cols['email2'] =$value[$input['email2']];
                    $cols['email3'] =$value[$input['email3']];
                    $cols['phone_number1'] =$value[$input['phone_number1']];
                    $cols['phone_number2'] =$value[$input['phone_number2']];
                    $cols['phone_number3'] =$value[$input['phone_number3']];
                    $cols['address1'] =$value[$input['address1']];
                    $cols['address2'] =$value[$input['address2']];
                    $cols['address3'] =$value[$input['address3']];
                    $cols['city'] =$value[$input['city']];
                    $cols['state'] =$value[$input['state']];
                    $cols['zip'] =$value[$input['zip']];
                    $cols['country'] =$value[$input['country']];
                    $cols['disposition'] ='';
                    $cols['validation'] ='';
                    $cols['health_status'] ='';

                    $data = CotentBatch::create($cols);
                   
                  
                }
                BatchDetail::where('id', $batch_detail->id)->update(array('total_record_count' => $count));
                return redirect()->route('viewData')->with('message', 'You successfully added new batch order!!');

      
      
    }
    public function readcsv(Request $request)
    {
    
    $input = $request->all(); 
    
    $filename = $request->file('csv_file')->getClientOriginalName();
    $path=$request->file('csv_file')->storeAs('csv', $filename);
    //print_r($path);
    //dd();
    $fullpath="storage/app/";
     //Excel::load($request->file('uploaded_file')->getRealPath(), function ($reader) {
    if ($request->has('header')) {
        $data = Excel::load($fullpath.$path, function($reader) {})->get()->toArray();
    } else {
        $data = array_map('str_getcsv', file($fullpath.$path));
    }
    //print_r($data);
    $filename=$path;
    //dd();
    $contentbatch = new CotentBatch;
    $tablecolums = $contentbatch->getTableColumns();
    //print_r($tablecolums);
    
   $csv_header_fields=array_keys($data[0]);
    //print_r(array_keys($data[0]));
//print_r(sizeof($data));
   
    if (sizeof($data) > 0) {
        if ($request->has('header')) {
            $csv_header_fields = [];
            foreach ($data[0] as $key => $value) {
                $csv_header_fields[] = $key;
            }
        }
        $csv_data = $data;
        $batch_name=$input['batch_name'];
        $due_date=$input['due_date'];
        $instructions=$input['instructions']; 
        $header=$input['header'];
        $company=$input['company'];
      
     //print_r(($data));   
    } else {
        return redirect()->back();
    }
 //dd();
    return view('data.choose_fields', compact('company','batch_name','due_date','instructions','header', 'filename','csv_header_fields', 'csv_data', 'tablecolums'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
     // print_r($input);dd();
       
        $validatoin =  $this->validate($request,[
          'organization_name' => 'required|string|max:255|unique:client',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            //'phone_number' => 'required|regex:/(01)[0-9]{9}'
            'phone_number' => 'required|regex:/(01)[0-9]{9}/'

          ]); 

          if ($validatoin) {

         $client = new Client;
       
           $client->organization_name = $input['organization_name'];
           $client->contact_first_name = $input['first_name'];
           $client->contact_last_name = $input['last_name'];
           $client->contact_person_email = $input['email'];
           $client->contact__person_phoneNumber = $input['phone_number'];
           $client->address1 = $input['address1'];
           $client->address2 = $input['address2'];
           $client->country = $input['country'];
           $client->city = $input['city'];
           $client->zip = $input['zip'];
           $client->state = $input['state'];
           $client->save();

             $user = User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'role_id' => '5',
            'client_id' => $client->id,
            //'password' => bcrypt($data['password']),
        ]);

        if(isset($input['manager_name'])){

          \App\CompanyManager::create([
            'user_id' => $input['manager_name'],
            'client_id' => $client->id,
        ]);

          if(isset($input['switch-field-1'])){
            if($input['switch-field-1'] == 'on'){
             // echo "string";dd();
            $enableUser = User::findOrFail($user->id);
            $enableUser->acount_status = 1;
            $enableUser->save();
              }else{
                  $enableUser = User::findOrFail($user->id);
            $enableUser->acount_status = 0;
            $enableUser->save();
              }
          }

           $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
 
        Mail::to($user->email)->send(new VerifyMail($user));
 

            return redirect()->route('client.view')
            ->with('flash_message',
             'User successfully added.');
        
        }else{
            
              return back()->with('error_message',
             'You are facing some error while saving new client please refresh and try again');
        }
    }

  }

    public function compareUpdateFile(){
      echo "string";dd();
    }
    //after complete data user will clik on batch completed 
    //
    public function completedBatch($id){

      $completedBatch = OrderBatch::where('batch_id', '=', $id)->get();

      return view('data.completeData', compact('completedBatch'));
    }


    //compare files 
    public function compareFiles(Request $request){
     // print_r($request->all());dd();
       $cols = array();
       $orderBatach=array();
             $input = $request->all();
          if($request->hasFile('uploaded_file')){
          //  echo "string";dd();
            //$existingdata=[];
           Excel::load($request->file('uploaded_file')->getRealPath(), function ($reader) {
               $count = 0; 
              // print_r($input);dd();
               $existingdata = OrderBatch::where('batch_id', '=', Input::get('file_id'))->get()->toArray();
               $importdata=$reader->toArray();
               $oldids=array();
               $importids=array();
               $badrecords=0;
               $goodrecords=0;
              //echo "<pre>";
              /*  print_r($existingdata);*/
               for($i=0;$i<sizeof($importdata);$i++)
               {
               $importids[]=$importdata[$i]['id'];
               }

                for($j=0;$j<sizeof($existingdata);$j++)
                
                {                  
                                  
                      if(in_array($existingdata[$j]['id'], $importids))
                        {
                          $key=array_search($existingdata[$j]['id'],$importids);
                                $status=0;    //echo "Record Found at".$key."<br>" ;
                               // print_r($importdata[$key]['disposition']);dd();
                               if($existingdata[$j]['first_name']!=$importdata[$key]['first_name'])
                                 {
                                 $existingdata[$j]['health_status']="Bad Record";
                                }
                                elseif($existingdata[$j]['last_name']!=$importdata[$key]['last_name'])
                                 {
                                 $existingdata[$j]['health_status']="Bad Record";
                                }
                                 
                                elseif($existingdata[$j]['title']!=$importdata[$key]['title'])
                                 {
                                 $existingdata[$j]['health_status']="Bad Record";
                                 
                                }
                                elseif($existingdata[$j]['phone_number']!=$importdata[$key]['phone_number'])
                                 {
                                 $existingdata[$j]['health_status']="Bad Record";
                                 
                                }
  
                                elseif($existingdata[$j]['address1']!=$importdata[$key]['address1'])
                                 {
                                 $existingdata[$j]['health_status']="Bad Record";
                                 $barrecords=1;
                                }
                                 else{
                                  $existingdata[$j]['health_status']="Good Record";
                                   
                                    
                                    $existingdata[$j]['id']=$importdata[$key]['id'];
                                    $existingdata[$j]['batch_id']=$importdata[$key]['batch_id'];

                                    if(is_null($existingdata[$j]['disposition'])){
                                   $existingdata[$j]['disposition']=$importdata[$key]['disposition'];
                                  }
                                  
                                     if(is_null($existingdata[$j]['validation'])){
                                   $existingdata[$j]['validation']=$importdata[$key]['validation'];
                                  }


                                    if(is_null($existingdata[$j]['organization'])){
                                    $existingdata[$j]['organization']=$importdata[$key]['organization'];
                                  }

                                }
                             }
                        else{

                              $existingdata[$j]['health_status']="Record Not Found";
                              $badrecords=1;
                        }
                     //   Session::flash('existingdata', array($existingdata));
                    } 
                   $GLOBALS['variable'] = $existingdata; 
                    $GLOBALS['badrecords'] = $badrecords; 

                    if($badrecords==0)
                    {
                        \App\CompareData::where('batch_id', '=', $existingdata[0]['batch_id'])->delete();
                    foreach ($existingdata as $value) {  

                      \App\CompareData::create($value);
                    }
                    }
          
            
             });
              //print_r( $GLOBALS['variable']);dd();
            return view('data.dataResult', compact($GLOBALS['variable'],$GLOBALS['badrecords']));
         
         }
   

    }

     public function uploadGoodRecords($id){
       //print_r($id);dd();

        $completed_data_table = \App\CompareData::where('batch_id', '=', $id)->get();
      
        foreach ($completed_data_table as  $value) {
       // echo $value->validation;dd();
        $update = \App\OrderBatch::where('id', '=', $value->id)->update(['validation'=> $value->validation, 'disposition'=> $value->disposition, 'health_status'=> $value->health_status, 'organization'=> $value->organization] );
        }
        \App\BatchDetail::where('id', '=', $id)->update(['status_id' => 4]);


return redirect()->route('viewData');
    }
   /* public function csvpreview(){

       
        return view('clients.view', compact('client_info', 'user'));
    }*/

    public function clientFullView($id){

       if(Auth::check()){
         // print_r(Auth::user()->role_id);dd();
            if(Auth::user()->role_id == 1){
                $clients = Client::with('CompanyManager')->findOrFail($id);
               return view('clients.clientFullView', compact('clients'));
           }
                else{
                  return redirect()->back();
                }
       }

     }
    public function view(){

        if(Auth::check()){
         // print_r(Auth::user()->role_id);dd();
            if(Auth::user()->role_id == 1){
               $client_info = Client::with('CompanyManager')->get();
              $user = User::where('role_id', '=', '2')->get(); 
              return view('clients.view', compact('client_info', 'user'));
             }
                else{
                  return redirect()->back();
                }
       }

        
    }

    public function importExcel(Request $request)
    {  

          
              $cols = array();
             $input = $request->all();
                 //  print_r(Input::get('company'));dd();
            // dd($request); 
          if($request->hasFile('import_file')){

           Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
               $count = 0; 
                $id = Auth::user()->id; 

                 $batch_detail = new  BatchDetail();
                $batch_detail->uploader_id = $id;
                $batch_detail->client_id = Input::get('company');
                $batch_detail->batch_name = Input::get('batch_name');
                $batch_detail->status_id = 1;
                $batch_detail->instructions = Input::get('instructions');
              //  $batch_detail->total_record_count = count();
               // $batch_detail->total_record_count = count();
              //  dd($batch_detail);
               $batch_detail->save();

                foreach ($reader->toArray() as $key => $value) {
                   // print_r($row);dd();
                   /*foreach ($row as $value) {*/
                   // print_r($value);dd();
                    $count++;
                   /* echo "<pre>";
                    print_r($value);dd();*/
                    $cols['batch_id'] = $batch_detail->id;
                    $cols['first_name'] = $value['first_name'];
                    $cols['last_name'] = $value['last_name'];
                    $cols['title'] = $value['title'];
                    $cols['phone_number'] = $value['phone_number'];
                    if($value['validation'] != null){
                    $cols['validation'] = $value['validation'];
                         }else{

                            $cols['validation'] = ''; 
                         }

                          if($value['disposition'] != null){
                     $cols['disposition'] = $value['disposition'];
                         }else{

                            $cols['disposition'] = ''; 
                         }
                    $cols['disposition'] = $value['disposition'];
                    $cols['organization'] = $value['organization'];
                    $cols['address1'] = $value['state'];
                    $cols['address2'] = $value['country'];
                   // $cols['health_status'] = $value['health_status'];
                   // print_r($cols);dd();
                    if(!empty($cols)) {

                     $data = OrderBatch::create($cols);
                     //DB::table('order_batch')->insert($cols);                    
                    }
                   /*}*/
                  
                }
                BatchDetail::where('id', $batch_detail->id)->update(array('total_record_count' => $count));

            });
            
          
             return redirect()->route('viewData')->with('message', 'You successfully added new batch order!!');
        }
        else
        {

            return back()->with('error', 'Please chose excel file to uplode');
        }

         

    }

    public function assignCompany(Request $request){
        
            $input = $request->all();
            $this->validate($request,[
          'manager' => 'required'
            ]); 
           // print_r($input);dD();

            $company = CompanyManager::where('client_id', '=', $input['id'])->first();
        //  dd($company);
           $companyManager='';
             $companyManager = new CompanyManager();
            if($company==''){
                //echo "string"; dd();
            $companyManager->user_id = $input['manager'];
            $companyManager->client_id = $input['id'];
            $companyManager->save();

            }else{
              
                CompanyManager::where('client_id', '=', $input['id'])->update(['user_id' =>trim($input['manager'])]);
           
            }
            $managerName = User::findOrFail($input['manager']);
            $companyName = Client::findOrFail($input['id']);
           // print_r($companyName->organization_name);dd();
            return redirect()->back()->with('status',  'you have assigned '.ucwords($managerName->first_name).' as Manager to '. $companyName->organization_name.'');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
