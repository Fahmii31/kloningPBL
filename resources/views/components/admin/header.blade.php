<header class="bg-[#b0cee3] shadow sticky top-0 z-10">
    <div class="flex items-center justify-between px-4 py-3">
        <!-- Kiri: Sidebar toggle & search -->
        <div class="flex items-center">
            <!-- Button Toggle Sidebar (untuk Mobile) -->
            <button id="toggle-sidebar" class="text-gray-700 focus:outline-none md:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- Search Input (Desktop) -->
            <div class="relative ml-4 hidden sm:block">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <i class="fas fa-search text-gray-500"></i>
                </span>
                <input class="w-full sm:w-64 rounded-full pl-10 pr-4 py-2 focus:outline-none focus:shadow-outline bg-white" type="text" placeholder="Search">
            </div>
        </div>

        <!-- Kanan: Notifikasi & Profile untuk Mobile -->
        <div class="flex items-center space-x-4 md:space-x-6">
            <!-- Notifikasi -->
            <div class="relative mx-2 sm:mx-4">
                <button class="flex text-gray-700 focus:outline-none">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 h-5 w-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs">2</span>
                </button>
            </div>

            <!-- Profile & Dropdown -->
            <div class="relative">
                <button id="user-menu-button" class="flex items-center focus:outline-none">
                    <div class="h-8 w-8 overflow-hidden rounded-full bg-gray-300">
                        <img class="h-full w-full object-cover" src="https://ui-avatars.com/api/?name=Admin" alt="Avatar">
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">#</span>
                    <svg class="h-5 w-5 text-gray-700 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Account</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log out</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Search -->
    <div class="px-4 pb-3 sm:hidden">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <i class="fas fa-search text-gray-500"></i>
            </span>
            <input class="w-full rounded-full pl-10 pr-4 py-2 focus:outline-none focus:shadow-outline bg-white" type="text" placeholder="Search">
        </div>
    </div>
</header>

<script>
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    // Toggle dropdown saat tombol diklik
    userMenuButton.addEventListener('click', (event) => {
        event.stopPropagation(); // ⛔ Hentikan bubbling ke window
        userDropdown.classList.toggle('hidden');
    });

    // Tutup dropdown saat klik di luar
    window.addEventListener('click', (event) => {
        if (!userDropdown.contains(event.target)) {
            userDropdown.classList.add('hidden');
        }
    });
</script>

