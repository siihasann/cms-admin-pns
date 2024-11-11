<div class="flex min-h-screen bg-gray-100 ">
  <!-- Sidebar -->
  <aside x-data="{ isOpen: true }" :class="isOpen ? 'w-64' : 'w-20'" class="bg-blue-800 text-gray-200 transition-all duration-300">
    <div class="flex flex-col h-full">
      <!-- Logo -->
      <div class="flex items-center justify-between h-16 bg-blue-900">
        <h1 x-show="isOpen" class="text-lg font-semibold ml-4">Larastore</h1>
        <button @click="isOpen = !isOpen" class="p-2 focus:outline-none">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-200">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- Navigation Links -->
      <nav class="flex-1 px-2 py-4 space-y-2">
        <a href="{{route('dashboard')}}"
          class="flex items-center px-4 py-2 text-sm font-medium text-gray-200 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
          <i class="fa-solid fa-house"></i>
          <span x-show="isOpen" class="ml-3">Dashboard</span>
        </a>

        <a href="{{route('employee.index')}}"
          class="flex items-center px-4 py-2 text-sm font-medium text-gray-200 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
          <i class="fa-solid fa-users"></i>
          <span x-show="isOpen" class="ml-3">Pegawai</span>
        </a>

        <a href="{{route('unit.index')}}"
          class="flex items-center px-4 py-2 text-sm font-medium text-gray-200 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
          <i class="fa-solid fa-suitcase"></i>
          <span x-show="isOpen" class="ml-3">Units Kerja</span>
        </a>

        <a href="{{route('jabatan.index')}}"
          class="flex items-center px-4 py-2 text-sm font-medium text-gray-200 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
          <i class="fa-solid fa-user-tie"></i>
          <span x-show="isOpen" class="ml-3">Jabatan</span>
        </a>

        <a href="{{route('eselon.index')}}"
          class="flex items-center px-4 py-2 text-sm font-medium text-gray-200 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
          <i class="fa-solid fa-sitemap"></i>
          <span x-show="isOpen" class="ml-3">Eselon</span>
        </a>

        <a href="{{route('group.index')}}"
          class="flex items-center px-4 py-2 text-sm font-medium text-gray-200 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
          <i class="fa-solid fa-users-rectangle"></i>
          <span x-show="isOpen" class="ml-3">Golongan</span>
        </a>

        <a href="{{route('workLoc.index')}}"
          class="flex items-center px-4 py-2 text-sm font-medium text-gray-200 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300">
          <i class="fa-solid fa-map"></i>
          <span x-show="isOpen" class="ml-3">Tempat Kerja</span>
        </a>
      </nav>

      <!-- Footer/Logout Button -->
      <div class="p-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            type="submit"
            class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-200 bg-red-500 rounded-lg hover:bg-red-600 transition duration-300">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </div>
  </aside>
</div>