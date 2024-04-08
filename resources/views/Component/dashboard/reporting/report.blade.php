@extends('Layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reporting</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">CPU Traffic</span>
                            <span class="info-box-number">
                                10
                                <small>%</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 pt-2">

                        <ul class="chart-legend clearfix m-0 p-2">
                            <li class="info-box-text"><i class="far fa-circle text-success"></i> Enligne
                                <span class="info-box-number" id="authUserCount"></span>
                            </li>
                            <li class="info-box-text"><i class="far fa-circle text-danger"></i> Horsligne
                                <span class="info-box-number" id="notAuthUserCount"></span>
                            </li>

                        </ul>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">


                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Line Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">

                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Sales
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; height: 300px;">

                                    <canvas id="barChart"
                                        style="min-height: 250px; height: 250px; max-height: 301px; max-width: 100%;"></canvas>

                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="pieChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->


            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="form-group">

                        <select class="form-control select2" id="CategoryCours" name="CategoryCours" style="width: 100%;">
                            @foreach ($category as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
                            @endforeach

                        </select>


                    </div>
                    <!-- /.form-group -->

                    <div class="info-box">
                        <span class="info-box-icon  elevation-1">
                            <img class="nav-icon rounded" style="height: 64px;width: 71px;"
                                src="{{ asset('asset/contentIcon.jpg') }}" alt="">
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Nomber Content</span>
                            <span class="info-box-number" id="CoursCount">0</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                </div>

                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" id="CategorySpeaker" name="CategorySpeaker"
                            style="width: 100%;">
                            @foreach ($category as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Nomber de Speaker</span>
                            <span class="info-box-number" id="SpeakerCount">0</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <!-- /.form-group -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div>
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script>
        $(document).ready(function() {

            function updateCounts() {
                $.ajax({
                    url: '/backoffice/authCount',
                    type: 'GET',
                    success: function(data) {
                        // Update the UI with the new counts
                        $('#authUserCount').text(data.AuthUserCount);
                        $('#notAuthUserCount').text(data.NotAuthUserCount);


                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching counts:', error);
                    }
                });
            }

            // Update counts initially and then every 5 seconds
            updateCounts();
            setInterval(updateCounts, 5000); // Update every 5 seconds


            //Category Cours
            $("#CategoryCours").on('change', function() {
                var CategoryCours = $(this).val();
                $.ajax({
                    url: '/backoffice/FilterCount',
                    method: 'get',
                    data: {
                        'CategoryCours': CategoryCours,
                    },
                    success: function(response) {
                        // Update the UI with the new counts
                        $('#CoursCount').empty();
                        $('#CoursCount').text(response);

                        console.log(response);


                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching counts:', error);
                    }
                });
            })

            // Category Speaker
            $("#CategorySpeaker").on('change', function() {
                var CategorySpeaker = $(this).val();
                $.ajax({
                    url: '/backoffice/FilterCount',
                    method: 'get',
                    data: {
                        'CategorySpeaker': CategorySpeaker,
                    },
                    success: function(response) {
                        // Update the UI with the new counts
                        $('#SpeakerCount').text(response);

                        console.log(response);


                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching counts:', error);
                    }
                });
            })

        })


        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //-------------
            //- LINE CHART -
            //--------------

            const xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
            const yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

            new Chart("lineChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "#DBDBDB",
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 6,
                                max: 16
                            }
                        }],
                    }
                }
            });


            //-------------
            //- BAR CHART -
            //-------------

            const barxValues = ["Italy", "France", "Spain", "USA", "Argentina"];
            const baryValues = [55, 49, 44, 24, 15];
            const barColors = ["red", "green", "blue", "orange", "brown"];

            new Chart("barChart", {
                type: "bar",
                data: {
                    labels: barxValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: baryValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "World Wine Production 2018"
                    }
                }
            });


            //-------------
            //- DONUT CHART -
            //-------------

            const PiexValues = ["Italy", "France", "Spain", "USA", "Argentina"];
            const PieyValues = [55, 49, 44, 24, 15];

            new Chart("pieChart", {
                type: "pie",
                data: {
                    labels: PiexValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: PieyValues
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "World Wide Wine Production"
                    }
                }
            });
        })
    </script>
@endsection
