
@extends('backend.layouts.master')

@section('title')
@lang('Nouvelle Categorie Restauration') - @lang('messages.admin_panel')
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
                <h4 class="page-title pull-left">@lang('Nouvelle Categorie Restauration')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><a href="{{ route('admin.category_restaurations.index') }}">@lang('messages.list')</a></li>
                    <li><span>@lang('Nouvelle Categorie Restauration')</span></li>
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
                    <h4 class="header-title">Nouvelle Categorie Restauration</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.category_restaurations.store') }}" method="POST">
                        @csrf
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="nif">Nom de la categorie<span class="text-danger"></span></label>
                                        <input name="name" type="text" class="form-control" placeholder="Entrer le nom de la categorie">
                                    </div>
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
