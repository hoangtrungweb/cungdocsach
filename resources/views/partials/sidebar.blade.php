  <div class="sidebar">
       @if(Auth::check())
            <div class="widget widget-profile">
              <div class="panel panel-info">
                  <div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Tài khoản của tôi</div>
                  <div class="panel-body">
                    <div class="info">
                      <div class="avatar">
                        <img src="{{asset('assets/site/images/jennifer-doe.jpg')}}" class="img-responsive center-block" > 
                      </div>
                      <div class="personal-info text-center">
                        <div class="name">
                          <h4>{{ Auth::user()->name }}</h4>
                        </div>
                        <div class="job">
                        <h4>Stanford University</h4>
                        </div>
                      </div>
                    </div>
                    <ul id="navigation">
                                <!--   <li class="currentmenu">
                                    <a href="#">
                                      <div class="icon"><i class="mdi-editor-border-color"></i></div>
                                      <div class="text">Chỉnh sửa thông tin</div>
                                    </a>
                                  </li> -->
                                  <li>
                                    <a href="{{URL::route('book.borrowpaydetail')}}">
                                      <div class="icon"><i class="mdi-maps-local-mall"></i></div>
                                      <div class="text">Quản lý mượn/trả sách</div>
                                    </a>
                                  </li>  
                                  <li>
                                    <a href="{!! URL::route('book.mycloset')!!}">
                                      <div class="icon"><i class="mdi-maps-local-mall"></i></div>
                                      <div class="text">Tủ sách của tôi</div>
                                    </a>
                                  </li> 
                                  <li>
                                    <a href="{{URL::route('book.create')}}">
                                      <div class="icon"><i class="mdi-hardware-mouse"></i></div>
                                      <div class="text">Cập nhật tủ sách</div>
                                    </a>
                                  </li> 
                                  
                                 <!--  <li>
                                    <a href="#">
                                      <div class="icon"><i class="mdi-action-favorite"></i></div>
                                      <div class="text">Sách yêu thích</div>
                                    </a>
                                  </li>  -->

                                  <li>
                                    <a href="{!! URL::to('auth/logout') !!}">
                                      <div class="icon"><i class="mdi-action-swap-horiz"></i></div>
                                      <div class="text">Thoát</div>
                                    </a>
                                  </li> 
                              </ul>
          
                </div>
              </div>
            </div>
          @endif
          
          @widget('featuredBooks', ['count' => 4])


   <div class="widget widget-video">
    <div class="panel panel-info">
        <div class="panel-heading"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>Quà tặng cuộc sống</div>
        <div class="panel-body">
          <div class="row">
            <iframe style="max-width: 100%" src="https://www.youtube.com/embed/XcP1udDzG4M" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
    </div>
  </div>
</div>