@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <section class="content pt-3">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3> {{ $postingan }} </h3>
                            <p>Total Postingan</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-usps"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3> {{ $anggota }} </h3>

                            <p>Total Anggota</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3> {{ $kegiatan }} </h3>

                            <p>Total Kegiatan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dice"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3> {{ $wa }} </h3>

                            <p>Total Group WhatsApp</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-1"></i>
                                Total Peserta Anggota Perangkatan
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart" style="position: relative; height: 300px;">
                                    <canvas id="chart-angkatan" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                {{-- <section class="col-lg-5 connectedSortable">

                    <!-- Map card -->
                    <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-user-graduate"></i>
                                Jabatan Anggota Sekarang
                            </h3>
                            <!-- card tools -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                    data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            
                        </div>
                        <!-- /.card-body-->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center" style="cursor: pointer">
                                    <div id="sparkline-1"></div>
                                    <div class="text-white" id="terbanyak">Ketua</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center" style="cursor: pointer">
                                    <div id="sparkline-2"></div>
                                    <div class="text-white" id="konsumtif">Wakil</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center" style="cursor: pointer">
                                    <div id="sparkline-3"></div>
                                    <div class="text-white" id="pasif">Bendahara</div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->
                </section> --}}
            </div>
        </div>
    </section>


    <script src="{{ asset('assets/adminlte') }}/plugins/jquery/jquery.min.js"></script>

    <!-- ChartJS -->
    <script src="{{ asset('assets/adminlte') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/adminlte') }}/plugins/sparklines/sparkline.js"></script>
    <script>
        $(function() {
            var active = {
                'background-color': '#023676',
                'border-radius': '10px',
                'padding': '2px 0'
            }

            $('#terbanyak').css(active)
            $('#terkonsumtif-container').addClass('d-none')
            $('#terpasif-container').addClass('d-none')

            $('#terbanyak').on('click', function() {
                $('#terbanyak').css(active)
                $('#konsumtif').removeAttr('style');
                $('#pasif').removeAttr('style');

                $('#terkaya-container').removeClass('d-none')
                $('#terkonsumtif-container').addClass('d-none')
                $('#terpasif-container').addClass('d-none')
            })

            $('#konsumtif').on('click', function() {
                $('#terbanyak').removeAttr('style');
                $('#konsumtif').css(active)
                $('#pasif').removeAttr('style');

                $('#terkaya-container').addClass('d-none')
                $('#terkonsumtif-container').removeClass('d-none')
                $('#terpasif-container').addClass('d-none')
            })

            $('#pasif').on('click', function() {
                $('#terbanyak').removeAttr('style')
                $('#konsumtif').removeAttr('style');
                $('#pasif').css(active);

                $('#terkaya-container').addClass('d-none')
                $('#terkonsumtif-container').addClass('d-none')
                $('#terpasif-container').removeClass('d-none')
            })


            var salesChartCanvas = document.getElementById('chart-angkatan').getContext('2d');
            //$('#revenue-chart').get(0).getContext('2d');

            var salesChartData = {
                labels: [
                    @foreach ($angkatan as $a)
                        "{{ $a }}",
                    @endforeach
                ],
                datasets: [{
                        label: 'Peserta',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(20, 54, 74,0.8)',
                        pointRadius: true,
                        pointColor: '#f7f9fa',
                        pointStrokeColor: 'rgba(30, 51, 84,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#f7fbfc',
                        data: [
                            @foreach ($jumlah_angkatan as $b)
                                "{{ $b }}",
                            @endforeach
                        ]
                    }
                ]
            }

            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: salesChartData,
                options: salesChartOptions
            })
        })
    </script>
@endsection
