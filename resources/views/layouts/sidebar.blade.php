<aside id="sidebar" class="fixed top-24 left-0 h-screen bg-primary text-white border-r border-gray-700 z-40 w-64 transition-all duration-300 ease-in-out overflow-hidden">
    <!-- Tombol Toggle Sidebar -->
    <button id="toggleSidebar" class="flex items-center justify-end w-full p-4 cursor-pointer">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="p-4">
        <nav class="flex flex-col gap-2">
            @include('components.sidebar-links')
        </nav>
    </div>
</aside>
