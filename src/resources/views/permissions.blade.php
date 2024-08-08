@extends('user.layouts.master')
@section('title','Settings')
@section('content')
<div class="row fv-plugins-icon-container">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Permissions for {{ $role->name}} </h5>
        <!-- Account -->
        <div class="card-body">
            <div class="row">
                <form action="{{ route('saas.roles.permission.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ encrypt($role->id)}}" id="rolId">
                    @foreach ($groupedPermissions as $category => $permissions)
                        <h4>{{ ucfirst($category) }}</h4>
                        @foreach ($permissions as $permission)
                            <div class="mb-3 col-md-3 d-flex">
                                <input type="checkbox" class="form-check-input" @if(in_array($permission->id, $rolePermissions)) checked @endif id="{{$permission->name}}" name="permission[]" value="{{$permission->name}}">
                                <label class="form-label ms-2" for="{{$permission->name}}">{{$permission->name}}</label>
                            </div>
                        @endforeach
                    @endforeach
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Account -->
      </div>
    </div>
</div>
@endsection
