
@extends('backend.layouts.master')

@section('title')
@lang('Modification') - @lang('messages.admin_panel')
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
                <h4 class="page-title pull-left">@lang('Modification')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">@lang('messages.dashboard')</a></li>
                    <li><a href="{{ route('admin.abouts.index') }}">@lang('messages.list')</a></li>
                    <li><span>@lang('Modification')</span></li>
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
                    <h4 class="header-title">Modification</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.abouts.update',$about->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="title">Titre<span class="text-danger"></span></label>
                                        <input autofocus type="text" class="form-control" name="title" value="{{ $about->title }} " required minlength="2" maxlength="255">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label for="image">Image<span class="text-danger"></span></label>
                                        <input type="file" class="form-control" name="image">
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
                                <td><input type="text" name="subtitle[]" value="{{ $data->subtitle }}" class="form-control" /></td>  
                                <td><button type='button' class='btn btn-danger remove-tr'><i class='fa fa-trash-o' title='Supprimer la ligne' aria-hidden='false'></i></button></td> 
                                @endforeach
                            </tr> 
                        </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="nif">Description<span class="text-danger"></span></label>
                                        <textarea class="form-control" name="description">
                                            {{ $about->description }}
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;

         var markup = "<tr>"+
                        "<td>"+
                          "<input type='text' name='subtitle[]' placeholder='Sous-Title' class='form-control' />"+
                        "</td>"+
                        "<td>"+
                          "<button type='button' class='btn btn-danger remove-tr'><i class='fa fa-trash-o' title='Supprimer la ligne' aria-hidden='false'></i></button>"+
                        "</td>"+
                    "</tr>";
   
        $("#dynamicTable").append(markup);
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    }); 


</script>
@endsection