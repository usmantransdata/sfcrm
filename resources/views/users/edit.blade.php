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
                      Edit Users
                      <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                       Edit {{$user->first_name}}
                      </small>
                    </h1>
                  </div><!-- /.page-header -->
                   @if (session('flash_message'))
                      <div class="alert alert-success">
                          {{ session('flash_message') }}
                      </div>
            		  @endif   
                  <div class="row">
                    <div class="col-xs-12">
                <div class='col-lg-4 col-lg-offset-4'>

                    <h1><i class='fa fa-user-plus'></i> Edit {{$user->first_name}}</h1>
                    <hr>

                    {{ Form::model($user, array('route' => array('usersUpdate', $user->id), 'method' => 'POST')) }}{{-- Form model binding to automatically populate our fields with user data --}}

                    <div class="form-group">
                        {{ Form::label('first name', 'First Name') }}
                        {{ Form::text('first_name', null, array('class' => 'form-control')) }}
                    </div>

                      <div class="form-group">
                        {{ Form::label('last name', 'Last Name') }}
                        {{ Form::text('last_name', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                    </div>

                   
                     <div class="form-group">
                       @if ($user->is_delete == 1)
                      <p style="color:red">this account is deleted</p>
                      @endif
                      
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}<br>
                        {{ Form::password('password', array('class' => 'form-control')) }}

                    </div>
                   

                    <div class="form-group">
                        {{ Form::label('password', 'Confirm Password') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                    </div>
                    {{ Form::submit('Submit', array('class' => 'pull-right btn btn-primary')) }}

                    {{ Form::close() }}

                </div>
 
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

@include('layouts.footer')
  </body>
</html>

