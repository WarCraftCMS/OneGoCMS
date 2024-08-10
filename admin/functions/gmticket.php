<?php

class TicketManager
{
    private $ticket_connection;

    public function __construct()
    {
        $config = new Configuration();
        $this->ticket_connection = $config->getDatabaseConnection('characters');
    }

    public function get_tickets($assigned_to = null)
    {
        $query = "SELECT 
                        id, 
                        type, 
                        playerGuid, 
                        name, 
                        description, 
                        createTime, 
                        mapId, 
                        posX, 
                        posY, 
                        posZ, 
                        lastModifiedTime, 
                        closedBy, 
                        assignedTo, 
                        comment, 
                        response, 
                        completed, 
                        escalated, 
                        viewed, 
                        needMoreHelp, 
                        resolvedBy 
                  FROM 
                        gm_ticket";

        if ($assigned_to !== null) {
            $query .= " WHERE assignedTo = ?";
        }

        $stmt = $this->ticket_connection->prepare($query);

        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->ticket_connection->error);
        }

        if ($assigned_to !== null) {
            $stmt->bind_param("i", $assigned_to);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $tickets = array();

        while ($row = $result->fetch_assoc()) {
            $tickets[] = $row;
        }

        return $tickets;
    }

    public function display_tickets($tickets)
    {
        foreach ($tickets as $ticket) {
            echo "ID тикета: " . $ticket['id'] . "<br>";
            echo "Тип: " . ($ticket['type'] == 0 ? 'Открыт' : ($ticket['type'] == 1 ? 'Закрыт' : 'Персонаж удален')) . "<br>";
            echo "GUID игрока: " . $ticket['playerGuid'] . "<br>";
            echo "Персонаж: " . htmlspecialchars($ticket['name'], ENT_QUOTES, 'UTF-8') . "<br>";
            echo "Описание: " . nl2br(htmlspecialchars($ticket['description'], ENT_QUOTES, 'UTF-8')) . "<br>";
            echo "Создано: " . date("Y-m-d H:i:s", $ticket['createTime']) . "<br>";
            echo "ID карты: " . $ticket['mapId'] . "<br>";
            echo "Позиция: (" . $ticket['posX'] . ", " . $ticket['posY'] . ", " . $ticket['posZ'] . ")<br>";
            echo "Время последнего изменения: " . date("Y-m-d H:i:s", $ticket['lastModifiedTime']) . "<br>";
            echo "Назначено: " . $ticket['assignedTo'] . "<br>";
            echo "Комментарий: " . nl2br(htmlspecialchars($ticket['comment'], ENT_QUOTES, 'UTF-8')) . "<br>";
            echo "Ответ: " . nl2br(htmlspecialchars($ticket['response'], ENT_QUOTES, 'UTF-8')) . "<br>";
            echo "Завершен: " . ($ticket['completed'] ? 'Да' : 'Нет') . "<br>";
            echo "Эскалация: " . ($ticket['escalated'] ? 'Да' : 'Нет') . "<br>";
            echo "Просмотрено: " . ($ticket['viewed'] ? 'Да' : 'Нет') . "<br>";
            echo "Нужна дополнительная помощь: " . ($ticket['needMoreHelp'] ? 'Да' : 'Нет') . "<br>";
            echo "Решено: " . $ticket['resolvedBy'] . "<br>";
            echo "<hr>";
        }
    }
}

?>
