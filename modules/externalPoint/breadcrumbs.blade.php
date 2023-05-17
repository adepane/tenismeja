<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{!! ucfirst($slug) !!}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="ajax-load"
                                href="{!!route('dash')!!}/#/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{!!Core::links($slug)!!}">{!! ucfirst($slug) !!}</a>
                        </li>
                        @if (!empty($subslug))
                        <li class="breadcrumb-item">
                            {!! $content->subMenu->$subslug->name !!}
                        </li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
        <div class="mb-1 breadcrumb-right">
            <div class="dropdown">
                <button
                    class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg"
                        width="14"
                        height="14"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-grid">
                        <rect x="3"
                            y="3"
                            width="7"
                            height="7"></rect>
                        <rect x="14"
                            y="3"
                            width="7"
                            height="7"></rect>
                        <rect x="14"
                            y="14"
                            width="7"
                            height="7"></rect>
                        <rect x="3"
                            y="14"
                            width="7"
                            height="7"></rect>
                    </svg></button>
                <div class="dropdown-menu dropdown-menu-end">
                    {!!Core::getActionModule(Auth::user(), $content->subMenu, $content->moduleSlug)!!}
                </div>
            </div>
        </div>
    </div>
</div>