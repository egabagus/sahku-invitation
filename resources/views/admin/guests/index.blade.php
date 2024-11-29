<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tamu Undangan') }}
            </h2>
            <x-button target="_blank" href="{{ url('/admin/guests/add') }}" class="justify-center max-w-xs gap-2 ">
                <span>Tambah Data</span>
            </x-button>
        </div>
    </x-slot>

    {{-- <button id="updateProductButton" data-modal-target="updateProductModal" data-modal-toggle="updateProductModal"
        class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
        type="button">
        Update product
    </button> --}}

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="guestTable">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="text-center">
                            No.
                        </th>
                        <th class="text-center">
                            Preposisi
                        </th>
                        <th class="text-center">
                            Nama
                        </th>
                        <th class="text-center">
                            Event
                        </th>
                        <th class="text-center">
                            Handphone
                        </th>
                        <th class="text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Sdr/i
                        </th>
                        <td class="px-6 py-4">
                            Ega Bagus Purnama
                        </td>
                        <td class="px-6 py-4">
                            Resepsi
                        </td>
                        <td class="px-6 py-4">
                            082133500252
                        </td>
                        <td class="px-6 py-4">
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content w-1/2">
            <div class="modal-header">
                <h1 class="text-xl ">Update Tamu Undangan</h1>
                <span id="closeModal" class="close">&times;</span>
                <hr class="border-header">
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="mb-5">
                                <input type="hidden" name="id" id="idGuest">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preposisi</label>
                                <select id="preposition" name="preposition"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih Preposisi</option>
                                    <option value="Bp.">Bp.</option>
                                    <option value="Ibu">Ibu</option>
                                    <option value="Sdr/i">Sdr/i</option>
                                    <option value="Keluarga">Keluarga</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event</label>
                                <select name="event" id="event"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih Events</option>
                                    <option value="Akad">Akad</option>
                                    <option value="Resepsi">Resepsi</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="mb-5">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Lengkap</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Nama Lengkap" required />
                            </div>
                            <div class="mb-5">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                    Handphone</label>
                                <input type="text" name="phone" id="phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Handphone" required />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <hr class="border-header">
                <x-button variant="success" type="button" onclick="updateGuest()">Simpan</x-button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadData();
        })

        var table;

        loadData = function() {
            if (undefined !== table) {
                requestTable.destroy()
            }

            table = $('#guestTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: "{{ url('admin/guests/data') }}",
                    beforeSend: function() {
                        showLoading();
                    },
                    complete: function() {
                        hideLoading();
                    },
                    error: function(error) {
                        handleErrorAjax(error)
                        hideLoading();
                    }
                },
                order: [
                    [1, 'asc']
                ],
                columns: [{
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'preposition',
                        name: 'preposition'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'event',
                        name: 'event'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'id',
                        class: 'text-center',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            // console.log(role)
                            return `<div class="d-flex justify-content-center" style="gap: 5px;">
                                <x-button id="openModal" variant=primary data-modal-target="updateProductModal" data-modal-toggle="updateProductModal" onclick="modalUpdate(${data}, '${row.preposition}', '${row.name}', '${row.event}', '${row.phone}')"><i class="fas fa-pen"></i></x-button>
                                <x-button variant=success target="_blank"><i class="fa-brands fa-whatsapp"></i></x-button>
                            </div>`
                        }
                    },
                ],
            });
        }

        function modalUpdate(id, prep, name, event, phone) {
            // Get modal elements
            const modal = document.getElementById('modal');
            const openModalButton = document.getElementById('openModal');
            const closeModalButton = document.getElementById('closeModal');

            // Open modal with fade-in
            modal.style.display = 'block'; // Ensure it's visible
            setTimeout(() => {
                modal.classList.add('show'); // Trigger fade-in
            }, 10); // Small delay to allow transition to start

            // Close modal with fade-out
            closeModalButton.addEventListener('click', () => {
                modal.classList.remove('show'); // Start fade-out
                setTimeout(() => {
                    modal.style.display = 'none'; // Hide after fade-out completes
                }, 300); // Match CSS transition duration
            });

            // Close modal when clicking outside modal content
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.remove('show'); // Start fade-out
                    setTimeout(() => {
                        modal.style.display = 'none'; // Hide after fade-out completes
                    }, 300);
                }
            });

            $('#idGuest').val(id)
            $('#preposition').val(prep).change()
            $('#name').val(name)
            $('#phone').val(phone)
            $('#event').val(event).change()
        }

        function updateGuest() {
            var form = document.getElementById('updateForm')
            var formData = new FormData(form)
            var id = $('#idGuest').val()

            $.ajax({
                url: `{{ url('admin/guests') }}/${id}`,
                data: formData,
                method: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(xhr) {
                    // Menambahkan CSRF token ke header
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
