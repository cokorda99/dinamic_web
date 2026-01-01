@extends('admin.layouts.main')
@section('title', 'Customers')
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
                        <!-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add">
                            <i class="fa fa-plus"> </i>
                            Add
                        </button> -->
                        <div style="float:right">
                            <form action="{{ route('customers.index') }}" method="GET" class="mb-3">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer..."
                                    class="form-control" style="width: 250px; display:inline-block;">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Profile Image</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach($data_customers as $customer)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    @if (Str::startsWith($customer->Img, 'https://lh3.googleusercontent.com'))
                                    {{-- Jika gambar dari Google --}}
                                    <td><img src="{{$customer->Img}}" alt="" width=100; height=100;></td>
                                    @else
                                    {{-- Jika gambar bukan dari Google --}}
                                    <td><img src="/img/customer/{{$customer->Img}}" alt="" width=100; height=100;></td>
                                    @endif
                                    <td>{{ $customer->name}}</td>
                                    <td>{{ $customer->email}}</td>
                                    <td>{{ $customer->phone}}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="updateData({{$customer->id}});"
                                            data-toggle="modal" data-target="#modal-edit">
                                            <i class="fa fa-edit"> </i>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" onclick="confirmDelete({{$customer->id}})"> <i
                                                class="fa fa-trash"> </i> Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <center>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $data_customers->links('vendor.pagination.simple-custom') }}
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

        <!-- modal edit -->
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Customer</h4>
                    </div>
                    <form action="{{ url('/admin/customer') }}" method="POST" id="editForm"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name">
                                        Customer ID
                                    </label>
                                    <input type="text" id="CustomerIDEdit" name="CustomerIDEdit" class="form-control"
                                        placeholder="ID" readonly>
                                </div>
                                <label for="logo">
                                    Customer Profile Image
                                </label>
                                <br>
                                <img src="" id="imagePreviewEdit" alt="" width=100; height=100;>
                                <input type="file" id="CustomerImageEdit" name="CustomerImageEdit" class="form-control"
                                    placeholder="image" onchange="previewImageEdit(event)"
                                    accept="image/png, image/gif, image/jpeg">
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    Customer Name
                                </label>
                                <input type="text" id="CustomerNameEdit" name="CustomerNameEdit" class="form-control"
                                    placeholder=" Customer Name">
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="text" id="CustomerEmailEdit" name="CustomerEmailEdit" class="form-control"
                                    placeholder="Email" readonly>
                            </div>
                            <div class="form-group">
                                <label for="phone">
                                    Phone
                                </label>
                                <input type="text" id="CustomerPhoneEdit" name="CustomerPhoneEdit" class="form-control"
                                    placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="address">
                                    Address
                                </label>
                                <input type="text" id="CustomerAddressEdit" name="CustomerAddressEdit"
                                    class="form-control" placeholder="Address">
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
var data_customer = {!!json_encode($data_customers -> toArray()['data']) !!};

function updateData(id) {
    var result = data_customer.filter(obj => obj.id === id)[0];
    // console.log(result);
    document.getElementById("CustomerIDEdit").value = result.id;
    document.getElementById("CustomerNameEdit").value = result.name;
    document.getElementById("CustomerEmailEdit").value = result.email;
    document.getElementById("CustomerPhoneEdit").value = result.phone;
    document.getElementById("CustomerAddressEdit").value = result.address;
    let customerImg = result.Img;
    if (customerImg.startsWith('https://lh3.googleusercontent.com')) {
        document.getElementById("imagePreviewEdit").src = customerImg;
    } else {
        document.getElementById("imagePreviewEdit").src = "/img/customer/" + customerImg;
    }

    $('#editForm').attr('action', 'customer')
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
    fetch(`/admin/customer/${itemId}`, {
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