 @extends('templates.site.main')
 @section('title')
    Cùng đọc sách | Trang thêm sách
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
 	<div class="site-addbook-page">
      @include('errors.list')

     @include('flash::message')
     
      	<form id="horizontalForm" class="form-horizontal" enctype='multipart/form-data' method="POST" action="@if(isset($item)){{ URL::route('book.getedit',$item->id) }}
            @else{{ URL::route('book.create') }}@endif">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Tên sách <span class="require">(*)</span></label> 
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tên sách" value="{{{ Input::old('title', isset($item) ? $item->title : null) }}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="author" class="col-lg-3 control-label">Tác giả</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="author" name="author" placeholder="Nhập tên giả" value="{{{ Input::old('author', isset($item) ? $item->author : null) }}}">
                        </div>
                    </div>
                    @if(count($listCategories)>0)
                     <div class="form-group">
                        <label for="category" class="col-lg-3 control-label">Thể loại</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="select" name="category" id="category">
                                <option value="">Chọn thể loại sách</option>
                        
                                  @foreach ($listCategories as $post)
                                    <option value="{!! $post->id !!}" @if(!empty($itemCategory))
                                        @if($post->id==$itemCategory)
                                selected="selected" @endif @endif>{!!$post->name!!}</option>
                                  @endforeach
                              
                            </select>
                        </div>
                    </div>
                    @endif
                <!--     <div class="form-group">
                        <label for="alias" class="col-lg-3 control-label">Alias</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="alias" name="alias" placeholder="alias">
                        </div>
                    </div> -->
             
                    <div class="form-group">
                        <label for="description" class="col-lg-3 control-label">Giới thiệu sách <span class="require">(*)</span></label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="description" name="description">{{{ Input::old('description', isset($item) ? $item->description : null) }}}</textarea>
                            
                 

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="detailinfo" class="col-lg-3 control-label">Thông tin chi tiết</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="detailinfo" id="detailinfo">{{{ Input::old('description', isset($item) ? $item->description : null) }}}</textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'detailinfo' );
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail" class="col-lg-3 control-label">Chọn ảnh cho sách</label>
                        <div class="col-md-9">
                            <input name="thumbnail" type="file" class="uploader" id="thumbnail" value="Chọn ảnh" />
                        </div>
                       <!--  <div class="col-md-3">
                            <input type="button" id="select_thumb" class="form-control btn-primary" value="Chọn ảnh" />
                        </div> -->
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-3">
                            <div class="checkbox">
                                 <label>
                                     <input type="checkbox" checked="" name="status"><span class="checkbox-material"><span class="check"></span></span> Sẵn sàng cho mượn
                                 </label>
                             </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-success">Lưu</button>
                            <a href=""class="btn btn-warning">Quay lại</a>
                        </div>
                    </div>

				</form>
	</div>
 @stop

 @section('body.script')
 <script type="text/javascript">
 $(document).ready(function () {

    /*code bung popup ckfinder*/
    // var button2 = document.getElementById( 'select_thumb' );

    // button2.onclick = function() {
    //     selectFileWithCKFinder( 'thumbnail' );
    //     $("#thumbnail").focus();
    // };

    // function selectFileWithCKFinder( elementId ) {
    //     CKFinder.popup( {
    //         chooseFiles: true,
    //         width: 800,
    //         height: 600,
    //         onInit: function( finder ) {
    //             finder.on( 'files:choose', function( evt ) {
    //                 var file = evt.data.files.first();
    //                 var output = document.getElementById( elementId );
    //                 output.value = file.getUrl();
    //             } );

    //             finder.on( 'file:choose:resizedImage', function( evt ) {
    //                 var output = document.getElementById( elementId );
    //                 output.value = evt.data.resizedUrl;
    //             } );
    //         }
    //     } );
    // }
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#horizontalForm').formValidation({
        excluded: [':disabled'],
        icon: {
            valid: 'checkmark icon',
            invalid: 'remove icon',
            validating: 'refresh icon',
            feedback: 'fv-control-feedback'
        },
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: 'Bạn cần nhập tên sách'
                    },
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Tên sách có độ dài từ 3 đến 100 kí tự'
                    },
                }
            },
            category: {
                validators: {
                    notEmpty: {
                        message: 'Bạn cần chọn thể loại cho sách'
                    }
                }
            },
            thumbnail: {
                validators: {
                     notEmpty: {
                        message: 'Bạn cần chọn ảnh cho sách'
                    },
                    file: {
                        extension: 'jpeg,png,jpg',
                        type: 'image/jpeg,image/png,image/jpg',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'Định dạng hỗ trợ:jpeg,png,jpg - Kích cỡ không quá 2M'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'Giới thiệu sách không được để trống'
                    },
                    callback: {
                        message: 'Giới thiệu sách tối thiểu phải 20 kí tự',
                        callback: function(value, validator, $field) {
                            if (value === '') {
                                return true;
                            }
                            // Get the plain text without HTML
                            var div  = $('<div/>').html(value).get(0),
                                text = div.textContent || div.innerText;

                            return text.length >= 20;
                        }
                    }
                }
            },
            // thumbnail: {
            //     validators: {
            //         notEmpty: {
            //             message: 'Bạn cần chọn ảnh cho sách'
            //         },
            //     }
            // },
        }
    }).find('[name="description"]')
        .ckeditor()
        .editor
        .on('change', function() {
                    $('#horizontalForm').formValidation('revalidateField', 'description');
                });

        //
        $("div.alert").not('.alert-important').delay(3000).slideUp(300);
});
</script>
 @stop