<?php
    if ($card['status'] == 0) {
        echo '<small class="text-primary">Впечатление ожидает модерации</small>';
    } elseif ($card['status'] == 1) {
        echo '<small class="text-success">Впечатление одобрено!</small>';
    } elseif ($card['status'] == 2) {
        echo '<small class="text-danger">Впечатление отклонено!</small>';
    }
?>