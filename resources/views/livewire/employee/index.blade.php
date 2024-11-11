<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Filter dan Search -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex space-x-4 items-center">
                        <input wire:model.live="search" type="search" placeholder="Cari karyawan..." class="form-input rounded-lg shadow-sm mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                        <select wire:model.live="selectedUnit" class="form-select rounded-lg shadow-sm mt-1 block border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Semua Unit</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button wire:click="create" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-200">
                        Tambah Karyawan
                    </button>
                </div>

                <!-- Tabel Karyawan -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">NIP</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Departemen</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Unit</th>
                                <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($employees as $employee)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($employee->photo)
                                            <img src="{{ Storage::url($employee->photo) }}" class="h-10 w-10 rounded-full shadow">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-200"></div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->nip }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->jabatan->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->units->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <button wire:click="edit({{ $employee->id }})" class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</button>
                                        <button wire:click="$dispatch('confirm-delete', { id: {{ $employee->id }} })" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block bg-white rounded-lg shadow-lg text-left overflow-hidden transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                <form wire:submit.prevent="store">
                    <div class="bg-white p-6">
                        <!-- NIP -->
                        <div class="mb-4">
                            <label for="nip" class="block text-gray-700 font-bold">NIP</label>
                            <input type="text" wire:model="nip" class="form-input rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1">
                            @error('nip') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Photo -->
                        <div class="mb-4">
                            <label for="photo" class="block text-gray-700 font-bold">Foto</label>
                            <input type="file" wire:model="photo" class="form-input rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1">
                            @error('photo') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-4">
                            <label for="jabatan_id" class="block text-gray-700 font-bold">Departemen</label>
                            <select wire:model="jabatan_id" class="form-select rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1">
                                <option value="">Pilih Departemen</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('departement_id') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Eselon -->
                        <div class="mb-4">
                            <label for="eselon_id" class="block text-gray-700 font-bold">Eselon</label>
                            <select wire:model="eselon_id" class="form-select rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1">
                                <option value="">Pilih Eselon</option>
                                @foreach($eselons as $eselon)
                                    <option value="{{ $eselon->id }}">{{ $eselon->name }}</option>
                                @endforeach
                            </select>
                            @error('eselon_id') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Rank -->
                        <div class="mb-4">
                            <label for="rank_id" class="block text-gray-700 font-bold">Pangkat</label>
                            <select wire:model="rank_id" class="form-select rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1">
                                <option value="">Pilih Pangkat</option>
                                @foreach($groups as $group)
                                    <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                                @endforeach
                            </select>
                            @error('group_id') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Unit -->
                        <div class="mb-4">
                            <label for="unit_id" class="block text-gray-700 font-bold">Unit</label>
                            <select wire:model="unit_id" class="form-select rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1">
                                <option value="">Pilih Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            @error('unit_id') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Work Location -->
                        <div class="mb-4">
                            <label for="work_location_id" class="block text-gray-700 font-bold">Lokasi Kerja</label>
                            <select wire:model="work_location_id" class="form-select rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-200 w-full mt-1">
                                <option value="">Pilih Lokasi Kerja</option>
                                @foreach($workLocations as $workLocation)
                                    <option value="{{ $workLocation->id }}">{{ $workLocation->name }}</option>
                                @endforeach
                            </select>
                            @error('work_location_id') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Simpan</button>
                        <button type="button" wire:click="$set('isModalOpen', false)" class="ml-3 bg-white hover:bg-gray-100 text-gray-700 font-bold py-2 px-4 rounded-lg shadow-md border">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Konfirmasi Hapus -->
    <div x-data="{ show: false, employeeId: null }" x-on:confirm-delete.window="show = true; employeeId = $event.detail.id" x-show="show" class="fixed inset-0 z-10 overflow-y-auto" style="display: none;">
        <div class="flex items-end justify-center min-h-screen px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle">&#8203;</span>
            <div class="bg-white rounded-lg text-left shadow-lg overflow-hidden transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg font-bold text-gray-800">Hapus Karyawan</h3>
                    <p class="text-sm text-gray-500">Anda yakin ingin menghapus karyawan ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                    <button x-on:click="$wire.delete(employeeId); show = false" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md sm:ml-3">Hapus</button>
                    <button x-on:click="show = false" class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-2 px-4 rounded-lg shadow-md border">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
