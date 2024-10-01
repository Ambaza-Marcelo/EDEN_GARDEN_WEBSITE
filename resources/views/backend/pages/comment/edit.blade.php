
@extends('backend.layouts.master')

@section('title')
@lang('modification du commentaire') - @lang('messages.admin_panel')
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
                <h4 class="page-title pull-left">@lang('modification du commentaire')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><a href="{{ route('admin.comments.index') }}">@lang('messages.list')</a></li>
                    <li><span>@lang('modification du commentaire')</span></li>
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
                    <h4 class="header-title">Modifier un commentaire</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="name">Nom<span class="text-danger"></span></label>
                                        <input autofocus type="text" class="form-control" name="name" value="{{ $comment->name }}">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">E-mail<span class="text-danger"></span></label>
                                        <input autofocus type="text" class="form-control" name="email" value="{{ $comment->email }} ">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="nif">Site web<span class="text-danger"></span></label>
                                        <input autofocus type="text" class="form-control" name="web_site" value="{{ $comment->web_site }}">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="message">Message<span class="text-danger"></span></label>
                                        <textarea class="form-control" name="message">
                                            {{ $comment->message }}
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
