<!DOCTYPE html>
<html lang="en">
  @include('layouts.header')
  @include('layouts.sidebar')

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">
                  <div class="page-header">
                    <h1>
                      Users List
                    </h1>
                  </div><!-- /.page-header -->
                   @if (session('flash_message'))
                      <div class="alert alert-success">
                          {{ session('flash_message') }}
                      </div>
              @endif   

                @if (session('deactive_message'))
                      <div class="alert alert-success">
                          {{ session('deactive_message') }}
                      </div>
              @endif   
                    <div class="main-content">
            <div class="page-content">
              <div class="page-content-area">
               

                    <div class="row">
                      <div class="col-xs-12">
                         <form method="post" action="">
                            {{csrf_field()}}
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
                             <th>Name</th>
                             <th>Email</th>
                              <th>User Type</th>   
                              <th>Change Status</th>
                                <th>Action</th>
                              </tr>
                        </thead>

                        <tbody>


                             @foreach($user as $users)
                             @if($users->role_id != 1)
                            <tr>

                              <td class="center">
                                <label class="position-relative">
                                  
                                  <input type="checkbox" class="ace" value="" name="input[]" />
                                  <span class="lbl"></span>
                                  
                                </label>
                              </td>

                            <td>{{ ucwords($users->first_name) }} {{ ucwords($users->last_name) }}</td>
                            <td>{{ $users->email  }}</td>
                           
                            <td>{{$users->roles->role}}</td>

                            @if($users->acount_status == 0)

                            <td>
                               <center>

                                 <input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-width="100" data-height="10" class="switchToggle" data-id="{{$users->id}}">
                        
                 
                          </center>
                          </td>
                          @else
                             <td>
                              <center>

                                <input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-width="100" data-height="10" class="switchToggle" data-id="{{$users->id}}" checked>
                          
                            </center>
                          </td>
                          
                          @endif
                          <td>
                              <a href="{{route('userEdit', $users->id)}}">
                             <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                           </a>

                                <a data-toggle="modal" data-id="{{$users->id}}" data-target="#myModal" style="cursor: pointer;">
                                <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endif
                         @endforeach    
                      </tbody>

                      </table>


                       
                  </div>
                  </div><!-- /.span -->
                </form>
                </div><!-- /.row -->

              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content-area -->
        </div><!-- /.page-content -->
      </div><!-- /.main-content -->
       </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

      <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                
                  <form action="{{route('userDel')}}" method="delete" >
                    {{csrf_field()}}
                  <div class="modal-body">
                   <span  class="text-danger"><h3>
                   Are you sure you want to delete this user ?</h3></span></a></a>
                    <input type="hidden" name="id" value="" class="del_id">
                  </div>
               
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>

                    </form>
                </div>


              </div>
            </div> 

            <!-- user activatio  -->        

             <div id="userActivate" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <form action="{{route('userActivate')}}" method="post" >
                    {{csrf_field()}}
                  <div class="modal-body">
                   <span  class="text-primary"><h3>
                   Are you sure you want to <span class="text-success">activate</span> this user ?</h3></span></a></a>
                    <input type="hidden" name="activate_id" value="" id="enable" class="active_id">
                  </div>
               
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>

                    </form>
                </div>
               </div>
            </div> 
<!-- user deactivate -->

  <div id="userDeactivate" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                
                  <form action="{{route('userActivate')}}" method="post" >
                    {{csrf_field()}}
                  <div class="modal-body">
                   <span  class="text-primary"><h3>
                   Are you sure you want to <span class="text-danger">de-activate</span> this user ?</h3></span></a></a>
                    <input type="hidden" name="de_activate_id" id="disable" value="" class="deActive_id">
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

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

   <!--  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> -->

<script >

  $('.switchToggle').on('change', function(){
     var value = this.checked;
     var id =  $(this).data("id");
         
      
      if(value == true){
     // alert();
          $('#userActivate').modal('show'); 
          $(".modal-body #enable").val( id );
        
      }else
      {
          $('#userDeactivate').modal('show'); 
          $(".modal-body #disable").val( id );
      }
    });

   $('#myModal').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.del_id').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });


    $('#userActivate').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.active_id').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });

    $('#userDeactivate').on('show.bs.modal', function (e) {
  var id = $(e.relatedTarget).data('id');
      $('.deActive_id').val(id);   /*
        proceed with rest of modal using the rowid variable as necessary 
        */
     });


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

