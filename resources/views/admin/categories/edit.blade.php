@extends('admin.layouts.master')

@section('content')
          <!-- Category Edit -->
<section id="categories">
  <h2 class="text-2xl font-semibold mb-4">Edit Category</h2>

<!-- Category Edit Form -->
<div class="bg-white p-6 rounded shadow mb-6">
  <h3 class="text-xl font-semibold mb-4">Edit Category</h3>
  <form class="space-y-4" action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
      <label class="block text-gray-700">Category Name</label>
      <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded" value="{{ old('name', $category->name) }}" placeholder="Category Name">
    </div>
    <div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Category</button>
    </div>
  </form>
</div>
</section>
@endsection
