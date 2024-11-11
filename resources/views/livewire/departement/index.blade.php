<div wire:loading>
    <div class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
        <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
        <p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
    </div>
</div>

<div wire:loading.remove>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 shadow-md">
                @if (session()->has('message'))
                <div class="text-green-500 mb-4">
                    {{ session('message') }}
                </div>
                @endif


                <div class="flex justify-end mb-4">
                    <button
                        wire:click="showModal"
                        class="bg-blue-600 hover:bg-blue-700 text-gray-900 dark:text-gray-100 font-bold py-2 px-4 rounded-lg shadow-md">
                        Tambah Jabatan
                    </button>
                </div>

                <table class="table-auto w-full mt-6">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Nama Jabatan</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($departements as $departement)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $departement->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $departement->name }}</td>
                            <td class="py-3 px-6 text-center">
                                <button wire:click="edit({{ $departement->id }})"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg shadow-md">Edit</button>
                                <button wire:click="delete({{ $departement->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg shadow-md">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $departements->links() }}
                </div>
            </div>
        </div>

        <!-- Modal Pop-Up -->
        @if($isModalOpen)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        {{ $isEditMode ? 'Edit Jabatan' : 'Tambah Jabatan' }}
                    </h3>

                    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold">Nama Jabatan</label>
                            <input type="text" wire:model="name"
                                class="form-input rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1"
                                placeholder="Masukkan nama jabatan">
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                                {{ $isEditMode ? 'Perbarui' : 'Simpan' }}
                            </button>
                            <button type="button" wire:click="closeModal"
                                class="ml-3 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>