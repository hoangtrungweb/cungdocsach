 @extends('templates.site.main')
 @section('title')
 Cùng đọc sách | Trang kết quả tìm kiếm
 @stop
 @section('body.content')
  <div class="content home-page">
     @include('partials.search')
       <div class="total text-center"><h4>Có tất cả {{$total}} kết quả trả về!</h4></div>
    <div class="list-product">
       @if(count($listItem)>0)
        <?php $count = 0; ?>
        @foreach ($listItem as $post)
        <?php
           
            $base_url = URL::to('/');
            $link  =  $base_url .'/uploads/products/images/default.jpg';
            $link_images = $base_url.'/uploads/products/images/'.$post->thumbnail;
            $title = Helper::cutString($post->title,60,true,true);
            if(Helper::isUrlExist($link_images)) {
                $link =    $link_images;
            }

            $status_class ='label-success';
            $status_content = 'Có thể mượn';
            if($post->status == UNAVAILABLE) {
              $status_class = 'label-warning';
              $status_content = 'Không thể mượn';

            }
            else if($post->status == LENDING) {
              $status_class = 'label-info';
              $status_content = 'Đang được mượn';
            }

            if($count % 4 == 0) echo '<div class="row list-item">';
         ?>
    
          <div class="col-md-3">
            <div class="product">
              <div class="product-thumb">
                <a href="assets/site/"><img src="{!! $link !!}" class="img-responsive center-block"></a>
              </div>
              <div class="product-info">
                <div class="product-name text-center">
                  <a href="{!! URL::route('book.detail',$post->alias) !!}"><h4>{!!  $title !!}</h4></a>
                </div>
                <div class="status text-center">
                  <span class="label {!! $status_class !!}">{!! $status_content !!} ...</span>
                </div>
                <div class="options">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="love text-left">
                        <i class="mdi-action-favorite mdi-material-pink" style="font-size: 20pt;"></i>
                        <span class="count">20</span>
                      </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>


    
     <?php  $check = $count +1; if($check % 4 == 0 || $check == count($listItem)) echo '</div>'; $count++; ?>
      @endforeach
      @endif


    </div>
  @if($listItem->hasPages())
    <div class="paginator text-center">
    {!! $listItem->appends(Request::only('q'))->render() !!}
    </div>
  @endif
  </div>    
@endsection