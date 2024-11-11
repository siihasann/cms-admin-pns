<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card for Total Employees -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Total Employees</h3>
                    <p class="text-3xl mt-2">{{ $totalEmployees }}</p>
                </div>
            </div>

            <!-- Card for Total Departments -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Total Departments</h3>
                    <p class="text-3xl mt-2">{{ $totalDepartments }}</p>
                </div>
            </div>

            <!-- Card for Total Units -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Total Units</h3>
                    <p class="text-3xl mt-2">{{ $totalUnits }}</p>
                </div>
            </div>
        </div>
    </div>
</div>