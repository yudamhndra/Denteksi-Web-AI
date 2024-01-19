<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <h2 class="mt-2">@yield('navbar-title')</h2>
        <ul class="navbar-nav">
            @php $notifications = Auth::user()->unreadNotifications; @endphp
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    @if(count($notifications) > 0)
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                    @endif
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>{{$notifications->count()}} Notifikasi Baru</p>
                    </div>
                    <div class="p-1">
                        @if(Auth::user()->role == 'dokter')
                            @foreach($notifications as $i => $notification)
                                @if(@$notification->data['pemeriksaan']['sekolah']['type'] == 'posyandu')
                                <a href="{{route('dokter.pemeriksaanDataUKGM',$notification->data['pemeriksaan']['id'])}}{{'?open=notification&id='.$notification->id.'&kec='.$notification->notifiable_id}}" class="dropdown-item d-flex align-items-center py-2 item-notification {{$i >= 1 ? 'd-none':'' }}">
                                    <div
                                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="gift"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>{{$notification->data['pemeriksaan']['anak']['nama'] . ' Melakukan Pemeriksaan Gigi'}}</p>
                                        <p class="tx-12 text-muted">{{$notification->created_at->diffForHumans()}}</p>
                                    </div>
                                </a>
                                @elseif(@$notification->data['pemeriksaan']['sekolah']['type'] == 'sekolah')
                                <a href="{{route('dokter.pemeriksaanDataUKGS',$notification->data['pemeriksaan']['id'])}}{{'?open=notification&id='.$notification->id.'&kec='.$notification->notifiable_id}}" class="dropdown-item d-flex align-items-center py-2 item-notification {{$i >= 1 ? 'd-none':'' }}">
                                    <div
                                        class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                        <i class="icon-sm text-white" data-feather="gift"></i>
                                    </div>
                                    <div class="flex-grow-1 me-2">
                                        <p>{{$notification->data['pemeriksaan']['anak']['nama'] . ' Melakukan Pemeriksaan Gigi'}}</p>
                                        <p class="tx-12 text-muted">{{$notification->created_at->diffForHumans()}}</p>
                                    </div>
                                </a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a type="button" id="btn-all-notification">Lihat Semua</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="sub-profile">
                    <!-- <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile" /> -->
                    <!-- <p>profil</p> -->
                    <span>Profil</span>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    </div>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt="" />
                        </div>
                        <div class="text-center">
                            @if(Auth::check()) @if(Auth::user()->role=='admin')
                            <p class="tx-16 fw-bolder">admin</p>
                            <p class="tx-12 text-muted">
                                {{auth()->user()->email}}
                            </p>
                            @elseif(Auth::user()->role=='orangtua')
                            <p class="tx-16 fw-bolder">
                                {{ auth()->user()->profilorangtua->nama ?? 'User' }}
                            </p>
                            <p class="tx-12 text-muted">
                                {{auth()->user()->email}}
                            </p>
                            @else
                            <p class="tx-16 fw-bolder">
                                {{auth()->user()->profildokter->nama ?? 'Dokter'}}
                            </p>
                            <p class="tx-12 text-muted">
                                {{auth()->user()->email}}
                            </p>
                            @endif @endif
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        @if(Auth::check()) @if(Auth::user()->role=='orangtua')
                        <li class="dropdown-item py-2">
                            <a href="{{route('orangtua.profil')}}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Ubah Profil</span>
                            </a>
                        </li>
                        @endif @if(Auth::user()->role=='dokter')
                        <li class="dropdown-item py-2">
                            <a href="{{route('dokter.profil')}}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        @endif @endif

                        <li class="dropdown-item py-2">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Log Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
@push('after-script')
<script>
    $(document).ready(function() {
        $(document).on('click', '.navbar-nav #btn-all-notification', function (e) {
            if ($(this).data('type') == 'expand') {
                $(this).parent().parent().toggleClass('show');
                $(this).parent().parent().attr('data-bs-popper', 'true');
                $(this).parent().parent().siblings().toggleClass('show');
                $(this).parent().parent().siblings().attr('aria-expanded', 'true');
                $('.notif-collapse').removeClass('d-none');
                $(this).text('Tampilkan lebih sedikit');
                $(this).data('type','collapsed');
            }
            else if ($(this).data('type') == 'collapsed') {
                console.log('collaps');
                $(this).parent().parent().toggleClass('show');
                $(this).parent().parent().attr('data-bs-popper', 'true');
                $(this).parent().parent().siblings().toggleClass('show');
                $(this).parent().parent().siblings().attr('aria-expanded', 'true');
                $('.notif-collapse').addClass('d-none');
                $(this).text('Lihat Semua');
                $(this).data('type','expand');
            }
        });
    });
</script>
@endpush
