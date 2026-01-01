@extends('admin.layouts.main')
@section('title', 'Notifications')
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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Notification</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                @foreach($data_notifications as $notif)
                                <tr>
                                    <td style="font-size:12px;">{{ $no++ }}</td>
                                    <td style="font-size:12px;">Order #{{ $notif->CheckoutID }} by {{ $notif->checkout->user->name }} is unpaid.</td>
                                    <!-- <td style="font-size:12px;">
                                        <button class="btn btn-warning" onclick="updateData({{$notif->CheckoutID}});"
                                            data-toggle="modal" data-target="#modal-view">
                                            <i class="fa fa-eye"> </i>
                                            View
                                        </button>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <!-- /.row -->
        </div>

        <!-- modal view -->
        <div class="modal fade" id="modal-view">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">View Order</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">
                                Order ID
                            </label>
                            <input type="text" class="form-control" placeholder="Brand Name" id="OrderID" name="OrderID"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="logo">
                                Product Image
                            </label>
                            <br>
                            <img src="/admin/img/image_default.png" id="imagePreview" alt="" width=100; height=100;>
                        </div>
                        <div class="form-group">
                            <label for="name">
                                Product Name
                            </label>
                            <input type="text" id="OrderName" class="form-control" placeholder="Product Name"
                                name="ProductName" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Quantity
                                    </label>
                                    <input type="text" id="Orderquantityview" class="form-control" placeholder="Qty"
                                        name="Quantity" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Price
                                    </label>
                                    <input type="text" id="Orderpriceview" class="form-control" placeholder="Price"
                                        name="Orderpriceview" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">
                                Ammount
                            </label>
                            <input type="text" id="Orderammount" class="form-control" placeholder="Ammount"
                                name="Orderammount" readonly>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Customer
                                    </label>
                                    <input type="text" id="Customer" class="form-control" placeholder="Customer"
                                        name="Customer" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Customer Email
                                    </label>
                                    <input type="text" id="Customer_Email" class="form-control"
                                        placeholder="Customer_Email" name="Customer_Email" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">
                                Customer Phone
                            </label>
                            <input type="text" id="Customer_Phone" class="form-control" placeholder="Customer_Phone"
                                name="Customer_Phone" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">
                                Order Status
                            </label>
                            <br>
                            <button id="statuspayment" class="btn"
                                style="width: 80px; border-radius: 30px; font-size: 12px; font-weight: 500;">
                                Unpaid
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div id="process_button" hidden>
                            <button id="paymentButton" onclick="confirmProcess()" class="btn btn-primary"
                                disabled>Process</button>
                        </div>
                        <div id="delivery_button" hidden>
                            <button id="deliveryButton" onclick="confirmDelivery()" class="btn btn-primary">Process Delivery</button>
                        </div>
                        <div id="finish_button" hidden>
                            <button id="finishButton" onclick="confirmFinish()" class="btn btn-primary">Finish Order</button>
                        </div>
                    </div>
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
var data_notif = {!!json_encode($data_notifications -> toArray()) !!};

function formatToRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(number);
}


