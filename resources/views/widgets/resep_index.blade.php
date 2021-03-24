<table class="table">
    <thead>
        <tr class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
            <th width="15%">Kode</th>
            <th width="15%">No.RM</th>
            <th width="35%">Nama Pasien</th>
            <th width="15%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reseps as $resep)
        <tr class="border-b dark:border-dark-5 whitespace-nowrap text-center">
            <td class="font-medium">{{ $resep->code }}</td>
            <td>{{ $resep->norm }}</td>
            <td>{{ $resep->nama }}</td>
            <td>
                <a href="{{ route('resep_show', $resep->id) }}" class="btn btn-primary btn-sm tooltip" title="Detail"><i class="fas fa-info fa-fw"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
