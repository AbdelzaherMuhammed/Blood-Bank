@extends('layouts.app')
@inject('clients' ,'App\Models\Client')
@inject('posts' ,'App\Models\Post')
@inject('donations' ,'App\Models\DonationRequest')
@inject('categories' ,'App\Models\Category')
@inject('governorates' ,'App\Models\Governorate')
@inject('users' ,'App\User')
@inject('roles' ,'App\Models\Role')
@inject('contact' ,'App\Models\Contact')

@section('title')

    الصفحة الرئيسيه

@endsection



@section('content')

    <section class="content">

        <div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">العملاء</span>
                        <span class="info-box-number">{{$clients->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-th-list"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">الاقسام</span>
                        <span class="info-box-number">{{$categories->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-newspaper-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">المقالات</span>
                        <span class="info-box-number">{{$posts->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red-gradient"><i class="fa fa-line-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">طلبات التبرع</span>
                        <span class="info-box-number">{{$donations->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow-gradient"><i class="fa fa-map-marker"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">المحافظات</span>
                        <span class="info-box-number">{{$governorates->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-purple"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">المدن</span>
                        <span class="info-box-number">{{$posts->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-gray"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">المشرفين</span>
                        <span class="info-box-number">{{$users->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-maroon-gradient"><i class="fa fa-flag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">رتب المشرفين</span>
                        <span class="info-box-number">{{$roles->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-olive-active"><i class="fa fa-phone"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">الرسائل</span>
                        <span class="info-box-number">{{$contact->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>


        </div>

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="card-body">

                    <div class="raw">
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border pull-right">
                                    <h3 class="box-title">منحني التبرعات</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart"
                                         style="height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                        <svg height="300" version="1.1" width="594" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             style="overflow: hidden; position: relative; left: -0.6px; top: -0.2px;">
                                            <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with
                                                Raphaël 2.3.0
                                            </desc>
                                            <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                            <text x="49.21875" y="261.375" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,261.375H569.6"
                                                  stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="49.21875" y="202.28125" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">5,000
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,202.28125H569.6"
                                                  stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="49.21875" y="143.1875" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">10,000
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,143.1875H569.6"
                                                  stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="49.21875" y="84.09375" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">15,000
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,84.09375H569.6"
                                                  stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="49.21875" y="25" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">20,000
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,25H569.6" stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="476.4164413730256" y="273.875" text-anchor="middle"
                                                  font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal" transform="matrix(1,0,0,1,0,6.8125)">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2020
                                                </tspan>
                                            </text>
                                            <text x="250.55430589307414" y="273.875" text-anchor="middle"
                                                  font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal" transform="matrix(1,0,0,1,0,6.8125)">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2018
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#3c8dbc"
                                                  d="M61.71875,229.86621250000002C75.91227217496962,229.5352875,104.29931652490887,231.8606265625,118.49283869987849,228.5425125C132.6863608748481,225.22439843749999,161.07340522478736,204.79037708333334,175.26692739975698,203.3213C189.30617215978128,201.86819114583335,217.38466167982992,219.6577671875,231.42390643985422,216.85376875C245.46315119987852,214.04977031250002,273.5416407199271,183.68533489583336,287.5808854799514,180.88931250000002C301.77440765492105,178.06256458333334,330.1614520048603,191.42277343749998,344.3549741798299,194.3626875C358.54849635479957,197.3026015625,386.9355407047388,218.37599791666668,401.12906287970844,204.408625C415.16830763973275,190.59307135416668,443.24679715978135,91.94644419026244,457.28604191980565,83.23098125000001C471.1710092648846,74.61129262776245,498.9409439550426,125.36479253090661,512.8259113001216,135.06801875000002C527.0194334750912,144.9868722184066,555.4064778250304,155.0564796875,569.6,161.7193"
                                                  stroke-width="3"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <circle cx="61.71875" cy="229.86621250000002" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="118.49283869987849" cy="228.5425125" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="175.26692739975698" cy="203.3213" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="231.42390643985422" cy="216.85376875" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="287.5808854799514" cy="180.88931250000002" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="344.3549741798299" cy="194.3626875" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="401.12906287970844" cy="204.408625" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="457.28604191980565" cy="83.23098125000001" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="512.8259113001216" cy="135.06801875000002" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="569.6" cy="161.7193" r="4" fill="#3c8dbc" stroke="#ffffff"
                                                    stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                        </svg>
                                        <div class="morris-hover morris-default-style"
                                             style="left: 75.4678px; top: 161px; display: none;">
                                            <div class="morris-hover-row-label">2011 Q2</div>
                                            <div class="morris-hover-point" style="color: #3c8dbc">
                                                Item 1:
                                                2,778
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border pull-right">
                                    <h3 class="box-title">منحني المقالات</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="revenue-chart"
                                         style="height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                        <svg height="300" version="1.1" width="594" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             style="overflow: hidden; position: relative; top: -0.2px;">
                                            <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with
                                                Raphaël 2.3.0
                                            </desc>
                                            <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                            <text x="49.21875" y="261.375" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,261.375H569.6"
                                                  stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="49.21875" y="202.28125" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">7,500
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,202.28125H569.6"
                                                  stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="49.21875" y="143.1875" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">15,000
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,143.1875H569.6"
                                                  stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="49.21875" y="84.09375" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">22,500
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,84.09375H569.6"
                                                  stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="49.21875" y="25" text-anchor="end" font-family="sans-serif"
                                                  font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">30,000
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#aaaaaa" d="M61.71875,25H569.6" stroke-width="0.5"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <text x="476.4164413730256" y="273.875" text-anchor="middle"
                                                  font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal" transform="matrix(1,0,0,1,0,6.8125)">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2020
                                                </tspan>
                                            </text>
                                            <text x="250.55430589307414" y="273.875" text-anchor="middle"
                                                  font-family="sans-serif" font-size="12px" stroke="none" fill="#888888"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                  font-weight="normal" transform="matrix(1,0,0,1,0,6.8125)">
                                                <tspan dy="4.3984375"
                                                       style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2018
                                                </tspan>
                                            </text>
                                            <path fill="#74a5c2" stroke="none"
                                                  d="M61.71875,219.36328333333333C75.91227217496962,219.87542916666666,104.29931652490887,222.9374703125,118.49283869987849,221.41186666666667C132.6863608748481,219.88626302083333,161.07340522478736,209.42817083333333,175.26692739975698,207.15845416666667C189.30617215978128,204.91340833333334,217.38466167982992,205.1679796875,231.42390643985422,203.35281666666668C245.46315119987852,201.53765364583336,273.5416407199271,195.18290659722223,287.5808854799514,192.63715000000002C301.77440765492105,190.0634180555556,330.1614520048603,182.76750885416666,344.3549741798299,182.8748625C358.54849635479957,182.98221614583335,386.9355407047388,204.4652861111111,401.12906287970844,193.49597916666667C415.16830763973275,182.64590381944444,443.24679715978135,102.06621622928179,457.28604191980565,95.59733333333335C471.1710092648846,89.19953706261512,498.9409439550426,135.31303052884616,512.8259113001216,142.02926250000002C527.0194334750912,148.89474407051284,555.4064778250304,147.95045625,569.6,149.92418750000002L569.6,261.375L61.71875,261.375Z"
                                                  fill-opacity="1"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path>
                                            <path fill="none" stroke="#3c8dbc"
                                                  d="M61.71875,219.36328333333333C75.91227217496962,219.87542916666666,104.29931652490887,222.9374703125,118.49283869987849,221.41186666666667C132.6863608748481,219.88626302083333,161.07340522478736,209.42817083333333,175.26692739975698,207.15845416666667C189.30617215978128,204.91340833333334,217.38466167982992,205.1679796875,231.42390643985422,203.35281666666668C245.46315119987852,201.53765364583336,273.5416407199271,195.18290659722223,287.5808854799514,192.63715000000002C301.77440765492105,190.0634180555556,330.1614520048603,182.76750885416666,344.3549741798299,182.8748625C358.54849635479957,182.98221614583335,386.9355407047388,204.4652861111111,401.12906287970844,193.49597916666667C415.16830763973275,182.64590381944444,443.24679715978135,102.06621622928179,457.28604191980565,95.59733333333335C471.1710092648846,89.19953706261512,498.9409439550426,135.31303052884616,512.8259113001216,142.02926250000002C527.0194334750912,148.89474407051284,555.4064778250304,147.95045625,569.6,149.92418750000002"
                                                  stroke-width="3"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <circle cx="61.71875" cy="219.36328333333333" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="118.49283869987849" cy="221.41186666666667" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="175.26692739975698" cy="207.15845416666667" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="231.42390643985422" cy="203.35281666666668" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="287.5808854799514" cy="192.63715000000002" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="344.3549741798299" cy="182.8748625" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="401.12906287970844" cy="193.49597916666667" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="457.28604191980565" cy="95.59733333333335" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="512.8259113001216" cy="142.02926250000002" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="569.6" cy="149.92418750000002" r="4" fill="#3c8dbc"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <path fill="#eaf3f6" stroke="none"
                                                  d="M61.71875,240.36914166666668C75.91227217496962,240.148525,104.29931652490887,241.69875104166667,118.49283869987849,239.486675C132.6863608748481,237.2745989583333,161.07340522478736,223.65191805555554,175.26692739975698,222.67253333333332C189.30617215978128,221.70379409722221,217.38466167982992,233.56351145833332,231.42390643985422,231.69417916666666C245.46315119987852,229.824846875,273.5416407199271,209.58188993055555,287.5808854799514,207.717875C301.77440765492105,205.8333763888889,330.1614520048603,214.74018229166668,344.3549741798299,216.700125C358.54849635479957,218.66006770833334,386.9355407047388,232.70899861111113,401.12906287970844,223.3974166666667C415.16830763973275,214.18704756944447,443.24679715978135,148.42262946017496,457.28604191980565,142.61232083333334C471.1710092648846,136.86586175184163,498.9409439550426,170.70152835393773,512.8259113001216,177.17034583333333C527.0194334750912,183.78291481227106,555.4064778250304,190.49598645833333,569.6,194.93786666666665L569.6,261.375L61.71875,261.375Z"
                                                  fill-opacity="1"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path>
                                            <path fill="none" stroke="#a0d0e0"
                                                  d="M61.71875,240.36914166666668C75.91227217496962,240.148525,104.29931652490887,241.69875104166667,118.49283869987849,239.486675C132.6863608748481,237.2745989583333,161.07340522478736,223.65191805555554,175.26692739975698,222.67253333333332C189.30617215978128,221.70379409722221,217.38466167982992,233.56351145833332,231.42390643985422,231.69417916666666C245.46315119987852,229.824846875,273.5416407199271,209.58188993055555,287.5808854799514,207.717875C301.77440765492105,205.8333763888889,330.1614520048603,214.74018229166668,344.3549741798299,216.700125C358.54849635479957,218.66006770833334,386.9355407047388,232.70899861111113,401.12906287970844,223.3974166666667C415.16830763973275,214.18704756944447,443.24679715978135,148.42262946017496,457.28604191980565,142.61232083333334C471.1710092648846,136.86586175184163,498.9409439550426,170.70152835393773,512.8259113001216,177.17034583333333C527.0194334750912,183.78291481227106,555.4064778250304,190.49598645833333,569.6,194.93786666666665"
                                                  stroke-width="3"
                                                  style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                            <circle cx="61.71875" cy="240.36914166666668" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="118.49283869987849" cy="239.486675" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="175.26692739975698" cy="222.67253333333332" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="231.42390643985422" cy="231.69417916666666" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="287.5808854799514" cy="207.717875" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="344.3549741798299" cy="216.700125" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="401.12906287970844" cy="223.3974166666667" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="457.28604191980565" cy="142.61232083333334" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="512.8259113001216" cy="177.17034583333333" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                            <circle cx="569.6" cy="194.93786666666665" r="4" fill="#a0d0e0"
                                                    stroke="#ffffff" stroke-width="1"
                                                    style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
                                        </svg>
                                        <div class="morris-hover morris-default-style"
                                             style="left: 410.924px; top: 57px; display: none;">
                                            <div class="morris-hover-row-label">2012 Q4</div>
                                            <div class="morris-hover-point" style="color: #a0d0e0">
                                                Item 1:
                                                15,073
                                            </div>
                                            <div class="morris-hover-point" style="color: #3c8dbc">
                                                Item 2:
                                                5,967
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>

                        <!-- /.box -->


                        <!-- /.box -->

                    </div>

                    <!-- /.card-body -->

                    <!-- /.card-footer-->
                </div>
            </div>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection
