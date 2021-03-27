@extends('templates.main')

@section('jscript')
<script src="{{asset('assets/js/chart.min.js')}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- START GENERAL REPORT -->
            <div class="col-span-12">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">General Report</h2>
                    <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                        <form class="flex" action="{{ route('dashboard') }}" method="get">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="far fa-calendar-alt text-xl"></i>
                                </div>
                                <select class="form-select" name="general" onchange='this.form.submit()'>
                                    @if($request->has('general'))<option value="{{ $request->general }}" selected disabled>@if($request->general == 'Harian') Hari Ini @else {{$request->general}} @endif</option>@endif
                                    <option value="Harian">Hari Ini</option>
                                    <option value="Mingguan">Mingguan</option>
                                    <option value="Bulanan" @if(!$request->has('general')) selected @endif>Bulanan</option>
                                    <option value="Tahunan">Tahunan</option>
                                    <option value="Semua">Semua</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i class="far fa-money-bill-wave text-3xl" style="color:#32CD32"></i>
                                    <div class="ml-auto"></div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">N/A</div>
                                <div class="text-base text-gray-600 mt-1">Pemasukan</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i class="far fa-coins text-3xl" style="color:#FA8072"></i>
                                    <div class="ml-auto"></div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">N/A</div>
                                <div class="text-base text-gray-600 mt-1">Pengeluaran</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i class="far fa-user text-3xl text-theme-12"></i>
                                    <div class="ml-auto"></div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $new_pasien_count }}</div>
                                <div class="text-base text-gray-600 mt-1">Pasien Baru</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i class="far fa-users text-3xl text-theme-10"></i>
                                    <div class="ml-auto"></div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $all_pasien_count }}</div>
                                <div class="text-base text-gray-600 mt-1">Total Pasien</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GENERAL REPORT -->
            <!-- START INCOME-EXPENSE -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Sales Report</h2>
                    <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                        <form class="flex" action="#" method="get">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="far fa-calendar-alt text-xl"></i>
                                </div>
                                <select class="form-select" name="" onchange='this.form.submit()'>
                                    <option value="Harian">Harian</option>
                                    <option value="Mingguan">Mingguan</option>
                                    <option value="Bulanan">Bulanan</option>
                                    <option value="Tahunan">Tahunan</option>
                                    <option value="Semua">Semua</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                            <div>
                                <div class="text-theme-19 dark:text-gray-300 text-lg xl:text-xl font-bold">$15,000</div>
                                <div class="mt-0.5 text-gray-600 dark:text-gray-600">This Month</div>
                            </div>
                            <div class="w-px h-12 border border-r border-dashed border-gray-300 dark:border-dark-5 mx-4 xl:mx-6"></div>
                            <div>
                                <div class="text-gray-600 dark:text-gray-600 text-lg xl:text-xl font-medium">$10,000</div>
                                <div class="mt-0.5 text-gray-600 dark:text-gray-600">Last Month</div>
                            </div>
                        </div>
                    </div>
                    <div class="report-chart">
                        <canvas class="mt-1" id="income-expense" height="200"></canvas>
                    </div>
                </div>
            </div>
            <!-- END INCOME-EXPENSE -->
            <!-- START PASIEN BY AGE -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Usia Pasien</h2>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="usia-pasien" height="234" width="234"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full mr-3" style="background:#FFB6C1;"></div>
                            <span class="truncate">0 - 17 Tahun</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{$age_pasien[0]}}</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 rounded-full mr-3" style="background:#3CB371;"></div>
                            <span class="truncate">18 - 30 Tahun</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{$age_pasien[1]}}</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 rounded-full mr-3" style="background:#F08080;"></div>
                            <span class="truncate">31 - 50 Tahun</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{$age_pasien[2]}}</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 rounded-full mr-3" style="background:#BDB76B;"></div>
                            <span class="truncate">&gt; 50 Tahun</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{$age_pasien[3]}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PASIEN BY AGE -->
            <!-- START PASIEN GENDER -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Gender Pasien</h2>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="gender-pasien" height="234" width="234"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full mr-3" style="background:#87CEFA;"></div>
                            <span class="truncate">Laki-laki</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{$gender_pasien[0]}}</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 rounded-full mr-3" style="background:#FF69B4;"></div>
                            <span class="truncate">Perempuan</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{$gender_pasien[1]}}</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 rounded-full mr-3"></div>
                            <span class="truncate">&nbsp;</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto"></span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 rounded-full mr-3"></div>
                            <span class="truncate">&nbsp;</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PASIEN GENDER -->
        </div>
    </div>
    <div class="col-span-12 xxl:col-span-3">
        <div class="xxl:border-l border-theme-5 -mb-10 pb-10">
            <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                <!-- START DOKTER JAGA -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-0">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Dokter Jaga</h2>
                    </div>
                    <div class="mt-5">
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    @if(isset($photo_dokter))
                                    <img src="{{asset('uploads/dokter').'/'.$photo_dokter->photo}}" onerror="this.src='{{asset('assets/images/default_avatar.png')}}';">
                                    @endif
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium text-lg">{{ config('setting.dokterjaga') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END DOKTER JAGA -->
                <!-- START STOK OBAT -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Stok Obat</h2>
                    </div>
                    <div class="mt-5">
                        @foreach($obats as $obat)
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="mr-auto">
                                    <div class="font-medium">{{ $obat->namaobat }}</div>
                                    <div class="text-gray-600 text-xs mt-0.5">{{ $obat->isiobat }}</div>
                                </div>
                                <div class="font-medium"><span class="text-theme-6">{{ $obat->stok }}</span>&nbsp;{{ $obat->jenis }}</div>
                            </div>
                        </div>
                        @endforeach
                        <a href="{{route('obat_stok')}}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">Lainnya</a>
                    </div>
                </div>
                <!-- END STOK OBAT -->
                <!-- START TRAKSAKSI -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Transaksi</h2>
                    </div>
                    <div class="mt-5">
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Midone Tailwind HTML Admin Template" src="dist/images/profile-15.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Kevin Spacey</div>
                                    <div class="text-gray-600 text-xs mt-0.5">2 April 2022</div>
                                </div>
                                <div class="text-theme-9">+$128</div>
                            </div>
                        </div>
                        <a href="javascript;" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">Lainnya</a>
                    </div>
                </div>
                <!-- END TRANSAKSI -->
            </div>
        </div>
    </div>
