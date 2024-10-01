 <!-- sidebar menu area start -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">EDEN</h2> 
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class="active">
                        <a href="{{ route('admin.dashboard') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>@lang('messages.dashboard')</span></a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('admin.roles.index') }}" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            @lang('messages.roles') & @lang('messages.permissions')
                        </span></a>
                    </li>

                    
                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li>
                        <a href="{{ route('admin.admins.index') }}" aria-expanded="true"><i class="fa fa-user"></i><span>
                            @lang('messages.users')
                        </span></a>
                    </li>
                    @endif
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class=""></i><span>
                            @lang('HOTEL')
                        </span></a>
                        <ul class="collapse">
                            <li class=""><a href="{{ route('admin.abouts.index')}}">@lang('A propos ')</a></li>
                            <li class=""><a href="{{ route('admin.sliders.index')}}">@lang('Slider')</a></li>
                            <!--
                            <li class=""><a href="{{ route('admin.infrastructures.index')}}">@lang('Infrastructures')</a></li>
                        -->
                            <li class=""><a href="{{ route('admin.paillotes.index')}}">@lang('Paillotes')</a></li>
                            <li class=""><a href="">@lang('Certification')</a></li>
                            <li class=""><a href="{{ route('admin.positions.index')}}">@lang('Position')</a></li>
                            <li class=""><a href="{{ route('admin.teams.index')}}">@lang('Equipe')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class=""></i><span>
                            @lang('SALLES DE CONFERENCES')
                        </span></a>
                        <ul class="collapse">
                            <li class=""><a href="{{ route('admin.category_salles.index')}}">@lang('Categorie')</a></li>
                            <li class=""><a href="{{ route('admin.salles.index')}}">@lang('Salle de Conferences')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class=""></i><span>
                            @lang('RESTAURATION')
                        </span></a>
                        <ul class="collapse">
                            <li class=""><a href="{{ route('admin.category_restaurations.index')}}">@lang('Categorie')</a></li>
                            <li class=""><a href="{{ route('admin.restaurations.index')}}">@lang('Restauration')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class=""></i><span>
                            @lang('CHAMBRES ET SUITES')
                        </span></a>
                        <ul class="collapse">
                            <li class=""><a href="{{ route('admin.category_rooms.index')}}">@lang('Categorie')</a></li>
                            <li class=""><a href="{{ route('admin.rooms.index')}}">@lang('Chambres&amp;Suites')</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class=""></i><span>
                            @lang('PUBLICATIONS')
                        </span></a>
                        <ul class="collapse">
                            <li class=""><a href="{{ route('admin.categories.index')}}">@lang('Categories ')</a></li>
                            <li class=""><a href="{{ route('admin.actualites.index')}}">@lang('Actualites ')</a></li>
                            <li class=""><a href="{{ route('admin.events.index')}}">@lang('Conferences et Evenements ')</a></li>
                            <li class=""><a href="{{ route('admin.galleries.index')}}">@lang('Gallerie')</a></li>
                            <li class=""><a href="{{ route('admin.comments.index')}}">@lang('Commentaires')</a></li>
                            <li class=""><a href="">@lang('Appels d\'Offres')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class=""></i><span>
                            @lang('RESERVATIONS')
                        </span></a>
                        <ul class="collapse">
                            <li class=""><a href="{{ route('admin.bookings.index')}}">@lang('Reservations Encours')</a></li>
                            <li class=""><a href="{{ route('admin.bookings.index')}}">@lang('Reservations Accompli')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class=""></i><span>
                            @lang('CONTACT')
                        </span></a>
                        <ul class="collapse">
                            <li class=""><a href="{{ route('admin.messages.index')}}">Messages</a></li>
                            <li class=""><a href="{{ route('admin.testimonials.index')}}">@lang('Testimonials')</a></li>
                        </ul>
                    </li>

                    <li class=""><a href="{{ route('admin.settings.index') }}"><i class="fa fa-cogs"></i><span>@lang('messages.setting')</a></li>

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->