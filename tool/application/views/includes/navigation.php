<ul class="sidebar-menu">
    <li class="header">Menu</li>
    <?php
    $CI = &get_instance();
    $CI->load->model('utils/navigation');
    $current = 0;
    $modules = $CI->navigation->getAllModulesTree($current);
    $currentMenu = $this->uri->segment(1);
    foreach ($modules as $m => $module) {
        $selected = (strtolower($module['PAGELINK']) == strtolower($currentMenu)) ? " active" : "";
        $li = '<li class="' . $selected . '">'
                . '<a href="' . site_url($module['PAGELINK']) . '">'
                . '<i class="fa fa-link"></i> '
                . '<span>' . $module['NAME'] . '</span>'
                . '</a>'
                . '</li>';
        echo $li;
    }
    ?>
    <!--    <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="#">Link in lefdewevel 2</a></li>
                <li><a href="#">Link in level 2</a></li>
            </ul>
        </li>-->
</ul>

<style>
    /**{color: red !important; }*/
</style>

