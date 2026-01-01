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
                    <div class="box-header">
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add">
                            <i class="fa fa-plus"> </i>
                            Add
                        </button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Brand Name</th>
                                    <th>Brand Logo</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                @endphp
                                @foreach($data_brands as $brand)
                                <tr>
                                    <td></td>
                                    <td>{{ $brand->BrandName}}</td>
                                    <td><img src="/img/brand/{{$brand->BrandLogo}}" alt="" width=100; height=100;></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="updateData({{$brand->BrandID}});"
                                            data-toggle="modal" data-target="#modal-edit">
                                            <i class="fa fa-edit"> </i>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" onclick="confirmDelete({{ $brand->BrandID }})">
                                            <i class="fa fa-trash"> </i> Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <center>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $data_brands->links('vendor.pagination.simple-custom') }}
                            </div>
                        </center>
                    </div>
                    <!-- /.box-body -->
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


<!-- MODAL EDIT -->

<script>
var data_brand = {!!json_encode($data_brands -> toArray()['data']) !!};

function updateData(id) {
    var result = data_brand.find(obj => obj.BrandID == id);

    if (result) {
        console.log(result);
        document.getElementById("BrandIDEdit").value = result.BrandID;
        document.getElementById("imagePreviewEdit").src = "/img/brand/" + result.BrandLogo;
        document.getElementById("BrandNameEdit").value = result.BrandName;
        $('#editForm').attr('action', 'brand')
    } else {
        console.error("Data dengan ID " + id + " tidak ditemukan.");
    }
}
</script>

<script>
// Delete Confirmation
function confirmDelete(id) {
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Data tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/brand/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("Terhapus!", data.message, "success").then(() => {
                            location.reload(); // tetap di halaman pagination saat ini
                        });
                    } else {
                        Swal.fire("Error!", data.message, "error");
                    }
                });
        }
    });
}
</script>

<script>
function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function() {
        var preview = document.getElementById('imagePreview');
        preview.src = reader.result;
        // preview.style.display = 'block';
    }
    reader.readAsDataURL(input.files[0]);
}

function previewImageEdit(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function() {
        var preview = document.getElementById('imagePreviewEdit');
        preview.src = reader.result;
        // preview.style.display = 'block';
    }
    reader.readAsDataURL(input.files[0]);
}
</script>