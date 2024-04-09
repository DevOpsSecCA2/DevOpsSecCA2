<?php
session_start();
include 'db.php';

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if(isset($_POST['create_post'])){
    $title = $_POST['title'];
    $todo = $_POST['todo'];

    $query = "INSERT INTO posts (title, todo, user) VALUES (:title, :todo, :username)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':todo', $todo);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

if(isset($_POST['edit_post'])){
    $id = $_POST['post_id'];
    $new_todo = $_POST['new_todo'];

    $query = "UPDATE posts SET todo=:new_todo WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':new_todo', $new_todo);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

if(isset($_POST['delete_post'])){
    $id = $_POST['post_id'];

    $query = "DELETE FROM posts WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id); 
    $stmt->execute();
}

$query = "SELECT * FROM posts WHERE user=:username";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm">
            <h1 class="mt-3">To-Do Application</h1>
        </div>
        <div class="col">
            <a class="btn btn-dark mt-3" href="logout.php">Logout</a>
        </div>
    </div>
    
    <h2 class="mt-2">Your List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>To be done...</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
            <tr>
                <td><?php echo htmlspecialchars($post['id']); ?></td>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['todo']); ?></td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>"> 
                        <button type="submit" name="delete_post" class="btn btn-dark">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Create Entry
            </a>
            <div class="collapse" id="collapseExample">
                <h2 class="mt-2">Create Entry</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <textarea name="todo" class="form-control" placeholder="Thing to do" required></textarea>
                    </div>
                    <button type="submit" name="create_post" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <a class="btn btn-dark" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                Edit Entry
            </a>
            <div class="collapse" id="collapseExample2">
                <h2 class="mt-2">Edit Entry</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <input type="text" name="post_id" class="form-control" placeholder="ID" required>
                    </div>
                    <div class="form-group">
                        <textarea name="new_todo" class="form-control" placeholder="New thing to do" required></textarea>
                    </div>
                    <button type="submit" name="edit_post" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="site.css">
</body>
</html>
