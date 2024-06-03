<form action="" method="post">
    <input type="text" name="Username"  id="Username"   placeholder="Username..."   value="<?= $_SESSION['username'] ?>"><br><br>
    <input type="text" name="Email"     id="Email"      placeholder="Email..."      value="<?= $_SESSION['email'] ?>"><br><br>

    <select name="Gender" id="Gender">
    <?php 
        selected(["Male", "Female"], $_SESSION['gender']);
    ?>
    </select><br><br>

    <select name="Religion" id="Religion">
    <?php 
        selected(["islam", "Christian", "buddha", "Catholic"], $_SESSION['religion']);
    ?>
    </select><br><br>

    <input type="text" name="Handphone" id="Handphone"  placeholder="Handphone..."  value="<?= $_SESSION['handphone'] ?>"><br><br>
    <input type="text" name="Address"   id="Address"    placeholder="Address..."    value="<?= $_SESSION['address'] ?>"><br><br>
    <button name="update" id="update">UPDATE</button><br><br>
</form>

<p class="error"><?= @$RESPONUPDATE ?></p>
<hr style="width: 95%">
<a href="index.php"><button>BACK</button></a><br><br>
