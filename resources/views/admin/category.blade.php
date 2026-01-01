@extends('admin.layouts.main')
@section('title', 'Categorys')
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
                                    <th>No</th>
                                    <th>Category Image</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach($data_categorys as $category)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><img src="/img/category/{{$category->CategoryImage}}" alt="" width=100;
                                            height=100;></td>
                                    <td>{{ $category->CategoryName}}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="updateData({{$category->CategoryID}});"
                                            data-toggle="modal" data-target="#modal-edit">
                                            <i class="fa fa-edit"> </i>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger"
                                            onclick="confirmDelete({{$category->CategoryID}})"> <i class="fa fa-trash">
                                            </i> Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <center>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $data_categorys->links('vendor.pagination.simple-custom') }}
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
                        <h4 class="modal-title">Add Category</h4>
                    </div>
                    <form action="{{ url('/admin/category') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="logo">
                                    Category Image
                                </label>
                                <br>
                                <img src="/admin/img/image_default.png" id="imagePreview" alt="" width=100; height=100;>
                                <input type="file" id="image" name="image" class="form-control" placeholder="image"
                                    onchange="previewImage(event)" accept="image/png, image/gif, image/jpeg">
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    Category Name
                                </label>
                                <input type="text" class="form-control" placeholder="Category Name" name="CategoryName"
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
                        <h4 class="modal-title">Edit Category</h4>
                    </div>
                    <form action="{{ url('/admin/category') }}" method="POST" id="editForm"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name">
                                        Category ID
                                    </label>
                                    <input type="text" id="CategoryIDEdit" name="CategoryIDEdit" class="form-control"
                                        placeholder="ID" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="logo">
                                        Category Image
                                    </label>
                                    <br>
                                    <img src="/admin/img/image_default.png" id="imagePreviewEdit" alt="" width=100;
                                        height=100;>
                                    <input type="file" id="imageEdit" name="imageEdit" class="form-control"
                                        placeholder="image" onchange="previewImageEdit(event)"
                                        accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="form-group">
                                    <label for="name">
                                        Category Name
                                    </label>
                                    <input type="text" id="CategoryNameEdit" name="CategoryNameEdit"
                                        class="form-control" placeholder=" Category Name">
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
var data_category = {!!json_encode($data_categorys -> toArray()['data'])!!};

function updateData(id) {
    var result = data_category.find(obj => obj.CategoryID === id);
    console.log(result);
    document.getElementById("CategoryIDEdit").value = result.CategoryID;
    document.getElementById("imagePreviewEdit").src = "/img/category/" + result.CategoryImage;
    document.getElementById("CategoryNameEdit").value = result.CategoryName;

    $('#editForm').attr('action', 'category')
}
</script>

<script>
// Delete Confirmation
function confirmDelete(itemId) {
    console.log(itemId);
    Swal.fire({
        title: "Delete",
        text: "Are you sure you want to delete this item?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            // document.getElementById("delete-form").submit();
            console.log("deleted");
            deleteItem(itemId);
        }
    });
}

function deleteItem(itemId) {
    fetch(`/admin/category/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: 'success',
                    title: "Data deleted successfully",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire(
                    'Gagal!',
                    'Terjadi kesalahan saat menghapus data.',
                    'error'
                );
            }
        })
        .catch(error => {
            Swal.fire(
                'Gagal!',
                'Terjadi kesalahan saat menghapus data.',
                'error'
            );
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