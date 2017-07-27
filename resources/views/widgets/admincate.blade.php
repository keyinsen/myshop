@if($role_id==1)
<li ><a href="{{URL('admin/category')}}" @yield('goods-type')>商品类别</a></li>
<li><a href="{{URL('admin/spec')}}"  @yield('goods-spec')>商品规格信息</a></li>
<li><a href="{{URL('admin/specval')}}"  @yield('goods-specval')>商品规格参数信息</a></li>
@endif
