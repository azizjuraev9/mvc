<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 22.10.2020
 * Time: 23:33
 *
 * @var string[] $errors
 *
 */
?>

<form action="/user/login" method="post">
    <div>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <input type="text" name="username">
    <input type="text" name="password">
    <button type="submit"> login </button>
</form>
