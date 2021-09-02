<?php






Class AesCtr extends Aes
{

    /**
     * Criptarea  unui text folosind criptarea AES în modul de operare Contor
     *  
     *
     * 
     *
     * @param plaintext textul sursă care trebuie criptat
     * @param password  parola de utilizat pentru a genera o cheie
     * @param nBits     numărul de biți care trebuie utilizați în tastă (128, 192 sau 256)
     * @return          encrypted text
     */
    public static function encrypt($plaintext, $password, $nBits)
    {
        $blockSize = 16; //dimensiunea blocului fixată la 16 octeți / 128 biți (Nb = 4) pentru AES
        if (!($nBits == 128 || $nBits == 192 || $nBits == 256)) return ''; // standard permite tastele de 128/192/256 biți
        // rețineți că PHP (5) ne oferă text simplu și parolă în codificarea UTF8!

        // utilizați AES în sine pentru a cripta parola pentru a obține cheia de cifrare (folosind parola simplă ca sursă pentru
        // extinderea cheii) - ne oferă o cheie bine criptată
        $nBytes = $nBits / 8; //fără octeți în cheie
        $pwBytes = array();
        for ($i = 0; $i < $nBytes; $i++) $pwBytes[$i] = ord(substr($password, $i, 1)) & 0xff;
        $key = Aes::criptare($pwBytes, Aes::keyExpansion($pwBytes));
        $key = array_merge($key, array_slice($key, 0, $nBytes - 16)); // extind cheia la 16/24/32 octeți lungime

        // inițializați primul 8 octeți de bloc contor cu nonce (NIST SP800-38A §B.2): [0-1] = milisec,
        // [2-3] = aleatoriu, [4-7] = secunde, oferind unicitate sub-ms garantată până în februarie 2106
        $counterBlock = array();
        $nonce = floor(microtime(true) * 1000); 
        $nonceMs = $nonce % 1000;
        $nonceSec = floor($nonce / 1000);
        $nonceRnd = floor(rand(0, 0xffff));

        for ($i = 0; $i < 2; $i++) $counterBlock[$i] = self::urs($nonceMs, $i * 8) & 0xff;
        for ($i = 0; $i < 2; $i++) $counterBlock[$i + 2] = self::urs($nonceRnd, $i * 8) & 0xff;
        for ($i = 0; $i < 4; $i++) $counterBlock[$i + 4] = self::urs($nonceSec, $i * 8) & 0xff;

        //  convertesc într-un șir pentru a merge pe partea din față a textului cifrat
        $ctrTxt = '';
        for ($i = 0; $i < 8; $i++) $ctrTxt .= chr($counterBlock[$i]);

        // genera program de chei - o extindere a cheii în runde de chei distincte pentru fiecare rundă
        $keySchedule = Aes::keyExpansion($key);
        //print_r($keySchedule);

        $blockCount = ceil(strlen($plaintext) / $blockSize);
        $ciphertxt = array(); // text cifrat ca matrice de șiruri

        for ($b = 0; $b < $blockCount; $b++) {
            // seteaz contorul (blocul #) în ultimii 8 octeți ai blocului contorului (lăsând nonce în primul 8 octeți)
            // realizat în două etape pentru operațiuni pe 32 de biți: utilizarea a două cuvinte ne permite să trecem de 2 ^ 32 blocuri (68 GB)
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c] = self::urs($b, $c * 8) & 0xff;
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c - 4] = self::urs($b / 0x100000000, $c * 8);

            $cipherCntr = Aes::criptare($counterBlock, $keySchedule); // -- criptare bloc contor --

            //dimensiunea blocului este redusă la blocul final
            $blockLength = $b < $blockCount - 1 ? $blockSize : (strlen($plaintext) - 1) % $blockSize + 1;
            $cipherByte = array();

            for ($i = 0; $i < $blockLength; $i++) { // -- xor text clar cu contor cifrat byte-by-byte--
                $cipherByte[$i] = $cipherCntr[$i] ^ ord(substr($plaintext, $b * $blockSize + $i, 1));
                $cipherByte[$i] = chr($cipherByte[$i]);
            }
            $ciphertxt[$b] = implode('', $cipherByte); // scapă de caractere supărătoare din text cifrat
        }

        // implodarea este mai eficientă decât concatenarea repetată a șirurilor
        $ciphertext = $ctrTxt . implode('', $ciphertxt);
        $ciphertext = base64_encode($ciphertext);
        return $ciphertext;
    }


    /**
     * Decriptați un text criptat de AES în modul de funcționare a contorului
     *
     * @param ciphertext textul sursă care trebuie decriptat
     * @param password   parola de utilizat pentru a genera o cheie
     * @param nBits      numărul de biți care trebuie utilizați în tastă (128, 192 sau 256)
     * @return           decrypted text
     */
    public static function decrypt($ciphertext, $password, $nBits)
    {
        $blockSize = 16; // dimensiunea blocului fixată la 16 octeți / 128 biți (Nb = 4) pentru AES
        if (!($nBits == 128 || $nBits == 192 || $nBits == 256)) return ''; // standard permite tastele de 128/192/256 biți
        $ciphertext = base64_decode($ciphertext);

        // utilizez  AES pentru a cripta parola (oglindirea rutinei de criptare)
        $nBytes = $nBits / 8; // fără octeți în cheie
        $pwBytes = array();
        for ($i = 0; $i < $nBytes; $i++) $pwBytes[$i] = ord(substr($password, $i, 1)) & 0xff;
        $key = Aes::criptare($pwBytes, Aes::keyExpansion($pwBytes));
        $key = array_merge($key, array_slice($key, 0, $nBytes - 16)); // extind cheia la 16/24/32 octeți lungime

        // recupera nonce din primul element al textului cifrat
        $counterBlock = array();
        $ctrTxt = substr($ciphertext, 0, 8);
        for ($i = 0; $i < 8; $i++) $counterBlock[$i] = ord(substr($ctrTxt, $i, 1));

        // generează programul cheie
        $keySchedule = Aes::keyExpansion($key);

        // separați textul cifrat în blocuri (săriți peste 8 octeți inițiali)
        $nBlocks = ceil((strlen($ciphertext) - 8) / $blockSize);
        $ct = array();
        for ($b = 0; $b < $nBlocks; $b++) $ct[$b] = substr($ciphertext, 8 + $b * $blockSize, 16);
        $ciphertext = $ct; //textul cifrat este acum o serie de șiruri de lungime de bloc

        // textul clar va fi generat bloc cu bloc într-o serie de șiruri de lungime bloc
        $plaintxt = array();

        for ($b = 0; $b < $nBlocks; $b++) {
            // setează contorul (blocul #) în ultimii 8 octeți ai blocului contorului (lăsând nonce în primul 8 octeți)
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c] = self::urs($b, $c * 8) & 0xff;
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c - 4] = self::urs(($b + 1) / 0x100000000 - 1, $c * 8) & 0xff;

            $cipherCntr = Aes::criptare($counterBlock, $keySchedule); // encrypt counter block

            $plaintxtByte = array();
            for ($i = 0; $i < strlen($ciphertext[$b]); $i++) {
              // - text clar xor cu contor cifrat byte-by-byte -
                $plaintxtByte[$i] = $cipherCntr[$i] ^ ord(substr($ciphertext[$b], $i, 1));
                $plaintxtByte[$i] = chr($plaintxtByte[$i]);

            }
            $plaintxt[$b] = implode('', $plaintxtByte);
        }

      // alăturați matrice de blocuri într-un singur șir de text simplu
        $plaintext = implode('', $plaintxt);

        return $plaintext;
    }


    /*
     * Unsigned right shift function, since PHP has neither >>> operator nor unsigned ints
     *
     * @param a  number to be shifted (32-bit integer)
     * @param b  number of bits to shift a to the right (0..31)
     * @return   a right-shifted and zero-filled by b bits
     */
    private static function urs($a, $b)
    {
        $a &= 0xffffffff;
        $b &= 0x1f; //(verificarea limitelor)
        if ($a & 0x80000000 && $b > 0) { // dacă este setat cel mai mult din stânga
            $a = ($a >> 1) & 0x7fffffff; //   schimbă dreapta cu un bit și șterge cel mai mult bit din stânga
            $a = $a >> ($b - 1); //  rămânând în schimbul la dreapta
        } else { // in caz contrar
            $a = ($a >> $b); //  folosiți schimbarea normală la dreapta
        }
        return $a;
    }

}
