@extends('admin.layouts.main')
@section('title', 'Brands')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{$title}}
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{$title}}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ url('/admin/settings_general') }}" method="POST">
                        @csrf

                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Website Name</label>
                                    <input type="text" name="site_name" class="form-control"
                                        value="{{ $setting->site_name }}">
                                </div>

                                <div class="form-group">
                                    <label>Tagline</label>
                                    <input type="text" name="tagline" class="form-control"
                                        value="{{ $setting->tagline }}">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $setting->email }}">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $setting->phone }}">
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control"
                                        rows="3">{{ $setting->address }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Default Theme</label>
                                    <select name="default_theme" class="form-control">
                                        <option value="light"
                                            {{ $setting->default_theme == 'light' ? 'selected' : '' }}>Light</option>
                                        <option value="dark" {{ $setting->default_theme == 'dark' ? 'selected' : '' }}>
                                            Dark</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="maintenance_mode"
                                            {{ $setting->maintenance_mode ? 'checked' : '' }}>
                                        Maintenance Mode
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Maintenance Message</label>
                                    <textarea name="maintenance_message" class="form-control" rows="2">
                        {{ $setting->maintenance_message }}
                    </textarea>
                                </div>

                            </div>

                            <div class="box-footer">
                                <button class="btn btn-primary">
                                    <i class="fa fa-save"></i> Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <!-- /.row -->
        </div>



        <!-- modal add -->
        <div class="modal fade" id="modal-add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Brand</h4>
                    </div>
                    <form action="{{ url('/admin/brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="logo">
                                    Brand Logo
                                </label>
                                <br>
                                <img src="/admin/img/image_default.png" id="imagePreview" alt="" width=100; height=100;>
                                <input type="file" id="image" name="image" class="form-control" placeholder="image"
                                    onchange="previewImage(event)" accept="image/png, image/gif, image/jpeg">
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    Brand Name
                                </label>
                                <input type="text" class="form-control" placeholder="Brand Name" name="BrandName"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- modal edit -->
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Brand</h4>
                    </div>
                    <form action="{{ url('/admin/brand') }}" method="POST" id="editForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name">
                                        Brand ID
                                    </label>
                                    <input type="text" id="BrandIDEdit" name="BrandIDEdit" class="form-control"
                                        placeholder="ID" readonly>
                                </div>
                                <label for="logo">
                                    Brand Logo
                                </label>
                                <br>
                                <img src="" id="imagePreviewEdit" alt="" width=100; height=100;>
                                <input type="file" id="BrandLogoEdit" name="BrandLogoEdit" class="form-control"
                                    placeholder="image" onchange="previewImageEdit(event)"
                                    accept="image/png, image/gif, image/jpeg">
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    Brand Name
                                </label>
                                <input type="text" id="BrandNameEdit" name="BrandNameEdit" class="form-control"
                                    placeholder=" Brand Name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection