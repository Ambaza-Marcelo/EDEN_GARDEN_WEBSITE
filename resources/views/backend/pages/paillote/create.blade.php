
@extends('backend.layouts.master')

@section('title')
@lang('Nouvelle Paillote') - @lang('messages.admin_panel')
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
                <h4 class="page-title pull-left">@lang('Nouvelle Paillote')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><a href="{{ route('admin.paillotes.index') }}">@lang('messages.list')</a></li>
                    <li><span>@lang('Nouvelle Paillote')</span></li>
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
                    <h4 class="header-title">Nouvelle Paillote</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.paillotes.store') }}" method="POST">
                        @csrf
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="name">Nom Paillote<span class="text-danger"></span></label>
                                        <input name="name" type="text" class="form-control" placeholder="Entrer le nom du Paillote">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="ofpeople">Max Personnes<span class="text-danger"></span></label>
                                        <input name="ofpeople" type="number" class="form-control" placeholder="Entrer le Max Personnes">
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
