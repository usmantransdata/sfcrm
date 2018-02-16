<!DOCTYPE html>
<html lang="en">
  @include('layouts.header')

  @if(auth::user()->role_id != 5 || auth::user()->role_id != 2)
  @else
  @include('layouts.sidebar')
  @endif

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  <body class="no-skin">
          <div class="main-container" id="main-container">
            <script type="text/javascript">
              try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
              <div class="page-content">
                <div class="page-content-area">
                  <div class="page-header">
                    <h1>
                    BATCH EDIT  
                    </h1>
                    <a href="{{ url()->previous() }}" class="col-lg-8 col-lg-offset-2" style="margin-top: -30px">
                     <i class="fa fa-arrow-left btn-lg" aria-hidden="true"></i>
                    </a>
                  </div><!-- /.page-header -->
                  <div class="row">
                    <div class="col-lg-12">
                        
                      
                     @if (session('error_message'))
                                    <div class="alert alert-success">
                                        {{ session('error_message') }}
                                    </div>
                    @endif       
        
                  <div class="col-lg-12">
                    <form action="{{ route('updateBatch', $batchEdit->id)}}" method="POST"> 
                      {{csrf_field()}}
                   <div class="col-lg-6 col-lg-offset-3">
                             <div class="form-group{{ $errors->has('batch_name') ? ' has-error' : '' }}">
                            <label class="block clearfix">Batch Name<span style="color: red">*</span>
                              <span class="block input-icon input-icon-right">
                                <input id="batch_name" type="text" class="form-control" name="batch_name" value="{{ $batchEdit->batch_name }}">

                                  @if ($errors->has('batch_name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('batch_name') }}</strong>
                                      </span>
                                  @endif
                                
                                    <i class="ace-icon fa fa-building"></i>
                                  </span>
                                </label>
                                </div>
                             </div>  
                         
                        <div class='col-lg-6 col-lg-offset-3'>    
                            <div class="form-group{{ $errors->has('due_date') ? ' has-error' : '' }}">
                          <label class="block clearfix">Proposed Due Date<span style="color: red";>*</span>
                            <span class="block input-icon input-icon-right">
                              <input class="form-control date-picker" id="id-date-picker-1" type="text"  name="due_date" value="{{ $batchEdit->due_date }}">

                                @if ($errors->has('due_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                                @endif
                              
                              <i class="ace-icon fa fa-calendar"></i>
                            </span>
                          </label>
                          </div>
                        </div>
                         <div class="col-lg-6 col-lg-offset-3">
                         <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                          <label class="block clearfix">Special Notes
                            <span class="block input-icon input-icon-right">
                        

                               <textarea id="notes" type="text" class="form-control" name="notes" class="form-control" >{{  $batchEdit->instructions }}</textarea>

                                @if ($errors->has('notes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                            </span>
                          </label>
                          </div>
                        </div>
                         <div class="col-lg-8 col-lg-offset-2" style="margin-top: 20px">
                          <input type="submit" class="pull-right  btn btn-primary" value="Save">
                        </div>
                        </form>
                    </div>
 
                       <!--  </form> -->

            </div>

                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

@include('layouts.footer')
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">

  $('.date-picker').datepicker({
    format: 'yyyy-mm-dd',
   // startDate: '-3d'
});
</script>
  </body>
</html>

