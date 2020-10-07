<div class="yui3-u Left all-sort-list">
    <div class="all-sort-list2">
        @foreach($quanbu as $v)
            <div class="item bo">
                <h3><a href="{{url('/shop/search/'.$v['cate_id'])}}">{{$v['cate_name']}}</a></h3>
                <div class="item-list clearfix">
                    <div class="subitem">
                        @foreach($v['child'] as $vv)
                            <dl class="fore1">
                                <dt><a href="{{url('/shop/search/'.$vv['cate_id'])}}">{{$vv['cate_name']}}</a></dt>

                                <dd>
                                    @foreach($vv['child'] as $vvv)
                                        <em><a href="{{url('/shop/search/'.$vvv['cate_id'])}}">{{$vvv['cate_name']}}</a></em>
                                    @endforeach
                                </dd>

                            </dl>
                        @endforeach

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>