
@extends('backend.layouts.master')

@section('title')
@lang('nouvelle actualité') - @lang('messages.admin_panel')
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
                <h4 class="page-title pull-left">@lang('nouvelle actualité')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><a href="{{ route('admin.actualites.index') }}">@lang('messages.list')</a></li>
                    <li><span>@lang('nouvelle actualité')</span></li>
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
                <div class="card-body">
                    <h4 class="header-title">Nouvelle actualité</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.actualites.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="date">Date<span class="text-danger"></span></label>
                                        <input autofocus type="date" class="form-control" name="date" placeholder="Entrer le titre ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="title">Titre<span class="text-danger"></span></label>
                                        <input autofocus type="text" class="form-control" name="title" placeholder="Entrer le titre " required minlength="2" maxlength="255">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="image">Image<span class="text-danger"></span></label>
                                        <input type="file" class="form-control" name="image" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="category_id">Categorie<span class="text-danger"></span></label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            <option disabled= "disabled" selected="selected">merci de choisir</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" class="form-control">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="nif">Description<span class="text-danger"></span></label>
                                        <textarea class="form-control" name="description" placeholder="Entrer la description">
                                            
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection