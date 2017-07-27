<div class="panel-group" id="accordion">
						@if(!empty($category))
						@foreach($category as $c)
							  @if($c->parentid==0)
						<div class="panel panel-success">
							<div class="panel-heading">
								<h4 class="panel-title">
					                <a data-toggle="collapse" data-parent="#accordion" href="#{{$c->cid}}">{{$c->cname}}</a>
            					</h4>
							</div>
							<div id="{{$c->cid}}" class="panel-collapse collapse">
								<div class="panel-body">
									
									  @foreach($category as $cate)									
										@if($c->cid==$cate->parentid) 
									<a class="Spinnes1" href="{{URL('home/category')}}/{{$cate->cid}}" style="width: 100%;">{{$cate->cname}}</a>
									    @endif
									@endforeach
									
								</div>
							</div>
						</div>
						 @endif
							@endforeach
							@endif
</div><!--panel-group-->
