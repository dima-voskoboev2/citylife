<?php
    if ($product['status'] == 0) {
        echo '<p style="color:#006FDB">Ожидает модерацию</p>';
    } elseif ($product['status'] == 1) {
        echo '<p style="color:#28a745">Одобрен!</p>';
    } elseif ($product['status'] == 2) {
        echo '<p style="color:#dc3545">Отклонён!</p>';
    }
?>