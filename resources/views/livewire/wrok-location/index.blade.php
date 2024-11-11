<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200 shadow-md">
            @if (session()->has('message'))
            <div class="text-green-500 mb-4">
                {{ session('message') }}
            </div>
            @endif

            <div class="flex justify-end mb-4">
                <button
                    wire:click="showModal"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                    Tambah Tempat Kerja
                </button>
            </div>

            <table class="table-auto w-full mt-6 border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nama Tempat Kerja</th>
                        <th class="py-3 px-6 text-left">Address</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($workLocations as $workLocation)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-300">
                        <td class="py-3 px-6 text-left">{{ $workLocation->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $workLocation->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $workLocation->address }}</td>
                        <td class="py-3 px-6 text-center">
                            <button wire:click="edit({{ $workLocation->id }})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                Edit
                            </button>
                            <button wire:click="delete({{ $workLocation->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $workLocations->links() }}
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
                    {{ $isEditMode ? 'Edit Golongan' : 'Tambah Golongan' }}
                </h3>

                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold">Nama</label>
                        <input type="text" wire:model="name"
                            class="form-input rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1"
                            placeholder="Masukkan nama tempat kerja">
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold">Address</label>
                        <input type="text" wire:model="address"
                            class="form-input rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1"
                            placeholder="Masukkan Address">
                        @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
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