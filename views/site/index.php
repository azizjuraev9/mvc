<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 20:26
 *
 * @var User|null $user
 *
 */

use models\User;

?>

<?php if(!$user): ?>

    <form action="/user/login" method="post">
        <input type="text" name="username">
        <input type="text" name="password">
        <button type="submit"> login </button>
    </form>

<?php else: ?>

    <h1><?= $user->username ?></h1>
    <a href="/user/logout">logout</a>

<?php endif; ?>

AAAAAAAAAAAAAAAAAAAAAAAA