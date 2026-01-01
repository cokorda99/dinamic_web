@extends('admin.layouts.main')
@section('title', 'Products')
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
                        <div style="float:right">
                            <form action="{{ route('products.index') }}" method="GET" class="mb-3">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
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
                                    <th>Product Thumbnail</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Totak Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach($data_products as $product)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><img src="/img/product/{{$product->Img_thumbnail}}" alt="" width=100;
                                            height=100;></td>
                                    <td>{{ $product->ProductName}}</td>
                                    <td>{{ $product->Price}}</td>
                                    <td>{{ $product->StockQuantity}}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="updateData({{$product->ProductID}});"
                                            data-toggle="modal" data-target="#modal-edit">
                                            <i class="fa fa-edit"> </i>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" onclick="confirmDelete({{$product->ProductID}})">
                                            <i class="fa fa-trash"> </i> Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <center>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $data_products->links('vendor.pagination.simple-custom') }}
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
                        <h4 class="modal-title">Add Product</h4>
                    </div>
                    <form action="{{ url('/admin/product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="logo">
                                    Product Thumbnail
                                </label>
                                <br>
                                <img src="/admin/img/image_default.png" id="imagePreview" alt="" width=100; height=100;>
                                <input type="file" id="image" name="image" class="form-control" placeholder="image"
                                    onchange="previewImage(event)" accept="image/png, image/gif, image/jpeg">
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Product Name
                                        </label>
                                        <input type="text" class="form-control" placeholder="Product Name"
                                            name="ProductName" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Product Images
                                        </label>
                                        <input type="file" class="form-control" name="images[]" id="images" multiple
                                            onchange="previewImages();">
                                        <div id="image-preview" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">
                                    Description
                                </label>
                                <textarea name="Description" id="Description" class="form-control"
                                    placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">
                                    Price
                                </label>
                                <input type="number" class="form-control" placeholder="Price" name="Price" id="price"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    Discount
                                </label>
                                <br>
                                <label class="switch">
                                    <input type="checkbox" name="discounts" id="discounts"
                                        onchange="checkToggleDC(this)">
                                    <span class="slider round"></span>
                                </label>

                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Discount" name="discount"
                                            id="discount" value="0" onkeyup="cekdisc()" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" placeholder="DiscountPrice"
                                            name="discount_price" id="discount_price" disabled>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label for="name">
                                    New Arrival
                                </label>
                                <br>
                                <label class="switch">
                                    <input type="checkbox" name="new_arivals" id="newarivals"
                                        onchange="checkToggleNA(this)">
                                    <span class="slider round"></span>
                                </label>
                                <input type="number" placeholder="New Arival" name="new_arival" id="new_arival"
                                    value="0" hidden>
                            </div>
                            <div class="form-group">
                                <label for="sizes">
                                    Size & Stock
                                    <span style="color: red; font-size: 0.85em; font-weight: normal;">
                                        <p style="margin: 0; display: inline;"> Add size & stock , Exp = S:20 then click
                                            enter</p>
                                    </span>
                                </label>
                                <input name="sizes" id="sizes"
                                    placeholder="Add size & stock , Exp = S:20 then click enter" class="form-control"
                                    onkeyup="checkSize()" required>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Category
                                        </label>
                                        <select name="category" id="category" class="form-control">
                                            @foreach($data_categorys as $category)
                                            <option value="{{ $category->CategoryID}}">{{ $category->CategoryName}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Brand
                                        </label>
                                        <select name="brand" id="brand" class="form-control">
                                            @foreach($data_brands as $brand)
                                            <option value="{{ $brand->BrandID}}">{{ $brand->BrandName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                        <h4 class="modal-title">Edit Product</h4>
                    </div>
                    <form action="{{ url('/admin/product') }}" method="POST" id="editForm"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name">
                                        Product ID
                                    </label>
                                    <input type="text" id="ProductIDEdit" name="ProductIDEdit" class="form-control"
                                        placeholder="ID" readonly>
                                </div>
                                <label for="logo">
                                    Product Thumbnail
                                </label>
                                <br>
                                <img src="" id="imagePreviewEdit" alt="" width=100; height=100;>
                                <input type="file" id="ProductLogoEdit" name="ProductLogoEdit" class="form-control"
                                    placeholder="image" onchange="previewImageEdit(event)"
                                    accept="image/png, image/gif, image/jpeg">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Product Name
                                        </label>
                                        <input type="text" id="ProductNameEdit" name="ProductNameEdit"
                                            class="form-control" placeholder=" Product Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Product Images
                                        </label>
                                        <!-- Preview Gambar yang Sudah Ada -->
                                        <!-- Container to display multiple images -->
                                        <div id="imagePreviewContainer"
                                            style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        </div>
                                        <input type="file" class="form-control" name="images[]" id="new-images" multiple
                                            onchange="previewNewImages();">
                                        <div id="new-image-preview" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">
                                    Description
                                </label>
                                <textarea name="DescriptionEdit" id="DescriptionEdit" class="form-control"
                                    placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">
                                    Price
                                </label>
                                <input type="number" class="form-control" placeholder="Price" name="priceEdit"
                                    id="priceEdit" required>
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    Discount
                                </label>
                                <br>
                                <label class="switch">
                                    <input type="checkbox" name="discountsEdit" id="discountsEdit"
                                        onchange="checkToggleDCEdit(this)">
                                    <span class="slider round"></span>
                                </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Discount"
                                            name="discountEdit" id="discountEdit" onkeyup="cekdiscEdit()" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" placeholder="DiscountPrice"
                                            name="discount_priceEdit" id="discount_priceEdit" disabled>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="name">
                                    New Arrival
                                </label>
                                <br>
                                <label class="switch">
                                    <input type="checkbox" name="new_arivals" id="newarivalsEdit"
                                        onchange="checkToggleNAEdit(this)">
                                    <span class="slider round"></span>
                                </label>
                                <input type="number" placeholder="New Arival" name="newarivalEdit" id="newarivalEdit"
                                    hidden>
                            </div>
                            <div class="form-group">
                                <label for="sizes">
                                    Size & Stock
                                    <span style="color: red; font-size: 0.85em; font-weight: normal;">
                                        <p style="margin: 0; display: inline;"> Add size & stock , Exp = S:20 then click
                                            enter</p>
                                    </span>
                                </label>
                                <input type="text" class="form-control" placeholder="Size" id="SizeEdit" name="SizeEdit"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="stock">
                                    Total Stock
                                </label>
                                <input type="number" class="form-control" placeholder="Stock" id="StockEdit"
                                    name="StockEdit" readonly>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Category
                                        </label>
                                        <select name="categoryEdit" id="categoryEdit" class="form-control">
                                            @foreach($data_categorys as $category)
                                            <option value="{{ $category->CategoryID}}">{{ $category->CategoryName}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">
                                            Brand
                                        </label>
                                        <select name="brandEdit" id="brandEdit" class="form-control">
                                            @foreach($data_brands as $brand)
                                            <option value="{{ $brand->BrandID}}">{{ $brand->BrandName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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

<script>
function previewImages() {
    console.log('TEST IMAGE')
    let preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    let files = document.getElementById('images').files;

    if (files) {
        Array.from(files).forEach(file => {
            let reader = new FileReader();

            reader.onload = (e) => {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    }
}

function previewNewImages() {
    let preview = document.getElementById('new-image-preview');
    preview.innerHTML = '';
    let files = document.getElementById('new-images').files;

    if (files) {
        Array.from(files).forEach(file => {
            let reader = new FileReader();

            reader.onload = (e) => {
                let img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    }
}
</script>

<!-- MODAL EDIT -->

<script>
var data_product = {!!json_encode($data_products -> toArray()['data']) !!};


function updateData(id) {
    var result = data_product.filter(obj => obj.ProductID === id)[0];
    console.log(result);
    document.getElementById("ProductIDEdit").value = result.ProductID;
    document.getElementById("imagePreviewEdit").src = "/img/product/" + result.Img_thumbnail;
    document.getElementById("ProductNameEdit").value = result.ProductName;
    document.getElementById("DescriptionEdit").value = result.Description;
    document.getElementById("priceEdit").value = result.Price;
    document.getElementById("discountEdit").value = result.Disc;
    document.getElementById("discount_priceEdit").value = result.Price_Disc;
    document.getElementById("newarivalEdit").value = result.New_arrival;
    document.getElementById("StockEdit").value = result.StockQuantity;
    document.getElementById("SizeEdit").value = result.Size;
    document.getElementById("categoryEdit").value = result.CategoryID;
    document.getElementById("brandEdit").value = result.BrandID;
    var check_NA = result.New_arrival;
    if (check_NA == 1) {
        document.getElementById("newarivalsEdit").checked = true;
    } else {
        document.getElementById("newarivalsEdit").checked = false;
    }
    var check_DC = result.Disc;
    console.log('CEK DC : ' + check_DC);
    if (check_DC == null || check_DC == 0) {
        document.getElementById("discountsEdit").checked = false;
        document.getElementById("discountEdit").disabled = true;
        document.getElementById("discount_priceEdit").disabled = true;
    } else {
        document.getElementById("discountsEdit").checked = true;
        document.getElementById("discountEdit").disabled = false;
        document.getElementById("discount_priceEdit").disabled = false;
    }

    // Handle multiple images preview
    var imagesContainer = document.getElementById("imagePreviewContainer");
    imagesContainer.innerHTML = ''; // Clear previous images

    var images = JSON.parse(result.Img); // Parse JSON images array
    images.forEach(function(image) {
        var imgElement = document.createElement("img");
        imgElement.src = "/img/product/images/" + image;
        imgElement.style.width = "100px"; // Set size as needed
        imgElement.style.margin = "5px";
        imagesContainer.appendChild(imgElement);
    });


    $('#editForm').attr('action', 'product')
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
    fetch(`/admin/product/${itemId}`, {
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
function cekdisc() {
    var disc = document.getElementById("discount").value
    var price = document.getElementById("price").value

    if (disc == 0) {
        console.log('Tidak ada diskon');
    } else {
        console.log('Ada diskon');
        var disc = document.getElementById("discount").value
        var price = document.getElementById("price").value
        var jml_disc = (disc * price) / 100;

        var disc_price = price - jml_disc
        document.getElementById("discount_price").value = disc_price;

    }
}

function cekdiscEdit() {
    var disc = document.getElementById("discountEdit").value
    var price = document.getElementById("priceEdit").value

    if (disc == 0) {
        console.log('Tidak ada diskon');
    } else {
        console.log('Ada diskon');
        var disc = document.getElementById("discountEdit").value
        var price = document.getElementById("priceEdit").value
        var jml_disc = (disc * price) / 100;

        var disc_price = price - jml_disc
        document.getElementById("discount_priceEdit").value = disc_price;

    }
}


function checkToggleNA(toggle) {
    if (toggle.checked) {
        console.log('Toggle is ON');
        document.getElementById("new_arival").value = '1';

        // Lakukan sesuatu jika toggle diaktifkan
    } else {
        console.log('Toggle is OFF');
        // Lakukan sesuatu jika toggle dimatikan
        document.getElementById("new_arival").value = '0';
    }
}

function checkToggleNAEdit(toggle) {
    if (toggle.checked) {
        console.log('Toggle is ON');
        document.getElementById("newarivalEdit").value = '1';

        // Lakukan sesuatu jika toggle diaktifkan
    } else {
        console.log('Toggle is OFF');
        // Lakukan sesuatu jika toggle dimatikan
        document.getElementById("newarivalEdit").value = '0';
    }
}

function checkToggleDC(toggle) {
    if (toggle.checked) {
        // Lakukan sesuatu jika toggle diaktifkan
        // console.log('Toggle is ON');
        document.getElementById("discount").value = '10';
        document.getElementById("discount").disabled = false;
        document.getElementById("discount_price").disabled = false;

        var disc = document.getElementById("discount").value
        var price = document.getElementById("price").value

        // console.log('CEK DISC : '+disc)
        // console.log('CEK PRICE : '+price)
        var jml_disc = (disc * price) / 100;
        // console.log('CEK : '+ jml_disc)
        var disc_price = price - jml_disc
        document.getElementById("discount_price").value = disc_price;
    } else {
        console.log('Toggle is OFF');
        // Lakukan sesuatu jika toggle dimatikan
        document.getElementById("discount").value = '0';
        document.getElementById("discount").disabled = true;
        document.getElementById("discount_price").disabled = true;
        document.getElementById("discount_price").value = '0';
    }
}

function checkToggleDCEdit(toggle) {
    if (toggle.checked) {
        // Lakukan sesuatu jika toggle diaktifkan
        console.log('Toggle is ON');
        document.getElementById("discountEdit").disabled = false;
        document.getElementById("discount_priceEdit").disabled = false;

        var disc = document.getElementById("discountEdit").value
        var price = document.getElementById("priceEdit").value

        // console.log('CEK DISC : '+disc)
        // console.log('CEK PRICE : '+price)
        var jml_disc = (disc * price) / 100;
        // console.log('CEK : '+ jml_disc)
        var disc_price = price - jml_disc
        document.getElementById("discount_priceEdit").value = disc_price;
    } else {
        console.log('Toggle is OFF');
        // Lakukan sesuatu jika toggle dimatikan
        document.getElementById("discountEdit").value = '0';
        document.getElementById("discountEdit").disabled = true;
        document.getElementById("discount_priceEdit").disabled = true;
        document.getElementById("discount_priceEdit").value = '0';
    }
}

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