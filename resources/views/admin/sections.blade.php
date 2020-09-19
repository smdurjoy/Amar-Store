@extends('layouts/admin/admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Catalogues</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active"><a href=" {{url('/admin/sections')}} ">Sections</a></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Sections</h3>
                                    <a href="{{ url('admin/add-edit-category ') }}" class="btn btn-dark" style="float: right">Add Sections</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="sectionTable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sections as $section)
                                            <tr>
                                                <td>{{ $section->id  }}</td>
                                                <td>{{ $section->name  }}</td>
                                                <td>
                                                    @if($section->status == 1)
                                                        <a class="updateStatus" record="section" href="javascript:void(0)" record_id="{{ $section->id  }}"> <span id="section-{{$section->id}}" class="badge badge-primary">Active</span> </a>
                                                    @else
                                                        <a class="updateStatus" record="section" href="javascript:void(0)" record_id="{{ $section->id  }}"> <span id="section-{{$section->id}}"  class="badge badge-primary">Inactive</span> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection


