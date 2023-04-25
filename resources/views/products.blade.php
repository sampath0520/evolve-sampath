@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add-Edit products</li>

                    </ol>
                </div>
                <div class="col-sm-12">
                    <a href="{{ route('members-data') }}" class="btn btn-dark float-sm-right">Back</a>
                    &nbsp; &nbsp; &nbsp;
                    <button type="button" class="btn btn-primary float-sm-right" data-toggle="modal"
                        data-target="#modal-lg">Add Products</button>





                </div>

            </div>


        </div>
    </section>
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">Add/Edit Products </h3>
                        </div>

                        <div class="card-body">
                            <table id="products_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>QTY</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal">
                        <div class="card-body">
                            <input type="hidden" id="member_id" value="{{ request()->route('id') }}">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_name" placeholder="Name"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Price :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="price" placeholder="Price" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="avalibale_item" class="col-sm-2 col-form-label">Availble Items:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="availabe_items"
                                        placeholder="Availble Items" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="avalibale_item" class="col-sm-2 col-form-label">Description :</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="save_products" class="btn btn-primary">Save changes</button>
                    <button type="button" id="update_products" class="btn btn-warning d-none">Update changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="product_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_name_display" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Price :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="price_display" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="avalibale_item" class="col-sm-2 col-form-label">Availble Items:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="availabe_items_display"
                                        placeholder="Availble Items" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="avalibale_item" class="col-sm-2 col-form-label">Description :</label>
                                <div class="col-sm-10">
                                    <textarea disabled class="form-control" id="description_display" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/products.js') }}"></script>
<script src="{{ asset('js/common-functions.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
