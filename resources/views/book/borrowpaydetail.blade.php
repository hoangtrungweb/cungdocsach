 @extends('templates.site.main')
 @section('title')
 Cùng đọc sách | Trang chi tiết mượn trả
 @stop
 @section('head.styleinline')
 	<style type="text/css">
 		table td.thumb{
 			width: 15%;
 		}
 		table td.title{
 			width: 30%;
 		}
 	</style>
 @stop

@section('body.content')

<div class="content borrowpaydetail">
	<section id="breadcrumb">
		<ol class="breadcrumb">
			<li><a href="{!! URL::to('') !!}">Trang chủ</a></li>
			<li><a href="#">Chi tiết mượn/trả</a></li>
		</ol>
	</section>
	<div class="show_alert">
		
	</div>
	   @if (Session::has('edit_message'))
		        <div class="alert alert-success }}">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            {{ Session::get('edit_message') }}
		        </div>
		    @endif
	<!-- <section class="requesting-books">
		<h1>Sách đang yêu cầu mượn</h1>
		<table class="table table-striped table-hover ">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Tiêu đề sách</th>
		            <th>Tác giả</th>
		            <th>Hình ảnh</th>
		        </tr>
		    </thead>
		    <tbody>
		            <?php $count = 0; ?>
        @foreach ($listborrowingBooks as $post)
       		<?php
	            $base_url = URL::to('/');
	            $link  =  $base_url .'/uploads/products/images/default.jpg';
	            $link_images = $base_url.'/uploads/products/images/'.$post->thumbnail;
	            $title = Helper::cutString($post->title,60,true,true);
	            if(Helper::isUrlExist($link_images)) {
	                $link =    $link_images;
	            }
            ?>
		        <tr>
		            <td>{{$count+1}}</td>
		             <td class="title"><a href="{!! URL::route('book.detail',$post->alias)!!}">{{ $post->title }}</a></td>
		            <td>{{ $post->author }}</td>
		             <td class="thumb"><img class="img-responsive" src="{{ $link }}"></td>
		        </tr>
		    @endforeach
		    </tbody>
		</table>
	</section> -->
	<div class="section">
	<!-- Sách đang mượn -->
	<section class="divide borrowing-books">
		 <h1>Sách đang mượn</h1>
		 @if(count($borrowingBooks) > 0 )
			<table class="table table-striped table-hover ">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Tiêu đề sách</th>
		            <th>Hình ảnh</th>
		            <th>Ngày mượn</th>
		            <th>Ngày trả</th>
		            <th>Tên chủ sách</th>
		            <th>Facebook liên hệ</th>
		        </tr>
		    </thead>
		    <tbody>
		            <?php $count = 0; ?>
        @foreach ($borrowingBooks as $post)
       		<?php
	            $base_url = URL::to('/');
	            $link  =  $base_url .'/uploads/products/images/default.jpg';
	            $link_images = $base_url.'/uploads/products/images/'.$post->thumbnail;
	            $title = Helper::cutString($post->title,60,true,true);
	            if(Helper::isUrlExist($link_images)) {
	                $link =    $link_images;
	            }
            ?>
		        <tr>
		            <td>{{$count+1}}</td>
		             <td class="title"><a href="{!! URL::route('book.detail',$post->alias)!!}">{{ $post->title }}</a></td>
		            <td class="thumb"><img class="img-responsive" src="{{ $link }}"></td>
		           	<td>{{ $post->borrow_at }}</td>
		            <td>{{ $post->return_at }}</td>
		            <td>{{ $post->owner_name }}</td>
		            <td><a href="{{ $post->owner_facebook }}">{{ $post->owner_facebook }}</a></td>
		        </tr>
		    @endforeach
		    </tbody>
		</table>
		@else 
		<h3 style="font-style: italic;">Không có dữ liệu</h3>
		@endif
	</section>

	<!--  -->
	
	<!-- Sách người khác yêu mượn chờ mình duyệt -->
	<section class="divide berequesting-books">
		<h1>Sách yêu cầu mượn chờ duyệt</h1>
			<table class="table table-striped table-hover ">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Tên người mượn</th>
		            <th>Tiêu đề sách</th>
		            <th>Hình ảnh</th>
		            <th>Ngày gửi yêu cầu</th>
		        </tr>
		    </thead>
		    <tbody>
		            <?php $count = 0; ?>
        @foreach ($berequestingBooks as $post)
       		<?php
	            $base_url = URL::to('/');
	            $link  =  $base_url .'/uploads/products/images/default.jpg';
	            $link_images = $base_url.'/uploads/products/images/'.$post->thumbnail;
	            $title = Helper::cutString($post->title,60,true,true);
	            if(Helper::isUrlExist($link_images)) {
	                $link =    $link_images;
	            }
            ?>
		        <tr>
		            <td>{{$count+1}}</td>
		            <td>{{ $post->name }}</td>
		            <td class="title"><a href="{!! URL::route('book.detail',$post->alias)!!}">{{ $post->title }}</a></td>
		            <td class="thumb"><img class="img-responsive" src="{{ $link }}"></td>
		            <td>{{ $post->request_date }}</td>
		            <td style="width:20%">
		            	<div class="form-inline">
				            <button  data-userid="{{$post->userid}}"  data-bookid="{{$post->id}}"  type="button" class="btn btn-success accept"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Duyệt </button>
				            <button  data-userid="{{$post->userid}}"  data-bookid="{{$post->id}}" type="button" class="btn btn-danger refuse"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Từ chối </button>
			            </div>
		            </td>
		        </tr>
		    @endforeach
		    </tbody>
		</table>
	</section>
		<!-- Sách đang cho người khác mượn -->
	<section class="divide lending-books">
		<h1>Sách đang cho mượn</h1>
			<table class="table table-striped table-hover ">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Tên người mượn</th>
		            <th>Tiêu đề sách</th>
		            <th>Hình ảnh</th>
		            <th>Ngày cho mượn</th>
		        </tr>
		    </thead>
		    <tbody>
		            <?php $count = 0; ?>
        @foreach ($lendingBooks as $post)
       		<?php
	            $base_url = URL::to('/');
	            $link  =  $base_url .'/uploads/products/images/default.jpg';
	            $link_images = $base_url.'/uploads/products/images/'.$post->thumbnail;
	            $title = Helper::cutString($post->title,60,true,true);
	            if(Helper::isUrlExist($link_images)) {
	                $link =    $link_images;
	            }
            ?>
		        <tr>
		            <td>{{$count+1}}</td>
		            <td>{{ $post->name }}</td>
		            <td class="title"><a href="{!! URL::route('book.detail',$post->alias)!!}">{{ $post->title }}</a></td>
		            <td class="thumb"><img class="img-responsive" src="{{ $link }}"></td>
		            <td>{{ $post->request_date }}</td>
		            <td style="width:20%">
		            	<div class="form-inline">
				            <button  data-userid="{{$post->userid}}"  data-bookid="{{$post->id}}"  type="button" class="btn btn-primary paid"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đã trả </button>
			            </div>
		            </td>
		        </tr>
		    @endforeach
		    </tbody>
		</table>
	</section>
	</div>
