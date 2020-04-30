@extends('back.layouts.master')
@section('title','Panel')
@section('content')
  <script>
    window.onload = function () {
      var chart = new CanvasJS.Chart("chartContainer", {
    	exportEnabled: true,
    	animationEnabled: true,
    	title:{
    		text: ""
    	},
    	axisX: {
    		title: "Yazılar"
    	},
    	toolTip: {
    		shared: true
    	},
    	legend: {
    		cursor: "pointer",
    		itemclick: "toggleDataSeries"
    	},
    	data: [{
    		type: "column",
    		name: "Görüntülenme",
    		showInLegend: true,
    		yValueFormatString: "#,##0.# Units",
    		dataPoints: [
          @foreach ($bestArticles as $article)
            { label: "{{ $article->title }}",  y: {{ $article->hit }} },
          @endforeach
    		]
    	}]
    });
    chart.render();
    }
  </script>
  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <!-- 'articleCount','articleHit','categoryCount','bestArticles','worstArticles' -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mevcut Yazı Sayısı</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $articleCount }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-pen fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Toplam Görüntülenme</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $articleHit }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-eye fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kategori Sayısı</div>
              <div class="row no-gutters align-items-center">
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categoryCount }}</div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Toplam İletişim</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $contactCount }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-envelope fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">En iyi etkileşim alan yazılar</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <!--<canvas id="myAreaChart"></canvas>-->
            <div id="chartContainer" style="height: 600px; width: 100%;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
