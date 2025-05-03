@extends('admin.layouts.master')


@section('content')
          <!-- Category -->
<section id="posts">
  <h2 class="text-2xl font-semibold mb-4">Category</h2>

<!-- Category Create Form -->
<div class="bg-white p-6 rounded shadow mb-6">
  <h3 class="text-xl font-semibold mb-4">Create Category</h3>
  <form class="space-y-4" action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div>
      <label class="block text-gray-700">Category Name</label>
      <input name="name" type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="Category Name">
      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
      @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
      @enderror
    </div>
    <div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Category</button>
    </div>
  </form>
</div>



</section>
@endsection