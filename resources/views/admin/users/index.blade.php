@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')
    <div class="container mb-2 pe-0">
        <div class="row justify-content-end">
            <div class="col-auto">
                <form action="{{ route('admin.users') }}" method="get" class="float-end" style="width: 300px">
                    <input type="search" name="search" id="search" class="form-control form-control-sm" placeholder="Search for names..." value="{{ $search }}">
                </form>
            </div>
        </div>
    </div>
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th>ACTIVATE/DEACTIVATE</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_users as $user)
                <tr>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user d-block text-center icon-md"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if ($user->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                        @else
                            <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
                        @endif
                        
                    </td>
                    <td>
                        @if (Auth::user()->id !== $user->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">

                                    @if ($user->trashed())
                                        <div class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#activate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-check"></i> Activate {{ $user->name }}
                                        </div>
                                    @else
                                        <div class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{ $user->id }}">
                                            <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->name }}
                                        </div>
                                    @endif

                                    
                                </div>
                            </div>
                            @include('admin.users.modal.status')
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center"> No Results Found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $all_users->links() }}
    </div>
@endsection