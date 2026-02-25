<?php

namespace App\Services;

class AzerothCoreAuth
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function generateSrp6(string $username, string $password): array
    {
        $salt = random_bytes(32);
        $g = gmp_init(7);
        $N = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);
        $h1 = sha1(strtoupper($username) . ':' . strtoupper($password), true);
        $h2 = sha1($salt . $h1, true);
        $h2_int = gmp_import($h2, 1, GMP_LSW_FIRST);
        $verifier = gmp_powm($g, $h2_int, $N);
        $verifier_bytes = gmp_export($verifier, 1, GMP_LSW_FIRST);
        $verifier_padded = str_pad($verifier_bytes, 32, chr(0), STR_PAD_RIGHT);
        
        return [
            'salt' => $salt,
            'verifier' => $verifier_padded,
        ];
    }

    public static function verifySrp6(string $username, string $password, string $salt, string $verifier): bool
    {
        $g = gmp_init(7);
        $N = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);
        $h1 = sha1(strtoupper($username) . ':' . strtoupper($password), true);
        $h2 = sha1($salt . $h1, true);
        $h2_int = gmp_import($h2, 1, GMP_LSW_FIRST);
        $v_calc = gmp_powm($g, $h2_int, $N);
        $v_calc_bytes = gmp_export($v_calc, 1, GMP_LSW_FIRST);
        $v_calc_padded = str_pad($v_calc_bytes, 32, chr(0), STR_PAD_RIGHT);
        
        return hash_equals($verifier, $v_calc_padded);
    }
}
