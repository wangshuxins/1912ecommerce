			@foreach($res as $k=>$v)
			@if($k==0|$k%2==0)
<div class="yui3-u row-220 split">
<span class="floor-x-line"></span>
			@endif
	<div class="floor-conver-pit"><a href="{{url('/shop/item/'.$v->goods_id)}}">
	<img  style="width:220px;height:183px"   src="/{{$v->goods_img}}" />
	</a></div>
			@if($k==1|$k%2==1)
				</div>
			@endif
@endforeach