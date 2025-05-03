<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      sidebar.classList.toggle("-translate-x-full");
    }
  </script>

<script>
// Toggle the username dropdown visibility
  function toggleDropdown() {
    const dropdown = document.getElementById('dropdown');
    dropdown.classList.toggle('hidden');
  }
</script>


</head>

<body class="flex min-h-screen bg-gray-100">
  <!-- Sidebar -->
    <div id="sidebar" class="w-64 bg-gray-900 text-white p-5 space-y-4 transform transition-transform duration-300 md:translate-x-0 -translate-x-full fixed md:relative z-50 h-screen">
      <!-- Close button for mobile -->
      <button class="md:hidden text-white absolute top-4 right-4" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      
      <h2 class="text-2xl font-bold mb-6"><a href="{{ route('dashboard') }}">Dashboard</a></h2>
      <nav class="space-y-2">
        <a href="{{ route('categories.index') }}" class="block p-2 rounded hover:bg-gray-700 {{ Route::is('categories.*') ? 'bg-gray-700' : '' }}">Categories</a>
        <a href="{{ route('posts.index') }}" class="block p-2 rounded hover:bg-gray-700 {{ Route::is('posts.*') ? 'bg-gray-700' : '' }}">Posts</a>
      </nav>
    </div>

  <!-- Main Content -->
  <div class="flex-1 md-64"> 
    <header class="bg-white shadow p-4 flex items-center justify-between">
      <!-- Sidebar Toggle Button -->
      <button class="md:hidden text-gray-500" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      
      <h1 class="text-xl font-bold">Admin Dashboard</h1>
      
      <!-- Username Dropdown Button -->
      <div class="relative">
        <button class="flex items-center space-x-2 text-gray-700" onclick="toggleDropdown()">
          <span class="text-gray-700">{{ auth()->user()->name }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg hidden">
          <ul class="py-2">
            <li>
              {{-- <a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Logout</a> --}}
              <form action="{{ route('logout') }}" method="post" class="p-3 inlineblock px-4 py-2 text-gray-700 hover:bg-gray-200">
                        @csrf
                        <button class="" type="submit">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <main class="p-6 space-y-12">
      @yield('content')
    </main>
  </div>
</body>

</html>