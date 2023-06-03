<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<title>{{isset($title) ? $title : ''}}</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		
        <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />

        {{isset($externalcss) ? $externalcss : ''}}

	</head>
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
        <script>
            var defaultThemeMode = "light";
            var themeMode;

            if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if (localStorage.getItem("data-bs-theme") !== null) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }

                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }

                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }            
        </script>

        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <!--begin::Page-->
            <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
                <!--begin::Header-->
                @include('layouts.header')
                <!--end::Header-->
                <!--begin::Wrapper-->
                <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                    <!--begin::Sidebar-->
                    @include('layouts.Asidebar')
                    <!--end::Sidebar-->
                    <!--begin::Main-->
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <!--begin::Content wrapper-->
                        <div class="d-flex flex-column flex-column-fluid">
                            <!--begin::Toolbar-->
                            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                                <!--begin::Toolbar container-->
                                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                                    <!--begin::Page title-->
                                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                                        <!--begin::Title-->
                                        <h1
                                            class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                            {{isset($title) ? $title : ''}}
                                        </h1>
                                        <!--end::Title-->
                                        <!--begin::Breadcrumb-->
                                            {{isset($breadcumb) ? $breadcumb : ''}}
                                        <!--end::Breadcrumb-->
                                    </div>
                                    <!--end::Page title-->
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                                        <!--begin::Filter menu-->
                                        {{isset($actionFilter) ? $actionFilter : ''}}
                                        <!--end::Filter menu-->
                                        <!--begin::Primary button-->
                                            {{isset($actionButton) ? $actionButton : ''}}
                                        <!--end::Primary button-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Toolbar container-->
                            </div>
                            <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content  flex-column-fluid ">
                            {{$slot}}
                        </div>
                         <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    @include('layouts.Footer')
                    <!--end::Footer-->
                    </div>
                    <!--end:::Main-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::App-->
            <!--begin::Scrolltop-->
            <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                <span class="svg-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                            fill="currentColor" />
                        <path
                            d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Scrolltop-->

		
		<!--begin::Javascript-->
        <script>
        var hostUrl = "{{asset('assets/index.html')}}";        </script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
        <!--end::Global Javascript Bundle-->

        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
        <!--end::Vendors Javascript-->

        <!--begin::Custom Javascript(used for this page only)-->
        <script src="{{asset('assets/js/custom/apps/contacts/edit-contact.js')}}"></script>
        <script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
        <script src="{{asset('assets/js/custom/widgets.js')}}"></script>
        <script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
        <script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
        <script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
        <script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->
        {{isset($scriptData) ? $scriptData : ''}}
	</body>
	<!--end::Body-->
</html>