@extends('layouts.back-end.app')

@section('title', translate('Advertisement'))

@section('content')
    <div class="content container-fluid" style="min-height: 100vh;">

        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-10">
                <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/brand-setup.png') }}" alt="">
                {{ translate('Advertisement') }}
            </h2>
        </div>

        {{-- CREATE ADVERTISEMENTS --}}
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ translate('Manage Advertisements') }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.advertisement.store') }}" method="POST">
                    @csrf

                    <div id="advertisement-wrapper">
                        <div class="row align-items-center mb-3 advertisement-row">
                            <div class="col-md-10">
                                <input type="text" name="advertisements[]" class="form-control"
                                    placeholder="{{ translate('Enter advertisement text') }}" required>
                            </div>
                            <div class="col-md-2 text-end">
                                <button type="button" class="btn btn-success add-advertisement">
                                    <i class="tio-add"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ translate('Save Advertisements') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- SAVED ADVERTISEMENTS --}}
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">{{ translate('Saved Advertisements') }}</h4>
            </div>

            <div class="card-body">
                @if ($advertisements->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>{{ translate('Advertisement Text') }}</th>
                                    <th width="120" class="text-center">{{ translate('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advertisements as $advertisement)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $advertisement->text }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                {{-- EDIT --}}
                                                <button type="button" class="btn btn-sm btn-info edit-advertisement"
                                                    data-id="{{ $advertisement->id }}"
                                                    data-text="{{ $advertisement->text }}">
                                                    <i class="tio-edit"></i>
                                                </button>

                                                {{-- DELETE --}}
                                                <form
                                                    action="{{ route('admin.advertisement.destroy', $advertisement->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ translate('Are you sure?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="tio-delete"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted">
                        {{ translate('No advertisements found') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editAdvertisementModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" id="editAdvertisementForm">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ translate('Edit Advertisement') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ translate('Advertisement Text') }}</label>
                        <input type="text"
                               name="text"
                               id="editAdvertisementText"
                               class="form-control"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ translate('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ translate('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
    <script>
        document.addEventListener('click', function(e) {

            // Add row
            if (e.target.closest('.add-advertisement')) {
                const wrapper = document.getElementById('advertisement-wrapper');

                const row = document.createElement('div');
                row.className = 'row align-items-center mb-3 advertisement-row';
                row.innerHTML = `
            <div class="col-md-10">
                <input type="text" name="advertisements[]" class="form-control"
                       placeholder="{{ translate('Enter advertisement text') }}" required>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-danger remove-advertisement">
                    <i class="tio-delete"></i>
                </button>
            </div>
        `;
                wrapper.appendChild(row);
            }

            // Remove row
            if (e.target.closest('.remove-advertisement')) {
                e.target.closest('.advertisement-row').remove();
            }

            // Edit modal
            if (e.target.closest('.edit-advertisement')) {
                const btn = e.target.closest('.edit-advertisement');

                document.getElementById('editAdvertisementText').value = btn.dataset.text;
                document.getElementById('editAdvertisementForm').action =
                    `/admin/advertisement/${btn.dataset.id}`;

                new bootstrap.Modal(document.getElementById('editAdvertisementModal')).show();
            }
        });
    </script>
@endpush