function updateData(id) {
    var result = data_notif.filter(obj => obj.CheckoutID === id)[0];
    // console.log(result.product.Disc);
    if (result.product.Disc == 0 || result.product.Disc == null) {
        document.getElementById("Orderpriceview").value = formatToRupiah(result.product.Price);
    } else {
        document.getElementById("Orderpriceview").value = formatToRupiah(result.product.Price_Disc);
    }

    document.getElementById("OrderID").value = result.CheckoutID;
    document.getElementById("OrderName").value = result.product.ProductName + ' - size: ' + result.Size;
    document.getElementById("Orderquantityview").value = result.Quantity;

    document.getElementById("Orderammount").value = formatToRupiah(result.Subtotal);
    document.getElementById("Customer").value = result.user.name + ' ' + result.user.email;
    document.getElementById("Customer_Email").value = result.user.email;
    document.getElementById("Customer_Phone").value = result.user.phone;

    var orderID = result.CheckoutID;

    document.getElementById("paymentButton").setAttribute("data-order-id", orderID);
    document.getElementById("deliveryButton").setAttribute("data-order-id", orderID);
    document.getElementById("finishButton").setAttribute("data-order-id", orderID);
    // document.getElementById("OrderStatus").value = result.Status;
    var orderStatus = result.Status;
    const status = document.getElementById("statuspayment");
    const processButton = document.getElementById("paymentButton");
    const processButtonContainer = document.getElementById("process_button");
    const deliveryButtonContainer = document.getElementById("delivery_button");
    const finishButtonContainer = document.getElementById("finish_button");
    if (orderStatus === "paid") {
        status.classList.remove("btn-danger");
        status.classList.remove("btn-primary");
        status.classList.remove("btn-info");
        status.classList.remove("btn-default");
        status.classList.add("btn-success");
        status.textContent = "Paid";

        processButton.disabled = false; // Aktifkan tombol jika status "paid"
        processButtonContainer.hidden = false;
        deliveryButtonContainer.hidden = true;
        finishButtonContainer.hidden = true;
        processButton.classList.remove("btn-secondary");
        processButton.classList.add("btn-primary");

    } else if (orderStatus === "on process") {
        status.classList.remove("btn-success");
        status.classList.remove("btn-danger");
        status.classList.remove("btn-info");
        status.classList.remove("btn-default");
        status.classList.add("btn-primary");
        status.textContent = "On Process";

        processButton.disabled = true; // Nonaktifkan tombol jika status "unpaid"
        processButtonContainer.hidden = true;
        deliveryButtonContainer.hidden = false;
        finishButtonContainer.hidden = true;
        processButton.classList.remove("btn-primary");
        processButton.classList.add("btn-secondary");
    }  else if (orderStatus === "on delivery") {
        status.classList.remove("btn-success");
        status.classList.remove("btn-danger");
        status.classList.remove("btn-primary");
        status.classList.remove("btn-default");
        status.classList.add("btn-info");
        status.textContent = "On Delivery";

        processButton.disabled = true; // Nonaktifkan tombol jika status "unpaid"
        processButtonContainer.hidden = true;
        deliveryButtonContainer.hidden = true;
        finishButtonContainer.hidden = false;
        processButton.classList.remove("btn-primary");
        processButton.classList.add("btn-secondary");
    }   else if (orderStatus === "completed") {
        status.classList.remove("btn-success");
        status.classList.remove("btn-danger");
        status.classList.remove("btn-primary");
        status.classList.remove("btn-info");
        status.classList.add("btn-default");
        status.textContent = "Completed";

        processButton.disabled = true; // Nonaktifkan tombol jika status "unpaid"
        processButtonContainer.hidden = true;
        deliveryButtonContainer.hidden = true;
        finishButtonContainer.hidden = true;
        processButton.classList.remove("btn-primary");
        processButton.classList.add("btn-secondary");
    } else {
        status.classList.remove("btn-success");
        status.classList.remove("btn-primary");
        status.classList.remove("btn-info");
        status.classList.remove("btn-default");
        status.classList.add("btn-danger");
        status.textContent = "Unpaid";

        processButton.disabled = true; // Nonaktifkan tombol jika status "unpaid"
        processButtonContainer.hidden = false;
        deliveryButtonContainer.hidden = true;
        finishButtonContainer.hidden = true;
        processButton.classList.remove("btn-primary");
        processButton.classList.add("btn-secondary");
    }

    $('#editForm').attr('action', 'order')
}


function confirmProcess() {
    const orderId = document.getElementById("paymentButton").getAttribute("data-order-id");
    console.log('ID : ' + orderId);
    Swal.fire({
        title: "Process",
        text: "Are you sure you want to process this order?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Process",
    }).then((result) => {
        if (result.isConfirmed) {
            // Mengirim request ke server untuk mengupdate status dan stok
            fetch(`/admin/order/${orderId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        status: 'on process'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        Swal.fire("Processed!", "The order has been processed.", "success").then((
                        result) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire("Failed!", "There was an error processing the order.", "error");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire("Error!", "An error occurred while processing the order.", "error");
                });
        }
    });
}

function confirmDelivery() {
    const orderId = document.getElementById("deliveryButton").getAttribute("data-order-id");
    console.log('ID : ' + orderId);
    Swal.fire({
        title: "Process Delivery",
        text: "Are you sure you want to process delivery this order?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delivery",
    }).then((result) => {
        if (result.isConfirmed) {
            // Mengirim request ke server untuk mengupdate status dan stok
            fetch(`/admin/order/${orderId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        status: 'on delivery'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        Swal.fire("Processed!", "The order has been delivery.", "success").then((
                        result) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire("Failed!", "There was an error processing the order.", "error");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire("Error!", "An error occurred while processing the order.", "error");
                });
        }
    });
}

function confirmFinish() {
    const orderId = document.getElementById("finishButton").getAttribute("data-order-id");
    console.log('ID : ' + orderId);
    Swal.fire({
        title: "Finish Order",
        text: "Are you sure you want to finish this order?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Finish",
    }).then((result) => {
        if (result.isConfirmed) {
            // Mengirim request ke server untuk mengupdate status dan stok
            fetch(`/admin/order/${orderId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        status: 'completed'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        Swal.fire("Processed!", "The order has been completed.", "success").then((
                        result) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire("Failed!", "There was an error processing the order.", "error");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire("Error!", "An error occurred while processing the order.", "error");
                });
        }
    });
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