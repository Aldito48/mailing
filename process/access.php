<?php
    require "../configure/connect.php";
    require "../layout/alert.php";
    require "request.php";

    if (isset($_POST['login'])) {
        $code = trim(mysqli_real_escape_string($con, $_POST['code']));
        $pass = trim(mysqli_real_escape_string($con, $_POST['password']));
        $qLogin = mysqli_query($con, "SELECT * FROM tbl_user WHERE code = '$code' LIMIT 1") or die (mysqli_error($con));
        if (mysqli_num_rows($qLogin) > 0) {
            $row = mysqli_fetch_assoc($qLogin);
            if (password_verify($pass, $row['password'])) {
                if ($row['is_verified'] == 'YES') {
                    $_SESSION['user'] = $row['code'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['login_time'] = time();
                    alert('success', 'Login Success', 'Access Granted!', base_url().'dashboard.php');
                } else {
                    sendWA($gateway, $wa_token, $wa_api_url, $contact, "*---- VERIFIKASI ----*\n\nUser Code / NIK : *{$row['code']}*\nOTP : *{$row['otp']}*");
                    alert('info', 'Not Verified', 'Please Confirm The OTP!', null);
                    echo "
                        <form id='redirectLogin' action='".base_url()."otp' method='POST'>
                            <input type='hidden' name='code' value='".htmlspecialchars($row['code'], ENT_QUOTES, 'UTF-8')."'>
                            <input type='hidden' name='otp' value='".htmlspecialchars($row['otp'], ENT_QUOTES, 'UTF-8')."'>
                            <input type='hidden' name='fpass' value='".htmlspecialchars('NO', ENT_QUOTES, 'UTF-8')."'>
                        </form>
                        <script>
                            setTimeout(() => {
                                document.getElementById('redirectLogin').submit();
                            }, 1000);
                        </script>
                    ";
                }
            } else {
                alert('error', 'Login Failed', 'Invalid Password!', base_url().'auth.php');
            }
        } else {
            alert('error', 'Login Failed', 'Invalid User Code / NIK!', base_url().'auth.php');
        }
    } else if (isset($_POST['signup'])) {
        $code = trim(mysqli_real_escape_string($con, $_POST['code']));
        $full_name = $_POST['full_name'];
        $contact = trim(mysqli_real_escape_string($con, $_POST['contact']));
        $pass = trim(mysqli_real_escape_string($con, $_POST['password']));
        $cpass = trim(mysqli_real_escape_string($con, $_POST['confirm-password']));
        $otp = mt_rand(1000, 9999);
        if ($pass == $cpass) {
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
            $qSignUp = mysqli_query($con, "INSERT INTO tbl_user (full_name, code, password, contact, otp)
            VALUES ('$full_name', '$code', '$hashedPassword', '$contact', '$otp')") or die(mysqli_error($con));
            if ($qSignUp) {
                sendWA($gateway, $wa_token, $wa_api_url, $contact, "*---- VERIFIKASI ----*\n\nUser Code / NIK : *$code*\nOTP : *$otp*");
                alert('success', 'OTP Sended', 'Please Check Your WhatsApp!', null);
                echo "
                    <form id='redirectSignUp' action='".base_url()."otp' method='POST'>
                        <input type='hidden' name='code' value='".htmlspecialchars($code, ENT_QUOTES, 'UTF-8')."'>
                        <input type='hidden' name='otp' value='".htmlspecialchars($otp, ENT_QUOTES, 'UTF-8')."'>
                        <input type='hidden' name='fpass' value='".htmlspecialchars('NO', ENT_QUOTES, 'UTF-8')."'>
                    </form>
                    <script>
                        setTimeout(() => {
                            document.getElementById('redirectSignUp').submit();
                        }, 1000);
                    </script>
                ";
            } else {
                alert('error', 'Signup Failed', 'Something Went Wrong!', base_url().'auth.php');
            }
        } else {
            alert('error', 'Signup Failed', 'Password Didn\'t Match!', base_url().'auth.php');
        }
    } else if (isset($_POST['forgot'])) {
        $code = trim(mysqli_real_escape_string($con, $_POST['code']));
        $contact = trim(mysqli_real_escape_string($con, $_POST['contact']));
        $otp = mt_rand(1000, 9999);
        $qForgot = mysqli_query($con, "UPDATE tbl_user SET otp = '$otp' WHERE code = '$code' AND contact = '$contact'") or die (mysqli_error($con));
        if ($qForgot) {
            sendWA($gateway, $wa_token, $wa_api_url, $contact, "*---- VERIFIKASI ----*\n\nUser Code / NIK : *$code*\nOTP : *$otp*");
            alert('success', 'OTP Sended', 'Please Check Your WhatsApp!', null);
            echo "
                <form id='redirectForgot' action='".base_url()."otp' method='POST'>
                    <input type='hidden' name='code' value='".htmlspecialchars($code, ENT_QUOTES, 'UTF-8')."'>
                    <input type='hidden' name='otp' value='".htmlspecialchars($otp, ENT_QUOTES, 'UTF-8')."'>
                    <input type='hidden' name='fpass' value='".htmlspecialchars('YES', ENT_QUOTES, 'UTF-8')."'>
                </form>
                <script>
                    setTimeout(() => {
                        document.getElementById('redirectForgot').submit();
                    }, 1000);
                </script>
            ";
        } else {
            alert('error', 'Failed', 'Invalid User Code / NIK and Contact!', base_url().'auth.php');
        }
    } else if (isset($_POST['sendOTP'])) {
        $code = trim(mysqli_real_escape_string($con, $_POST['code']));
        $otp = trim(mysqli_real_escape_string($con, $_POST['otp']));
        $cotp = trim(mysqli_real_escape_string($con, $_POST['cotp']));
        $fpass = trim(mysqli_real_escape_string($con, $_POST['fpass']));
        if ($otp == $cotp) {
            $qOTP = mysqli_query($con, "UPDATE tbl_user SET otp = null, is_verified = 'YES' WHERE code = '$code' AND otp = '$otp'") or die (mysqli_error($con));
            if ($qOTP) {
                if ($fpass == 'YES') {
                    alert('success', 'Confirmed', 'Make New Password!', null);
                    echo "
                        <form id='redirectNewPass' action='".base_url()."newPass' method='POST'>
                            <input type='hidden' name='code' value='".htmlspecialchars($code, ENT_QUOTES, 'UTF-8')."'>
                            <input type='hidden' name='otp' value='".htmlspecialchars($otp, ENT_QUOTES, 'UTF-8')."'>
                            <input type='hidden' name='fpass' value='".htmlspecialchars($fpass, ENT_QUOTES, 'UTF-8')."'>
                        </form>
                        <script>
                            setTimeout(() => {
                                document.getElementById('redirectNewPass').submit();
                            }, 1000);
                        </script>
                    ";
                } else {
                    alert('success', 'Confirmed', 'OTP Confirmed!', base_url().'auth.php');
                }
            } else {
                alert('error', 'Failed', 'Something Went Wrong!', base_url().'auth.php');
            }
        } else {
            alert('error', 'Failed', 'OTP Didn\'t Match!', base_url().'auth.php');
        }
    } else if (isset($_POST['sendPass'])) {
        $code = trim(mysqli_real_escape_string($con, $_POST['code']));
        $pass = trim(mysqli_real_escape_string($con, $_POST['password']));
        $cpass = trim(mysqli_real_escape_string($con, $_POST['confirm-password']));
        if ($pass == $cpass) {
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
            $qNewPass = mysqli_query($con, "UPDATE tbl_user SET password = '$hashedPassword' WHERE code = '$code'") or die (mysqli_error($con));
            if ($qNewPass) {
                alert('success', 'Success', 'Password Updated!', base_url().'auth.php');
            } else {
                alert('error', 'Failed', 'Something Went Wrong!', base_url().'auth.php');
            }
        } else {
            alert('error', 'Failed', 'Password Didn\'t Match!', base_url().'auth.php');
        }
    } else {
        alert('error', 'Oops...', 'Something Went Wrong!', base_url().'auth.php');
    }
?>