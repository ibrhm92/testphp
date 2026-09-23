<HTML>
    <head>
       <link rel="stylesheet" href="style.css">

    </head>
    <body>
<!-- insert into users table -->
        <?php
        include 'config.php';
        include 'functions.php';
       
        // try frist code
        $formName = '';
        $formUsername = '';
        $editId = '';

         if (isset($_POST["edit"])){
                    $user = getuser($_POST["edit"]);
                    if ($user) {
                        $formName = $user['name'];
                        $formUsername = $user['username'];
                        $editId = $user['id'];
                    }
                //     $id = $_POST["edit"];
                //     $sql ="update users set name =".$name.", username =".$uname.", password =".$pass." where id=".$id;
         }  

        $name = "بسم الله الرحمن الرحيم ";
        $lastid=getlastid()+1;
        echo "<h2>" ,"السلام عليكم ورحمه الله" ,"</h2>","<br><h1> $name</h1>";
        ?>
        <div class="container" align="center">
        <form id="fdetails" method="POST" >
            <label for="id">ID : <?php echo $lastid; ?> </label> <br>
            <label for="fname">الاسم : </label> <br>
            <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($formName) ?>"><br>
            <label for="uname">اسم المستخدم : </label> <br>
            <input type="text" id="uname" name="uname" value="<?=htmlspecialchars($formUsername)?>"><br>  
             <label for="pass">الرقم السري : </label> <br>
            <input type="password" id="pass" name="pass"><br>
            <input type="submit" name="save" value="Save">
            <?php if ($editId): ?>
            <input type="hidden" name="id" value="<?= $editId ?>">
            <?php endif; ?>
        </form>
        </div>
        <?php
            //    $name =$_POST['fname'];
            //     $uname =$_POST['uname'];
            //     $pass =$_POST['pass'];
                
            if (isset($_POST["delete"])){
                    $id = $_POST["delete"];
                    deleteuser($id);
                }
           
            elseif (isset($_POST['save']))
            {
                $name = trim($_POST['fname'] ?? '');
                $username = trim($_POST['uname'] ?? '');
                $password = $_POST['pass'] ?? '';
                $id = (int) ($_POST['id'] ?? 0);
                 if ($id > 0) {
                    // تعديل مستخدم موجود
                    $statement = $con->prepare(
                        'UPDATE users
                        SET name = :name,
                            username = :username,
                            password = :password
                        WHERE id = :id'
                    );

                    $statement->execute([
                        ':name' => $name,
                        ':username' => $username,
                        ':password' => $password,
                        ':id' => $id
                    ]);
                 }
                 else {
                    // إضافة مستخدم جديد
                    $sql = "insert into users (name , username , password)
                            values ('$name','$username','$password')";
                    if($con->exec($sql))
                        {
                            echo "<script>alert('saved');</script>";
                        }
                        else
                        {
                            echo "<script>alert('not saved');</script>";
                        }
                 }
            }
        ?>
<!-- select from users table -->
        <h2>المستخدمين</h2>
        <?php
            $sql = "select * from users";
            $result = $con->query($sql);
            if ($result->rowCount() > 0)
            {
                echo "<h3 align='center'>عدد المستخدمين : ".$result->rowCount()."</h3>";
                echo "<table class='tblusers' border='2' cellpadding='5' cellspacing='0'>";
                echo "<tr class='header'><th>ID</th><th>Name</th><th>UserName</th><th>Password</th><th>Do</th></tr>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['password']."</td>";
                    echo "<form method='POST' action='index.php'>";
                    echo "<td>"."<button type='submit' name='edit' value='".$row['id']."'>Edit</button>"."<button type='submit' method='POST' name='delete' value='".$row['id']."'>Delete</button>"."</td>";
                    echo "</form>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else
            {
                echo "No records found";
            }
            
        ?>
    </body>
</HTML>
