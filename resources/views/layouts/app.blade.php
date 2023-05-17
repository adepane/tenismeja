<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    
    <title>{!! config('app.name') !!}</title>
    <link rel="apple-touch-icon" href='{!!asset("/images/ico/apple-icon-120.png")!!}'>
    <link rel="shortcut icon" type="image/x-icon" href='{!!asset("/images/ico/favicon.ico")!!}'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Source+Sans+3:wght@200&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href='{!!asset("/vendors/css/vendors.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/vendors/css/tables/datatable/dataTables.bootstrap5.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/vendors/css/tables/datatable/responsive.bootstrap5.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/vendors/css/tables/datatable/buttons.bootstrap5.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/vendors/css/extensions/toastr.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/plugins/extensions/ext-component-toastr.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/vendors/css/forms/select/select2.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/bootstrap.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/bootstrap-extended.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/colors.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/components.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/themes/bordered-layout.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/themes/dark-layout.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/themes/semi-dark-layout.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/core/menu/menu-types/vertical-menu.min.css")!!}'>
    <link rel="stylesheet" type="text/css" href='{!!asset("/css/custom.css")!!}'>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <style>
        div.dataTables_wrapper div.dataTables_filter select,
        div.dataTables_wrapper div.dataTables_length select {
            background-position: calc(100% - 3px) 7px, calc(100% - 20px) 13px, 100% 0 !important;
        }
        .card {
            padding: 10px;
        }
        th.dt-center,
        td.dt-center {
            text-align: center;
            vertical-align: top !important;
        }

        th.dt-left,
        td.dt-left {
            text-align: left;
            vertical-align: top !important;
        }
        th.dt-right,
        td.dt-right {
            text-align: right;
            vertical-align: top !important;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    @include('layouts.components.header')
    @include('layouts.components.menu')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div id="main">
                {{-- @yield('content') --}}
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    @include('layouts.components.footer')
    @include('layouts.components.modal')

    <!-- BEGIN: Vendor JS-->
    <script src='{!!asset("/vendors/js/vendors.min.js")!!}'></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src='{!!asset("/vendors/js/charts/apexcharts.min.js")!!}'></script> --}}
    <script src='{!!asset("/vendors/js/extensions/toastr.min.js")!!}'></script>
    <!-- END: Page Vendor JS-->

    <script src='{!!asset("/vendors/js/tables/datatable/jquery.dataTables.min.js")!!}'></script>
    <script src='{!!asset("/vendors/js/tables/datatable/dataTables.bootstrap5.min.js")!!}'></script>
    <script src='{!!asset("/vendors/js/tables/datatable/dataTables.responsive.min.js")!!}'></script>
    <script src='{!!asset("/vendors/js/tables/datatable/responsive.bootstrap5.min.js")!!}'></script>
    <script src='{!!asset("/vendors/js/tables/datatable/datatables.checkboxes.min.js")!!}'></script>
    <script src='{!!asset("/vendors/js/tables/datatable/datatables.buttons.min.js")!!}'></script>
    {{-- <script src='{!!asset("/vendors/js/tables/datatable/jszip.min.js")!!}'></script> --}}
    {{-- <script src='{!!asset("/vendors/js/tables/datatable/pdfmake.min.js")!!}'></script> --}}
    {{-- <script src='{!!asset("/vendors/js/tables/datatable/vfs_fonts.js")!!}'></script> --}}
    <script src='{!!asset("/vendors/js/tables/datatable/buttons.html5.min.js")!!}'></script>
    {{-- <script src='{!!asset("/vendors/js/tables/datatable/buttons.print.min.js")!!}'></script> --}}
    <script src='{!!asset("/vendors/js/tables/datatable/dataTables.rowGroup.min.js")!!}'></script>
    
    
    <script src='{!!asset("/js/custom.js")!!}'></script>
    <!-- BEGIN: Theme JS-->
    <script src='{!!asset("/js/core/app-menu.js")!!}'></script>
    <script src='{!!asset("/js/core/app.js")!!}'></script>
    <!-- END: Theme JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js"
    integrity="sha512-LW9+kKj/cBGHqnI4ok24dUWNR/e8sUD8RLzak1mNw5Ja2JYCmTXJTF5VpgFSw+VoBfpMvPScCo2DnKTIUjrzYw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"
        integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <!-- BEGIN: Page JS-->
    <script src='{!!asset("/vendors/js/extensions/sweetalert2.all.min.js")!!}'></script>
    <script src='{!!asset("/vendors/js/forms/select/select2.full.min.js")!!}'></script>
    @vite('resources/js/app.js')
    <!-- END: Page JS-->

    <?php 
        $decryptCookie = \Cookie::get('user_token');
        if (!Cookie::has('user_token')) {
            Auth::logout();
            return Redirect::route('dash');
        }
    ?>
    <script>
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
            "showMethod": "slideDown",
            "hideMethod": "slideUp"
        }
        let defHeader = 'Bearer {!!$decryptCookie!!}';
        let table = null;
        $(window).on('load', async function() {
            $('.nav-item').find('a[href="'+window.location.href+'"]').parent().addClass('active');
            window.onhashchange = async function(event) {
                if(document.location.hash != '') {
                    await getThePage('/admin/'+document.location.hash);
                }
            }
            if(document.location.hash != '') {
                await getThePage('/admin/'+document.location.hash);
            }
            await getMenu(); // get menu from api
            await clickAjax(); // change active menu
        });

        const viewTemplate = async (uri, textHeader, model = [], data = null) => {
            let modalbig = $('#md-large');
            modalbig.find(".modal-title").html(textHeader);
            modalbig.find(".modal-body").html("");
            axios.get(uri, {
                params: {
                    'noheader': 1,
                    'models': model,
        			'data':data,
                    '_':(new Date()).getTime()
                }
            })
            .then(response => {
                modalbig.find(".modal-body").html(response.data);
                modalbig.modal({backdrop: 'static', keyboard: false});
                modalbig.modal('show');
            })
            .catch(error => {
                console.log(error);
            });
        }
        
        const getThePage = async (params) => { // get page from controller
            if (params != 'javascript:void(0)') {
                const lastPath = params.slice(-3);
                if (lastPath != '/#/') {
                    const menuName = params.split('/#/')[1];
                    const hrefattr = params.replace('/#/', '/');
                    axios.get(hrefattr,{
                        params: {
                            _:(new Date()).getTime()
                        }
                    })
                    .then(response => {
                        $('#main').empty();
                        $('#main').animate({opacity: 0}, 200, function(){
                            $(this).html(response.data).animate({opacity:1});
                        });
                        window.scrollTo({top: 0, behavior: 'smooth'});
                        
                    })
                    .catch(error => {
                        if (error.response.status == 401) {
                            toastr.warning("Your credential token has been expired",'Error :(')
                            setTimeout(function () {  window.location = '{!!url("/logout")!!}'}, 1000 );
                        } 
                    });
                }
            }
        }

        const getMenu = async () => {
            let menuList = '';
            const menus = await axios({
                url:'{!!route("menu")!!}',
                method:'get',
                headers: {
                    'Authorization': defHeader
                }
            });
            const dataMenu = await menus.data;
            let fullHash = document.location.hash.split('/');
            let dataHash = fullHash[0]+'/'+fullHash[1];
            let activeMenu = '';
            for (const [key, value] of Object.entries(dataMenu)) {
                activeMenu = (dataHash == value.hash)?'active':'';
                if(value.hasOwnProperty("submenu")) {
                    let subMenuList = ''
                    let activeSubMenu = '';
                    let openMenu = '';
                    for (const [keySub, valueSub] of Object.entries(value.submenu)) {
                        activeSubMenu = (dataHash == valueSub.hash)?'active':'';
                        if (dataHash == valueSub.hash) {
                            openMenu = 'open';
                        }
                        subMenuList += `
                            <li class="side-menu nav-item ${activeSubMenu}"><a href="${valueSub.url}" data-hash="${valueSub.hash}" class="ajax-load"><i
                            class="fas fa-circle-notch"></i><span class="menu-item text-truncate"
                            data-i18n="${valueSub.name}">${valueSub.name}</span></a></li>
                        `
                    }
                    menuList += `
                        <li class="nav-item has-sub ${openMenu}">
                            <a class="d-flex align-items-center" href="${value.url}" data-hash="${value.hash}">
                                <i class="fas ${value.icon}"></i>
                                <span class="menu-title text-truncate" data-i18n="${value.name}">${value.name}</span>
                            </a>
                            <ul class="menu-content">
                                ${subMenuList}
                            </ul>
                        </li>
                    `
                } else {
                    menuList += `
                    <li class="side-menu nav-item ${activeMenu}">
                        <a class="d-flex align-items-center ajax-load" href="${value.url}" data-hash="${value.hash}">
                            <i class="fas ${value.icon}"></i>
                            <span class="menu-title text-truncate" data-i18n="${value.name}">${value.name}</span>
                        </a>
                    </li>
                `
                }
            }
            document.querySelector('#main-menu-navigation').innerHTML = menuList;
        }
        
        const clickAjax = () => { // handle click active menu
            $(document).on('click','.ajax-load',function(event){
                $(".nav-item.active").removeClass("active");
                $('.nav-item').find('a[href="'+$(this).attr('href')+'"]').parent().addClass('active');
            });
            $('.ajax-load').click(function(event){
                $(".nav-item.active").removeClass("active");
            });
        }

        const updateStatus = async (dataId,uri) =>  {
            const changethis = await dataId.data('value').split('#');
            const status = dataId.is(':checked')
            await axios({
                url:uri,
                headers:{
                    'Authorization':defHeader,
                    'accept':'application/json'
                },
                data:{
                    'data': changethis[0],
                    'statusid':status,
                    '_token':'{{ csrf_token() }}'
                },
                method:"patch"
            }).then(response => {
                if (response.data.success) {
                    toastr.success(response.data.message,'Success');
                } else {
                    toastr.warning(response.data.message,'Warning');
                }
            }).catch(error => {
                toastr.error(error,'Error');
            });
        }

        const deleteData = async (dataId, uri) => {
            Swal.fire({ 
                title: "Are you sure?", 
                text: "You won't be able to revert this!", 
                icon: "warning", 
                showCancelButton: !0, 
                confirmButtonColor: "#34c38f", 
                cancelButtonColor: "#f46a6a", 
                confirmButtonText: "Yes, delete it!",
                preConfirm: (valueid) => {
                    return dataId;
                },
            })
            .then(async function(data) {
                if (data.value) {
                    await axios({
                        url: uri,
                        headers:{
                            'Authorization':defHeader,
                            'accept':'application/json'
                        },
                        data:{
                            'data':data.value,
                            '_token':'{{ csrf_token() }}'
                        },
                        method:"delete"
                    }).then(response => {
                        if (response.data.success) {
                            return data.value && Swal.fire("Deleted!", response.data.message, "success");
                        } else {
                            return data.value && Swal.fire("Failed", response.data.message, "error");
                        }
                    }).catch(error => {
                        return data.value && Swal.fire("Error!", error, "error");
                    });			
                    await table.ajax.reload(null, false);
                }
            });
        }

        const customModalData = async (title,text,icon,dataId, uri) => {
            Swal.fire({ 
                title: title, 
                text: text, 
                icon: icon, 
                showCancelButton: !0, 
                confirmButtonColor: "#34c38f", 
                cancelButtonColor: "#f46a6a", 
                confirmButtonText: "Yes",
                preConfirm: (valueid) => {
                    return dataId;
                },
            })
            .then(async function(data) {
                if (data.value) {
                    await axios({
                        url: uri,
                        headers:{
                            'Authorization':defHeader,
                            'accept':'application/json'
                        },
                        data:{
                            'data':data.value,
                            '_token':'{{ csrf_token() }}'
                        },
                        method:"delete"
                    }).then(response => {
                        if (response.data.success) {
                            return data.value && Swal.fire("Success!", response.data.message, "success");
                        } else {
                            return data.value && Swal.fire("Failed", response.data.message, "error");
                        }
                    }).catch(error => {
                        return data.value && Swal.fire("Error!", error, "error");
                    });			
                    await table.ajax.reload(null, false);
                }
            });
        }
    </script>
</body>
<!-- END: Body-->

</html>