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
                     <div class="col-xs-12 col-xs-offset-4" > 
                      <form method="post" action="{{route('compareFiles')}}" enctype="multipart/form-data">
                  {{csrf_field()}}
                          <label>Upload File</label>
                           <input type="file" name="uploaded_file" required="required">

                           <div class="col-xs-4" style="margin-top: -20px;margin-left:200px ">
                            @foreach($completedBatch as $fileId)
                            <input type="hidden" name="file_id" value="{{$fileId->batch_id}}">
                            @endforeach
                            <button type="submit" class="btn btn-primary btn-xs" id="uploadMe">upload</button>
                           </div>
                        </form>
                    </div>
                    <h1>
                     Batch Detail
                     
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
                              </th><!-- 
                             <th>Id</th>
                             <th>Batch id</th> -->
                             <th>First Name</th>
                             <th>Last Name</th>
                             <th>Title</th>
                              <th>Phone Number</th>.
                              <th>Validation</th>
                              <th>Disposition</th>
                              <th>Organization</th>
                              <th>Adress1</th>
                              <th>Adress2</th>
                              <th>Health</th>
                              </tr>
                        </thead>

                        <tbody>


                             @foreach($completedBatch as $data)
                            <tr>
                              <td class="center">
                                <label class="position-relative">
                                  
                                  <input type="checkbox" class="ace" value="" name="input[]" />
                                  <span class="lbl"></span>
                                  
                                </label>
                              </td>

                              <!-- 
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->batch_id }}</td> -->
                            <td>{{ $data->first_name  }}</td>
                           
                            <td>{{$data->last_name}}</td>
                             <td>{{ $data->title }}</td>
                             <td>{{ $data->phone_number }}</td>
                             <td>{{ $data->validation }}</td>
                             <td>{{ $data->disposition }}</td>
                             <td>{{ $data->organization }}</td>
                             <td>{{ $data->address1 }}</td>
                             <td>{{ $data->address2 }}</td>
                             @if($data->health_status=='Good Record')
                             <td class="text-success">{{$data->health_status}}</td>
                             @else
                             <td>{{ $data->health_status }}</td>
                             @endif
                             
                            
                        </tr>
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

          

@include('layouts.footer')

 <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}public/aceadmin/assets/js/jquery.dataTables.bootstrap.js"></script>

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

