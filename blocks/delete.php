<?php

$curl = new iNviNho\Curl();

if (isset($_GET["do"])) {
    $id = $_GET["id"];
    
    $response = $curl->deleteRecord($id);
    if($response->status == "success") {
        echo "<p class='message success'>Záznam bol úspešne zmazaný</p>";
    } else {
        echo "<p class='message error'>Niekde nastala chyba</p>";
    }
}

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
            <th>Akcie</th>
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
                . "<td><a href='index.php?action=delete&do=delete&id=$rec->id'>ZMAZAŤ</a></td>"
                . "</tr>";
            }
        ?>
    </tbody>
</table>
<p><strong><?php echo count($records);?></strong> záznamov</p>