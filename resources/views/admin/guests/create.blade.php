<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tambah Tamu Undangan') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <form id="formGuest">
                @csrf
                <table class="w-full text-md text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">
                                Preposisi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Event
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Handphone
                            </th>
                        </tr>
                    </thead>
                    <tbody id="itemGuests">
                    </tbody>
                </table>
            </form>
        </div>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mt-5">
            <x-button variant="success" onclick="addRow()">
                <i class="fa-solid fa-plus"></i>
            </x-button>
            <x-button class="justify-center max-w-xs gap-2 " onclick="addGuest()">
                <span>Simpan Data</span>
            </x-button>
        </div>
    </div>

    <script>
        var itemRow = 0;

        function addRow() {
            itemRow++
            $('#itemGuests').append(
                `<tr id="row_${itemRow}"
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-4">
                        <x-button variant="danger" onclick="deleteRow(${itemRow})">
                            <i class="fa-solid fa-minus"></i>
                        </x-button>
                    </td>
                    <td class="px-6 py-4">
                        <select id="countries" name="preposition[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Pilih Preposisi</option>
                            <option value="Bp.">Bp.</option>
                            <option value="Ibu">Ibu</option>
                            <option value="Sdr/i">Sdr/i</option>
                            <option value="Keluarga">Keluarga</option>
                        </select>
                    </td>
                    <td class="px-6 py-4">
                        <input type="text" name="name[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Nama Lengkap" required />
                    </td>
                    <td class="px-6 py-4">
                        <select name="event[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Pilih Events</option>
                            <option value="Akad">Akad</option>
                            <option value="Resepsi">Resepsi</option>
                        </select>
                    </td>
                    <td class="px-6 py-4">
                        <input type="text" name="phone[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Handphone" required />
                    </td>
                </tr>`
            )
        }

        function deleteRow(row) {
            $(`#row_${row}`).remove();
        }

        function addGuest() {
            var form = document.getElementById('formGuest')
            var formData = new FormData(form)

            $.ajax({
                url: `{{ url('admin/dashboard/guests') }}`,
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
