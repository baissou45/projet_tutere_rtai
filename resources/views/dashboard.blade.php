@extends('layouts.app')

@section("style")
<!--Morris Chart CSS -->
<link rel="stylesheet" href="{{ asset('template/back/assets/plugins/morris/morris.css') }}">
@endsection


@section("content")
<div class="card">
    <div class="card-body">
        <h3>Evolution de la programmation des inspecteurs</h3>
    </div>
    <div class="card-body">
        <div id="morris-bar-example" class="dash-chart"></div>
    </div>
</div>

@endsection


@section("script")
<!--Morris Chart-->
<script src="{{ asset('template/back/assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('template/back/assets/plugins/raphael/raphael-min.js') }}"></script>

<script src="{{ asset('template/back/assets/pages/dashboard.js') }}"></script>

<script>
    var $barData = [
        {y: '2006', a: 100, b: 90},
        {y: '2007', a: 75, b: 65},
        {y: '2008', a: 50, b: 40},
        {y: '2009', a: 75, b: 65},
        {y: '2010', a: 50, b: 40},
        {y: '2011', a: 75, b: 65},
        {y: '2012', a: 100, b: 90},
        {y: '2013', a: 90, b: 75},
        {y: '2014', a: 75, b: 65},
        {y: '2015', a: 50, b: 40},
        {y: '2016', a: 75, b: 65},
        {y: '2017', a: 100, b: 90},
        {y: '2018', a: 90, b: 75}
    ];
    this.createBarChart('morris-bar-example', $barData, 'y', ['Programmer', 'Effectuer'], ['Series A', 'Series B'], ['#C019BF','#91B508']);
</script>

@endsection