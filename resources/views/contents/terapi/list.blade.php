@extends('layouts.app')

@php
    $plugins = ['datatable', 'swal', 'select2'];
@endphp

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (rbacCheck('terapi', 2))
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="text-sm-right">
                                    <button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light btn-tambah"><i
                                            class="bx bx-plus-circle mr-1"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table class="table table-striped" id="table-data" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th>Nama Lengkap</th>
                                    <th>Keluhan</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sample modal content -->
    <div id="modal-terapi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-terapiLabel"
        aria-hidden="true">
        <form action="{{ route('terapi.store') }}" method="post" id="form-terapi" autocomplete="off">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-terapiLabel">Form Terapi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="form-group">
                            <label for="username">Nama terapi</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Masukkan Nama terapi" required>
                            <div id="error-username"></div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan Nama Lengkap" required>
                            <div id="error-name"></div>
                        </div> --}}
                        <div class="form-group">
                            <label for="keluhan">Keluhan</label>
                            <input type="keluhan" name="keluhan" id="keluhan" class="form-control"
                                placeholder="Masukkan Keluhan" required>
                            <div id="error-keluhan"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->

    <!-- sample modal content -->
    <div id="modal-terapi-update" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="modal-terapi-updateLabel" aria-hidden="true">
        <form action="{{ route('terapi.update') }}" method="post" id="form-terapi-update" autocomplete="off">
            @method('PATCH')
            <input type="hidden" name="id" id="update-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="modal-terapi-updateLabel">Form terapi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="update-keluhan">Keluhan</label>
                            <input type="text" name="keluhan" id="update-keluhan" class="form-control"
                                placeholder="Masukkan Keluhan" required>
                            <div id="error-update-keluhan"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
@endsection

@push('scripts')
    <script src="{{ asset('js/page/terapi/list.js?q=' . Str::random(5)) }}"></script>
@endpush
