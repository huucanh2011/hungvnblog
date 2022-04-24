@include('admin.layout.header')
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('admin.layout.app-sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('admin.layout.app-topbar')
            <!-- End of Topbar -->

            @yield('content')

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.layout.app-footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
@include('admin.layout.footer')
