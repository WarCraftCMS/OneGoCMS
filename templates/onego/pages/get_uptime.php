<?php
session_start();
require_once '../engine/configs/db_config.php';
require_once 'ServerInfo.php';

$server = new ServerInfo();
$uptime_info = $server->get_uptime();

if ($uptime_info) {
    echo json_encode([
        'status' => 'success',
        'uptime' => htmlspecialchars($uptime_info['uptime']),
        'starttime' => $uptime_info['starttime'],
        'maxplayers' => $uptime_info['maxplayers']
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'неизвестно']);
}
?>
