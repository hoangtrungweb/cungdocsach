
<div class="widget widget-same-author">
  <h3 class="title">Sách cùng thể loại</h3>
  <div class="row list-item">
            @foreach ($listItem as $post)
              <?php 
           
              $base_url = URL::to('/');
              $link  =  $base_url .'/uploads/products/images/default.jpg';
              $link_images = $base_url.'/uploads/products/images/'.$post->thumbnail;
              $title = Helper::cutString($post->title,60,true,true);
              if(Helper::isUrlExist($link_images)) {
                $link =    $link_images;
              }
               ?>

  <div class="col-md-3">
    <div class="product">
          <div class="product-thumb">
            <a href="{!! URL::route('book.detail',$post->alias) !!}"><img src="{{$link}}" class="img-responsive center-block"></a>
          </div>
          <div class="product-info">
            <div class="product-name text-center">
              <a href="{!! URL::route('book.detail',$post->alias) !!}"><h4>{{$post->title}}</h4></a>
            </div>
          </div>
        </div>
   </div>
   @endforeach
  </div>
</div>