@extends('user.layouts.master')
@section('title','Roles')
@section('content')
<div class="card">
    <div class="card-header flex-column flex-md-row">
        <div class="head-label text-left">
            <h5 class="card-title mb-0">Roles</h5>
        </div>
        <div class="dt-action-buttons text-end pt-3 pt-md-0 ms-md-auto">
            <div class="dt-buttons">
                <a class="dt-button create-new btn-sm btn btn-primary waves-effect waves-light" href="#"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasGroupForm">
                    <span><i class="ti ti-plus me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">New</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
  <hr class="mt-0" />
  @if(session()->has('message'))
  <div class="offset-sm-1 col-md-6">
    <div class="alert alert-success" role="alert">{{session()->get('message')}}</div>
  </div>
  @endif
  <div class="card-datatable">
    {{ $dataTable->table() }}
  </div>
</div>
<!-- Offcanvas for adding/editing group -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditRoleForm" aria-labelledby="offcanvasGroupFormLabel"
    aria-modal="true" role="dialog">
    <div class="offcanvas-header">
        <h5 id="offcanvasGroupFormLabel" class="offcanvas-title">Add Role</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-group pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="groupForm"
            data-save-url="{{ route('saas.roles.save') }}" data-update-url="{{ route('saas.roles.update') }}">
            @csrf
            <input type="hidden" id="roleId" name="id">
            <div class="fv-plugins-message-container invalid-feedback"></div>

            <div class="mb-3 fv-plugins-icon-container">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" id="roleName" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
            <button type="reset" class="btn btn-label-secondary waves-effect"
                data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
@endsection
@push('js')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush



@push('js')
    <script src="{{ asset('vendor/jishadp/roles/js/roles.js') }}"></script>
@endpush
