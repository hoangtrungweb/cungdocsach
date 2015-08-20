 @extends('templates.site.main')
 @section('title')
    Trang đăng ký
 @stop
 @section('body.content')
      @include('errors.list')
 <form class="form-horizontal" role="form" method="POST" action="{!! URL::to('/auth/register') !!}">
 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                    			<legend class="text-center"> <strong >Vui lòng nhập đầy đủ thông tin để đăng ký!</strong> </legend>
                               
                     
                                    <div class="form-group">
                                        <label for="name" class="col-lg-3 control-label">Họ tên</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-lg-3 control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input type="email" class="form-control" id="email" name="email"  placeholder="Email"  value="{{ old('email') }}">
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <label for="facebook" class="col-lg-3 control-label">Link Facebook cá nhân</label>
                                        <div class="col-lg-9">
                                            <input type="facebook" class="form-control" id="facebook" name="facebook"  placeholder="Link Facebook"  value="{{ old('facebook') }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-lg-3 control-label">Mật khẩu</label>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="col-lg-3 control-label">Nhập lại mật khẩu</label>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control" id="password_confirmation"  name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                        </div>
                                    </div>
                                    <div class="form-group">
	                                    <div class="col-lg-9 col-lg-offset-3">
                                    	   <div class="checkbox">
						                             <label>
						                                 <input type="checkbox"><span class="checkbox-material"><span class="check"></span></span> Đồng ý với các Điều khoản và Quy định
						                             </label>
						                         </div>
	                                    </div>
                                               
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-9 col-lg-offset-3">
              
                                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
 @stop