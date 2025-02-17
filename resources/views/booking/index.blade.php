@extends('layout.mainhome')

@section('subheader')
<!--begin::Dashboard-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Sewa Mobil Sekarang</h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
    </div>
</div>
<style>
    .card {
    border-radius: 8px;
    border: none;
    overflow: hidden;
    }

    .card-body {
        padding: 2.8rem;
    }

    .card-body p {
        margin: 0.5rem 0;
        display: flex;
        justify-content: space-between;
    }

    .card-body p strong {
        font-weight: 600;
    }

    .card-body p span {
        color: #6c757d;
    }

    .card-body i {
        color: #17a2b8;
    }

</style>
<!--end::Dashboard-->
@endsection

<!--start::Content-->
@section('content')
<div class="row">
    @php
    $mobils = DB::table('mobils')
                    ->leftJoin('mobiltypes', 'mobils.type', '=', 'mobiltypes.id')
                    ->select('mobils.*', 'mobiltypes.name as type_name')
                    ->orderBy('status', 'asc')
                    ->get();
    @endphp

    @foreach ($mobils as $mobil)
    <div class="col-md-4 mb-4">
        <div class="card rounded-0 border-0 shadow">
            <div class="card-header bg-transparent border-0">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <h3 class="card-label font-weight-bold text-dark" style="font-size: 2.3rem">{{ $mobil->name }}</h3>
                    @php
                        $statusClass = '';
                        switch ($mobil->status) {
                            case 1:
                                $statusClass = 'badge-success';
                                $statusText = 'Tersedia';
                                break;
                            case 2:
                                $statusClass = 'badge-danger';
                                $statusText = 'Tidak Tersedia';
                                break;
                            case 3:
                                $statusClass = 'badge-warning';
                                $statusText = 'Perawatan';
                                break;
                            default:
                                $statusClass = 'badge-secondary';
                                $statusText = 'Unknown';
                                break;
                        }
                    @endphp
                    <span class="badge {{ $statusClass }}" style="font-family: Verdana, sans-serif;">{{ $statusText }}</span>
                </div>
            </div>


            <div class="card-body">
                <div class="text-center mb-3" data-toggle="modal" data-target="#modal{{ $mobil->id }}">
                    <img src="{{ $mobil->mobil_path }}" alt="Mobil Image" class="img-fluid" style="max-height: 200px;">
                </div>
                <div class="card shadow-sm" data-toggle="modal" data-target="#modal{{ $mobil->id }}">
                    <div class="card-body">
                        <p class="mb-1" style="font-family: Verdana, sans-serif;"><strong>Merek</strong> <span class="text-secondary">{{ $mobil->merek }}</span></p>
                        <p class="mb-1" style="font-family: Verdana, sans-serif;"><strong>Warna</strong> <span class="text-secondary">{{ $mobil->warna }}</span></p>
                        <p class="mb-1" style="font-family: Verdana, sans-serif;"><strong>Type</strong> <span class="text-secondary">{{ $mobil->type_name }}</span></p>
                    </div>
                </div>


                <div class="d-flex mt-3">
                    @if(Auth::check())
                        @php
                            $user = Auth::user();
                        @endphp
                        @if($user->role == 1)
                            <a href="/booking/vcreate" class="add_link btn btn-primary flex-grow-1 mr-2">Pesan Sekarang</a>
                        @else
                            @if($user->kwc_required == 1)
                                <a href="/booking/vcreate" class="add_link btn btn-primary flex-grow-1 mr-2">Pesan Sekarang</a>
                            @else
                                <a href="/profiled" class="btn btn-primary flex-grow-1 mr-2" data-toggle="modal" data-target="#verificationModal">Pesan Sekarang</a>
                            @endif
                        @endif
                    @else
                        <a href="/login" class="btn btn-primary flex-grow-1 mr-2">Pesan Sekarang</a>
                    @endif

                    <!-- Tombol Selengkapnya -->
                    <a href="#" class="btn btn-info flex-grow-1" data-toggle="modal" data-target="#modal{{ $mobil->id }}">Selengkapnya</a>
                </div>


            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verificationModalLabel">Verifikasi Diperlukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Silakan melakukan verifikasi terlebih dahulu sebelum menyewa mobil. Untuk melakukan verifikasi, kunjungi halaman berikut ini: <a href="/profiled">DISINI</a>.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal{{ $mobil->id }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $mobil->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="modal{{ $mobil->id }}Label">{{ $mobil->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="{{ $mobil->mobil_path }}" alt="Mobil Image" class="img-fluid">
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="mb-1" style="font-family: Verdana, sans-serif;"><strong>Merek</strong> <span class="text-secondary">{{ $mobil->merek }}</span></p>
                            <p class="mb-1" style="font-family: Verdana, sans-serif;"><strong>Warna</strong> <span class="text-secondary">{{ $mobil->warna }}</span></p>
                            <p class="mb-1" style="font-family: Verdana, sans-serif;"><strong>Tahun Produksi</strong> <span class="text-secondary">{{ $mobil->tahun_produksi }}</span></p>
                            <p class="mb-1" style="font-family: Verdana, sans-serif;"><strong>Type</strong> <span class="text-secondary">{{ $mobil->type_name }}</span></p>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-money-bill-wave mr-2"></i>
                                    <p class="mb-2" style="font-family: Verdana, sans-serif;"><strong>Sewa Harian</strong></p>
                                </div>
                                <span class="text-secondary">Rp. {{ number_format($mobil->sewa_harian, 2, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-week mr-2"></i>
                                    <p class="mb-2" style="font-family: Verdana, sans-serif;"><strong>Sewa Mingguan</strong></p>
                                </div>
                                <span class="text-secondary">Rp. {{ number_format($mobil->sewa_mingguan, 2, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <p class="mb-2" style="font-family: Verdana, sans-serif;"><strong>Sewa Bulanan</strong></p>
                                </div>
                                <span class="text-secondary">Rp. {{ number_format($mobil->sewa_bulanan, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

<!--JAVASCRIPT -->
@section('javascript')
<!-- Add your custom JavaScript here if needed -->
<script>
    $(".add_link").click(function(e) {
                e.preventDefault();
                $("#modal-form").modal("show").find(".modal-content").load($(this).attr("href"));
            });
</script>

@endsection
