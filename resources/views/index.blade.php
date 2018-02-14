<!DOCTYPE html>
<html lang="en">
  @include('layouts.header')
  @include('layouts.sidebar')
  
  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">
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
                              <th class="center">
                                <label class="position-relative"> 
                                  <input type="checkbox" class="ace" name="checkbox-top" />
                                  <span class="lbl"></span> 
                                </label>
                              </th>
                            <th>Company Name</th>
                             <th>Btach Name</th>
                             <th>Count</th>
                             <th>Proposed Due Date</th>
                             <th>Status</th>

                             <!-- <th></th> -->
                            </tr>
                        </thead>
              @foreach($orderBatch as $data)
                         
                        <tbody>

                            <tr>

                              <td class="center">
                                <label class="position-relative">
                                  
                                  <input type="checkbox" class="ace" value="" name="input[]" />
                                  <span class="lbl"></span>
                                  
                                </label>
                              </td>
                              <td>{{$data->client->organization_name}}</td>
                            <td>{{$data->batch_name}}</td>
                            <td>{{$data->total_record_count}}</td>
                            <td>{{$data->due_date}}</td>
                            <td class="text-secondary">{{$data->batchStatus->status}}
                            <br>
                                 @if($data->batchStatus->status == 'Completed')
                                  
                                   <span><a href="{{url('download-csv', $data->id)}}">Download as Csv</a></span>
                                @endif
                                </td>


                        </tr>
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
                     <input type="hidden" name="pendindStatus" value="3" >
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


@include('layouts.footer')

 <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.bootstrap.js"></script>


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

