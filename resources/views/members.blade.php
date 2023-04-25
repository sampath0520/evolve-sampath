@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Seller Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add-Edit Seller</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Seller Page</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" id="first_name" class="form-control" placeholder="First Name" value="{{ isset($member->first_name) ? $member->first_name : '' }}" >
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DS Division</label>
                                        <input type="hidden" id="division_id" value="{{ isset($member->division_id) ? $member->division_id : '' }}">
                                        <select class="form-control" id="ds_division" required>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name:</label>
                                        <input type="text" id="last_name" class="form-control" placeholder="Last Name" required value="{{ isset($member->last_name) ? $member->last_name : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date Of Birth:</label>
                                        <div class="input-group date" >
                                            <input type="date" id="dob" class="form-control datetimepicker-input" value="{{ isset($member->dob) ? $member->dob : '' }}" >

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Summery:</label>
                                        <textarea class="form-control" id="summery" rows="3" placeholder="Enter ...">{{isset($member->summary) ? $member->summary : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="reset">Reset</button>
                            <button type="button" class="btn btn-success" id="save">Save</button>
                            <button type="button" class="btn btn-warning" id="update" value="{{ isset($member->id) ? $member->id : '' }}">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/members.js') }}"></script>
<script src="{{ asset('js/common-functions.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
