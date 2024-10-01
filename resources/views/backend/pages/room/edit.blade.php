
@extends('backend.layouts.master')

@section('title')
@lang('Modifier Chambre') - @lang('messages.admin_panel')
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
                <h4 class="page-title pull-left">@lang('Modifier Chambre')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><a href="{{ route('admin.rooms.index') }}">@lang('messages.list')</a></li>
                    <li><span>@lang('Modifier Chambre')</span></li>
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
                    <h4 class="header-title">Modifier Chambre</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.rooms.update',$room->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="title">Titre<span class="text-danger"></span></label>
                                        <input autofocus type="text" class="form-control" name="title" value="{{ $room->title }}" required minlength="2" maxlength="255">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="category_room_id">Categorie<span class="text-danger"></span></label>
                                        <select class="form-control" name="category_room_id" id="category_room_id">
                                            <option disabled= "disabled" selected="selected">merci de choisir</option>
                                            @foreach($categoryRooms as $categoryRoom)
                                            <option value="{{ $categoryRoom->id }}" {{$room->category_room_id == $categoryRoom->id  ? 'selected' : ''}}  class="form-control">{{ $categoryRoom->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="image">Image<span class="text-danger"></span></label>
                                        <input autofocus type="file" class="form-control" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="old_price">Ancien Prix<span class="text-danger"></span></label>
                                        <input autofocus type="number" class="form-control" name="old_price" value="{{ $room->old_price }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="price">Prix<span class="text-danger"></span></label>
                                        <input type="number" class="form-control" value="{{ $room->price }}" name="price" required>
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
                                <td><input type="text" name="subtitle[]" value="{{ $room->title }}" class="form-control" /></td>   
                                <td><button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-plus-square" title="Ajouter Plus" aria-hidden="false"></i></button></td> 
                                @endforeach
                            </tr> 
                        </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="nif">Description<span class="text-danger"></span></label>
                                        <textarea class="form-control" name="description">
                                            {{ $room->description }}
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