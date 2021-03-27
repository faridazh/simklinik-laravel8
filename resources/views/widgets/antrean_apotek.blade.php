<div class="report-box zoom-in">
    <div class="box p-5">
        <div class="flex">
            <i class="fad fa-pills fa-fw text-4xl font-medium"></i>
            <div class="ml-auto">
                <div class="text-4xl font-bold text-theme-1">@if(isset($antrean)) {{$antrean->antrian}} @else - @endif</div>
            </div>
        </div>
        @if(isset($antrean))
        <div class="text-3xl font-bold mt-6">{{ $antrean->norm }}</div>
        <div class="text-base text-gray-600 mt-1">{{ $antrean->nama }}</div>
        @endif
    </div>
</div>

<div class="box mt-10">
    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5 text-center">
        <div class="font-medium text-base text-xl">Antrian Berikutnya</div>
    </div>
    <div class="accordion p-5">
        @if(isset($antreans))
        @foreach($antreans as $antrean)
        <div class="accordion-item">
            <div class="accordion-header text-lg font-medium text-center">{{$antrean->antrian}}</div>
        </div>
        @endforeach
        @endif
    </div>
</div>
