
@extends('backend.layouts.master')

@section('title')
@lang('Réservation') - @lang('messages.admin_panel')
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
                <h4 class="page-title pull-left">@lang('Réservation')</h4>
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
                    <h4 class="header-title float-left">Réservation</h4>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Date</th>
                                    <th width="10%">Nom</th>
                                    <th width="10%">Telephone</th>
                                    <th width="10%">Date Reservation</th>
                                    <th width="10%">Temps Reservation</th>
                                    <th width="10%">Etat</th>
                                    <th width="10%">Chambre/Paillote/Salle/</th>
                                    <th width="10%">Nombre Personnes</th>
                                    <th width="30%">Message</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($bookings as $booking)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $booking->created_at }}</td>
                                    <td>{{ $booking->name }}</td>
                                    <td>{{ $booking->phone_no }}</td>
                                    <td>{{ $booking->date }}</td>
                                    <td>{{ $booking->time }}</td>
                                    <td>@if($booking->status == 1) <span class="badge badge-success">Confirmé</span> @else<span class="badge badge-warning">Encours..</span>@endif</td>
                                    <td>@if($booking->room_id){{ $booking->room->title }}/{{ number_format($booking->room->price,0,',',' ') }} @elseif($booking->paillote_id){{ $booking->paillote->name }} @elseif($booking->salle_id){{ $booking->salle->title }}/{{ number_format($booking->salle->price,0,',',' ') }} @endif</td>
                                    <td>{{ $booking->ofpeople }}</td>>
                                    <td>{{ $booking->message }}</td>
                                    <td>

                                        @if (Auth::guard('admin')->user()->can('reservation.confirm'))
                                            <a class="btn btn-primary text-white" href="{{ route('admin.bookings.confirm',$booking->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('confirm-form-{{ $booking->id }}').submit();">
                                                Confirmer
                                            </a>
                                            <form id="confirm-form-{{ $booking->id }}" action="{{ route('admin.bookings.confirm',$booking->id) }}" method="POST" style="display: none;">
                                                @method('PUT')
                                                @csrf
                                            </form>
                                        @endif
                                        
                                        @if (Auth::guard('admin')->user()->can('reservation.delete'))
                                            <a class="btn btn-danger text-white" href=""
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $booking->id }}').submit();">
                                                Supprimer
                                            </a>

                                            <form id="delete-form-{{ $booking->id }}" action="" method="POST" style="display: none;">
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