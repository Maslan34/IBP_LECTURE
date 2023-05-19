<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Muhammet Kaya">
    <meta name="description" content="This is 10th Week Homework"> <!-- SEO amaçlı -->
    <meta name="generator" content="Visual Studio Code">
    <meta name="keywords" content="HTML, CSS, JavaScript"> <!-- SEO amaçlı -->
    <title>Student Registration Form</title>
</head>
<body>
    <h1>Student Registration Form</h1>
    <h2>Sample Form</h2>

    <form action="registration.php" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" placeholder="Name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="E-mail"><br><br>

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" id="gendermale" value="male" required>
        <label for="gendermale">Male</label>
        <input type="radio" name="gender" id="genderfemale" value="female" required>
        <label for="genderfemale">Female</label><br><br>

        <input type="submit" value="Kaydet">
    
    </form>

    <br><hr>

    <h3>Registered Students</h3>
    <?php include 'display.php'; ?>
    
    
</body>
</html>