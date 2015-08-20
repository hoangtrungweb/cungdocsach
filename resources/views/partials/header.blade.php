
  <header class="header">
<!--     <div class="top">
      <div class="container">
        <div class="col-md-6 area-left text-right">
        @if (Auth::guest())
          <div class="form-group">
            <a href="{!! URL::to('auth/register') !!}" class="relog register_link">Đăng ký</a>
            <a href="{!! URL::to('auth/login') !!}" class="relog login_link">Đăng nhập</a>
          </div>
        @else
        <div class="form-group">
            <a href="#" class="relog register_link">Xin chào, {{ Auth::user()->name }}</a>
            <a href="{!! URL::to('auth/logout') !!}" class="relog login_link">Thoát</a>
        </div>
        @endif
        </div>
        <div class="col-md-6 area-right">
          Contact us on 0 800 123-4567 or tuanmythkt@gmail.com
        </div>
      </div>  
    </div> -->
<!--     <div class="logo-area">
      <div class="container">
        <div class="col-md-3">
          <div class="logo">
            <img src="{{asset('assets/site/images/logo_2.jpg')}}" class="img-responsive" style="width:100%;">
          </div>
        </div>
        <div class="col-md-9">
            <div id="cbp-qtrotator" class="cbp-qtrotator">
          <div class="cbp-qtcontent">
            <img src="{{asset('assets/site/quotesrotator/images/1.jpg')}}" alt="img01" />
            <blockquote>
              <p>People eat meat and think they will become as strong as an ox, forgetting that the ox eats grass.</p>
              <footer>Pino Caruso</footer>
            </blockquote>
          </div>
          <div class="cbp-qtcontent">
            <img src="{{asset('assets/site/quotesrotator/images/2.jpg')}}" alt="img02" />
            <blockquote>
              <p>Nothing will benefit human health and increase the chances for survival of life on Earth as much as the evolution to a vegetarian diet.</p>
              <footer>Albert Einstein</footer>
            </blockquote>
          </div>
          <div class="cbp-qtcontent">
            <img src="{{asset('assets/site/quotesrotator/images/3.jpg')}}" alt="img03" />
            <blockquote>
              <p>If you don't want to be beaten, imprisoned, mutilated, killed or tortured then you shouldn't condone such behaviour towards anyone, be they human or not.</p>
              <footer>Moby</footer>
            </blockquote>
          </div>
          <div class="cbp-qtcontent">
            <img src="{{asset('assets/site/quotesrotator/images/4.jpg')}}" alt="img04" />
            <blockquote>
              <p>My body will not be a tomb for other creatures.</p>
              <footer>Leonardo Da Vinci</footer>
            </blockquote>
          </div>
        </div>
        </div>
      </div>
    </div> -->

    <div class="main-menu">
        <!-- Static navbar -->
        <nav class="navbar navbar-default">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
          
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="{!! URL::to('') !!}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
                <li class="{{ (Request::is('/category') ? 'active' : '') }}"><a href="{!! URL::to('the-loai/sach-ky-nang') !!}">Sách kỹ năng</a></li>
                <li class="{{ (Request::is('/category') ? 'active' : '') }}"><a href="{!! URL::to('the-loai/sach-chuyen-nganh') !!}">Sách chuyên ngành</a></li>
                <li class="{{ (Request::is('/category') ? 'active' : '') }}"><a href="{!! URL::to('the-loai/truyen') !!}">Truyện</a></li>
                <li class="{{ (Request::is('/contact') ? 'active' : '') }}"><a href="">Liên hệ</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                <li class=""><a href="{!! URL::to('auth/register') !!}">Đăng ký</a></li>
                <li class=""><a href="{!! URL::to('auth/login') !!}">Đăng nhập</a></li>
                @else
                <li class="dropdown">
                <a style="text-transform: initial" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Xin chào, {{ Auth::user()->name }}<span class="caret"></span></a>
                <ul class="dropdown-menu" >
                  <li><a href="#" style="text-transform: initial">Tài khoản của tôi</a></li>
                  <li><a href="{!! URL::to('auth/logout') !!}" style="text-transform: initial">Thoát</a></li>
                  
                </ul>
              </li>
                @endif

            </ul>
            
            </div><!--/.nav-collapse -->
          </div><!--/.container-fluid -->
        </nav>
    </div>
  </header>