<!DOCTYPE html>
<html lang="en">
  @include('layouts.header')

  @if(auth::user()->role_id != 5 || auth::user()->role_id != 2)

  @else
  @include('layouts.sidebar')
  @endif
  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">
                  @if(auth::user()->role_id == 5)
                  <div class="col-xs-12 col-xs-offset-5">
                    <a href="{{route('data_upload')}}">
                        <button class="btn btn-primary btn-lg">Upload Data
                            <i class="ace-icon fa fa-cloud-upload bigger-200"></i>
                        </button>
                      </a>

                      <a href="{{route('viewData')}}">
                        <button class="btn btn-primary btn-lg" disabled="disabled">Manage Data
                       <i class="ace-icon fa fa-cog bigger-230"></i>
                        </button>
                      </a>
                      </div>
                      @endif
                  <div class="page-header">
                    <h1>
                     Batch Details
                  
                    </h1>
                     
                  </div><!-- /.page-header -->


                   @if (session('flash_message'))
                      <div class="alert alert-success">
                          {{ session('flash_message') }}
                      </div>
                   @endif  

                   @if (session('edit_message'))
                      <div class="alert alert-success">
                          {{ session('edit_message') }}
                      </div>
                   @endif 
                    <div class="main-content">
            <div class="page-content">
              <div class="page-content-area">
               

                    <div class="row">
                      <div class="col-xs-12">
                            <div class="row">
                       <div>

                         <table id="sample-table-3" class="table table-striped table-bordered table-hover">

                        <thead>
                          <tr>

                             <!--  <th class="center">
                                <label class="position-relative">
                                   
                                <input type="checkbox" class="ace" name="checkbox-top" /> 

                                  <span class="lbl"></span> 
                                 
                                </label>
                              </th> -->
                             @if(auth::user()->role_id == 2)
                             <th>Download</th>
                             @endif

                              @if(auth::user()->role_id == 4)
                             <th>Download</th>
                             @endif
                              @if(auth::user()->role_id != 5)
                             <th>Company Name</th>
                             @endif
                            
                             <th>Btach Name</th>
                             <th>Count</th>
                             <th>Notes</th>
                            
                             @if(auth::user()->role_id == 5 || auth::user()->role_id == 2 || auth::user()->role_id == 4)
                             <th>Proposed Due Date</th>
                              <th>Status</th>
                             <th>Action</th>
                             @endif

                             

                          <!--    <th>Status</th>
                             <th></th> -->
                             

                             <!-- <th></th> -->
                            </tr>
                        </thead>
        @foreach($orderBatch as $data)
                          @if(auth::user()->client_id == $data->client_id)
                      
                        <tbody>

     @if(auth::user()->role_id == 2)
                              @if($data->batchStatus->status == 'Pending')
                              @else
                            <tr>

                              <td class="center">
                                <label class="position-relative">
                                  
                                  <input type="checkbox" class="ace" value="" name="input[]" />
                                  <span class="lbl"></span>
                                  
                                </label>
                              </td>
                              <td>{{$data->client->organization_name}}</td>
                              <td>ddasd</td>
                            <td>{{$data->batch_name}}</td>
                            <td>{{$data->total_record_count}}</td>

                            <td class="text-secondary">{{$data->batchStatus->status}}
                            <br>
                                 @if($data->batchStatus->status == 'Completed')
                                  
                                   <span><a href="{{url('download-csv', $data->id)}}">Download as Csv</a></span>
                                @endif
                                </td>
                                  
                                   @if($data->batchStatus->status == 'Submited')
                                  <td>
                                    <center>
                                  <a data-toggle="modal" data-id="{{$data->id}}" data-target="#manager"><span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                   </center>

                                 </td>
                                

                                   @else
                                   <td ><span class="text-success">Submited</span><br><br>
                                     <a data-toggle="modal" data-id="{{$data->id}}" data-target="#manager" style="cursor: pointer;">
                                  <!--  <span class="text-primary">Change ?</span>   <span class="glyphicon glyphicon-edit"></span> -->
                                    </a></td>
                                  @endif


                        </tr>
                           @endif
                @else
                <!-- client area  -->
                           <tr>

                             <!--  <td class="center">
                                <label class="position-relative">
                                  
                                  <input type="checkbox" class="ace" value="" name="input[]" />
                                  <span class="lbl"></span>
                                  
                                </label>
                              </td> -->
                                
                             <!--  <td>{{$data->client->organization_name}}</td> -->
                          
                            <td><!-- <a data-toggle="modal" data-target="#batch_detail_view" data-id="{{$data->id}}" style="cursor: pointer;"> -->{{$data->batch_name}}</a></td>
                            <td>{{$data->total_record_count}}</td>
                            <td><a href="#" data-toggle="tooltip" title="{{$data->instructions}}">
                              {{substr($data->instructions, 0, 10)}}
                               </a>
                            </td>
                            <td>{{$data->due_date}}</td>
                            <td class="text-secondary">{{$data->batchStatus->status}}</td>
                           
                            @if($data->batchStatus->status == 'Pending')
                            <td>
                              <center>
                                <a data-toggle="modal" data-target="#myModal" data-id="{{$data->id}}">
                                   <button type="button" class="btn btn-primary btn-xs" style="margin: 10px;margin-bottom: 15px;">Submit</button>
                                </a>

                                 <a href="{{route('batchEdit', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-pencil-square-o bigger-230" aria-hidden="true"></i>
                                </a>

                                 <a href="{{route('batchFullView', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-eye bigger-230" aria-hidden="true" ></i>
                                </a>

                                <a data-toggle="modal" data-target="#delBatch" data-id="{{$data->id}}">
                                <i class="fa fa-trash-o bigger-230" aria-hidden="true"></i>
                              </a>
                              </center>

                             
                            </td>
                            
                            @endif
                             @if($data->batchStatus->status == 'Submited')
                            <td>
                                <center>
                             

                                 <a href="{{route('batchEdit', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-pencil-square-o bigger-230" aria-hidden="true"></i>
                                </a>

                                 <a href="{{route('batchFullView', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-eye bigger-230" aria-hidden="true" ></i>
                                </a>

                              </center>
                            </td>
                            @endif
                              @if($data->batchStatus->status == 'In-Process')
                            <td>
                                <center>
                             

                                 <a href="{{route('batchEdit', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-pencil-square-o bigger-230" aria-hidden="true"></i>
                                </a>

                                 <a href="{{route('batchFullView', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-eye bigger-230" aria-hidden="true" ></i>
                                </a>
                                
                              </center>
                            </td>
                            @endif
                            @if($data->batchStatus->status == 'QA-Review')
                            <td>
                                <center>
                             

                                 <a href="{{route('batchEdit', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-pencil-square-o bigger-230" aria-hidden="true"></i>
                                </a>

                                 <a href="{{route('batchFullView', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-eye bigger-230" aria-hidden="true" ></i>
                                </a>
                                
                              </center>
                            </td>
                            @endif

                             @if($data->batchStatus->status == 'Completed')
                            <td>
                                <center>
                                 <a href="{{route('batchEdit', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-pencil-square-o bigger-230" aria-hidden="true"></i>
                                </a>

                                 <a href="{{route('batchFullView', $data->id)}}" style="margin: 10px;">
                                   <i class="fa fa-eye bigger-230" aria-hidden="true" ></i>
                                </a>
                                  
                                    <a href="{{url('download-csv-client', $data->id)}}" style="margin: 10px;"><i class="fa fa-file-excel-o bigger-230"></i></a>
                              </center>
                         
                            </td>
                            @endif

                           
                        </tr>
                       

                        @endif

                        @elseif(auth::user()->role_id==2)
                          <?php 
                              $id = \auth::user()->id;
                              $manager = \App\CompanyManager::where('user_id', '=', $id)->get()->toArray();
                               
                                $output=array();
                                foreach ($manager as $value) {
                                  //print_r($value);
                                  for($i=0;$i<sizeof($value);$i++)
                                  {
                                    //echo "<br>";
                                    //print_r($value['client_id']);
                                    if(!in_array($value['client_id'], $output))
                                    {
                                   $output[] = $value['client_id']; 
                                  // print_r($output);dd();
                                    }
                                  }

                                 //$output[] = $manager['client_id'];
                                 //print_r($output);
                                 //echo "<br>";
                                }
                          //echo $data->client->id;
                          
                          //print_r($output);
                                //dd();
                          ?>
                            @if(is_null($manager))
                            @else
                          
                       
                             @if($data->batchStatus->status == 'Pending')
                              @else
                            <tr>

                              <!-- <td class="center">
                                <label class="position-relative">
                                  
                                  <input type="checkbox" class="ace" value="" name="input[]" />
                                  <span class="lbl"></span>
                                  
                                </label>
                              </td> -->
                               <td><span><a href="{{url('download-csv', $data->id)}}"><center><i class="fa fa-file-excel-o"></i></center></a></span></td>
                              <td>{{$data->client['company_name']}}</td>

                            <td>{{$data->batch_name}}</td>
                            <td>{{$data->total_record_count}}</td>
                             <td><a href="#" data-toggle="tooltip" title="{{$data->instructions}}">
                              {{substr($data->instructions, 0, 10)}}
                               </a>
                            </td>
                            <td>{{$data->due_date}}</td>

                            <td class="text-secondary">{{$data->batchStatus->status}}
                            <br>
                                </td>
                                  
                                   @if($data->batchStatus->status == 'Submited')
                                  <td >
                                     <a data-toggle="tooltip" title="Start Processing" data-id="{{$data->id}}" data-target="#inProcess" style="cursor: pointer;" class="btn btn-xs btn-success" onclick="openModel()">
                                  <span class="glyphicon glyphicon-circle-arrow-right"></span>  
                                   
                                    </a></td>
                                
                                 @endif
                                   @if($data->batchStatus->status == 'In-Process')
                                   <td >
                                     <a data-toggle="modal" data-id="{{$data->id}}" data-target="#startQa" style="cursor: pointer;">
                                      <button class="btn btn-primary btn-xs">
                                          Start QA-Review 
                                      </button>
                                    <br><br>
                                    </a></td>
                                  @endif

                                  @if($data->batchStatus->status == 'QA-Review')
                                   <td >
                                     <a class="btn btn-xs btn-success" style="cursor: pointer;" data-toggle="tooltip" title="Complete" href="{{route('completedBatch', $data->id)}}">
                                      <span class="glyphicon glyphicon-ok"></span></a>
                                    </td>
                                  @endif
                                   @if($data->batchStatus->status == 'Completed')
                                   <td ></td>
                                  @endif



                        </tr>
                           @endif

                      
                        @endif

                        @endif
                        @if(auth::user()->role_id == 4)
                                   @if($data->batchStatus->status == 'Pending')
                                    @else
                                  <tr>

                                   <!--  <td class="center">
                                      <label class="position-relative">
                                        
                                        <input type="checkbox" class="ace" value="" name="input[]" />
                                        <span class="lbl"></span>
                                        
                                      </label>
                                    </td> -->
                                   <td><span><a href="{{url('download-csv', $data->id)}}"><center><i class="fa fa-file-excel-o"></i></center></a></span></td> 
                                    <td>{{$data->client['company_name']}}</td>
                                  <td>{{$data->batch_name}}</td>
                                  <td>{{$data->total_record_count}}</td>
                                  <td><a href="#" data-toggle="tooltip" title="{{$data->instructions}}">
                              {{substr($data->instructions, 0, 10)}}
                               </a>
                            </td>
                            <td>{{$data->due_date}}</td>

                                  <td class="text-secondary">{{$data->batchStatus->status}}
                                  <br>
                                      @if($data->batchStatus->status == 'Submited')
                                  <td >
                                     <a data-toggle="modal" data-id="{{$data->id}}" data-target="#inProcess" style="cursor: pointer;">
                                      <button class="btn btn-primary btn-xs">
                                          Start Processing
                                      </button>
                                    <br><br>
                                    </a></td>
                                
                                 @endif
                                   @if($data->batchStatus->status == 'In-Process')
                                   <td >
                                     <a data-toggle="modal" data-id="{{$data->id}}" data-target="#startQa" style="cursor: pointer;">
                                      <button class="btn btn-primary btn-xs">
                                          Start QA-Review 
                                      </button>
                                    <br><br>
                                    </a></td>
                                  @endif

                                  @if($data->batchStatus->status == 'QA-Review')
                                   <td >
                                      <a style="cursor: pointer;" href="{{route('completedBatch', $data->id)}}">
                                      <button class="btn btn-primary btn-xs" >
                                          Batch Completed 
                                      </button>
                                    <br><br>
                                    </a></td>
                                  @endif
                                   @if($data->batchStatus->status == 'Completed')
                                   <td ></td>
                                  @endif
                                  
                                   
                                 

                                  <!--  @if($data->batchStatus->status == 'Completed')
                                   <td class="text-success">
                                    Completed
                                   </td>
                                  @endif -->


                              </tr>
                              @endif
                        @endif
                         @endforeach   
                        <!--  managers data  -->
                      </tbody>

                      </table>


                       
                  </div>
                  </div><!-- /.span -->
                </div><!-- /.row -->

              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content-area -->
        </div><!-- /.page-content -->
      </div><!-- /.main-content -->
      



                </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->
            <!-- manager model -->
               <div id="manager" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                           
                                             <form action="{{route('statusChanged')}}" method="POST" >
                                        {{csrf_field()}}
                                            <div class="modal-body">
                                              <span class="text-danger">Are you sure you want to change status ??</span>
                                               <input type="hidden" name="manager_id" value="" class="manager_class">
                                            </div>
                                              <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">Yes</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>

                                  </form>
                                      </div>

                    </div>
            </div>
