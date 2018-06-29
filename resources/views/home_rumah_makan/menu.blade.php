<div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{{url('admin')}}">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemantauan.create') }}">
                            <i class="material-icons">border_color</i>
                            <span>Entri Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemantauan') }}">
                            <i class="material-icons">all_out</i>
                            <span>Pemantauan</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('permasalahan') }}">
                            <i class="material-icons">chat_bubble_outline</i>
                            <span>Permasalahan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bukti') }}">
                            <i class="material-icons">attach_file</i>
                            <span>Bukti Pendukung</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pratinjau')}}">
                            <i class="material-icons">touch_app</i>
                            <span>Pratinjau Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laporan') }}">
                            <i class="material-icons">assignment</i>
                            <span>Cetak Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user') }}">
                            <i class="material-icons">group</i>
                            <span>User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil') }}">
                            <i class="material-icons">person</i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li class="header">Aksi</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Kembali Ke Homepage</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('logout')}}">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>