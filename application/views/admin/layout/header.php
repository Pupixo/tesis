<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>public/web/img/logo_.png">
    <title>Syllabus</title>
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/dist/css/style.min.css" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

    <script src="<?= base_url() ?>assets/libs/jquery/dist/jquery-3.6.0.min.js"></script>

    <!-- Custom CSS -->
        <link href="<?= base_url() ?>assets/libs/morris.js/morris.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/extra-libs/c3/c3.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/Ionicons/css/ionicons.min.css">
    <!-- Datatables  css-->
                    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets\extra-libs\datatable\datatables.min.css"/> -->
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/DataTables-1.13.4/css/dataTables.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/AutoFill-2.5.3/css/autoFill.jqueryui.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/Buttons-2.3.6/css/buttons.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/ColReorder-1.6.2/css/colReorder.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/DateTime-1.4.0/css/dataTables.dateTime.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/FixedColumns-4.2.2/css/fixedColumns.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/FixedHeader-3.3.2/css/fixedHeader.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/KeyTable-2.8.2/css/keyTable.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/Responsive-2.4.1/css/responsive.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/RowGroup-1.3.1/css/rowGroup.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/RowReorder-1.3.3/css/rowReorder.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/Scroller-2.1.1/css/scroller.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/SearchBuilder-1.4.2/css/searchBuilder.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/SearchPanes-2.1.2/css/searchPanes.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/Select-1.6.2/css/select.jqueryui.min.css" rel="stylesheet"/>
                    <link type='text/css' href="<?= base_url() ?>assets/datatable/StateRestore-1.2.2/css/stateRestore.jqueryui.min.css" rel="stylesheet"/>   
    <!-- Datatables  css-->
    <link href="<?= base_url() ?>assets/select2/css/select2.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/flatpickr/flatpickr.css" rel="stylesheet">

    <style>
        .content-loading{
            display: flex;align-content: center;align-items: center;justify-content: center;background: #f9fbfd;width: 100%;height: 100%;
        }
    

        .altura_tabla-unopx{
            height: 1px;
        }

        .avatar > img {
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }
        .avatar {
            position: relative;
            display: inline-block;
            width: 3rem;
            height: 3rem;
        }
        .accept {
            background-color: #04AE1B;
            border-radius: 4px;
            color: #fff;
            text-transform: uppercase;
            padding: 3px 5px
        }

        .reject {
            background-color: #FF0000;
            border-radius: 4px;
            color: #fff;
            text-transform: uppercase;
            padding: 3px 5px;
        }

        .pending {
            background-color: #FBA20A;
            border-radius: 4px;
            color: #fff;
            text-transform: uppercase;
            padding: 3px 5px;
        }

        table, th, td {
            overflow-wrap: break-word!important;
        }


    </style>

    <style>

        .image_area_usu {
        position: relative;
        width: 100%;
        height: 100%;

        }

        .img_usu {
            display: block;
            max-width: 100%;
        }

        .preview_img_usu {
            overflow: hidden;
            width: 160px; 
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        /* .estilo_modal-lg{
            max-width: 1000px !important;
        } */

        .overlay_usu {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
        }

        .image_area_usu:hover .overlay_usu {
        height: 50%;
        cursor: pointer;
        }

        .text_usu {
        color: #333;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
        }

        #result_busqueda_seccion {
        position: absolute;
        width: 100%;
        max-width:870px;
        cursor: pointer;
        overflow-y: auto;
        max-height: 400px;
        box-sizing: border-box;
        z-index: 1001;
        }
        .link-class-busqueda:hover{
        background-color:#f1f1f1;
        }
  

    </style>

    <link href="<?=base_url() ?>assets/template/fileinput/css/fileinput.min.css" rel="stylesheet">
    <!-- endinject -->
    <!-- SweetAlert -->
    <link rel="stylesheet" href="<?=base_url('assets/template/assets/sweetalert2/dist/sweetalert2.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/toast/css/jquery.toast.css')?>">
    <!-- include summernote css/js -->
    <link href="<?= base_url() ?>assets/summernote/summernote-bs4.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/dropzone/dropzone.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/cropper/cropper.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/dropzone/dropzone.js"></script>
    <script src="<?= base_url() ?>assets/cropper/cropper.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/extra-libs/prism/prism.css">

</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    		<!-- Modals -->
        <div id="acceso_modal" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
              
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg"  id="RegistrarModal"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    
                </div>
            </div>
        </div>
     
        <div class="modal fade bd-example-modal-lg" id="editarModal"   role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_photo_crop"  role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg estilo_modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Recortar imagen antes de cargar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="" id="sample_image_usu" class="img_usu" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview_img_usu"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="crop_usu">Recortar</button>
                    </div>
                </div>
            </div>
        </div>		
            <!-- Modals -->