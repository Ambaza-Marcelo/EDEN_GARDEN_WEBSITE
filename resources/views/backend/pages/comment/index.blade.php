
@extends('backend.layouts.master')

@section('title')
@lang('Commentaires') - @lang('messages.admin_panel')
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">@lang('Commentaires')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><span>@lang('messages.list')</span></li>
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
                    <h4 class="header-title float-left">Commentaires</h4>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Date</th>
                                    <th width="10%">Nom</th>
                                    <th width="10%">E-mail</th>
                                    <th width="10%">Site web</th>
                                    <th width="30%">Message</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($comments as $comment)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ $comment->email }}</td>
                                    <td>{{ $comment->web_site }}</td>
                                    <td>{{ $comment->message }}</td>
                                    <td>
                                        @if (Auth::guard('admin')->user()->can('commentaire.edit'))
                                            <a class="btn btn-success text-white" href="{{ route('admin.comments.edit', $comment->id) }}">Modifier</a>
                                        @endif

                                        @if (Auth::guard('admin')->user()->can('commentaire.publish'))
                                            <a class="btn btn-primary text-white" href="{{ route('admin.comments.publish', $comment->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('publish-form-{{ $comment->id }}').submit();">
                                                Publier
                                            </a>
                                            <form id="publish-form-{{ $comment->id }}" action="{{ route('admin.comments.publish', $comment->id) }}" method="POST" style="display: none;">
                                                @method('PUT')
                                                @csrf
                                            </form>
                                        @endif
                                        
                                        @if (Auth::guard('admin')->user()->can('commentaire.delete'))
                                            <a class="btn btn-danger text-white" href="{{ route('admin.comments.destroy', $comment->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $comment->id }}').submit();">
                                                Supprimer
                                            </a>

                                            <form id="delete-form-{{ $comment->id }}" action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection


@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     
     <script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

     </script>
@endsection