<!--Client Model -->
      <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <form action="{{route('statusChanged')}}" method="POST" >
                    {{csrf_field()}}
                  <div class="modal-body">
                   <span  class="text-success"><h3>
                   Are you sure you want to change status Submited</h3></span></a></a>
                    <input type="hidden" name="client_id" value="" class="client_class">
                     <input type="hidden" name="pendindStatus" value="2" >
                  </div>
               
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>

                    </form>
                </div>


              </div>
            </div>

            <!--delBatch-->

             <div id="delBatch" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                
                  <form action="{{route('delBatch')}}" method="delete" >
                     {{csrf_field()}}
                  <div class="modal-body">
                   <span  class="text-danger"><h3>
                   Are you sure you want delete this batch ?</h3></span></a></a>
                    <input type="hidden" name="batch_id" value="" class="batch_id">
                 </div>
               
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>

                    </form>
                </div>


              </div>
            </div>

<!--Client Model -->
      <div id="inProcess" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                 
                  <form action="{{route('statusChanged')}}" method="POST" >
                    {{csrf_field()}}
                  <div class="modal-body">
                    <span  class="text-success"><h3>
                   Are you sure you want to change status In-Process</h3></span></a>
                    <input type="hidden" name="client_id" value="" class="inProcess_staus">
                    <input type="hidden" name="inProcess_staus" value="3" >
                  </div>
               
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>

                    </form>
                </div>


              </div>
            </div>    

