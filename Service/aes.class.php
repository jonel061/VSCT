<?php


Class Aes
{
    /**
     * Funcția de cifrare AES [§5.1]: criptează „intrare” cu algoritmul Rijndael
     *
     * @param input mesaj (16-bit)
     * @param w     programare cheie ca matrice de octeți 2D (Nr + 1 x Nb octeți) -
     *              generat din cheia cifrată de cheia Expansion ()
     * @return      ciphertext ca octet-matrice (16 octeți)
     */
    public static function criptare($input, $w)
    {
        $Nb = 4; // dimensiunea blocului (în cuvinte): numărul de coloane în stare (fixat la 4 pentru AES)
        $Nr = count($w) / $Nb - 1; // nr de runde: 10/12/14 pentru tastele 128/192/256-bit

        $state = array(); // inițializează 4xNb octet-matrice „stare” cu intrare
        for ($i = 0; $i < 4 * $Nb; $i++) $state[$i % 4][floor($i / 4)] = $input[$i];

        $state = self::addRoundKey($state, $w, 0, $Nb);

        for ($round = 1; $round < $Nr; $round++) { // aplică Nr runde
            $state = self::subBytes($state, $Nb);
            $state = self::shiftRows($state, $Nb);
            $state = self::mixColumns($state, $Nb);
            $state = self::addRoundKey($state, $w, $round, $Nb);
        }

        $state = self::subBytes($state, $Nb);
        $state = self::shiftRows($state, $Nb);
        $state = self::addRoundKey($state, $w, $Nr, $Nb);

        $output = array(4 * $Nb); // convertește starea în matrice 1-d înainte de a reveni 
        for ($i = 0; $i < 4 * $Nb; $i++) $output[$i] = $state[$i % 4][floor($i / 4)];
        return $output;
    }


    /**
     * Xor Round Key în starea S .
     */
    private static function addRoundKey($state, $w, $rnd, $Nb)
    {
        for ($r = 0; $r < 4; $r++) {
            for ($c = 0; $c < $Nb; $c++) $state[$r][$c] ^= $w[$rnd * 4 + $c][$r];
        }
        return $state;
    }

    /**
     * Aplic SBoxla  starea S .
     */
    private static function subBytes($s, $Nb)
    {
        for ($r = 0; $r < 4; $r++) {
            for ($c = 0; $c < $Nb; $c++) $s[$r][$c] = self::$sBox[$s[$r][$c]];
        }
        return $s;
    }

    /**
     * Deplasez  rândul r al stării S lăsat de r octeți .
     */
    private static function shiftRows($s, $Nb)
    {
        $t = array(4);
        for ($r = 1; $r < 4; $r++) {
            for ($c = 0; $c < 4; $c++) $t[$c] = $s[$r][($c + $r) % $Nb]; // trec la copia temporară
            for ($c = 0; $c < 4; $c++) $s[$r][$c] = $t[$c]; // și o copiez 
        } //rețin că acest lucru va funcționa pentru Nb = 4,5,6, dar nu pentru 7,8 (întotdeauna 4 pentru AES):
        return $s; 
    }

    /**
     * Combin octeți pentru fiecare col de stare S.
     */
    private static function mixColumns($s, $Nb)
    {
        for ($c = 0; $c < 4; $c++) {
            $a = array(4); // 'a' este o copie a coloanei curente din 's'
            $b = array(4); // 'b' este a•{02} în GF(2^8)
            for ($i = 0; $i < 4; $i++) {
                $a[$i] = $s[$i][$c];
                $b[$i] = $s[$i][$c] & 0x80 ? $s[$i][$c] << 1 ^ 0x011b : $s[$i][$c] << 1;
            }
            // a[n] ^ b[n] is a•{03} in GF(2^8)
            $s[0][$c] = $b[0] ^ $a[1] ^ $b[1] ^ $a[2] ^ $a[3]; // 2*a0 + 3*a1 + a2 + a3
            $s[1][$c] = $a[0] ^ $b[1] ^ $a[2] ^ $b[2] ^ $a[3]; // a0 * 2*a1 + 3*a2 + a3
            $s[2][$c] = $a[0] ^ $a[1] ^ $b[2] ^ $a[3] ^ $b[3]; // a0 + a1 + 2*a2 + 3*a3
            $s[3][$c] = $a[0] ^ $b[0] ^ $a[1] ^ $a[2] ^ $b[3]; // 3*a0 + a1 + a2 + 2*a3
        }
        return $s;
    }

    /**
     * Generez programarea cheilor din cheia cifrată .
     *
     * Efectuați extinderea cheii pe cheia de cifrare pentru a genera un program de chei.
     *
     * @param  key cifrare cheie-octet-matrice (16 octeți).
     * @return key programează ca matrice de octeți 2D (Nr + 1 x Nb octeți)
     */
    public static function keyExpansion($key)
    {
        $Nb = 4; // dimensiunea blocului (în cuvinte): numărul de coloane în stare (fixat la 4 pentru AES)
        $Nk = count($key) / 4; // lungimea tastei (în cuvinte): 4/6/8 pentru tastele 128/192/256-bit
        $Nr = $Nk + 6; // nr de runde: 10/12/14 pentru tastele 128/192/256-bit

        $w = array();
        $temp = array();

        for ($i = 0; $i < $Nk; $i++) {
            $r = array($key[4 * $i], $key[4 * $i + 1], $key[4 * $i + 2], $key[4 * $i + 3]);
            $w[$i] = $r;
        }

        for ($i = $Nk; $i < ($Nb * ($Nr + 1)); $i++) {
            $w[$i] = array();
            for ($t = 0; $t < 4; $t++) $temp[$t] = $w[$i - 1][$t];
            if ($i % $Nk == 0) {
                $temp = self::subWord(self::rotWord($temp));
                for ($t = 0; $t < 4; $t++) $temp[$t] ^= self::$rCon[$i / $Nk][$t];
            } else if ($Nk > 6 && $i % $Nk == 4) {
                $temp = self::subWord($temp);
            }
            for ($t = 0; $t < 4; $t++) $w[$i][$t] = $w[$i - $Nk][$t] ^ $temp[$t];
        }
        return $w;
    }

    /**
     * Aplic SBox la cuvântul de 4 octeți w.
     */
    private static function subWord($w)
    {
        for ($i = 0; $i < 4; $i++) $w[$i] = self::$sBox[$w[$i]];
        return $w;
    }

    /**
     * Rotesc cuvântul de 4 octeți w lăsat cu un octet.
     */
    private static function rotWord($w)
    {
        $tmp = $w[0];
        for ($i = 0; $i < 3; $i++) $w[$i] = $w[$i + 1];
        $w[3] = $tmp;
        return $w;
    }

    // sBox este invers multiplicat precomputat în GF (2 ^ 8) utilizat în subBytes și keyExpansion
    private static $sBox = array(
        0x63, 0x7c, 0x77, 0x7b, 0xf2, 0x6b, 0x6f, 0xc5, 0x30, 0x01, 0x67, 0x2b, 0xfe, 0xd7, 0xab, 0x76,
        0xca, 0x82, 0xc9, 0x7d, 0xfa, 0x59, 0x47, 0xf0, 0xad, 0xd4, 0xa2, 0xaf, 0x9c, 0xa4, 0x72, 0xc0,
        0xb7, 0xfd, 0x93, 0x26, 0x36, 0x3f, 0xf7, 0xcc, 0x34, 0xa5, 0xe5, 0xf1, 0x71, 0xd8, 0x31, 0x15,
        0x04, 0xc7, 0x23, 0xc3, 0x18, 0x96, 0x05, 0x9a, 0x07, 0x12, 0x80, 0xe2, 0xeb, 0x27, 0xb2, 0x75,
        0x09, 0x83, 0x2c, 0x1a, 0x1b, 0x6e, 0x5a, 0xa0, 0x52, 0x3b, 0xd6, 0xb3, 0x29, 0xe3, 0x2f, 0x84,
        0x53, 0xd1, 0x00, 0xed, 0x20, 0xfc, 0xb1, 0x5b, 0x6a, 0xcb, 0xbe, 0x39, 0x4a, 0x4c, 0x58, 0xcf,
        0xd0, 0xef, 0xaa, 0xfb, 0x43, 0x4d, 0x33, 0x85, 0x45, 0xf9, 0x02, 0x7f, 0x50, 0x3c, 0x9f, 0xa8,
        0x51, 0xa3, 0x40, 0x8f, 0x92, 0x9d, 0x38, 0xf5, 0xbc, 0xb6, 0xda, 0x21, 0x10, 0xff, 0xf3, 0xd2,
        0xcd, 0x0c, 0x13, 0xec, 0x5f, 0x97, 0x44, 0x17, 0xc4, 0xa7, 0x7e, 0x3d, 0x64, 0x5d, 0x19, 0x73,
        0x60, 0x81, 0x4f, 0xdc, 0x22, 0x2a, 0x90, 0x88, 0x46, 0xee, 0xb8, 0x14, 0xde, 0x5e, 0x0b, 0xdb,
        0xe0, 0x32, 0x3a, 0x0a, 0x49, 0x06, 0x24, 0x5c, 0xc2, 0xd3, 0xac, 0x62, 0x91, 0x95, 0xe4, 0x79,
        0xe7, 0xc8, 0x37, 0x6d, 0x8d, 0xd5, 0x4e, 0xa9, 0x6c, 0x56, 0xf4, 0xea, 0x65, 0x7a, 0xae, 0x08,
        0xba, 0x78, 0x25, 0x2e, 0x1c, 0xa6, 0xb4, 0xc6, 0xe8, 0xdd, 0x74, 0x1f, 0x4b, 0xbd, 0x8b, 0x8a,
        0x70, 0x3e, 0xb5, 0x66, 0x48, 0x03, 0xf6, 0x0e, 0x61, 0x35, 0x57, 0xb9, 0x86, 0xc1, 0x1d, 0x9e,
        0xe1, 0xf8, 0x98, 0x11, 0x69, 0xd9, 0x8e, 0x94, 0x9b, 0x1e, 0x87, 0xe9, 0xce, 0x55, 0x28, 0xdf,
        0x8c, 0xa1, 0x89, 0x0d, 0xbf, 0xe6, 0x42, 0x68, 0x41, 0x99, 0x2d, 0x0f, 0xb0, 0x54, 0xbb, 0x16);

    // rCon este constantă rotundă utilizată pentru expansiunea cheii [prima col este 2 ^ (r-1) în GF (2 ^ 8)] [§5.2]
    private static $rCon = array(
        array(0x00, 0x00, 0x00, 0x00),
        array(0x01, 0x00, 0x00, 0x00),
        array(0x02, 0x00, 0x00, 0x00),
        array(0x04, 0x00, 0x00, 0x00),
        array(0x08, 0x00, 0x00, 0x00),
        array(0x10, 0x00, 0x00, 0x00),
        array(0x20, 0x00, 0x00, 0x00),
        array(0x40, 0x00, 0x00, 0x00),
        array(0x80, 0x00, 0x00, 0x00),
        array(0x1b, 0x00, 0x00, 0x00),
        array(0x36, 0x00, 0x00, 0x00));

}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */