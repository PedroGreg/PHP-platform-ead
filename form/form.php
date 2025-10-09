<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .rq {
            color: red;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <p>Required <span class="rq">*</span></p>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><span class="rq">*</span>
        </div><br>
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"><span class="rq">*</span>
        </div><br>
        <div>
            <label for="website">Website:</label>
            <input type="text" id="website" name="website">
        </div><br>
        <div>
            <label for="comment">Comment:</label>
            <textarea cols="30" rows="3" id="comment" name="comment"></textarea>
        </div><br>
        <div><label for="">Gender:</label>
            <input type="radio" name="gender" id="male" value="male">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" value="female">
            <label for="female">Female</label>
            <input type="radio" name="gender" id="other" value="other">
            <label for="other">Other</label>
        </div><br>
        <button type="submit" name="submit" id="submit" value="Register">Register</button>
    </form>
    <h1>Data sent</h1>
    <?php
    if (isset($_POST["submit"])) {
        if (empty($_POST["name"]) || strlen($_POST["name"]) < 3 || strlen($_POST["name"]) > 100) {
            echo "<p class='rq'> Fill in the name field";
            die();
        }
        if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            echo "<p class='rq'> Fill in the email field";
            die();
        }
        if (!empty($_POST["website"]) && !filter_var($_POST["website"], FILTER_VALIDATE_URL)) {
            echo "<p class='rq'> Fill in the website field";
            die();
        }
        $gender = "NOT Informed";
        if (isset($_POST["gender"])) {
            $gender = $_POST["gender"];
            if ($gender != "male" && $gender != "female" && $gender != "other") {
                echo "<p class='rq'> Fill in the gender field";
                die();
            }
        }
        echo "<p>" . $_POST["name"] . "</p>";
        echo "<p>" . $_POST["email"] . "</p>";
        echo "<p>" . $_POST["website"] . "</p>";
        echo "<p>" . $_POST["comment"] . "</p>";
        echo "<p>" . $gender . "</p>";
    }

    ?>
</body>

</html>