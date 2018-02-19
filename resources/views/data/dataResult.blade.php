<!DOCTYPE html>
<html lang="en">
  @include('layouts.header')


  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">


                   @if (session('flash_message'))
                      <div class="alert alert-success">
                          {{ session('flash_message') }}
                      </div>
              @endif   
                    <div class="main-content">
            <div class="page-content">
              <div class="page-content-area">
                   <div class="showErros">
                          @if($GLOBALS['badrecords'] > 0)
                          <span class="alert alert-danger">Please re-check your file. There are some in-valid records.</span>
                          @endif

                           @if($GLOBALS['badrecords'] < 1)
                           <span style="margin-left: 600px;margin-bottom: 20px">
                           <label>Press Upload to update record!</label>
                          <a href="{{route('uploadGoodRecords', $GLOBALS['variable'][0]['batch_id'])}}" type="button" class="btn btn-primary uploadgooddata" >upload</a>
                          </span>
                          @endif
                       </div> 
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
                              <th>Phone Number</th>
                              <th >Validation</th>
                              <th>Disposition</th>
                              <th>Organization</th>
                              <th>Adress1</th>
                              <th>Adress2</th>
                              <th>Health</th>
                              </tr>
      
                        </thead>

                        <tbody>


                         @foreach($GLOBALS['variable'] as $data)
                      <form id="goodData">   
                            <tr>
                              <td class="center">
                                <label class="position-relative">
                                  
                                  <input type="checkbox" class="ace" value="" name="input[]" />
                                  <span class="lbl"></span>
                                  
                                </label>
                              </td>

                            <td>{{ $data['first_name']  }}</td>
                           
                            <td>{{$data['last_name']}}</td>
                             <td>{{ $data['title'] }}</td>
                             <td>{{ $data['phone_number'] }}</td>
                             <td id="validation">{{ $data['validation'] }}</td>
                             <td>{{ $data['disposition'] }}</td>
                             <td>{{ $data['organization'] }}</td>
                             <td>{{ $data['address1'] }}</td>
                             <td>{{ $data['address2'] }}</td>
                             @if($data['health_status'] == 'Bad Record')
                             <td class="text-danger">{{ $data['health_status'] }}</td>
                             @elseif ($data['health_status'] == 'Record Not Found')
                             <td class="text-danger">{{ $data['health_status'] }}</td>
                             @else
                             <td class="text-success" id="goodStatus">{{ $data['health_status'] }}</td>
                             @endif


                            
                        </tr>
                      </form>
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
        $('#sample-table-3').dataTable( {
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


</script>
  </body>
</html>

