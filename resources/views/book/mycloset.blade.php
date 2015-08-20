 @extends('templates.site.main')
 @section('title')
 Cùng đọc sách | Tủ sách của tôi
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
	  @if(count($listItem)>0)
	<section class="section_table borrowing_books">
		   @if (Session::has('edit_message'))
		        <div class="alert alert-success }}">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            {{ Session::get('edit_message') }}
		        </div>
		    @endif
		<table class="table table-striped table-hover ">
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Tiêu đề sách</th>
		            <th>Tác giả</th>
		            <th>Hình ảnh</th>
		            <th>Tình trạng</th>
		            <th>Ngày tạo</th>
		        </tr>
		    </thead>
		    <tbody>
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
            ?>
		        <tr>
		            <td>{{$count+1}}</td>
		            <td class="title"><a href="{!! URL::route('book.getedit',$post->id)!!}">{{ $post->title }}</a></td>
		            <td>{{ $post->author }}</td>
		            <td class="thumb"><img class="img-responsive" src="{{ $link }}"></td>
		            <td><span class="label {{ $status_class}}">{{$status_content}}</span></td>
		            <td>{{ $post->created_at }}</td>
		        </tr>
		    @endforeach
		    </tbody>
		</table>
	</section>
	  @include('partials.paginator')
	@endif
</div>

@stop

@section('body.script')
<script type="text/javascript">
	$("div.alert").not('.alert-important').delay(3000).slideUp(300);
</script>
@stop