<form id="formHandleBorrow" action="{{ URL::route('book.handleborrowload')}}" method="POST">
	 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<input type="hidden" name="user_id" id="user_id" value="" >
	<input type="hidden" name="book_id" id="book_id" value="" >
	<input type="hidden" name="action" id="action" value="" >
</form>
</div>

@stop
@section('body.script')
<script type="text/javascript">
$(document).ready(function() {
	$(".accept").click(function(){
		var user_id = $(this).data('userid');
		var book_id = $(this).data('bookid');
		$("#user_id").val(user_id);
		$("#book_id").val(book_id);
		$("#action").val('accept');
		$("#formHandleBorrow").submit();
		// handleborrow(user_id,book_id,'accept');
		// $(this).parents('tr').remove();


		
	});
	
	$(".refuse").click(function(){
		var user_id = $(this).data('userid');
		var book_id = $(this).data('bookid');
		$("#user_id").val(user_id);
		$("#book_id").val(book_id);
		$("#action").val('refuse');
		$("#formHandleBorrow").submit();
		// handleborrow(user_id,book_id,'refuse');
		// $(this).parents('tr').remove();
	});

	$(".paid").click(function(){
		var user_id = $(this).data('userid');
		var book_id = $(this).data('bookid');
		$("#user_id").val(user_id);
		$("#book_id").val(book_id);
		$("#action").val('paid');
		$("#formHandleBorrow").submit();
		// handleborrow(user_id,book_id,'refuse');
		// $(this).parents('tr').remove();
	});
	$("div.alert").not('.alert-important').delay(3000).slideUp(300);

	
});
</script>
@stop

