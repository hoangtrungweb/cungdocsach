    <div class="search-product">
        <form action="{{URL::route('book.getfind')}}" class="form-horizontal"  method="get" name="SearchForm" id="SearchForm">
           
           
          	<div class="form-group form-inline text-center">
            <input style="width:50%" type="text" class="form-control" name="q" id="q" placeholder="Nhập tên sách hoặc tên tác giả">
            <button type="submit" class="btn btn-info">Tìm</button>
          </div>
        </form>
      </div>