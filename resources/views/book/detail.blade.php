 @extends('templates.site.main')
 @section('title')
 Cùng đọc sách | {{ $item->title }}
 @stop
 @section('body.content')
	<div class="content detail-page">
		<section id="breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{!! URL::to('') !!}">Trang chủ</a></li>
				<li><a href="#">{{ $item->title }}</a></li>
			</ol>
		</section>
		<?php 	
			$base_url = URL::to('/');
			$link  =  $base_url .'/uploads/products/images/default.jpg';
			$link_images = $base_url.'/uploads/products/images/'.$item->thumbnail;
			if(Helper::isUrlExist($link_images)) {
             	$link  =  $link_images;
          	}
		?>
		<article class="">
			<div class="row">
				<div class="col-md-4">
					<div class="under-item">
						<div class="thumb">
							<img src="{{$link}}" class="img-responsive">
						</div>
						<div class="options">
							<div class="form-group text-center">
								<button class="add-love btn btn-default"></button>
							</div>
							<div class="event_borrow">
		
								@if(Auth::guest())
									<!-- Show popup thông báo bạn phải đăng nhập -->
									@if($item->status == AVAILABLE)
									<div class="form-group">
										<button id="alertLogin" type="button" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> MƯỢN SÁCH</button>
									</div>
									@else
									<div class="form-group">
										<button class="btn btn-primary btn-block"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> ĐANG ĐƯỢC MƯỢN</button>
									</div>
									@endif
								@else
									@if($item->user_id != Auth::id())
										@if($statusRequest == STATUS_ACCEPT)
											<div class="form-group">
												<button href="#" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> ĐANG ĐƯỢC MƯỢN</button>
											</div>
										@elseif($statusRequest == STATUS_WAITING)
											<div class="form-group">
												<button class="btn btn-primary btn-block"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> ĐANG CHỜ XỬ LÝ</button>
											</div>
										@else 
											<div class="form-group">
												<button id="alertRequest" type="button" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> MƯỢN SÁCH</button>
											</div>
										@endif
									@endif
								@endif 
						
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="general-info">
						<h1 class="title">{{ $item->title }}</h1>
						<div class="author">
							<label>Tác giả: {{ $item->author }}</label>	
						</div>
						<div class="categories">
							<label>Thể loại: {{ $nameCate }}</label>
						</div>
					</div>
					<ul id="myTabs" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#intro" id="intro-tab" role="tab" data-toggle="tab" aria-controls="intro" aria-expanded="true">Giới thiệu sách</a></li>
						<li role="presentation" class=""><a href="#info" id="info-tab" role="tab" data-toggle="tab" aria-controls="info" aria-expanded="true">Thông tin chi tiết</a></li>
						<li role="presentation" class=""><a href="#comment" role="tab" id="comment-tab" data-toggle="tab" aria-controls="comment" aria-expanded="false">Đánh giá - Bình luận</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="intro" aria-labelledby="intro-tab">
							<div class="block">
								{!!$item->description!!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="info" aria-labelledby="info-tab">
							<div class="block">
									{!!$item->detailinfo!!}
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="comment" aria-labelledby="dropdown1-tab">
							<div class="block">
								Chưa có đánh giá, bình luận nào.
							</div>
						</div>
					</div>
				</div>
			</div>
		</article>
		<form id="form">
			 <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input id="user_id" name="user_id" type="hidden" value="<?php if(!Auth::guest()) echo Auth::user()->id; else echo ''?>">
			<input id="book_id" name="book_id" type="hidden" value="{{$item->id}}">
			<input id="owner_id" name="owner_id" type="hidden" value="{{$item->user_id}}">
		</form>
<hr>
@widget('SamecategoryBooks', ['id' => $idCate])
</div>
 @stop

 @section('body.script')
 	<script type="text/javascript">
 		$("#alertLogin").click(function(){
 			swal({
 			title: "",
			  text: "Vui lòng Đăng nhập để Mượn sách!",
			  type: "info",
			  showCancelButton: true,
			  confirmButtonClass: "btn-info",
			  confirmButtonText: "Đăng nhập",
			  closeOnConfirm: false
			},
			function(){
			 	window.location.href = "/auth/login";
			});
 		});

 		$("#alertRequest").click(function(){
 			    swal({
			      title: "", 
			      text: "Bạn có chắc chắn mượn cuốn sách này", 
			      type: "info",
			      showCancelButton: true,
			      closeOnConfirm: true,
			      confirmButtonText: "Xác nhận!",
			      confirmButtonColor: "#ec6c62"
			    }, function() {
			   	 var dataForm = $( "#form" ).serialize();
			      $.ajax({
			        url: '<?php echo URL::route("book.bookrequest") ?>',
			        // url:'/sach/yeu-cau-muon',
			        type: "POST",
			        data:dataForm,
			        dataType: 'html',
			       success: function (result) {
                   		swal("Gửi yêu cầu thành công!", "Vui lòng liên hệ với chủ sách qua link facebook sau:"+result, "success")
                   		$(".event_borrow").html('<div class="form-group"><a href="#" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> ĐANG CHỜ XỬ LÝ</a></div>');
                	},
			      });
			    });
 		});
 	</script>
 @stop