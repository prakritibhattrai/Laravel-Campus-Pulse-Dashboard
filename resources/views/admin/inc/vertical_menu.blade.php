<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">NAVIGATION</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">Academic Programs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('programs') }}" key="t-product-detail">Program</a></li>
                        <li><a href="{{ route('levels') }}" key="t-products">Add Level</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-notepad"></i>
                        <span key="t-multi-level">Notices</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('notices') }}" key="t-level-1-1">Notices </a></li>
                        <li><a href="{{ route('notice-categories') }}" key="t-level-1-1">Add Category </a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('events') }}" class="waves-effect">
                        <i class="bx bx-calendar-event"></i>
                        <span key="t-dashboards">Events</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-pencil"></i>
                        <span key="t-multi-level">Research</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('research') }}" key="t-level-1-1">Research</a></li>
                        <li><a href="{{ route('research-categories') }}" key="t-level-1-1">Add Category </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-tag-multiple"></i>
                        <span key="t-multi-level">Catalog</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('teams') }}" key="t-level-1-1">Our Teams</a></li>
                        <li><a href="{{ route('team-types') }}" key="t-level-1-1">Team Types</a></li>
                        <li><a href="{{ route('users') }}" key="t-level-1-1">Users</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-command"></i>
                        <span key="t-multi-level">CMS</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('blogs') }}" key="t-level-1-1">Blog</a></li>
                        <li><a href="{{ route('categories') }}" key="t-level-1-1">Categories</a></li>
                        <li><a href="{{ route('tags') }}" key="t-level-1-1">Tags</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-folder-open"></i>
                        <span key="t-multi-level">Report / Publication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('reports') }}" key="t-level-1-1">Report </a></li>
                        <li><a href="{{ route('publications') }}" key="t-level-1-1">Publication </a></li>
                        <li><a href="{{ route('publication-categories') }}" key="t-level-1-1">Publication Category </a></li>
                        <li><a href="{{ route('report-categories') }}" key="t-level-1-1">Report Category </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-file-doc"></i>
                        <span key="t-multi-level">Resources</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('gallery') }}" key="t-level-1-1">Gallery</a></li>
                        <li><a href="{{ route('downloads') }}" key="t-level-1-1">Downloads</a></li>
                        <li><a href="{{ route('gallery-categories') }}" key="t-level-1-1">Gallery Category</a></li>
                        <li><a href="{{ route('resources-categories') }}" key="t-level-1-1">Resources Category</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-tone"></i>
                        <span key="t-email">Designs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('sliders') }}" key="t-inbox">Sliders</a></li>
                        <li><a href="{{ route('settings') }}" key="t-inbox">System Setting</a></li>
                        <li><a href="{{ route('themes') }}" key="t-inbox">Theme Setting</a></li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <span key="t-email">Layouts</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('aboutus') }}" key="t-basic-action">AboutUs</a></li>
                                <li><a href="{{ route('privacy-policies') }}" key="t-alert-email">Privacy Policy</a></li>
                                <li><a href="{{ route('terms-conditions') }}" key="t-bill-email">Terms Conditions</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
