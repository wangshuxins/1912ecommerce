 <!--左侧列表-->
                <div class="yui3-u-1-6 list">

                    <div class="person-info">
                        <div class="person-photo"><img src="/index/static/img/_/photo.png" alt=""></div>
                        <div class="person-account">
                            <span class="name">Michelle</span>
                            <span class="safe">账户安全</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="list-items">
                        <dl>
							<dt><i>·</i> 订单中心</dt>
							<dd ><a href="{{url('/shop/homeorderdetail')}}"  class="list-active" ></a>
							<a href="{{url('/shop/homeindex')}}">我的订单</a></dd>
							<dd><a href="{{url('/shop/homeorderpay')}}" >待付款</a></dd>
							<dd><a href="{{url('/shop/homeordersend')}}"  >待发货</a></dd>
							<dd><a href="{{url('/shop/homeorderreceive')}}" >待收货</a></dd>
							<dd><a href="{{url('/shop/homeorderevaluate')}}" >待评价</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 我的中心</dt>
							<dd><a href="{{url('/shop/homepersoncollect')}}">我的收藏</a></dd>
							<dd><a href="{{url('/shop/homepersonfootmark')}}">我的足迹</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 物流消息</dt>
						</dl>
						<dl>
							<dt><i>·</i> 设置</dt>
							<dd><a href="{{url('/shop/homesettinginfo')}}">个人信息</a></dd>
							<dd><a href="{{url('/shop/homesettingaddress')}}"  >地址管理</a></dd>
							<dd><a href="{{url('/shop/homesettingsafe')}}" >安全管理</a></dd>
						</dl>
                    </div>
                </div>