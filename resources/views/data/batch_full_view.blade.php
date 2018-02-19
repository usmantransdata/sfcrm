<!DOCTYPE html>
<html lang="en">
  @include('layouts.header')

  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
            
              <div class="page-content">
                <div class="page-header">
                  <a href="{{ URL::previous() }}">
                  <i class="fa fa-arrow-left bigger-200" aria-hidden="true"></i>
                  </a>
                </div>
                <div class="page-content-area">
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
                        <table id="sample-table-3" class="table table-striped table-bordered table-hover" style="overflow-y: scroll;height: 100%;display: block;
    width: 100%;overflow-x: scroll;">
                           <thead>
                          <tr>

                             <th>First Name</th>
                             <th>Last Name</th>
                             <th>Company Name</th>
                             <th>Title</th>
                             <th>Email1</th>
                             <th>Email2</th>
                             <th>Email3</th>
                              <th>Phone Number1</th>
                              <th>Phone Number2</th>
                              <th>Phone Number3</th>
                              <th>Adress1</th>
                              <th>Adress2</th>
                              <th>Adress3</th>
                              <th>City</th>
                              <th>State</th>
                              <th>Zip</th>
                              <th>Country</th>
                              <th>Disposition</th>
                              <th>Validation</th>
                              <th>Health</th>
                              </tr>
                        </thead>

                        <tbody>


                             @foreach($content_batch as $data)
                            <tr>

                            <td>{{ $data->first_name  }}</td>
                            <td>{{$data->last_name}}</td>
                            <td>{{$data->company_name}}</td>
                            <td>{{$data->title}}</td>
                            <td>{{$data->email1}}</td>
                            <td>{{$data->email2}}</td>
                            <td>{{$data->email3}}</td>
                            <td>{{$data->phone_number1}}</td>
                            <td>{{$data->phone_number2}}</td>
                            <td>{{$data->phone_number3}}</td>
                            <td>{{$data->address1}}</td>
                            <td>{{$data->address2}}</td>
                            <td>{{$data->address3}}</td>
                            <td>{{$data->city}}</td>
                            <td>{{$data->state}}</td>
                            <td>{{$data->zip}}</td>
                            <td>{{$data->country}}</td>
                            <td>{{$data->disposition}}</td>
                            <td>{{$data->validation}}</td>
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
<style type="text/css">
  


</style>
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

