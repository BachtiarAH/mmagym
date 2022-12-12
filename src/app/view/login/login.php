<?php

use LearnPhpMvc\APP\View;
// var_dump($_SESSION);
// echo "aksdhjf";
// session_start();
// var_dump($_SESSION);
if (isset($_SESSION['fail'])) {
    $massage = $_SESSION['fail'];
    echo "<script>
        Toast.fire({
            icon: 'error',
            title: 'login gagal',
            text: '$massage',
            })
    </script>";;
    session_unset();
}

// if (isset($_SESSION['notification'])) {
//     $title = $_SESSION['notification']['title'];
//     $text = $_SESSION['notification']['text'];
//     if ($_SESSION['notification']['status']) {
//         echo "<script>
//         Toast.fire({
//             icon: 'success',
//             title: '$title',
//             text: '$text',
//             })
//     </script>";
//         unset($_SESSION['notification']);
//     } else {
//         echo "<script>
//         Toast.fire({
//             icon: 'error',
//             title: '$title',
//             text: '$text',
//             })
//     </script>";
//         unset($_SESSION['notification']);
//     }
// }

?>

<div class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>MMA</b>GYM</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="<?= View::getUrl('/submit/login') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <!-- /.col -->
                        <div class="d-flex justify-content-around">
                            <button type="submit" class="btn btn-primary btn-block" name="submit" id="submit">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>
<!-- /login page -->