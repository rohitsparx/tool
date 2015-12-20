<?php

function generateBreadcrumb() {
    $ci = &get_instance();
    $i = 1;
    $uri = $ci->uri->segment($i);
    $link = '<ol class="breadcrumb">';

    while ($uri != '') {
        $prep_link = '';
        for ($j = 1; $j <= $i; $j++) {
            $prep_link .= $ci->uri->segment($j) . '/';
        }

        $icon = '<i class="fa fa-dashboard"></i>';
        if ($i != 1) {
            $icon = '';
        }

        if ($ci->uri->segment($i + 1) == '') {
            $link.='<li class="active">' . $icon . $ci->uri->segment($i) . '</li> ';
        } else {
            $link.='<li><a href="' . site_url($prep_link) . '">' . $icon;
            $link.=$ci->uri->segment($i) . '</a></li> ';
        }

        $i++;
        $uri = $ci->uri->segment($i);
    }
    $link .= '</ol>';
    return $link;
}
?>

<?= generateBreadcrumb(); ?>