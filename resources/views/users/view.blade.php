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
                      Users List
                      <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        overview &amp; stats
                      </small>
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
                             <th>First Name</th>
                             <th>Last Name</th>
                             <th>Email</th>
                              <th>User Type</th>
                              <th>Verified</th>
                              <th>Created_at</th>
                               <th>Acount Status</th>
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

                            <td>{{ $users->first_name }}</td>
                            <td>{{ $users->last_name }}</td>
                            <td>{{ $users->email  }}</td>
                           
                            <td>{{$users->roles->role}}</td>
                            @if($users->verified == 1)
                            <td class="text-success">Verified</td>
                            @else
                             <td class="text-danger">Un-Verified</td>
                            @endif
                             <td>{{ $users->created_at }}</td>

                           
                             @if($users->acount_status == 1)
                            <td class="text-success">Active</td>
                            @else
                             <td class="text-danger">De-Active</td>
                            @endif
                            @if($users->acount_status == 0)
                            <td>
                               <center>
                             <a data-toggle="modal" data-id="{{$users->id}}" data-target="#userActivate" style="cursor: pointer;">
                              <i class="fa fa-check" aria-hidden="true"></i>
                            </a>
                          </center>
                          </td>
                          @else
                             <td>
                              <center>
                             <a data-toggle="modal" data-id="{{$users->id}}" data-target="#userDeactivate" style="cursor: pointer;">
                              <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
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
                    <input type="hidden" name="activate_id" value="" class="active_id">
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
                    <input type="hidden" name="de_activate_id" value="" class="deActive_id">
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

   <!--  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> -->

<script >

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

