@extends('layouts.app')
@section('header')
    Pengguna | Permission
@endsection

@section('content')
    <form method="POST" action="{{ route('pengguna.permission.update', $user->id) }}"
        class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <h2 class="text-xl font-semibold mb-4">Pengaturan Hak Akses</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">Menu</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Create</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Read</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Update</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedPermissions as $menu)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300 capitalize">{{ $menu }}</td>
                            @foreach (['create', 'read', 'update', 'delete'] as $action)
                                @php
                                    $permissionName = $action . ' ' . $menu;
                                @endphp
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    <input type="checkbox" name="permissions[]" value="{{ $permissionName }}"
                                        class="form-checkbox h-4 w-4 text-blue-600"
                                        {{ $user->hasPermissionTo($permissionName) ? 'checked' : '' }}>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                Simpan
            </button>
        </div>
    </form>
@endsection
