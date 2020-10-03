                              <table id="dataList" class="table table-bordered table-striped table-hover dataTable">
                                <center>{{session("get")}}</center>
                                  <thead>
                                      <tr>
                                          <th>属性名ID</th>
                                          <th>属性名</th>
                                          <th>属性名添加时间</th>
                                          <th>操作</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($name as $a=>$v)
                                      <tr center="center">
                                          <td>{{$v["id"]}}</td>
                                          <td>{{$v["attr_name"]}}</td>
                                          <td>{{date("Y-m-s H:i:s",$v["add_time"])}}</td>
                                          <td class="text-center">
                                                <a id="del" slide_id="{{$v['id']}}" class="btn bg-olive btn-xs">删除</a>
                                                <a href="{{url('/admin/attrupdate/'.$v['id'])}}" class="btn bg-olive btn-xs">修改</a>
                                          </td>
                                      </tr>
                                  
                                      @endforeach
                                      <td colspan="5" align="center">
                                         {{$name->appends(['attr_name'=>$attr_name])->links()}}
                                      </td>
                                  </tbody>