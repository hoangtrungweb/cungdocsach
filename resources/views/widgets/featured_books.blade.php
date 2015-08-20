
 <div class="widget widget-featured-item">
  <div class="panel panel-info">
      <div class="panel-heading"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>Sách nổi bật</div>
      <div class="panel-body">
          <div class="featured-item">
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
            <div class="item">
              <div class="row">
                <div class="col-md-5">
                  <div class="thumb">
                    <a href="{!! URL::route('book.detail',$post->alias) !!}"><img src="{{ $link }}" class="img-responsive"></a>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="name">
                    <a href="{!! URL::route('book.detail',$post->alias) !!}">{{$post->title}}</a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
    </div>
  </div>
</div>