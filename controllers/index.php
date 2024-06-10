<?php 

$config = require('config.php');
$db = new Database($config['database']);

// Fetch the list items
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle DELETE request
    if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
        $db->query('DELETE FROM lists WHERE id = :id', [
            'id' => $_POST['id'],
        ]);
    } 

    // Handle UPDATE request
    elseif (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
       
            $db->query('UPDATE lists SET name = :name WHERE id = :id', [
                'name' => $_POST['name'],
                'id' => $_POST['id'],
            ]);
       
    } 
    
    // Handle INSERT request
    
    else if (isset($_POST['name']) && !empty($_POST['name'])) {
        $db->query('INSERT INTO lists(name) VALUES(:name)', [
            'name' => $_POST['name'],
        ]);
    }
}


$lists = $db->query('SELECT * FROM lists')->get();



require "view/index.view.php";
?>
