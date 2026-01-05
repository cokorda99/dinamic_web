@extends('admin.layouts.main')
@section('title', 'Branding Settings')
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
                    <form action="{{ url('/admin/settings_branding') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box box-primary">
                            <div class="box-body">

                                <h4>Logo & Icon</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                        @if($branding->logo)
                                            <img src="{{ asset('storage/'.$branding->logo) }}" class="img-responsive mt-2">
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <label>Logo Dark</label>
                                        <input type="file" name="logo_dark" class="form-control">
                                        @if($branding->logo_dark)
                                        <img src="{{ asset('storage/'.$branding->logo_dark) }}"
                                            class="img-responsive mt-2">
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <label>Logo Light</label>
                                        <input type="file" name="logo_light" class="form-control">
                                        @if($branding->logo_light)
                                        <img src="{{ asset('storage/'.$branding->logo_light) }}"
                                            class="img-responsive mt-2">
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <label>Favicon</label>
                                        <input type="file" name="favicon" class="form-control">
                                        @if($branding->favicon)
                                        <img src="{{ asset('storage/'.$branding->favicon) }}" width="32">
                                        @endif
                                    </div>
                                </div>

                                <hr>

                                <h4>Colors</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Primary</label>
                                        <input type="color" name="primary_color" value="{{ $branding->primary_color }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Secondary</label>
                                        <input type="color" name="secondary_color"
                                            value="{{ $branding->secondary_color }}" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Accent</label>
                                        <input type="color" name="accent_color" value="{{ $branding->accent_color }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <hr>

                                <h4>Typography</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Heading Font</label>
                                        <input type="text" name="font_heading" value="{{ $branding->font_heading }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Body Font</label>
                                        <input type="text" name="font_body" value="{{ $branding->font_body }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Font Size</label>
                                        <input type="number" name="font_base_size"
                                            value="{{ $branding->font_base_size }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Line Height</label>
                                        <input type="text" name="line_height" value="{{ $branding->line_height }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <hr>

                                <h4>Theme & UI</h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Default Theme</label>
                                        <select name="default_theme" class="form-control">
                                            <option value="light" {{ $branding->default_theme=='light'?'selected':'' }}>
                                                Light</option>
                                            <option value="dark" {{ $branding->default_theme=='dark'?'selected':'' }}>
                                                Dark</option>
                                            <option value="auto" {{ $branding->default_theme=='auto'?'selected':'' }}>
                                                Auto</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Border Radius</label>
                                        <input type="number" name="border_radius" value="{{ $branding->border_radius }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" name="enable_shadow"
                                                {{ $branding->enable_shadow?'checked':'' }}>
                                            Enable Shadow
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" name="enable_theme_toggle"
                                                {{ $branding->enable_theme_toggle?'checked':'' }}>
                                            Theme Toggle
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <h4>Custom Code</h4>
                                <div class="form-group">
                                    <label>Custom CSS</label>
                                    <textarea name="custom_css" rows="4"
                                        class="form-control">{{ $branding->custom_css }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Custom JS</label>
                                    <textarea name="custom_js" rows="4"
                                        class="form-control">{{ $branding->custom_js }}</textarea>
                                </div>

                            </div>

                            <div class="box-footer">
                                <button class="btn btn-primary">
                                    <i class="fa fa-save"></i> Save Branding
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
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->
@endsection