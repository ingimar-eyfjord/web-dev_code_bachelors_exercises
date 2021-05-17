<?php
try{
    $db = new PDO("sqlite:db/users.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('SELECT * FROM users LIMIT 20');
    $q->execute();
    $users = $q->fetchAll();
    echo "<table>
    <thead>
    <tr>
    <td>ID</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Email</td>
    <td>Phone</td>
    <td>Delete</td>
    </tr>
    </thead>
    <tbody>
    ";

    foreach ($users as $key => $value) {
        ?>
<tr class="user" data-user_id="<?= $value['user_uuid']?>">
    <td class="id"><?= $value['user_uuid'] ?? "" ?></td>
    <td class="id"><?= $value['user_name'] ?? ""?></td>
    <td class="id"><?= $value['user_last_name'] ?? ""?></td>
    <td class="id"><?= $value['user_email'] ?? ""?></td>
    <td class="id"><?= $value['user_phone'] ?? ""?></td>
    <td class="id"><button onclick="delete_user(this)">🗑️</button></td>
</tr>
<?php
}
echo "</tbody><table>";
}catch(PDOException $ex){
  echo $ex;
} 
?>