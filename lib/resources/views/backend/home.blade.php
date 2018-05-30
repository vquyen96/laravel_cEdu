@extends('backend.master')
@section('title','Home')
@section('main')

<div>
	<div class="dashboard">
		<div class="item student">
			<a href="" class="icon red">
				<i class="fa fa-users" aria-hidden="true"></i>
			</a>
			<div class="content">
				<p>Số học viên</p>
				{{$student}}
			</div>
		</div>
		<div class="item rating">
			<a href="{{ asset('admin/teacher') }}" class="icon yell">
				<i class="fa fa-magic" aria-hidden="true"></i>
			</a>
			<div class="content">
				<p>Giáo viên</p>
				{{$teacher}}
				{{-- {{$item->cou_star}} --}}
			</div>
		</div>
		<div class="item lesson">
			<a href="{{ asset('admin/course') }}" class="icon blue">
				<i class="fa fa-shopping-bag" aria-hidden="true"></i>
			</a>
			<div class="content">
				<p>CTV</p>
				{{$ctv}}
				{{-- {{$lesson}} --}}
			</div>
		</div>
		<div class="item earnings">
			<a href="" class="icon green">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
			</a>
			<div class="content">
				<p>Thu Nhập</p>
				30.000.000đ
				{{-- {{number_format($item->orderDe->count()*$item->cou_price,0,',','.')}} --}}
			</div>
		</div>
	</div>
</div>

@stop