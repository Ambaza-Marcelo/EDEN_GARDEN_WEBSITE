
@extends('backend.layouts.master')

@section('title')
@lang('Modifier Certificat') - @lang('messages.admin_panel')
@endsection

@section('styles')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">@lang('Modifier Certificat')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><a href="{{ route('admin.rooms.index') }}">@lang('messages.list')</a></li>
                    <li><span>@lang('Modifier Certificat')</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body bg-success">
                    <h4 class="header-title">Modifier Certificat</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.certifications.update',$certification->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="title">Titre<span class="text-danger"></span></label>
                                        <input autofocus type="text" class="form-control" name="title" value="{{ $certification->title }}" required minlength="2" maxlength="255">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="image">Image<span class="text-danger"></span></label>
                                        <input autofocus type="file" class="form-control" name="image">
                                    </div>
                                </div>
                            </div>
                            <br>
                         <table class="table table-bordered" id="dynamicTable">  
                            <tr>
                                <th>Sous-Title</th>
                                <th>Action</th>
                            </tr>
                            <tr> 
                                @foreach($datas as $data) 
                                <td><input type="text" name="subtitle[]" value="{{ $certification->title }}" class="form-control" /></td>   
                                <td><button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-plus-square" title="Ajouter Plus" aria-hidden="false"></i></button></td> 
                                @endforeach
                            </tr> 
                        </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="nif">Description<span class="text-danger"></span></label>
                                        <textarea class="form-control" name="description">
                                            {{ $certification->description }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection