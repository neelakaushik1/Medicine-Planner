<?php
 
    // configuration
    require("../includes/config.php");
 
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["password"] == NULL)
        {
            apologize("Enter a password!");
        }
        else if ($_POST["username"] == NULL)
        {
            apologize("Enter a username!");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match!");
        }
        if (query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"])) === false)
        {
            apologize("That username is taken!");
        }
        else
        {
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");
         }   
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
 
?>