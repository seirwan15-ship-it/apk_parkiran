<?php 
session_start(); 
include_once 'Model/m_koneksi.php'; 
include_once 'Model/m_log.php'; 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
 
    $koneksi = new koneksi(); 
 
    $user = trim($_POST['username']); 
    $pass = trim($_POST['password']); 
 
    if ($user == "" || $pass == "") { 
        echo "<script>alert('Isi username dan password'); window.location='index.php'</script>"; 
        exit; 
    } 
 
    $user = mysqli_real_escape_string($koneksi->koneksi, $user); 
    $pass = mysqli_real_escape_string($koneksi->koneksi, $pass); 
 
    $query = mysqli_query($koneksi->koneksi, 
        "SELECT * FROM tb_user  
         WHERE username='$user' AND status_aktif=1 LIMIT 1" 
    ); 
 
    if ($query && mysqli_num_rows($query) > 0) { 
 
        $data = mysqli_fetch_assoc($query); 
 
        if ($pass == $data['password']) { 
 
            $_SESSION['data'] = $data; 
 
            $log = new m_log(); 
            $log->simpan_log($data['id_user']); 
 
            if ($data['role'] == 'admin') { 
                header("Location: View/v_homeadmin.php"); 
            } elseif ($data['role'] == 'petugas') { 
                header("Location: View/v_homepetugas.php"); 
            } elseif ($data['role'] == 'owner') { 
                header("Location: View/v_homeowner.php"); 
            } else { 
                echo "<script>alert('Role tidak dikenali'); window.location='index.php'</script>"; 
            } 
            exit; 
 
        } else { 
            echo "<script>alert('Password salah'); window.location='index.php'</script>"; 
        } 
 
    } else { 
        echo "<script>alert('Username tidak ditemukan atau akun nonaktif'); window.location='index.php'</script>"; 
    } 
} 
?> 

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Parkir</title>

    <style>

        /* ==========================================
           LOGIN SISTEM PARKIR
           DESAIN ALTERNATIF
           ========================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body.login-page {
            min-height: 100vh;

            font-family: Arial, Helvetica, sans-serif;

            background: #eef2f7;

            color: #1e293b;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 25px;
        }


        /* ==========================================
           CONTAINER
           ========================================== */

        .login-page .login-container {
            width: 100%;
            max-width: 850px;

            min-height: 500px;

            background: #ffffff;

            border-radius: 14px;

            overflow: hidden;

            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);

            display: flex;
        }


        /* ==========================================
           BAGIAN KIRI
           ========================================== */

        .login-page .login-info {
            width: 42%;

            background: #2563eb;

            color: #ffffff;

            padding: 45px 38px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        .login-page .parking-symbol {
            width: 55px;
            height: 55px;

            border: 2px solid rgba(255,255,255,0.7);

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 25px;
            font-weight: bold;

            margin-bottom: 25px;
        }


        .login-page .login-info h1 {
            font-size: 28px;

            margin-bottom: 12px;
        }


        .login-page .login-info p {
            color: rgba(255,255,255,0.82);

            font-size: 13px;

            line-height: 1.7;
        }


        .login-page .info-line {
            width: 45px;
            height: 3px;

            background: #ffffff;

            margin: 20px 0;
        }


        /* ==========================================
           BAGIAN FORM
           ========================================== */

        .login-page .login-form-area {
            width: 58%;

            padding: 55px 55px;

            display: flex;
            align-items: center;
        }


        .login-page .login-form {
            width: 100%;
            max-width: 390px;

            margin: auto;
        }


        .login-page .login-form h2 {
            font-size: 25px;

            color: #1e293b;

            margin-bottom: 8px;
        }


        .login-page .login-form .subtitle {
            font-size: 13px;

            color: #64748b;

            margin-bottom: 30px;
        }


        /* ==========================================
           INPUT
           ========================================== */

        .login-page .field {
            margin-bottom: 20px;
        }


        .login-page .field label {
            display: block;

            font-size: 13px;

            font-weight: 600;

            color: #334155;

            margin-bottom: 8px;
        }


        .login-page .field input {
            width: 100%;

            height: 46px;

            padding: 0 13px;

            border: 1px solid #cbd5e1;

            border-radius: 6px;

            background: #ffffff;

            color: #1e293b;

            outline: none;

            font-size: 14px;

            transition: 0.2s;
        }


        .login-page .field input:hover {
            border-color: #94a3b8;
        }


        .login-page .field input:focus {
            border-color: #2563eb;

            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.08);
        }


        /* ==========================================
           BUTTON
           ========================================== */

        .login-page .btn-login {
            width: 100%;

            height: 46px;

            border: none;

            border-radius: 6px;

            background: #2563eb;

            color: #ffffff;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.2s;
        }


        .login-page .btn-login:hover {
            background: #1d4ed8;
        }


        /* ==========================================
           FOOTER
           ========================================== */

        .login-page .form-footer {
            margin-top: 25px;

            padding-top: 17px;

            border-top: 1px solid #e5e7eb;

            text-align: center;

            font-size: 11px;

            color: #94a3b8;
        }


        /* ==========================================
           RESPONSIVE
           ========================================== */

        @media (max-width: 700px) {

            body.login-page {
                padding: 15px;
            }

            .login-page .login-container {
                display: block;

                max-width: 430px;

                min-height: auto;
            }

            .login-page .login-info {
                width: 100%;

                padding: 30px;

                min-height: 190px;
            }

            .login-page .parking-symbol {
                width: 45px;
                height: 45px;

                font-size: 20px;

                margin-bottom: 15px;
            }

            .login-page .login-info h1 {
                font-size: 23px;
            }

            .login-page .info-line {
                margin: 12px 0;
            }

            .login-page .login-form-area {
                width: 100%;

                padding: 35px 25px;
            }
        }

    </style>
</head>

<body class="login-page">

    <div class="login-container">

        <!-- INFORMASI SISTEM -->

        <div class="login-info">

            <div class="parking-symbol">
                P
            </div>

            <h1>
                Sistem Parkir
            </h1>

            <div class="info-line"></div>

            <p>
                Selamat datang di sistem informasi parkir.
                Silakan masuk menggunakan akun yang telah
                terdaftar untuk melanjutkan.
            </p>

        </div>


        <!-- FORM LOGIN -->

        <div class="login-form-area">

            <div class="login-form">

                <h2>
                    Login
                </h2>

                <p class="subtitle">
                    Masukkan username dan password Anda.
                </p>


                <form method="POST" action="index.php">

                    <div class="field">

                        <label for="username">
                            Username
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Masukkan username"
                            required
                            autofocus
                        >

                    </div>


                    <div class="field">

                        <label for="password">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="btn-login"
                    >
                        Masuk
                    </button>

                </form>


                <div class="form-footer">
                    Sistem Informasi Parkir
                </div>

            </div>

        </div>

    </div>

</body>
</html>