<div id="startQa" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                 
                  <form action="{{route('statusChanged')}}" method="POST" >
                    {{csrf_field()}}
                  <div class="modal-body">
                    <span  class="text-success"><h3>
                   Are you sure you want to change status QA-Review</h3></span></a>
                    <input type="hidden" name="client_id" value="" class="startQa_status">
                    <input type="hidden" name="startQa_status" value="5" >
                  </div>
               
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>

                    </form>
                </div>


              </div>
            </div>            
<!-- batch detail full view -->

<div id="batch_detail_view" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-body">
                    <input type="hidden" class="batch" name="batch_detail_id" value="" >

                    
                  </div>
               
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>

                    </form>
                </div>


              </div>
            </div>   

            <!-- ends here -->

@include('layouts.footer')

 <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.bootstrap.js"></script>
<script>
 
$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();   
});
</script> 
<script type="text/javascript">
 $('#myModal').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.client_class').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });

 $('#manager').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.manager_class').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });

 $('#inProcess').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.inProcess_staus').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });

  $('#startQa').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.startQa_status').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });

  $('#delBatch').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.batch_id').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });

   $('#batch_detail_view').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.batch').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });


$(".show").click(function(){
    $(".hideMe").show();
}); 

$(".cross").click(function(){
    $(".hideMe").hide();
});   
</script>
<script >
   jQuery(function($) {
        var oTable1 = 
        $('#sample-table-3')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
          bAutoWidth: false,
          "aaSorting": [],
         
          });
});
  $(document).on('click', 'th input:checkbox' , function(){
          var that = this;
          $(this).closest('table').find('tr > td:first-child input:checkbox')
          .each(function(){
            this.checked = that.checked;
            $(this).closest('tr').toggleClass('selected');
          });
        });
</script>
  </body>
</html>

