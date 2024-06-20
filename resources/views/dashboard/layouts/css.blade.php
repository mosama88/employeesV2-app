<!-- Title -->
<title> برنامج الموظفين | @yield('title')</title>


<!-- Favicon -->
<link rel="icon" href="{{ asset('dashboard/assets/img/media/logo-Administrative-Prosecution.png') }}"
    type="image/x-icon" />
<!-- Icons css -->
<link href="{{ asset('dashboard/assets/css/icons.css') }}" rel="stylesheet">
<!--  Owl-carousel css-->
<link href="{{ asset('dashboard/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />

{{-- Font Arabic font-family: DroidKufi-Regular; --}}
<link href="{{ asset('dashboard/assets/fonts_ar/stylesheet.css') }}" rel="stylesheet">

<link href="{{ asset('dashboard/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('dashboard/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('dashboard/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('dashboard/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('dashboard/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">

<!--- Internal Morris css-->
<link href="{{ asset('dashboard/assets/plugins/morris.js/morris.css') }}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{ asset('dashboard/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
<!--  Sidebar css -->
<link href="{{ asset('dashboard/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{ asset('dashboard/assets/css-rtl/sidemenu.css') }}">
<!--- Style css -->
<link href="{{ asset('dashboard/assets/css-rtl/style.css') }}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{ asset('dashboard/assets/css-rtl/style-dark.css') }}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{ asset('dashboard/assets/css-rtl/skin-modes.css') }}" rel="stylesheet">


<link href="{{ asset('dashboard/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{ asset('dashboard/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}"
    rel="stylesheet">
<link href="{{ asset('dashboard/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
    rel="stylesheet">

<!--Internal   Notify -->
<link href="{{ asset('dashboard/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

<!--- Animations css-->
<link href="{{ asset('dashboard/assets/css/animate.css') }}" rel="stylesheet">


@yield('css')
@livewireStyles
