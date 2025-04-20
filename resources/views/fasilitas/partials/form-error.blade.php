@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded">
        <strong>Terjadi kesalahan!</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
