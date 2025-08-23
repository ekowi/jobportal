@include('partials.head', ['title' => 'Job Vacancies - Job Portal MTU'])

<body>
    @include('partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Render the Livewire job listing component -->
        <livewire:lowongan.list-lowongan />
    </div>

    @include('partials.footer')

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top rounded fs-5">
        <i data-feather="arrow-up" class="fea icon-sm align-middle"></i>
    </a>

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/choices.min.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <!-- Custom -->
    <script src="{{ asset('js/plugins.init.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
</body>
</html>