</div>
<!-- INCOME-EXPANSE -->
<script>
    var ctx = document.getElementById('income-expense').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",],
            datasets: [
                {
                    label: "Pemasukan",
                    data: [200000,250000,200000,500000,400500,850000,1050000,1250000,1100000,900000,1200000,1500000],
                    borderWidth: 4,
                    borderColor: "#32CD32",
                    backgroundColor: "transparent",
                    pointBorderWidth: 2,
                    pointBorderColor: "#32CD32",
                },
                {
                    label: "Pengeluaran",
                    data: [300000,400000,500000,450000,690000,705000,500000,450000,200000,250000,200000],
                    borderWidth: 4,
                    // borderDash: [2, 2],
                    borderColor: "#FA8072",
                    backgroundColor: "transparent",
                    pointBorderWidth: 2,
                    pointBorderColor: "#FA8072",
                },
            ],
        },
        options: {
            legend: {
                display: true
            },
            scales: {
                xAxes: [
                    {
                        ticks: {
                            fontSize: "12",
                            @dark
                            fontColor: "#718096",
                            @else
                            fontColor: "#777777",
                            @enddark
                        },
                        gridLines: {
                            display: false,
                        },
                    },
                ],
                yAxes: [
                    {
                        ticks: {
                            fontSize: "12",
                            @dark
                            fontColor: "#718096",
                            @else
                            fontColor: "#777777",
                            @enddark
                        },
                        gridLines: {
                            @dark
                            color: "#718096",
                            zeroLineColor: "#718096",
                            @else
                            color: "#D8D8D8",
                            zeroLineColor: "#D8D8D8",
                            @enddark
                            borderDash: [2, 2],
                            zeroLineBorderDash: [2, 2],
                            drawBorder: false,
                        },
                    },
                ],
            },
        },
    });
</script>
<!-- PASIEN AGE -->
<script>
    var ctx = document.getElementById('usia-pasien').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['<18 Tahun', '18-30 Tahun', '31-50 Tahun', '>50 Tahun'],
            datasets: [{
                label: 'Rata-rata Usia Pasien',
                data: [{{$age_pasien[0]}}, {{$age_pasien[1]}}, {{$age_pasien[2]}}, {{$age_pasien[3]}}],
                backgroundColor: ['#FFB6C1', '#3CB371', '#F08080', '#BDB76B'],
                hoverBackgroundColor: ['#FFB6C1', '#3CB371', '#F08080', '#BDB76B'],
                borderWidth: 5,
                @dark
                borderColor: '#313A55',
                @else
                borderColor: '#FFFFFF',
                @enddark
            }]
        },
        options: {
            legend: {
                display: false
            },
        }
    });
</script>
<!-- PASIEN GENDER -->
<script>
    var ctx = document.getElementById('gender-pasien').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                label: 'Rata-rata Usia Pasien',
                data: [{{$gender_pasien[0]}}, {{$gender_pasien[1]}}],
                backgroundColor: ['#87CEFA', '#FF69B4'],
                hoverBackgroundColor: ['#87CEFA', '#FF69B4'],
                borderWidth: 5,
                @dark
                borderColor: '#313A55',
                @else
                borderColor: '#FFFFFF',
                @enddark
            }]
        },
        options: {
            legend: {
                display: false
            },
        }
    });
</script>
@endsection
