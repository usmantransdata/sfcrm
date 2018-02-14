<!DOCTYPE html>
  @include('layouts.header')
  @include('layouts.sidebar')

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
					<!-- /section:settings.box -->
	 <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">
                  <div class="page-header">
                    <h1>
								Upload Data
								
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							<form class="form-horizontal" method="POST" action="{{ route('import_process') }}">
							    {{ csrf_field() }}
                                <input type="hidden" name='filename' value="{{$filename}}"> 
							    <table class="table">
							    	@foreach ($tablecolums as $key => $value)
							    	   @if($value!='id' && $value!='batch_id' && $value!='health_status' && $value!='disposition' && $value!='validation' && $value!='created_date' && $value!='updated_date')
							    	   
							                 <tr><td>{{ucfirst(str_replace('_', ' ', $value))}}:</td><td>
                                               <select name="{{ $value }}">
                                               	@foreach ($csv_header_fields as $db_field)
							                            <option value="{{ $db_field }}">{{ $db_field }}</option>
							                        @endforeach

                                               </select>

							                 </td></tr>
                                        @endif

							        @endforeach
							      
							       	
							       
							    </table>

							    <button type="submit" class="btn btn-primary">
							        Import Data
							    </button>
							</form>

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->


@include('layouts.footer')
	

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>  

</html>


