<?php

$ticketManager = new TicketManager();
$tickets = $ticketManager->get_tickets();

?>


<?php 
                        if (!empty($tickets)) {
                            $ticketManager->display_tickets($tickets);
                        } else {
                            echo "<p class='text-gray-300'>Нет тикетов для отображения.</p>";
                        }
                        ?>