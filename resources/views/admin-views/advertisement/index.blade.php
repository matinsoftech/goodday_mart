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

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ translate('Manage Advertisements') }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.advertisement.store') }}" method="POST">
                    @csrf

                    <div id="advertisement-wrapper">
                        {{-- First Row --}}
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

        {{-- SAVED ADVERTISEMENTS LIST --}}
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">{{ translate('Saved Advertisements') }}</h4>
            </div>

            <div class="card-body">
                @if ($advertisements->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="50">#</th>
                                    <th>{{ translate('Advertisement Text') }}</th>
                                    <th width="120" class="text-center">{{ translate('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advertisements as $key => $advertisement)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $advertisement->text }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.advertisement.destroy', $advertisement->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('{{ translate('Are you sure?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </form>
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
@endsection

@push('script')
    <script>
        document.addEventListener('click', function(e) {

            // Add new advertisement row
            if (e.target.closest('.add-advertisement')) {
                let wrapper = document.getElementById('advertisement-wrapper');

                let row = document.createElement('div');
                row.classList.add('row', 'align-items-center', 'mb-3', 'advertisement-row');

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

            // Remove advertisement row
            if (e.target.closest('.remove-advertisement')) {
                e.target.closest('.advertisement-row').remove();
            }
        });
    </script>
@endpush
