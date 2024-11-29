<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Galeri Foto') }}
            </h2>
        </div>
    </x-slot>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <div class="grid grid-cols-2 gap-4 p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                {{-- @dd($data->items) --}}
                <div>
                    @if (!$cover)
                        <img class="rounded-md w-full" src="{{ asset('assets/image/image-notfound.jpg') }}">
                    @else
                        <img class="rounded-md  w-full" src="{{ asset('storage/' . $cover->photo) }}">
                    @endif
                </div>
                <form id="coverForm" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <h2 class="mb-5
                    text-xl font-bold">Foto Cover</h2>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Upload
                            file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="file_input" type="file" name="cover">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
                            GIF
                            (MAX. 800x400px).</p>
                        <x-button onclick="saveCover()" class="mt-8" type="button"
                            variant="success">Simpan</x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div>
                <h2 class="mb-5 text-xl font-bold ">Foto Galeri</h2>

                <form id="galleryForm" enctype="multipart/form-data">
                    @csrf
                    <div data-element="fields" data-stacked="false"
                        class="flex items-center w-full max-w-md mb-3 seva-fields formkit-fields">
                        <div class="relative w-full mr-3 formkit-field">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Upload
                                file</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_input_help" id="file_input" type="file" name="photos">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG
                                or
                                GIF
                                (MAX. 800x400px).</p>
                        </div>
                        <x-button onclick="saveGallery()" variant="success" type="button">Simpan</x-button>
                    </div>
                </form>

                <div class="mt-10 grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($data as $photos)
                        <div class="relative group">
                            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/' . $photos->photo) }}"
                                alt="">

                            <div
                                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 transition-opacity group-hover:opacity-100 rounded-lg">
                                <x-button variant='danger' type="button" onclick="deletePhotos({{ $photos->id }})"><i
                                        class="fa-solid fa-trash"></i></x-button>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <script>
        function saveCover() {
            var form = document.getElementById('coverForm')
            var formData = new FormData(form)

            $.ajax({
                url: `{{ url('admin/gallery/cover') }}`,
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    showLoading();
                },
                success: (data) => {
                    Swal.fire({
                        title: "Berhasil!",
                        type: "success",
                        icon: "success",
                    }).then(function() {
                        location.reload()
                    })
                },
                error: function(error) {
                    hideLoading();
                    handleErrorAjax(error)
                },
                complete: function() {
                    hideLoading();
                },
            })
        }

        function saveGallery() {
            var form = document.getElementById('galleryForm')
            var formData = new FormData(form)

            $.ajax({
                url: `{{ url('admin/gallery/photos') }}`,
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    showLoading();
                },
                success: (data) => {
                    Swal.fire({
                        title: "Berhasil!",
                        type: "success",
                        icon: "success",
                    }).then(function() {
                        location.reload()
                    })
                },
                error: function(error) {
                    hideLoading();
                    handleErrorAjax(error)
                },
                complete: function() {
                    hideLoading();
                },
            })
        }

        function deletePhotos(id) {
            // console.log(id)
            $.ajax({
                url: `{{ url('admin/gallery/photos') }}/${id}`,
                method: 'DELETE',
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(xhr) {
                    // Menambahkan CSRF token ke header
                    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    showLoading();
                },
                success: (data) => {
                    Swal.fire({
                        title: "Berhasil!",
                        type: "success",
                        icon: "success",
                    }).then(function() {
                        location.reload()
                    })
                },
                error: function(error) {
                    hideLoading();
                    handleErrorAjax(error)
                },
                complete: function() {
                    hideLoading();
                },
            })
        }
    </script>
</x-app-layout>
