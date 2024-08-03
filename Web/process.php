<?php
    if (isset($_POST['ghiam'])) {
        $ghiam = $_POST['ghiam'];
        // Xử lý dữ liệu ở đây
        $switchStatus = '';

        if ($ghiam == 'bật đèn') {
            $switchStatus = 'on';
        } elseif ($ghiam == 'tắt đèn') {
            $switchStatus = 'off';
        }
    }
?>