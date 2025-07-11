<section class="bg-home d-flex align-items-center" style="background: url('{{ asset('images/hero/bg3.jpg') }}') center;">
    <div class="bg-overlay bg-linear-gradient-2"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-12">
                <div class="p-4 bg-white rounded shadow-md mx-auto w-100" style="max-width: 400px;">
                    {{ $slot }}
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section>
