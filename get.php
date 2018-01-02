<?php

$curl = new Curl();
$records = $curl->getAllRecords();

?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Content</th>
            <th>TTL</th>
            <th>Prio</th>
            <th>Weight</th>
            <th>Port</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($records as $rec) {
                echo "<tr>"
                . "<td>" . $rec->id . "</td>"
                . "<td>" . $rec->type . "</td>"
                . "<td>" . $rec->name . "</td>"
                . "<td>" . $rec->content . "</td>"
                . "<td>" . $rec->ttl . "</td>"
                . "<td>" . $rec->prio . "</td>"
                . "<td>" . $rec->weight . "</td>"
                . "<td>" . $rec->port . "</td>"
                . "</tr>";
            }
        ?>
    </tbody>
</table>
<p><strong><?php echo count($records);?></strong> záznamov</p>
