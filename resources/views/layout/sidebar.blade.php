<style>
    .nav-item{
        margin-bottom: 5px;
    }
</style>
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="/" class="sidebar-brand">
        <img class="img-fluid mx-4" src="{{asset('assets/images/logo-denteksi-text.jpg')}}" width="100" alt="" >
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="sidebar-body">
        <ul class="nav w-100\">
            @if (Auth::user()->role=='admin')
            <!-- <p class="text-center fs-4 font-weight-bold">Admin</p> -->
            <li class="nav-item nav-category ">Main</li>
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link">
                    <i class="link-icon" data-feather="airplay"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#data-pengguna" role="button" aria-expanded="false"
                    aria-controls="data-pengguna">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Data Pengguna</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="data-pengguna">
                    <ul class="nav sub-menu ">
                        <li class="nav-item">
                            <a href="{{route('admin.index')}}" class="nav-link">
                                Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dokter.index')}}" class="nav-link">
                                Dokter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('orangtua.index')}}" class="nav-link">
                                Orangtua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('anak.index')}}" class="nav-link">
                                Anak
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
                <li class="nav-item">
                    <a href="{{route('klinik.index')}}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Layanan Kesehatan</span>
                    </a>
                </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#data-lokasi" role="button" aria-expanded="false"
                    aria-controls="data-lokasi">
                    <i class="link-icon" data-feather="map-pin"></i>
                    <span class="link-title">Data Lokasi</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="data-lokasi">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{route('kecamatan.index')}}" class="nav-link">
                                Kecamatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('kelurahan.index')}}" class="nav-link">
                                Kelurahan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('sekolah.index')}}" class="nav-link">
                                Sekolah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('posyandu.index')}}" class="nav-link">
                                Posyandu
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#data-edukasi" role="button" aria-expanded="false"
                    aria-controls="data-edukasi">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Data Edukasi</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="data-edukasi">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('artikel.index')}}" class="nav-link">
                                Artikel
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('video.index')}}" class="nav-link">
                                Video
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Lainnya</li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="link-icon" data-feather="log-out"></i>
                    <span class="link-title">Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            @elseif (Auth::user()->role=='orangtua')
            <!-- <p class="text-center fs-4 font-weight-bold">Orang tua</p> -->
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="/orangtua/dashboard" class="nav-link">
                    <i class="link-icon" data-feather="airplay"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <!-- <li class="nav-item nav-category">Pemeriksaan</li> -->
            <li class="nav-item">
                <!-- <a href="{{route('pemeriksaanfisik.create')}}" class="nav-link"> -->
                <a href="{{ route('view-anak.create') }}" class="nav-link">
                    <i class="link-icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 3C8.69036 3 9.25 2.44036 9.25 1.75C9.25 1.05964 8.69036 0.5 8 0.5C7.30964 0.5 6.75 1.05964 6.75 1.75C6.75 2.44036 7.30964 3 8 3Z" stroke="currentColor" stroke-linejoin="round"/>
                        <path d="M6.3822 8.57621C6.47283 8.01183 6.51345 7.46621 6.36658 7.08902C6.24158 6.76464 5.9697 6.58308 5.64158 6.45933L2.75002 5.52371C2.37502 5.39871 2.0247 5.18933 2.00002 4.77558C1.96877 4.24433 2.43752 3.90058 2.90627 4.02558C2.90627 4.02558 5.65627 4.99871 8.00002 4.99871C10.3438 4.99871 13.0625 4.02996 13.0625 4.02996C13.625 3.87371 14 4.31121 14 4.77339C14 5.21746 13.6563 5.37371 13.25 5.52152L10.5 6.51871C10.25 6.61246 9.84377 6.79996 9.68752 7.08683C9.50002 7.42277 9.53127 8.00964 9.62189 8.57402L9.80627 9.49996L10.9753 14.6218C11.0628 15.0328 10.7785 15.4168 10.3691 15.4887C9.9597 15.5606 9.62502 15.2812 9.50377 14.8837L8.33002 11.2609C8.27356 11.0871 8.22356 10.9114 8.18002 10.7337L8.00002 9.99996L7.83439 10.6765C7.78189 10.8921 7.72147 11.1055 7.65314 11.3165L6.50002 14.8806C6.37502 15.2821 6.04689 15.5603 5.63752 15.4887C5.22814 15.4171 4.93752 15.0015 5.02939 14.6218L6.19783 9.50214L6.3822 8.57621Z" stroke="currentColor" stroke-linejoin="round"/>
                        </svg>
                    </i>
                    <span class="link-title">Pemeriksaan Gigi </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('view-riwayat')}}" class="nav-link">
                <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title"> Riwayat Pemeriksaan</span>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a href="{{route('periksa-gigi.create')}}" class="nav-link">--}}
{{--                    <i class="link-icon">--}}
{{--                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M3.37546 1.35872C2.07355 1.50368 0.875579 2.37345 0.339499 3.56595C0.202745 3.87228 0.107016 4.1704 0.046844 4.46853C-0.0160632 4.79674 -0.0160632 5.49693 0.0495791 5.96463C0.334029 8.02142 1.1737 10.9671 1.98876 12.7613C2.65613 14.2246 3.24964 14.985 3.93615 15.2503C4.1659 15.3405 4.49958 15.3405 4.72933 15.2503C5.04934 15.1272 5.32558 14.7634 5.48969 14.252C5.59636 13.9238 5.63191 13.7706 5.78234 12.9665C6.01483 11.7247 6.1215 11.3117 6.31569 10.8851C6.58373 10.297 7.07604 10.1521 7.44255 10.5541C7.727 10.8632 7.89931 11.4102 8.17555 12.8762C8.40257 14.0879 8.51197 14.4626 8.73351 14.8017C9.04258 15.2749 9.52396 15.439 10.0382 15.2476C10.7137 14.9959 11.3182 14.2246 11.9828 12.7613C12.9127 10.7155 13.8837 7.11337 13.9794 5.34923C14.0779 3.54954 12.858 1.90574 11.0884 1.45172C9.89593 1.14812 8.84839 1.42163 7.64495 2.34883L7.3605 2.56764L7.21827 2.55123C7.00767 2.52935 6.71501 2.40353 6.13791 2.08079C5.39943 1.67053 5.01925 1.51189 4.51873 1.41069C4.20419 1.34505 3.69546 1.32317 3.37546 1.35872ZM4.40112 2.502C4.69104 2.57311 5.00831 2.70986 5.44046 2.94508C5.63738 3.05449 5.91636 3.20765 6.06679 3.28423L6.33757 3.42919L6.13517 3.57689C5.64285 3.94066 5.21344 4.12117 4.77036 4.15126L4.67463 4.15946L4.66642 4.69828L4.66095 5.23983H4.80591C5.1478 5.23983 5.69209 5.09487 6.06679 4.90615C6.49894 4.68734 6.82442 4.45212 7.69691 3.72185C8.37795 3.15295 8.63505 2.95876 8.94959 2.78371C9.63336 2.40353 10.2296 2.33242 10.9517 2.54849C12.1524 2.91226 12.9592 4.07741 12.8854 5.33556C12.817 6.44601 12.3028 8.66417 11.6847 10.5049C11.2744 11.733 10.763 12.8872 10.3527 13.5053C10.1585 13.8007 9.83029 14.1617 9.72362 14.1973C9.6443 14.2219 9.60875 14.1727 9.52943 13.9265C9.43643 13.6393 9.38173 13.3959 9.22857 12.5699C8.95779 11.1039 8.75539 10.4885 8.37795 9.96881C7.74067 9.09358 6.53997 8.98144 5.80422 9.72813C5.28729 10.256 5.05754 10.8851 4.72933 12.6574C4.54061 13.6694 4.39291 14.211 4.29992 14.211C4.23975 14.211 4.06197 14.0687 3.91154 13.8992C3.41648 13.333 2.80929 12.0666 2.28689 10.5049C1.66876 8.66417 1.15456 6.44601 1.08618 5.33556C1.01233 4.09929 1.77543 2.96696 2.95152 2.5649C3.09374 2.51567 3.18127 2.49653 3.51221 2.43909C3.65991 2.41174 4.19325 2.45003 4.40112 2.502Z" fill="currentColor"/>--}}
{{--                        </svg>--}}
{{--                    </i>--}}
{{--                    <span class="link-title"> Periksa gigi</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item nav-category">Lainnya</li>

            {{--                 <li class="nav-item">--}}
            {{--                  <a href="{{route('reservasi.riwayat')}}" class="nav-link">--}}
            {{--                        <i class="link-icon" data-feather="book"></i>--}}
            {{--                        <span class="link-title"> Riwayat Reservasi</span>--}}
            {{--                    </a>--}}
            {{--                 </li>--}}

                {{--<li class="nav-item">
                    <!-- <a href="{{route('viewanak')}}" class="nav-link"> -->
                    <a href="" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Data Anak</span>
                    </a>
                </li>--}}

                <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="link-icon" data-feather="log-out"></i>
                    <span class="link-title">Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            @elseif (Auth::user()->role=='dokter')
            <!-- <p class="text-center fs-4 font-weight-bold">Dokter</p> -->
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="/dokter/dashboard" class="nav-link">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#PemeriksaanGigi" role="button" aria-expanded="false"
                    aria-controls="PemeriksaanGigi">
                    <i class="link-icon">
                        <svg width="16" height="18" viewBox="0 2 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.37546 1.35872C2.07355 1.50368 0.875579 2.37345 0.339499 3.56595C0.202745 3.87228 0.107016 4.1704 0.046844 4.46853C-0.0160632 4.79674 -0.0160632 5.49693 0.0495791 5.96463C0.334029 8.02142 1.1737 10.9671 1.98876 12.7613C2.65613 14.2246 3.24964 14.985 3.93615 15.2503C4.1659 15.3405 4.49958 15.3405 4.72933 15.2503C5.04934 15.1272 5.32558 14.7634 5.48969 14.252C5.59636 13.9238 5.63191 13.7706 5.78234 12.9665C6.01483 11.7247 6.1215 11.3117 6.31569 10.8851C6.58373 10.297 7.07604 10.1521 7.44255 10.5541C7.727 10.8632 7.89931 11.4102 8.17555 12.8762C8.40257 14.0879 8.51197 14.4626 8.73351 14.8017C9.04258 15.2749 9.52396 15.439 10.0382 15.2476C10.7137 14.9959 11.3182 14.2246 11.9828 12.7613C12.9127 10.7155 13.8837 7.11337 13.9794 5.34923C14.0779 3.54954 12.858 1.90574 11.0884 1.45172C9.89593 1.14812 8.84839 1.42163 7.64495 2.34883L7.3605 2.56764L7.21827 2.55123C7.00767 2.52935 6.71501 2.40353 6.13791 2.08079C5.39943 1.67053 5.01925 1.51189 4.51873 1.41069C4.20419 1.34505 3.69546 1.32317 3.37546 1.35872ZM4.40112 2.502C4.69104 2.57311 5.00831 2.70986 5.44046 2.94508C5.63738 3.05449 5.91636 3.20765 6.06679 3.28423L6.33757 3.42919L6.13517 3.57689C5.64285 3.94066 5.21344 4.12117 4.77036 4.15126L4.67463 4.15946L4.66642 4.69828L4.66095 5.23983H4.80591C5.1478 5.23983 5.69209 5.09487 6.06679 4.90615C6.49894 4.68734 6.82442 4.45212 7.69691 3.72185C8.37795 3.15295 8.63505 2.95876 8.94959 2.78371C9.63336 2.40353 10.2296 2.33242 10.9517 2.54849C12.1524 2.91226 12.9592 4.07741 12.8854 5.33556C12.817 6.44601 12.3028 8.66417 11.6847 10.5049C11.2744 11.733 10.763 12.8872 10.3527 13.5053C10.1585 13.8007 9.83029 14.1617 9.72362 14.1973C9.6443 14.2219 9.60875 14.1727 9.52943 13.9265C9.43643 13.6393 9.38173 13.3959 9.22857 12.5699C8.95779 11.1039 8.75539 10.4885 8.37795 9.96881C7.74067 9.09358 6.53997 8.98144 5.80422 9.72813C5.28729 10.256 5.05754 10.8851 4.72933 12.6574C4.54061 13.6694 4.39291 14.211 4.29992 14.211C4.23975 14.211 4.06197 14.0687 3.91154 13.8992C3.41648 13.333 2.80929 12.0666 2.28689 10.5049C1.66876 8.66417 1.15456 6.44601 1.08618 5.33556C1.01233 4.09929 1.77543 2.96696 2.95152 2.5649C3.09374 2.51567 3.18127 2.49653 3.51221 2.43909C3.65991 2.41174 4.19325 2.45003 4.40112 2.502Z" fill="currentColor"/>
                        </svg>
                    </i>
                    <span class="link-title">Pemeriksaan Gigi</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="PemeriksaanGigi">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Periksa Anak</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dokter.periksaUKGS')}}" class="nav-link">UKGS</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dokter.periksaUKGM')}}" class="nav-link">UKGM</a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="nav-item nav-category">Fitur</li>
            <li class="nav-item">
                <a href="{{route('artikel.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Data Artikel</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('video.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="film"></i>
                    <span class="link-title">Data Video</span>
                </a>
            </li>

{{--                <li class="nav-item">--}}
{{--                    <a href="/dokter/reservasi" class="nav-link">--}}
{{--                        <i class="link-icon" data-feather="book"></i>--}}
{{--                        <span class="link-title">Daftar Reservasi</span>--}}
{{--                    </a>--}}
{{--                </li>--}}



            <!-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#RekapData" role="button" aria-expanded="false"
                    aria-controls="RekapData">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Rekap Data Pasien</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="RekapData">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('dokter.rekapDataUKGS')}}" class="nav-link">UKGS</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dokter.rekapDataUKGM')}}" class="nav-link">UKGM</a>
                        </li>
                    </ul>
                </div>
            </li> -->
            <li class="nav-item nav-category">lainnya</li>

            <li class="nav-item">
                <a href="/dokter/profil" class="nav-link">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Profil</span>
                </a>
            </li>


{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('reminder.index')}}" class="nav-link">--}}
{{--                        <i class="link-icon" data-feather="bell"></i>--}}
{{--                        <span class="link-title">Data Reminder</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="link-icon" data-feather="log-out"></i>
                    <span class="link-title">Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            @endif
        </ul>
    </div>
</nav>

