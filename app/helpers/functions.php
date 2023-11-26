<?php
function isLoginUser()
{
    if (isset($_SESSION["login_user"]) && isset($_SESSION["id_user"])) return true;
    else return false;
}

function isLoginAdmin()
{
    if (isset($_SESSION["login_admin"]) && isset($_SESSION["id_admin"])) return true;
    else return false;
}

function getLamaSewa($jamMulai, $jamSelesai)
{
    $waktuMulai = new DateTime($jamMulai);
    $waktuAkhir = new DateTime($jamSelesai);

    $differ = $waktuMulai->diff($waktuAkhir);
    $jamTanpa0 = intval($differ->format("%h"));
    $jamFormat12 = ($jamTanpa0 == 0) ? 12 : $jamTanpa0;

    return $jamFormat12;
}

function upload_image($file_name, $file_size, $temp_loc, $target_loc)
{
    $valid_ext = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($ext, $valid_ext)) return false;
    else {
        if ($file_size > 3000000) return false;
        else {
            $new_file_name = uniqid() . "." . $ext;
            move_uploaded_file($temp_loc, $target_loc . $new_file_name);
            return $new_file_name;
        }
    }
}
