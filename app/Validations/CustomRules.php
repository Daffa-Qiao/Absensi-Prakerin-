<?php

namespace App\Validations;

class CustomRules
{
    function check_old_password(string $str, string &$error = null): bool
    {
        $member = new \App\Models\MemberModel();
        if (empty($str)) {
            return true;
        }

        $nim_nis = session()->get('member_nim_nis');
        $dataMember = $member->where('nim_nis', $nim_nis)->first();

        $password = $dataMember['password'];

        if ($str == $password) {
            return true;
        } else {
            return false;
        }
    }
}

function valid_nomor($value)
{
    $value = trim($value);
    if ($value == '') {
        return TRUE;
    } else {
        if (preg_match('/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/', $value)) {
            return preg_replace('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/', '($1) $2-$3', $value);
        } else {
            return FALSE;
        }
    }
}