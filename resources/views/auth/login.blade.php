 @extends('templates.site.main')
 @section('page')
	login-page
 @stop
 @section('title')
Trang đăng nhập
 @stop
      @section('head.css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/formvalidation/css/formValidation.min.css')}}">
      <!-- <link rel="stylesheet" href="http://cdn.jsdelivr.net/semantic-ui/1.2.0/semantic.min.css"/>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/formvalidation/css/semantic.min.css')}}"> -->
  @stop
  @section('head.script')

    <script language="javascript" src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <script language="javascript" src="{{asset('assets/ckeditor/adapters/jquery.js')}}"></script>
   <!-- <script language="javascript" src="{{asset('assets/ckfinder/ckfinder.js')}}"></script> -->

    <script type="text/javascript" src="{{asset('assets/formvalidation/js/formValidation.js')}}"></script>
     <script type="text/javascript" src="{{asset('assets/formvalidation/js/framework/bootstrap.min.js')}}"></script>


  @stop

 @section('body.content')
      @include('errors.list')
      <div class="login-page">
      	<form id="loginForm" class="form-horizontal" method="POST" action="{!! URL::to('/auth/login') !!}">
      	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                    			<legend class="text-center"> <strong >Đăng nhập!</strong> </legend>
                               
                                    <div class="form-group">
                                        <label for="email" class="col-lg-3 control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-lg-3 control-label">Mật khẩu</label>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                    
                                        </div>
                                    </div>
                                    <div class="form-group vertical-align">
	                                    <div class="col-lg-5 col-lg-offset-3">
                                    	   <div class="checkbox">
						                             <label>
						                                 <input type="checkbox" name="remember"><span class="checkbox-material"><span class="check"></span></span> Ghi nhớ mật khẩu
						                             </label>
						                         </div>
	                                    </div>
	                                    <div class="col-lg-4"><label><a href="">Quên mật khẩu</label></a></div>
                                               
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-9 col-lg-offset-3">
              
                                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            </div>
<script type="text/javascript">
        $('#loginForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        },
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and can\'t be empty'
                        },
                    }
                },
            }
        });
</script>
 @stop