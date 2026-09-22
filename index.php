<HTML>
    <head>
       <link rel="stylesheet" href="style.css">

    </head>
    <body>

        <?php
        include 'config.php';
        // try frist code
        $name = "بسم الله الرحمن الرحيم ";
        echo "<h2>" ,"السلام عليكم ورحمه الله" ,"</h2>","<br><h1> $name</h1>";
        ?>

        <form id="fdetails" method="POST">
            <label for="fname">Name : </label> <br>
            <input type="text" id="fname" name="fname"><br>
            <label for="uname">UserName : </label> <br>
            <input type="text" id="uname" name="uname"><br>    
            <label for="pass">Password : </label> <br>
            <input type="password" id="pass" name="pass"><br>
            <input type="submit" name="save" value="Save">
        </form>
        <?PHP
            if (isset($_POST['save']))
            {
                $name =$_POST['fname'];
                $uname =$_POST['uname'];
                $pass =$_POST['pass'];
                $sql = "insert into users (name , username , password)
                        values ('$name','$uname','$pass')";
                if($con->exec($sql))
                    {
                        echo "<script>alert('saved');</script>";
                    }
                    else
                    {
                        echo "<script>alert('not saved');</script>";
                    }
            }
        ?>
    </body>
</HTML>
