<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li>
                    <a href="{{ action('AnalysisController@comparison') }}" class="waves-effect"><i class="ti-flag-alt-2"></i> <span> Comparison</span></a>
                </li>

                <li>
                    <a href="{{ action('AnalysisController@crossReference') }}" class="waves-effect"><i class="ti-layers-alt"></i> <span> Cross Reference</span></a>
                </li>

                <li>
                    <a href="{{ action('AnalysisController@explore') }}" class="waves-effect"><i class="ti-target"></i> <span> Exploration</span></a>
                </li>
                <li>
                    <a href="{{ action('AnalysisController@ofert') }}" class="waves-effect"><i class="ti-search"></i> <span>Upload Offers</span></a>
                </li>

                <li>
                    <a href="{{ action('SourceController@index') }}" class="waves-effect"><i class="ti-cloud-up"></i> <span> Sources</span></a>
                </li>

                <li>
                    <a href="{{ action('UserController@index') }}" class="waves-effect"><i class="ti-user"></i> <span> Users</span></a>
                </li>
                <li>
                    <a href="{{ action('DataController@index') }}" class="waves-effect"><i class="ti-bar-chart-alt"></i> <span>Data Offers</span></a>
                </li>
                <li>
                    <a href="{{ action('DataController@LogfileOferts') }}" class="waves-effect"><i class="ti-file"></i> <span> Log File Offers</span></a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Right Sidebar End ========== -->