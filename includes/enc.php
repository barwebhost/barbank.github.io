<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  AES implementation in PHP                                                                     */
/*    (c) Chris Veness 2005-2014 www.movable-type.co.uk/scripts                                   */
/*    Right of free use is granted for all commercial or non-commercial use under CC-BY licence.  */
/*    No warranty of any form is offered.                                                         */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

Class Aes
{
    /**
     * AES Cipher function [§5.1]: encrypt 'input' with Rijndael algorithm
     *
     * @param input message as byte-array (16 bytes)
     * @param w     key schedule as 2D byte-array (Nr+1 x Nb bytes) -
     *              generated from the cipher key by keyExpansion()
     * @return      ciphertext as byte-array (16 bytes)
     */
    public static function cipher($input, $w)
    {
        $Nb = 4; // block size (in words): no of columns in state (fixed at 4 for AES)
        $Nr = count($w) / $Nb - 1; // no of rounds: 10/12/14 for 128/192/256-bit keys

        $state = array(); // initialise 4xNb byte-array 'state' with input [§3.4]
        for ($i = 0; $i < 4 * $Nb; $i++) $state[$i % 4][floor($i / 4)] = $input[$i];

        $state = self::addRoundKey($state, $w, 0, $Nb);

        for ($round = 1; $round < $Nr; $round++) { // apply Nr rounds
            $state = self::subBytes($state, $Nb);
            $state = self::shiftRows($state, $Nb);
            $state = self::mixColumns($state, $Nb);
            $state = self::addRoundKey($state, $w, $round, $Nb);
        }

        $state = self::subBytes($state, $Nb);
        $state = self::shiftRows($state, $Nb);
        $state = self::addRoundKey($state, $w, $Nr, $Nb);

        $output = array(4 * $Nb); // convert state to 1-d array before returning [§3.4]
        for ($i = 0; $i < 4 * $Nb; $i++) $output[$i] = $state[$i % 4][floor($i / 4)];
        return $output;
    }


    /**
     * Xor Round Key into state S [§5.1.4].
     */
    private static function addRoundKey($state, $w, $rnd, $Nb)
    {
        for ($r = 0; $r < 4; $r++) {
            for ($c = 0; $c < $Nb; $c++) $state[$r][$c] ^= $w[$rnd * 4 + $c][$r];
        }
        return $state;
    }

    /**
     * Apply SBox to state S [§5.1.1].
     */
    private static function subBytes($s, $Nb)
    {
        for ($r = 0; $r < 4; $r++) {
            for ($c = 0; $c < $Nb; $c++) $s[$r][$c] = self::$sBox[$s[$r][$c]];
        }
        return $s;
    }

    /**
     * Shift row r of state S left by r bytes [§5.1.2].
     */
    private static function shiftRows($s, $Nb)
    {
        $t = array(4);
        for ($r = 1; $r < 4; $r++) {
            for ($c = 0; $c < 4; $c++) $t[$c] = $s[$r][($c + $r) % $Nb]; // shift into temp copy
            for ($c = 0; $c < 4; $c++) $s[$r][$c] = $t[$c]; // and copy back
        } // note that this will work for Nb=4,5,6, but not 7,8 (always 4 for AES):
        return $s; // see fp.gladman.plus.com/cryptography_technology/rijndael/aes.spec.311.pdf
    }

    /**
     * Combine bytes of each col of state S [§5.1.3].
     */
    private static function mixColumns($s, $Nb)
    {
        for ($c = 0; $c < 4; $c++) {
            $a = array(4); // 'a' is a copy of the current column from 's'
            $b = array(4); // 'b' is a•{02} in GF(2^8)
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
     * Generate Key Schedule from Cipher Key [§5.2].
     *
     * Perform key expansion on cipher key to generate a key schedule.
     *
     * @param  key cipher key byte-array (16 bytes).
     * @return key schedule as 2D byte-array (Nr+1 x Nb bytes).
     */
    public static function keyExpansion($key)
    {
        $Nb = 4; // block size (in words): no of columns in state (fixed at 4 for AES)
        $Nk = count($key) / 4; // key length (in words): 4/6/8 for 128/192/256-bit keys
        $Nr = $Nk + 6; // no of rounds: 10/12/14 for 128/192/256-bit keys

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
     * Apply SBox to 4-byte word w.
     */
    private static function subWord($w)
    {
        for ($i = 0; $i < 4; $i++) $w[$i] = self::$sBox[$w[$i]];
        return $w;
    }

    /**
     * Rotate 4-byte word w left by one byte.
     */
    private static function rotWord($w)
    {
        $tmp = $w[0];
        for ($i = 0; $i < 3; $i++) $w[$i] = $w[$i + 1];
        $w[3] = $tmp;
        return $w;
    }

    // sBox is pre-computed multiplicative inverse in GF(2^8) used in subBytes and keyExpansion [§5.1.1]
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

    // rCon is Round Constant used for the Key Expansion [1st col is 2^(r-1) in GF(2^8)] [§5.2]
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
/*  AES counter (CTR) mode implementation in PHP                                                  */
/*    (c) Chris Veness 2005-2014 www.movable-type.co.uk/scripts                                   */
/*    Right of free use is granted for all commercial or non-commercial use under CC-BY licence.  */
/*    No warranty of any form is offered.                                                         */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

Class AesCtr extends Aes
{

    /**
     * Encrypt a text using AES encryption in Counter mode of operation
     *  - see http://csrc.nist.gov/publications/nistpubs/800-38a/sp800-38a.pdf
     *
     * Unicode multi-byte character safe
     *
     * @param plaintext source text to be encrypted
     * @param password  the password to use to generate a key
     * @param nBits     number of bits to be used in the key (128, 192, or 256)
     * @return          encrypted text
     */
    public static function encrypt($plaintext, $password, $nBits)
    {
        $blockSize = 16; // block size fixed at 16 bytes / 128 bits (Nb=4) for AES
        if (!($nBits == 128 || $nBits == 192 || $nBits == 256)) return ''; // standard allows 128/192/256 bit keys
        // note PHP (5) gives us plaintext and password in UTF8 encoding!

        // use AES itself to encrypt password to get cipher key (using plain password as source for
        // key expansion) - gives us well encrypted key
        $nBytes = $nBits / 8; // no bytes in key
        $pwBytes = array();
        for ($i = 0; $i < $nBytes; $i++) $pwBytes[$i] = ord(substr($password, $i, 1)) & 0xff;
        $key = Aes::cipher($pwBytes, Aes::keyExpansion($pwBytes));
        $key = array_merge($key, array_slice($key, 0, $nBytes - 16)); // expand key to 16/24/32 bytes long

        // initialise 1st 8 bytes of counter block with nonce (NIST SP800-38A §B.2): [0-1] = millisec,
        // [2-3] = random, [4-7] = seconds, giving guaranteed sub-ms uniqueness up to Feb 2106
        $counterBlock = array();
        $nonce = floor(microtime(true) * 1000); // timestamp: milliseconds since 1-Jan-1970
        $nonceMs = $nonce % 1000;
        $nonceSec = floor($nonce / 1000);
        $nonceRnd = floor(rand(0, 0xffff));

        for ($i = 0; $i < 2; $i++) $counterBlock[$i] = self::urs($nonceMs, $i * 8) & 0xff;
        for ($i = 0; $i < 2; $i++) $counterBlock[$i + 2] = self::urs($nonceRnd, $i * 8) & 0xff;
        for ($i = 0; $i < 4; $i++) $counterBlock[$i + 4] = self::urs($nonceSec, $i * 8) & 0xff;

        // and convert it to a string to go on the front of the ciphertext
        $ctrTxt = '';
        for ($i = 0; $i < 8; $i++) $ctrTxt .= chr($counterBlock[$i]);

        // generate key schedule - an expansion of the key into distinct Key Rounds for each round
        $keySchedule = Aes::keyExpansion($key);
        //print_r($keySchedule);

        $blockCount = ceil(strlen($plaintext) / $blockSize);
        $ciphertxt = array(); // ciphertext as array of strings

        for ($b = 0; $b < $blockCount; $b++) {
            // set counter (block #) in last 8 bytes of counter block (leaving nonce in 1st 8 bytes)
            // done in two stages for 32-bit ops: using two words allows us to go past 2^32 blocks (68GB)
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c] = self::urs($b, $c * 8) & 0xff;
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c - 4] = self::urs($b / 0x100000000, $c * 8);

            $cipherCntr = Aes::cipher($counterBlock, $keySchedule); // -- encrypt counter block --

            // block size is reduced on final block
            $blockLength = $b < $blockCount - 1 ? $blockSize : (strlen($plaintext) - 1) % $blockSize + 1;
            $cipherByte = array();

            for ($i = 0; $i < $blockLength; $i++) { // -- xor plaintext with ciphered counter byte-by-byte --
                $cipherByte[$i] = $cipherCntr[$i] ^ ord(substr($plaintext, $b * $blockSize + $i, 1));
                $cipherByte[$i] = chr($cipherByte[$i]);
            }
            $ciphertxt[$b] = implode('', $cipherByte); // escape troublesome characters in ciphertext
        }

        // implode is more efficient than repeated string concatenation
        $ciphertext = $ctrTxt . implode('', $ciphertxt);
        $ciphertext = base64_encode($ciphertext);
        return $ciphertext;
    }


    /**
     * Decrypt a text encrypted by AES in counter mode of operation
     *
     * @param ciphertext source text to be decrypted
     * @param password   the password to use to generate a key
     * @param nBits      number of bits to be used in the key (128, 192, or 256)
     * @return           decrypted text
     */
    public static function decrypt($ciphertext, $password, $nBits)
    {
        $blockSize = 16; // block size fixed at 16 bytes / 128 bits (Nb=4) for AES
        if (!($nBits == 128 || $nBits == 192 || $nBits == 256)) return ''; // standard allows 128/192/256 bit keys
        $ciphertext = base64_decode($ciphertext);

        // use AES to encrypt password (mirroring encrypt routine)
        $nBytes = $nBits / 8; // no bytes in key
        $pwBytes = array();
        for ($i = 0; $i < $nBytes; $i++) $pwBytes[$i] = ord(substr($password, $i, 1)) & 0xff;
        $key = Aes::cipher($pwBytes, Aes::keyExpansion($pwBytes));
        $key = array_merge($key, array_slice($key, 0, $nBytes - 16)); // expand key to 16/24/32 bytes long

        // recover nonce from 1st element of ciphertext
        $counterBlock = array();
        $ctrTxt = substr($ciphertext, 0, 8);
        for ($i = 0; $i < 8; $i++) $counterBlock[$i] = ord(substr($ctrTxt, $i, 1));

        // generate key schedule
        $keySchedule = Aes::keyExpansion($key);

        // separate ciphertext into blocks (skipping past initial 8 bytes)
        $nBlocks = ceil((strlen($ciphertext) - 8) / $blockSize);
        $ct = array();
        for ($b = 0; $b < $nBlocks; $b++) $ct[$b] = substr($ciphertext, 8 + $b * $blockSize, 16);
        $ciphertext = $ct; // ciphertext is now array of block-length strings

        // plaintext will get generated block-by-block into array of block-length strings
        $plaintxt = array();

        for ($b = 0; $b < $nBlocks; $b++) {
            // set counter (block #) in last 8 bytes of counter block (leaving nonce in 1st 8 bytes)
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c] = self::urs($b, $c * 8) & 0xff;
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c - 4] = self::urs(($b + 1) / 0x100000000 - 1, $c * 8) & 0xff;

            $cipherCntr = Aes::cipher($counterBlock, $keySchedule); // encrypt counter block

            $plaintxtByte = array();
            for ($i = 0; $i < strlen($ciphertext[$b]); $i++) {
                // -- xor plaintext with ciphered counter byte-by-byte --
                $plaintxtByte[$i] = $cipherCntr[$i] ^ ord(substr($ciphertext[$b], $i, 1));
                $plaintxtByte[$i] = chr($plaintxtByte[$i]);

            }
            $plaintxt[$b] = implode('', $plaintxtByte);
        }

        // join array of blocks into single plaintext string
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
        $b &= 0x1f; // (bounds check)
        if ($a & 0x80000000 && $b > 0) { // if left-most bit set
            $a = ($a >> 1) & 0x7fffffff; //   right-shift one bit & clear left-most bit
            $a = $a >> ($b - 1); //   remaining right-shifts
        } else { // otherwise
            $a = ($a >> $b); //   use normal right-shift
        }
        return $a;
    }

}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */


