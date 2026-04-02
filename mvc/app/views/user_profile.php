<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h3>User Profile</h3>
    <?php if ($userData): ?>
        <p><strong>Name: </strong> <?php echo $userData['name']; ?></p>
        <p><strong>Email: </strong> <?php echo $userData['email']; ?></p>
    <?php else: ?>
        <p>User not found</p>
    <?php endif; ?>
    
</body>
</html>