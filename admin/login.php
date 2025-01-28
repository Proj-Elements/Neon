<?php
require_once 'config/define.php';
session_start();
$passwordHash = password_hash(ADMIN_PASSWD, PASSWORD_DEFAULT);
$isLoggedIn = isset($_SESSION['authenticated']) && $_SESSION['authenticated'];
if ($isLoggedIn) {
    header('Location: /admin/board');
    exit;
}
$error = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputPassword = $_POST['password'] ?? '';
    if (password_verify($inputPassword, $passwordHash)) {
        $_SESSION['authenticated'] = true;
        header('Location: /admin/board');
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="/resource/semantic/semantic.min.css" />
    <script src="/resource/jquery.min.js"></script>
    <script src="/resource/semantic/semantic.min.js"></script>
    <title>登陆 | 管理面板</title>
</head>
<body style="height: 100vh;">
    <div class="ui middle aligned centered grid" style="height: 100vh;">
        <div class="six wide column">
            <div class="ui raised padded segment">
                <h1 class="ui header center aligned">登录</h1>

                <form class="ui large form" method="post">
                    <div class="field">
                        <label>用户名</label>
                        <div class="ui disabled left icon input">
                            <i class="user icon"></i>
                            <input type="text" value="admin" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label>密码</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="请输入密码" required>
                        </div>
                    </div>

                    <button class="ui fluid large primary submit button" type="submit">
                        <i class="sign in icon"></i> 提交
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php if($error): ?>
        <div class="ui tiny modal">
            <div class="content">
                <div class="ui header">您输入了错误的密码</div>
                <p>请检查您的密码后再进行登录。</p>
            </div>
            <div class="actions">
                <div class="ui deny button">
                    确定
                </div>
            </div>
        </div>
        <script>$('.ui.modal').modal('show');</script>
    <?php endif; ?>
</body>
</html>