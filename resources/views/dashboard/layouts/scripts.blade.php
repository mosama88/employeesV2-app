



<!-- JQuery min js -->
<script src="{{ asset('dashboard/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{ asset('dashboard/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!--Internal  Chart.bundle js -->
<script src="{{ asset('dashboard/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<!-- Ionicons js -->
<script src="{{ asset('dashboard/assets/plugins/ionicons/ionicons.js') }}"></script>

<!-- Moment js -->
<script src="{{ asset('dashboard/assets/plugins/moment/moment.js') }}"></script>

<!--Internal Sparkline js -->
<script src="{{ asset('dashboard/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Moment js -->
<script src="{{ asset('dashboard/assets/plugins/raphael/raphael.min.js') }}"></script>


<!--Internal  Flot js-->
<script src="{{ asset('dashboard/assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/dashboard.sampledata.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/chart.flot.sampledata.js') }}"></script>

<!-- Custom Scroll bar Js-->
<script src="{{ asset('dashboard/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- Rating js-->
<script src="{{ asset('dashboard/assets/plugins/rating/jquery.rating-stars.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/rating/jquery.barrating.js') }}"></script>

<!-- P-scroll js -->
<script src="{{ asset('dashboard/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>


<!-- Right-sidebar js -->
<script src="{{ asset('dashboard/assets/plugins/sidebar/sidebar-rtl.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/sidebar/sidebar-custom.js') }}"></script>


<!-- eva-icons js -->
<script src="{{ asset('dashboard/assets/js/eva-icons.min.js') }}"></script>

<!-- Sticky js -->
<script src="{{ asset('dashboard/assets/js/sticky.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/modal-popup.js') }}"></script>



<!-- Left-menu js-->
<script src="{{ asset('dashboard/assets/plugins/side-menu/sidemenu.js') }}"></script>

<!-- Internal Map -->
<script src="{{ asset('dashboard/assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>



<!--Internal  index js -->
<script src="{{ asset('dashboard/assets/js/index.js') }}"></script>

<!-- Apexchart js-->
<script src="{{ asset('dashboard/assets/js/apexcharts.js') }}"></script>


<!-- custom js -->
<script src="{{ asset('dashboard/assets/js/custom.js') }}"></script>

<!-- custom js -->
<script src="{{ asset('dashboard/assets/js/jquery.vmap.sampledata.js') }}"></script>




<!--Internal  Morris js -->
<script src="{{ asset('dashboard/assets/plugins/morris.js/morris.min.js') }}"></script>

<!--Internal Chart Morris js -->
<script src="{{ asset('dashboard/assets/js/chart.morris.js') }}"></script>



<!--Internal  Notify js -->
<script src="{{ asset('dashboard/assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('dashboard/assets/plugins/notify/js/notifit-custom.js') }}"></script>



        @yield('scripts')




        <script>
            document.addEventListener("DOMContentLoaded", () => {

                Livewire.hook('morph.updated', (el, component) => {
                    const mySuccessAlert = document.querySelector('.my-success-alert');

                    if (mySuccessAlert) {
                        setTimeout(() => {
                            mySuccessAlert.classList.add('fade-out');
                        }, 3000);
                    }
                });
            });
        </script>