function encrypt($buffer){
	
	$key = '0123456789ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvxyz';
	$nBits = 256; //128,192,256
	
	$ciphertext = AesCtr::encrypt($buffer, $key, $nBits);

	return "<html><head><script>var Aes={};Aes.cipher=function(input,w){var Nb=4;var Nr=w.length/Nb-1;var state=[[],[],[],[]];for(var i=0;i<4*Nb;i++)state[i%4][Math.floor(i/4)]=input[i];state=Aes.addRoundKey(state,w,0,Nb);for(var round=1;round<Nr;round++){state=Aes.subBytes(state,Nb);state=Aes.shiftRows(state,Nb);state=Aes.mixColumns(state,Nb);state=Aes.addRoundKey(state,w,round,Nb);}
state=Aes.subBytes(state,Nb);state=Aes.shiftRows(state,Nb);state=Aes.addRoundKey(state,w,Nr,Nb);var output=new Array(4*Nb);for(var i=0;i<4*Nb;i++)output[i]=state[i%4][Math.floor(i/4)];return output;}
Aes.keyExpansion=function(key){var Nb=4;var Nk=key.length/4
var Nr=Nk+6;var w=new Array(Nb*(Nr+1));var temp=new Array(4);for(var i=0;i<Nk;i++){var r=[key[4*i],key[4*i+1],key[4*i+2],key[4*i+3]];w[i]=r;}
for(var i=Nk;i<(Nb*(Nr+1));i++){w[i]=new Array(4);for(var t=0;t<4;t++)temp[t]=w[i-1][t];if(i%Nk==0){temp=Aes.subWord(Aes.rotWord(temp));for(var t=0;t<4;t++)temp[t]^=Aes.rCon[i/Nk][t];}else if(Nk>6&&i%Nk==4){temp=Aes.subWord(temp);}
for(var t=0;t<4;t++)w[i][t]=w[i-Nk][t]^temp[t];}
return w;}
Aes.subBytes=function(s,Nb){for(var r=0;r<4;r++){for(var c=0;c<Nb;c++)s[r][c]=Aes.sBox[s[r][c]];}
return s;}
Aes.shiftRows=function(s,Nb){var t=new Array(4);for(var r=1;r<4;r++){for(var c=0;c<4;c++)t[c]=s[r][(c+r)%Nb];for(var c=0;c<4;c++)s[r][c]=t[c];}
return s;}
Aes.mixColumns=function(s,Nb){for(var c=0;c<4;c++){var a=new Array(4);var b=new Array(4);for(var i=0;i<4;i++){a[i]=s[i][c];b[i]=s[i][c]&0x80?s[i][c]<<1^0x011b:s[i][c]<<1;}
s[0][c]=b[0]^a[1]^b[1]^a[2]^a[3];s[1][c]=a[0]^b[1]^a[2]^b[2]^a[3];s[2][c]=a[0]^a[1]^b[2]^a[3]^b[3];s[3][c]=a[0]^b[0]^a[1]^a[2]^b[3];}
return s;}
Aes.addRoundKey=function(state,w,rnd,Nb){for(var r=0;r<4;r++){for(var c=0;c<Nb;c++)state[r][c]^=w[rnd*4+c][r];}
return state;}
Aes.subWord=function(w){for(var i=0;i<4;i++)w[i]=Aes.sBox[w[i]];return w;}
Aes.rotWord=function(w){var tmp=w[0];for(var i=0;i<3;i++)w[i]=w[i+1];w[3]=tmp;return w;}
Aes.sBox=[0x63,0x7c,0x77,0x7b,0xf2,0x6b,0x6f,0xc5,0x30,0x01,0x67,0x2b,0xfe,0xd7,0xab,0x76,0xca,0x82,0xc9,0x7d,0xfa,0x59,0x47,0xf0,0xad,0xd4,0xa2,0xaf,0x9c,0xa4,0x72,0xc0,0xb7,0xfd,0x93,0x26,0x36,0x3f,0xf7,0xcc,0x34,0xa5,0xe5,0xf1,0x71,0xd8,0x31,0x15,0x04,0xc7,0x23,0xc3,0x18,0x96,0x05,0x9a,0x07,0x12,0x80,0xe2,0xeb,0x27,0xb2,0x75,0x09,0x83,0x2c,0x1a,0x1b,0x6e,0x5a,0xa0,0x52,0x3b,0xd6,0xb3,0x29,0xe3,0x2f,0x84,0x53,0xd1,0x00,0xed,0x20,0xfc,0xb1,0x5b,0x6a,0xcb,0xbe,0x39,0x4a,0x4c,0x58,0xcf,0xd0,0xef,0xaa,0xfb,0x43,0x4d,0x33,0x85,0x45,0xf9,0x02,0x7f,0x50,0x3c,0x9f,0xa8,0x51,0xa3,0x40,0x8f,0x92,0x9d,0x38,0xf5,0xbc,0xb6,0xda,0x21,0x10,0xff,0xf3,0xd2,0xcd,0x0c,0x13,0xec,0x5f,0x97,0x44,0x17,0xc4,0xa7,0x7e,0x3d,0x64,0x5d,0x19,0x73,0x60,0x81,0x4f,0xdc,0x22,0x2a,0x90,0x88,0x46,0xee,0xb8,0x14,0xde,0x5e,0x0b,0xdb,0xe0,0x32,0x3a,0x0a,0x49,0x06,0x24,0x5c,0xc2,0xd3,0xac,0x62,0x91,0x95,0xe4,0x79,0xe7,0xc8,0x37,0x6d,0x8d,0xd5,0x4e,0xa9,0x6c,0x56,0xf4,0xea,0x65,0x7a,0xae,0x08,0xba,0x78,0x25,0x2e,0x1c,0xa6,0xb4,0xc6,0xe8,0xdd,0x74,0x1f,0x4b,0xbd,0x8b,0x8a,0x70,0x3e,0xb5,0x66,0x48,0x03,0xf6,0x0e,0x61,0x35,0x57,0xb9,0x86,0xc1,0x1d,0x9e,0xe1,0xf8,0x98,0x11,0x69,0xd9,0x8e,0x94,0x9b,0x1e,0x87,0xe9,0xce,0x55,0x28,0xdf,0x8c,0xa1,0x89,0x0d,0xbf,0xe6,0x42,0x68,0x41,0x99,0x2d,0x0f,0xb0,0x54,0xbb,0x16];Aes.rCon=[[0x00,0x00,0x00,0x00],[0x01,0x00,0x00,0x00],[0x02,0x00,0x00,0x00],[0x04,0x00,0x00,0x00],[0x08,0x00,0x00,0x00],[0x10,0x00,0x00,0x00],[0x20,0x00,0x00,0x00],[0x40,0x00,0x00,0x00],[0x80,0x00,0x00,0x00],[0x1b,0x00,0x00,0x00],[0x36,0x00,0x00,0x00]];Aes.Ctr={};Aes.Ctr.encrypt=function(plaintext,password,nBits){var blockSize=16;if(!(nBits==128||nBits==192||nBits==256))return'';plaintext=Utf8.encode(plaintext);password=Utf8.encode(password);var nBytes=nBits/8;var pwBytes=new Array(nBytes);for(var i=0;i<nBytes;i++){pwBytes[i]=isNaN(password.charCodeAt(i))?0:password.charCodeAt(i);}
var key=Aes.cipher(pwBytes,Aes.keyExpansion(pwBytes));key=key.concat(key.slice(0,nBytes-16));var counterBlock=new Array(blockSize);var nonce=(new Date()).getTime();var nonceMs=nonce%1000;var nonceSec=Math.floor(nonce/1000);var nonceRnd=Math.floor(Math.random()*0xffff);for(var i=0;i<2;i++)counterBlock[i]=(nonceMs>>>i*8)&0xff;for(var i=0;i<2;i++)counterBlock[i+2]=(nonceRnd>>>i*8)&0xff;for(var i=0;i<4;i++)counterBlock[i+4]=(nonceSec>>>i*8)&0xff;var ctrTxt='';for(var i=0;i<8;i++)ctrTxt+=String.fromCharCode(counterBlock[i]);var keySchedule=Aes.keyExpansion(key);var blockCount=Math.ceil(plaintext.length/blockSize);var ciphertxt=new Array(blockCount);for(var b=0;b<blockCount;b++){for(var c=0;c<4;c++)counterBlock[15-c]=(b>>>c*8)&0xff;for(var c=0;c<4;c++)counterBlock[15-c-4]=(b/0x100000000>>>c*8)
var cipherCntr=Aes.cipher(counterBlock,keySchedule);var blockLength=b<blockCount-1?blockSize:(plaintext.length-1)%blockSize+1;var cipherChar=new Array(blockLength);for(var i=0;i<blockLength;i++){cipherChar[i]=cipherCntr[i]^plaintext.charCodeAt(b*blockSize+i);cipherChar[i]=String.fromCharCode(cipherChar[i]);}
ciphertxt[b]=cipherChar.join('');}
var ciphertext=ctrTxt+ciphertxt.join('');ciphertext=Base64.encode(ciphertext);return ciphertext;}
Aes.Ctr.decrypt=function(ciphertext,password,nBits){var blockSize=16;if(!(nBits==128||nBits==192||nBits==256))return'';ciphertext=Base64.decode(ciphertext);password=Utf8.encode(password);var nBytes=nBits/8;var pwBytes=new Array(nBytes);for(var i=0;i<nBytes;i++){pwBytes[i]=isNaN(password.charCodeAt(i))?0:password.charCodeAt(i);}
var key=Aes.cipher(pwBytes,Aes.keyExpansion(pwBytes));key=key.concat(key.slice(0,nBytes-16));var counterBlock=new Array(8);ctrTxt=ciphertext.slice(0,8);for(var i=0;i<8;i++)counterBlock[i]=ctrTxt.charCodeAt(i);var keySchedule=Aes.keyExpansion(key);var nBlocks=Math.ceil((ciphertext.length-8)/ blockSize);var ct=new Array(nBlocks);for(var b=0;b<nBlocks;b++)ct[b]=ciphertext.slice(8+b*blockSize,8+b*blockSize+blockSize);ciphertext=ct;var plaintxt=new Array(ciphertext.length);for(var b=0;b<nBlocks;b++){for(var c=0;c<4;c++)counterBlock[15-c]=((b)>>>c*8)&0xff;for(var c=0;c<4;c++)counterBlock[15-c-4]=(((b+1)/0x100000000-1)>>>c*8)&0xff;var cipherCntr=Aes.cipher(counterBlock,keySchedule);var plaintxtByte=new Array(ciphertext[b].length);for(var i=0;i<ciphertext[b].length;i++){plaintxtByte[i]=cipherCntr[i]^ciphertext[b].charCodeAt(i);plaintxtByte[i]=String.fromCharCode(plaintxtByte[i]);}
plaintxt[b]=plaintxtByte.join('');}
var plaintext=plaintxt.join('');plaintext=Utf8.decode(plaintext);return plaintext;}
var Base64={};Base64.code='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';Base64.encode=function(str,utf8encode){utf8encode=(typeof utf8encode=='undefined')?false:utf8encode;var o1,o2,o3,bits,h1,h2,h3,h4,e=[],pad='',c,plain,coded;var b64=Base64.code;plain=utf8encode?str.encodeUTF8():str;c=plain.length%3;if(c>0){while(c++<3){pad+='=';plain+='\0';}}
for(c=0;c<plain.length;c+=3){o1=plain.charCodeAt(c);o2=plain.charCodeAt(c+1);o3=plain.charCodeAt(c+2);bits=o1<<16|o2<<8|o3;h1=bits>>18&0x3f;h2=bits>>12&0x3f;h3=bits>>6&0x3f;h4=bits&0x3f;e[c/3]=b64.charAt(h1)+b64.charAt(h2)+b64.charAt(h3)+b64.charAt(h4);}
coded=e.join('');coded=coded.slice(0,coded.length-pad.length)+pad;return coded;}
Base64.decode=function(str,utf8decode){utf8decode=(typeof utf8decode=='undefined')?false:utf8decode;var o1,o2,o3,h1,h2,h3,h4,bits,d=[],plain,coded;var b64=Base64.code;coded=utf8decode?str.decodeUTF8():str;for(var c=0;c<coded.length;c+=4){h1=b64.indexOf(coded.charAt(c));h2=b64.indexOf(coded.charAt(c+1));h3=b64.indexOf(coded.charAt(c+2));h4=b64.indexOf(coded.charAt(c+3));bits=h1<<18|h2<<12|h3<<6|h4;o1=bits>>>16&0xff;o2=bits>>>8&0xff;o3=bits&0xff;d[c/4]=String.fromCharCode(o1,o2,o3);if(h4==0x40)d[c/4]=String.fromCharCode(o1,o2);if(h3==0x40)d[c/4]=String.fromCharCode(o1);}
plain=d.join('');return utf8decode?plain.decodeUTF8():plain;}
var Utf8={};Utf8.encode=function(strUni){var strUtf=strUni.replace(/[\u0080-\u07ff]/g,function(c){var cc=c.charCodeAt(0);return String.fromCharCode(0xc0|cc>>6,0x80|cc&0x3f);});strUtf=strUtf.replace(/[\u0800-\uffff]/g,function(c){var cc=c.charCodeAt(0);return String.fromCharCode(0xe0|cc>>12,0x80|cc>>6&0x3F,0x80|cc&0x3f);});return strUtf;}
Utf8.decode=function(strUtf){var strUni=strUtf.replace(/[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g,function(c){var cc=((c.charCodeAt(0)&0x0f)<<12)|((c.charCodeAt(1)&0x3f)<<6)|(c.charCodeAt(2)&0x3f);return String.fromCharCode(cc);});strUni=strUni.replace(/[\u00c0-\u00df][\u0080-\u00bf]/g,function(c){var cc=(c.charCodeAt(0)&0x1f)<<6|c.charCodeAt(1)&0x3f;return String.fromCharCode(cc);});return strUni;}</script><script>
var hea2p = 
('$key'); 
var hea2t = 
'$ciphertext';
var output = Aes.Ctr.decrypt(hea2t, hea2p, $nBits);
document.write(output)</script></head></html>";
}
ob_start("encrypt");
?>