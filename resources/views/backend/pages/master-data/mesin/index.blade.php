@extends('backend.layouts-new.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">


    <style>
        .form-check-label {
            text-transform: capitalize;
        }

        .select2 {
            width: 100% !important
        }

        label {
            float: left;
        }
    </style>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">{{ $page_title }} List</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('mesin.create'))
                                <button class="btn btn-primary text-white d-none buttonCreate" type="button"
                                    data-bs-toggle="offcanvas" style="float: right" data-bs-target="#create"
                                    aria-controls="offcanvasEnd">
                                    Create</button>

                                <div class="offcanvas offcanvas-end" tabindex="-1" id="create"
                                    aria-labelledby="offcanvasActivityAdd" aria-modal="true" role="dialog">
                                    <div class="offcanvas-header">
                                        <h5 id="offcanvasActivityAdd" class="offcanvas-title">Add Mesin</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body mx-0 flex-grow-0">
                                        <form action="{{ route('mesin.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="ecommerce-customer-add-shiping mb-3 pt-3">

                                                <div class="form-row">
                                                    <div class="form-group col-md-12 col-sm-12 mb-3">
                                                        <label for="name" class="mb-3">TITLE</label>
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" placeholder="Enter Title" value="">
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="pt-3">
                                                <button type="submit"
                                                    class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                                                <button type="reset" class="btn bg-label-secondary"
                                                    data-bs-dismiss="offcanvas">Cancel</button>
                                            </div>
                                            <input type="hidden"><input type="hidden"><input type="hidden"><input
                                                type="hidden"><input type="hidden">
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="card-datatable table-responsive">
                            @include('backend.layouts.partials.messages')
                            <table id="dataTable" class="datatables-simply table border-top">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>NO</th>
                                        <th>Title</th>
                                        <th class="no-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mesins as $mesin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mesin->title }}</td>
                                            <td>
                                                <div class="d-inline-block text-nowrap">
                                                    @if (Auth::guard('admin')->user()->can('mesin.edit'))
                                                        <button class="btn btn-sm btn-icon" type="button"
                                                            data-bs-toggle="offcanvas"
                                                            data-bs-target="#edit-{{ $mesin->id }}"
                                                            aria-controls="offcanvasEnd">
                                                            <i class="bx bx-edit"></i>
                                                        </button>
                                                        <div class="offcanvas offcanvas-end" tabindex="-1"
                                                            id="edit-{{ $mesin->id }}"
                                                            aria-labelledby="offcanvasActivityAdd" aria-modal="true"
                                                            role="dialog">
                                                            <div class="offcanvas-header">
                                                                <h5 id="offcanvasActivityAdd" class="offcanvas-title">Edit
                                                                    Mesin</h5>
                                                                <button type="button" class="btn-close text-reset"
                                                                    data-bs-dismiss="offcanvas"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="offcanvas-body mx-0 flex-grow-0">
                                                                <form action="{{ route('mesin.update', $mesin->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="ecommerce-customer-add-shiping mb-3 pt-3">

                                                                        <div class="form-row">
                                                                            <div
                                                                                class="form-group col-md-12 col-sm-12 mb-3">
                                                                                <label for="name"
                                                                                    class="mb-3">Title</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="title"
                                                                                    value="{{ $mesin->title }}"
                                                                                    name="title"
                                                                                    placeholder="Enter Title"
                                                                                    value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="pt-3">
                                                                        <button type="submit"
                                                                            class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                                                                        <button type="reset"
                                                                            class="btn bg-label-secondary"
                                                                            data-bs-dismiss="offcanvas">Cancel</button>
                                                                    </div>
                                                                    <input type="hidden"><input type="hidden"><input
                                                                        type="hidden"><input type="hidden"><input
                                                                        type="hidden">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (Auth::guard('admin')->user()->can('mesin.delete'))
                                                        <button class="btn btn-sm btn-icon"
                                                            onclick="confirmDelete('{{ route('mesin.destroy', $mesin->id) }}')">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>

@endsection


@section('script')
<!-- jQuery (Wajib sebelum Bootstrap JS) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap 4 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
          $(function () {
                $('[data-toggle="tooltip"]').tooltip(); // Inisialisasi tooltip secara manual
            });
        $('.summernote').summernote({
            placeholder: 'Content Here',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                //['fontname', ['fontname']],
                // ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                //['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ],
        });
    </script>
    <script>
         function showCreateButton() {
            console.log('click');
            $('.buttonCreate').trigger('click');
        }
    </script>
@endsection
