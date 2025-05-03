@extends('admin.layouts.master')


@section('content')

<section id="dashboard-stats" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
    <!-- Categories Stat Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700">Categories</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $categoriesCount ?? 0 }}</p>
        <p class="text-sm text-gray-500 mt-2">Total Categories</p>
    </div>

    <!-- Posts Stat Card -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700">Posts</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $postsCount ?? 0 }}</p>
        <p class="text-sm text-gray-500 mt-2">Total Posts</p>
    </div>
</section>

  


@endsection