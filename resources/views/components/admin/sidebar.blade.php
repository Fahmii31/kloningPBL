<!-- Mobile Toggle Button (Top Left, No Title) -->
<div class="md:hidden fixed top-4 left-4 z-50">
    <button id="menuToggle" class="text-gray-800 bg-[#b0cee3] p-2 rounded shadow-md focus:outline-none">
        <i class="fas fa-bars text-xl"></i>
    </button>
</div>

<!-- Mobile Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

<style>
/* Hide scrollbar for Webkit browsers */
.hide-scrollbar::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for Firefox */
.hide-scrollbar {
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none;  /* IE 10+ */
}
</style>

<!-- Sidebar -->
<aside id="sidebar" class="fixed z-40 inset-y-0 left-0 w-64 bg-[#b0cee3] shadow-md p-4 transform -translate-x-full md:translate-x-0 md:relative md:inset-0 transition-transform duration-300 ease-in-out flex flex-col h-screen">

    <div class="hidden md:flex items-center mb-6">
        <h1 class="font-bold text-lg ml-2 md:ml-6">E-TechnoCart</h1>
    </div>

    <nav class="flex flex-col flex-grow overflow-y-auto hide-scrollbar">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('dashboard') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('inbox') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('inbox') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-inbox mr-3"></i> Inbox
                </a>
            </li>
            <li>
                <a href="{{ route('order') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('order') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-list mr-3"></i> Order Lists
                </a>
            </li>
            <li>
                <a href="{{ route('manage_product.index') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('manage_product.index') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-cubes mr-3"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('category.index') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('category.index') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-tags mr-3"></i> Category
                </a>
            </li>
            <li>
                <a href="{{ route('merk.index') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->is('admin/merk*') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-trademark mr-3"></i> Merk
                </a>
            </li>
            <li>
                <a href="{{ route('manage_stock') }}"
                   class="flex items-center p-3 rounded-lg {{ request()->routeIs('manage_stock') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                    <i class="fas fa-boxes mr-3"></i> Stock
                </a>
            </li>
        </ul>

        <div class="mt-8">
            <h3 class="text-xs text-gray-500 font-semibold uppercase tracking-wider mb-2 ml-2">Management</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('sales') }}"
                       class="flex items-center p-3 rounded-lg {{ request()->routeIs('sales') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                        <i class="fas fa-chart-line mr-3"></i> Sales Report
                    </a>
                </li>
                <li>
                    <a href="{{ route('team.index') }}"
                       class="flex items-center p-3 rounded-lg {{ request()->routeIs('team.index') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                        <i class="fas fa-users mr-3"></i> Team
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.edit') }}"
                       class="flex items-center p-3 rounded-lg {{ request()->routeIs('settings.edit') ? 'text-white bg-[#4880FF]' : 'text-gray-700 hover:bg-[#4880FF]' }}">
                        <i class="fas fa-cog mr-3"></i> Settings
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="mt-auto pt-4">
        <a href="{{ route('logout') }}"
           class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-[#4880FF]">
            <i class="fas fa-sign-out-alt mr-3"></i> Logout
        </a>
    </div>

</aside>

<!-- Script -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('menuToggle');

        if(toggleBtn && sidebar && overlay) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
    });
</script>
