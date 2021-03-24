<div class="text-center">
    @if(isset($antrean))
    <div class="text-3xl font-bold text-theme-1">{{ $antrean->antrian }}</div>
    <div class="text-lg font-medium">{{ $antrean->norm }} - {{ $antrean->nama }}</div>
    <form class="mt-4" action="{{ route('konsultasi_update_antrian', $antrean->antrian) }}" method="post">
        @csrf
        <button class="btn btn-outline-primary" type="submit" name="submit"><i class="fas fa-user-plus mr-2"></i> Rekam Medis Baru</button>
    </form>
    @else
    <div class="text-lg font-medium">&mdash;</div>
    @endif
</div>
