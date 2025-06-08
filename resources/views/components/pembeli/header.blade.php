<header class="top-0 z-1000">
    <div class="flex justify-between items-center bg-[#b0cee3] px-6 py-3">

        <!-- Logo -->
        <div class="logo font-bold text-lg">E-TechnoCart</div>

        <!-- Hamburger Menu Icon (mobile) -->
        <div class="md:hidden text-2xl cursor-pointer" onclick="toggleMobileMenu()">
            <i class='bx bx-menu'></i>
        </div>

        <!-- Desktop Menu -->
        <nav class="menu hidden md:flex gap-8">
        <a href="{{ route('home_page') }}"
                class="text-black text-base hover:text-gray-700 hover:underline font-medium">Home</a>
            <a href="{{ route('contact') }}"
                class="text-black text-base hover:text-gray-700 hover:underline font-medium">Contact</a>
            <a href="{{ route('about') }}"
                class="text-black text-base hover:text-gray-700 hover:underline font-medium">About</a>
        </nav>

        <!-- Search & Actions -->
        <div class="actions hidden md:flex items-center gap-8">
            <div class="search-box relative flex items-center bg-[#e8dedd] rounded px-3 py-1">
                <input type="text" id="search" placeholder="What are you looking for?"
                    class="bg-transparent border-none text-sm placeholder-gray-500 w-48 px-2 py-1 focus:outline-none" />
                <i class='bx bx-search icon absolute right-2 text-base text-black'></i>
            </div>

            <div class="nav-icon flex items-center gap-6 text-xl text-black">
                <a href="{{ route('cart') }}"><i class='bx bx-cart-alt'></i></a>
                <a href="javascript:void(0);" onclick="toggleDropdown()"><i class='bx bx-user'></i></a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu"
        class="hidden flex flex-col gap-4 bg-[#b0cee3] px-6 py-4 md:hidden border-t border-gray-300">

        <a href="{{ route('home_page') }}" class="text-black text-base font-medium">Home</a>
        <a href="{{ route('contact') }}" class="text-black text-base font-medium">Contact</a>
        <a href="{{ route('about') }}" class="text-black text-base font-medium">About</a>

        <div class="search-box relative flex items-center bg-[#e8dedd] rounded px-3 py-1">
            <input type="text" id="searchMobile" placeholder="Search..."
                class="bg-transparent border-none text-sm placeholder-gray-500 w-full px-2 py-1 focus:outline-none" />
            <i class='bx bx-search icon absolute right-2 text-base text-black'></i>
        </div>

        <div class="flex items-center gap-6 text-xl text-black mt-2">
            <a href="{{ route('cart') }}"><i class='bx bx-cart-alt'></i></a>
            <a href="javascript:void(0);" onclick="toggleDropdown()"><i class='bx bx-user'></i></a>
        </div>
    </div>

    <!-- Akun Dropdown -->
    <div id="accountDropdown"
        class="account-dropdown absolute right-6 top-20 bg-gray-300/50 border border-gray-300 rounded-lg w-52 shadow-lg z-50 hidden">
        <div class="option px-4 py-3 hover:bg-gray-100">
        <a href="{{ route('profile') }}" class="flex items-center gap-3 text-gray-800 text-sm ">
                <i class='bx bx-user'></i> <span>Manage My Account</span>
            </a>
        </div>
        <div class="option px-4 py-3 hover:bg-gray-100">
            <a href="orderList" class="flex items-center gap-3 text-gray-800 text-sm">
                <i class='bx bxl-shopify'></i> <span>My Order</span>
            </a>
        </div>
        <div class="option px-4 py-3 hover:bg-gray-100">
            <a href="{{ route('logout') }}" class="flex items-center gap-3 text-red-800 text-sm">
                <i class='bx bx-log-out'></i> <span>Logout</span>
            </a>
        </div>
    </div>
</header>

<script>
    // Toggle dropdown
    function toggleDropdown() {
        const dropdown = document.getElementById("accountDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Close dropdown when clicking outside
    window.addEventListener("click", function (e) {
        const dropdown = document.getElementById("accountDropdown");
        const profileIcon = document.querySelectorAll(".bx-user");

        // Check semua icon bx-user
        let isUserIcon = false;
        profileIcon.forEach(icon => {
            if (icon.contains(e.target)) isUserIcon = true;
        });

        if (!dropdown.contains(e.target) && !isUserIcon) {
            dropdown.classList.add("hidden");
        }
    });

    // Toggle mobile menu
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById("mobileMenu");
        mobileMenu.classList.toggle("hidden");
    }
</script>