<audio id="commonAudio">
    <source src="Sound/notification.mp3" type="audio/mpeg">
</audio>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2020-<?php echo date("Y"); ?> <a target="_blank" href="http://drawhousedhaka.com">DrawHouse</a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.5
    </div>
</footer>

<div class="loader-holder">
    <div class="loader"></div>
</div>



</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- PAGE PLUGINS -->

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>


<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>



<!-- datetimepicker -->
<script src="plugins/datetimepicker/dist/date-time-picker.min.js"></script>

<!-- Croppie JS -->
<script src="plugins/Croppie/croppie.js"></script>

<!-- PAGE SCRIPTS -->


<script type="application/javascript">
    var url = window.location;
    //console.log(url);
    /*remove all active and menu open classes(collapse)*/
    $('ul.nav-sidebar a').removeClass('active').parent().siblings().removeClass('menu-open');
    /*find active element add active class ,if it is inside treeview element, expand its elements and select treeview*/
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active').closest(".has-treeview").addClass('menu-open').find("> a").addClass('active');


    $(function() {

        $('.loader-holder').hide();

    });

    function unselectImage(fileId) {
        $("#" + fileId).val("");
    }


    function statusToggler(question, tableName, id, changeTo) {

        swal({
                title: "Are you sure?",
                text: question,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                            method: "get",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "statusToggler",
                                tableName: tableName,
                                id: id,
                                changeTo: changeTo
                            }
                        })
                        .done(function(response) {

                            if (parseInt(response) == 1) {
                                swal("Request Successful !", {
                                    icon: "success",
                                });

                                setTimeout(
                                    function() {
                                        location.reload();
                                    }, 1000);

                            } else {
                                swal("Request Can't Be Processed !", {
                                    icon: "error",
                                });
                            }
                        });



                } else {
                    swal("NO REQUEST WAS SENT !", "", "error");
                }
            });

    }


    var commonAudio = document.getElementById("commonAudio");

    setInterval(function() {
        //location.reload();

        showCommonNotificationFunction();

        showNotificationFunctionCC();

    }, 10000);

    function showCommonNotificationFunction() {
        $.ajax({
                method: "post",
                url: 'ajaxfunctions.php',
                data: {
                    funName: "showCommonNotification"
                }
            })
            .done(function(response) {

                if (parseInt(response) > 0) {

                    playCommonNotification();
                    $('#commonOrderSign').css('visibility', 'visible');


                } else {
                    commonAudio.loop = false;
                }
            });
    }

    function showNotificationFunctionCC() {
            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "showNotification"
                    }
                })
                .done(function(response) {

                    if (parseInt(response) > 0) {

                        playCommonNotification();
                        // reloadTable();
                        $('#newOrderSign').css('visibility', 'visible');


                    } else {
                        commonAudio.loop = false;
                    }
                });
        }

    function playCommonNotification() {
        commonAudio.loop = true;
        commonAudio.play();
    }
</script>