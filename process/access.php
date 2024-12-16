<?php
    require "../configure/connect.php";
    require "../layout/notify.php";
    require "request.php";

    function autoDirect($action, $data = []) {
        $form = "<form id='autoSubmitForm' action='".htmlspecialchars($action)."' method='POST'>";
        foreach ($data as $name => $value) {
            $form .= "<input type='hidden' name='".htmlspecialchars($name)."' value='".htmlspecialchars($value)."'>";
        }
        $form .= "</form>
            <script>
                setTimeout(() => {
                    document.getElementById('autoSubmitForm').submit();
                }, 1000);
            </script>";
        echo $form;
    }

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
                    alert('info', 'Not Verified', 'Please Confirm The OTP!', null);
                    autoDirect(base_url().'otp', [
                        'code' => $row['code'],
                        'contact' => $row['contact'],
                        'otp' => $row['otp'],
                        'otp_time' => $row['otp_time'],
                        'fpass' => 'false'
                    ]);
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
        $otp_time = date("Y-m-d H:i:s");
        if ($pass == $cpass) {
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
            $qSignUp = mysqli_query($con, "INSERT INTO tbl_user (full_name, code, password, contact, otp, otp_time)
            VALUES ('$full_name', '$code', '$hashedPassword', '$contact', '$otp', '$otp_time')") or die(mysqli_error($con));
            if ($qSignUp) {
                $sendWA = sendWA(
                    $gateway,
                    $wa_token,
                    $wa_api_url,
                    $contact,
                    "*---- VERIFIKASI ----*\n\nUser : *$code*\nOTP : *$otp*"
                );
                if ($sendWA) {
                    alert('success', 'OTP Sended', 'Please Check Your WhatsApp!', null);
                    autoDirect(base_url().'otp', [
                        'code' => $code,
                        'contact' => $contact,
                        'otp' => $otp,
                        'otp_time' => $otp_time,
                        'fpass' => 'false'
                    ]);
                } else {
                    alert('error', 'Couldn\'t send OTP', 'Please Contact The Admin!', base_url().'auth.php');
                }
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
        $otp_time = date("Y-m-d H:i:s");
        $qForgot = mysqli_query($con, "UPDATE tbl_user SET otp = '$otp', otp_time = '$otp_time' WHERE code = '$code' AND contact = '$contact'") or die (mysqli_error($con));
        if ($qForgot) {
            $sendWA = sendWA(
                $gateway,
                $wa_token,
                $wa_api_url,
                $contact,
                "*---- VERIFIKASI ----*\n\nUser : *$code*\nOTP : *$otp*"
            );
            if ($sendWA) {
                alert('success', 'OTP Sended', 'Please Check Your WhatsApp!', null);
                autoDirect(base_url().'otp', [
                    'code' => $code,
                    'contact' => $contact,
                    'otp' => $otp,
                    'otp_time' => $otp_time,
                    'fpass' => 'true'
                ]);
            } else {
                alert('error', 'Couldn\'t send OTP', 'Please Contact The Admin!', base_url().'auth.php');
            }
        } else {
            alert('error', 'Failed', 'Invalid User Code / NIK and Contact!', base_url().'auth.php');
        }
    } else if (isset($_POST['resendOTP'])) {
        $code = trim(mysqli_real_escape_string($con, $_POST['code']));
        $contact = trim(mysqli_real_escape_string($con, $_POST['contact']));
        $fpass = trim(mysqli_real_escape_string($con, $_POST['fpass']));
        $otp = mt_rand(1000, 9999);
        $otp_time = date("Y-m-d H:i:s");
        $qResend = mysqli_query($con, "UPDATE tbl_user SET otp = '$otp', otp_time = '$otp_time' WHERE code = '$code' AND contact = '$contact'") or die (mysqli_error($con));
        if ($qResend) {
            $sendWA = sendWA(
                $gateway,
                $wa_token,
                $wa_api_url,
                $contact,
                "*---- VERIFIKASI ----*\n\nUser : *$code*\nOTP : *$otp*"
            );
            if ($sendWA) {
                alert('success', 'OTP Sended', 'Please Check Your WhatsApp!', null);
                autoDirect(base_url().'otp', [
                    'code' => $code,
                    'contact' => $contact,
                    'otp' => $otp,
                    'otp_time' => $otp_time,
                    'fpass' => $fpass
                ]);
            } else {
                alert('error', 'Couldn\'t send OTP', 'Please Contact The Admin!', base_url().'auth.php');
            }
        } else {
            alert('error', 'Failed', 'Invalid User Code / NIK and Contact!', base_url().'auth.php');
        }
    } else if (isset($_POST['confirmOTP'])) {
        $code = trim(mysqli_real_escape_string($con, $_POST['code']));
        $otp = trim(mysqli_real_escape_string($con, $_POST['otp']));
        $cotp = trim(mysqli_real_escape_string($con, $_POST['cotp']));
        $fpass = trim(mysqli_real_escape_string($con, $_POST['fpass']));
        if ($otp == $cotp) {
            $qOTP = mysqli_query($con, "UPDATE tbl_user SET otp = null, otp_time = null, is_verified = 'YES' WHERE code = '$code' AND otp = '$otp'") or die (mysqli_error($con));
            if ($qOTP) {
                if ($fpass == 'true') {
                    alert('success', 'Confirmed', 'Make New Password!', null);
                    autoDirect(base_url().'newPass', [
                        'code' => $code,
                        'otp' => $otp,
                        'fpass' => $fpass
                    ]);
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