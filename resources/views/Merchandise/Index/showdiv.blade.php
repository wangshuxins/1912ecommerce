
    <div class="goods-list">
        <ul class="yui3-g">
            @foreach($limit as $v)
                <li class="yui3-u-1-5">
                    <div class="list-wrap">
                        <div class="p-img">
                            <a href="{{url('shop/item/'.$v->goods_id)}}" target="_blank"><img src="/{{$v->goods_img}}" /></a>
                        </div>
                        <div class="price">
                            <strong>
                                <em>¥</em>
                                <i>{{$v->goods_price}}.00</i>
                            </strong>
                        </div>
                        <div class="attr">
                            <em>{{$v->goods_name}}</em>
                        </div>
                        <div class="cu">
                            <!-- 									<em><span>促</span>满一件可参加超值换购</em>
                             -->								</div>
                        <div class="commit">
                            <!-- 									<i class="command">已有2000人评价</i>
                             -->								</div>
                        <div class="operate">
                            <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                            <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                            <a href="javascript:void(0);" class="sui-btn btn-bordered">关注</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="fr page">
        <div class="sui-pagination pagination-large">
            <ul>
                <li class="prev disabled">
                    <a href="#">«上一页</a>
                </li>
                <li class="active">
                    {!! $str  !!}
                </li>
                <li class="next">
                    <a href="#">下一页»</a>
                </li>
            </ul>
            <div><span>共10页&nbsp;</span><span>
      到第
      <input type="text" class="page-num">
      页 <button class="page-confirm" onclick="alert(1)">确定</button></span></div>
        </div>
    </div>
