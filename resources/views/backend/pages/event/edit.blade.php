
@extends('backend.layouts.master')

@section('title')
@lang('Modifier Evenement') - @lang('messages.admin_panel')
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
                <h4 class="page-title pull-left">@lang('Modifier Evenement')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><a href="{{ route('admin.events.index') }}">@lang('messages.list')</a></li>
                    <li><span>@lang('Modifier Evenement')</span></li>
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
                    <h4 class="header-title">Modifier Evenement</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.events.update',$event->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="title">Titre<span class="text-danger"></span></label>
                                        <input autofocus type="text" class="form-control" name="title" value="{{ $event->title }}" required minlength="2" maxlength="255">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="old_price">Ancien Prix<span class="text-danger"></span></label>
                                        <input autofocus type="number" class="form-control" name="old_price" value="{{ $event->old_price }}" required minlength="2" maxlength="255">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="price">Nouveau Prix<span class="text-danger"></span></label>
                                        <input type="number" class="form-control" name="price" required value="{{ $event->price }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="image">Image<span class="text-danger"></span></label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="nif">Description<span class="text-danger"></span></label>
                                        <textarea class="form-control" name="description">
                                            {{ $event->description }}
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