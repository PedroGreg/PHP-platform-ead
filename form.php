<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .rq{
            color: red;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <p>Required<span class="rq">*</span></p>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><span class="rq">*</span>
        </div><br>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><span class="rq">*</span>
        </div><br>
        <div>
            <label for="website">Website:</label>
            <input type="url" id="website" name="website">
        </div><br>
        <div>
            <label for="comment">Comment:</label>
            <textarea cols="30" rows="3" id="comment" name="comment"></textarea>
        </div><br>
        <div><label for="">Gender:</label>
            <input type="radio" name="gender" id="male" value="Male">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" value="Female">
            <label for="female">Female</label>
            <input type="radio" name="gender" id="other" value="Other">
            <label for="other">Other</label>
        </div><br>
        <button type="submit" name="submit" id="submit" value="Register">Register</button>
    </form>
    <h1>Data sent</h1>
    <?php
    if(isset($_POST["submit"])){
        $gender = "NOT Informed";
        if(isset($_POST["gender"])) $gender = $_POST["gender"];
        echo "<p>" . $_POST["name"] . "</p>";
        echo "<p>" . $_POST["email"] . "</p>";
        echo "<p>" . $_POST["website"] . "</p>";
        echo "<p>" . $_POST["comment"] . "</p>";
        echo "<p>" . $gender . "</p>";
    }
    ?>
</body>

</html>