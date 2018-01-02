<?php

$curl = new Curl();


if (isset($_GET["addRecord"])) {
    
    $params = [
      "type" => $_POST["type"],
      "name" => $_POST["name"], 
      "content" => $_POST["content"],  
      "prio" => $_POST["prio"],
      "port" => $_POST["port"],
      "weight" => $_POST["weight"], 
      "ttl" => $_POST["ttl"]
    ];
    
    $response = $curl->addRecord($params);
    if($response->status == "success") {
        echo "<p class='message success'>Záznam bol úspešne pridaný</p>";
    } else {
        echo "<p class='message error'>Niekde nastala chyba</p>";
    }
}


$records = $curl->getAllRecords();

?>

<form action="index.php?action=add&addRecord=true" method="POST">
    
    <input type="text" name="type">
    <input type="text" name="name">
    <input type="text" name="content">
    <input type="text" name="prio">
    <input type="text" name="port">
    <input type="text" name="weight">
    <input type="text" name="ttl">
    
    <input type="submit" name="submit" value="ADD RECORD">
    
</form>

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