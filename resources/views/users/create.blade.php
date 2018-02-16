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
                      Add Users
                     <!--  <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Add Users
                      </small> -->
                    </h1>
                  </div><!-- /.page-header -->
                  <div class="row">
                    <div class="col-xs-12">

 @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
            <div class='col-lg-4 col-lg-offset-4'>

             <!--  <h1><i class='fa fa-user-plus'></i> Add User</h1>
                        <hr> -->

                  <form action="{{route('user_signup')}}" method="POST" id="form">
                    {{csrf_field()}}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                          <label class="block clearfix">User Type
                              <select name="role_id" class="form-control" id="form-field-select-1">
                                 @foreach ($roles as $role)
                                 @if($role->role == 'Super-Admin')
                                      @elseif($role->role == 'Client')
                                      @else
                                <option value="{{$role->id}}">{{$role->role}}</option>
                                @endif
                                @endforeach
                             </select>
                             
                          </label>
                         </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                          <label class="block clearfix">First Name
                            <span class="block input-icon input-icon-right">
                              <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                              
                              <i class="ace-icon fa fa-user"></i>
                            </span>
                          </label>
                          </div>


                           <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                          <label class="block clearfix">Last Name
                            <span class="block input-icon input-icon-right">
                              <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                              
                              <i class="ace-icon fa fa-user"></i>
                            </span>
                          </label>
                          </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label class="block clearfix">Email
                            <span class="block input-icon input-icon-right">
                               <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <i class="ace-icon fa fa-envelope"></i>
                            </span>
                          </label>
                           </div>

             <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"> 
                          <label class="block clearfix">Password
                            <span class="block input-icon input-icon-right">
                             <input id="password" type="password" class="form-control" name="password" required onChange="checkPasswordMatch();">  
                             <span><h6>(For better security,use a password with lower case, upper case include special characters)</h6></span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                              <i class="ace-icon fa fa-lock"></i>
                               <span id="result"></span>
                            </span>
                          </label>
                          </div>

                         <div class="form-group">
                          <label class="block clearfix">Repeat Password
                            <span class="block input-icon input-icon-right">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                              <i class="ace-icon fa fa-retweet"></i>
                               <span class="registrationFormAlert" id="divCheckPasswordMatch"></span>
                            </span>
                          </label>
                        </div>

                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                  </form>

            </div>

                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.page-content-area -->
              </div><!-- /.page-content -->
            </div><!-- /.main-content -->

@include('layouts.footer')


<style type="text/css">
#form .short{
font-weight:bold;
color:#FF0000;
font-size:larger;
}
#form .weak{
font-weight:bold;
color:orange;
font-size:larger;
}
#form .good{
font-weight:bold;
color:#2D98F3;
font-size:larger;
}
#form .strong{
font-weight:bold;
color: limegreen;
font-size:larger;
}  
</style>
    <!-- inline scripts related to this page -->
   <script type="text/javascript">
     $(document).ready(function() {
$('#password').keyup(function() {
$('#result').html(checkStrength($('#password').val()))
})
function checkStrength(password) {
var strength = 0
if (password.length < 6) {
$('#result').removeClass()
$('#result').addClass('short')
return 'Too short'
}
if (password.length > 7) strength += 1
// If password contains both lower and uppercase characters, increase strength value.
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
// If it has numbers and characters, increase strength value.
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
// If it has one special character, increase strength value.
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// If it has two special characters, increase strength value.
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// Calculated strength value, we can return messages
// If value is less than 2
if (strength < 2) {
$('#result').removeClass()
$('#result').addClass('weak')
return 'Weak'
} else if (strength == 2) {
$('#result').removeClass()
$('#result').addClass('good')
return 'Good'
} else {
$('#result').removeClass()
$('#result').addClass('strong')
return 'Strong'
}
}
});
   </script>
   <script type="text/javascript">
function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#password-confirm").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("<span style='font-weight: bold;    font-size: larger;color: #FF0000;'>Passwords do not match!</span>");
    else
        $("#divCheckPasswordMatch").html("<span style='font-weight: bold;    font-size: larger;color: #2D98F3;'>Passwords match.</span>");
}

$(document).ready(function () {
   $("#password-confirm").keyup(checkPasswordMatch);
});     
   </script>
  </body>
</html>

