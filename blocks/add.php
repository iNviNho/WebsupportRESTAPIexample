<?php

$curl = new iNviNho\Curl();

// if form was sent
if (isset($_GET["addRecord"])) {
    
    // we prepare params from form
    // if we want to be more precise we should work with it as an object
    // and check if params are valid and maybe escape them
    $params = [
      "type" => $_POST["type"],
      "name" => $_POST["name"], 
      "content" => $_POST["content"],  
      "prio" => $_POST["prio"],
      "port" => $_POST["port"],
      "weight" => $_POST["weight"], 
      "ttl" => $_POST["ttl"]
    ];
    
    // do curl post request
    $response = $curl->addRecord($params);
    
    // simple check if we have status set to success
    // we could also check status code
    if($response->status == "success") {
        echo "<p class='message success'>Záznam bol úspešne pridaný</p>";
    } else {
        echo "<p class='message error'>Niekde nastala chyba</p>";
    }
}

$records = $curl->getAllRecords();

?>
<h2>PRIDAŤ DNS ZÁZNAM</h2>

<form action="index.php?action=add&addRecord=true" method="POST">
    
    <select name="type">
        <option value="A">A</option>
        <option value="MX">MX</option>
        <option value="NS">NS</option>
        <option value="TXT">TXT</option>
        <option value="ANAME">ANAME</option>
        <option value="CNAME">CNAME</option>
        <option value="SRV">SRV</option>
        <option value="AAAA">AAAA</option>
    </select>
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="content" placeholder="Content">
    <input type="text" name="ttl" placeholder="TTL">
    <input type="text" name="prio" placeholder="Prio">
    <input type="text" name="port" placeholder="Port">
    <input type="text" name="weight" placeholder="Weight">
    
    <input type="submit" name="submit" value="ADD RECORD">
    <br class="clear">
    
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