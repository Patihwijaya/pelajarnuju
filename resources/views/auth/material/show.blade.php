<x-layouts.app-user title="Pengajuan SK IPNU">

    <div class="container">

    <a href="{{ route('material.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card">
        <div class="card-header">
            <h3>{{ $material->title }}</h3>
        </div>

        <div class="card-body">

            <p>{!! nl2br(e($material->content)) !!}</p>

            @if($material->file)
                @php
                    $ext = pathinfo($material->file, PATHINFO_EXTENSION);
                @endphp

                <h5 class="mt-4">File Materi:</h5>

                @if($ext == 'pdf')
                    <iframe src="{{ asset('materials/' . $material->file) }}" width="100%" height="600px"></iframe>
                @endif

                <a href="{{ asset('materials/' . $material->file) }}" class="btn btn-success mt-2" download>
                    Download File
                </a>
            @endif

        </div>
    </div>
</div>

</x-layouts.app>
