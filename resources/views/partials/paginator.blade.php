@if($listItem->hasPages())
  <div class="paginator text-center">
  {!! $listItem->render()!!}
  </div>
@endif