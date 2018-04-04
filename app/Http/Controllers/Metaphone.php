<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class Metaphone extends Controller
{
    public static function metaphoneIndo($string){ 
        $konsonan = "BCDFGHKLMNPRSTWXY0";
        $vokal = "AIUEO";
        $varson = "CGPST";
        $vokal_depan = "IEY";

        if(strlen($string) == 0){
            return null;
        }else{
            // menghilangkan angka
            $string = preg_replace('/[0-9]+/', '', $string);
            if(strlen($string) == 1){
                return $string;
            }else{
                $string = strtoupper($string);
                $string = preg_replace('/TJ/', 'C', $string);
                $string = preg_replace('/DJ/', 'J', $string);
                $string = preg_replace('/DZ/', 'Z', $string);

                $string_len = strlen($string);
                $i = 0;

                while($i < $string_len){
                    if(strpos($konsonan, $string[$i]) !== false && $i != $string_len-1){
                        
                        if($string[$i] == $string[$i+1]){
                            // Jika ada string [i] dan string [i+1] adalah konsonan yang sama, buang string [i]
                            $string[$i] = "\0";
                            
                            $string_len = strlen($string);
                        }
                    }
                    
                    
                    if($string[$i] == 'B' && $i == $string_len-1){
                        // Jika string [i] = B dan berada diakhir kata,maka petakan menjadi P
                        $string[$i] = 'P';
                    }

                    if($string[$i] == 'C' && $i != $string_len-1){
                        
                        if($string[$i+1] == 'H' && $string[$i+2] == 'S'){
                            //  Jika string [i] = C dan berada sebelum “hs”, maka petakan menjadi K
                            $string[$i] = 'K';
                        }

                        else if (strpos($vokal, $string[$i+1]) !== false && strpos($vokal, $string[$i+2]) !== false) {
                            $string[$i] = 'K';
                        }

                        else if($string[$i+1] == 'H' && $string[$i+2] == 'R'){
                            
                            $string[$i] = 'R';
                        }

                        else if($string[$i+1] == 'H'){
                            $string[$i] = 'C';
                        }

                        else{
                            $string[$i] = 'K';
                        }

                    }

                    if ($string[$i] == 'D') {
                        $string[$i] = 'D';
                    }
                    if($string[$i] == 'D' && $i == $string_len-1){
                        // Jika string [i] = D dan berada di akhir kata, maka petakan menjadi T
                        $string[$i] = 'T';
                    }

                    if($string[$i] == 'G' && $string[$i-1] == 'N'){
                        // Jika string [i] = G dan berada setelah N, maka buang G => NG
                        $string[$i] == "\0";
                        
                        $string_len = strlen($string);
                    }

                    if($string[$i] == 'H' && $i != $string_len-1){
                        if(strpos($vokal, $string[$i+1]) !== false || strpos($vokal, $string[$i-1]) !==false || 
                            strpos($konsonan, $string[$i-1]) !== false){
                            // Jika string [i] = H dan berada sebelum huruf vokal atau di depan huruf vokal atau sesudah huruf konsonan, maka buang H
                            $string[$i] = "\0";
                            
                            $string_len = strlen($string);
                        }
                    }else if($string[$i] == 'H' && $i == $string_len-1){
                        if(strpos($vokal, $string[$i-1]) !==false || 
                            strpos($konsonan, $string[$i-1]) !== false){
                            // Jika string [i] = H dan berada sebelum huruf vokal atau di depan huruf vokal atau sesudah huruf konsonan, maka buang H
                            $string[$i] = "\0";
                            
                            $string_len = strlen($string);
                        }
                    }

                    if ($string[$i]  == 'I' && $i <= $string_len-2 && strpos($vokal, $string[$i+1]) !== false && $string[$i+2]  != 'E') {
                        // Jika string [i] = I dan berada sebelum huruf vokal dan huruf berikutnya bukan E, maka petakan menjadi Y
                        $string[$i] = 'Y';
                    }

                    if ($string[$i] == 'J') {
                        // Jika string [i] = J, maka petakan menjadi Y
                        $string[$i] = 'Y';
                    }

                    if ($string[$i] == 'K' && $i < $string_len-1 && $string[$i+1] == 'H'){
                        // Jika string [i] = K dan berada sebelum H, maka buang K
                        $string[$i] == "\0";
                        
                        $string_len = strlen($string);
                    }

                    if ($string[$i] == 'N' && $i < $string_len-1 && $string[$i+1] == 'G') {
                        // Jika string [i] = N dan berada sebelum G, maka petakan menjadi O
                        $string[$i] = 'O';
                    }

                    if ($string[$i] == 'P' && $i < $string_len-1 && $string[$i+1] == 'H') {
                        // Jika string [i] = P dan berada sebelum H, maka petakan menjadi F
                        $string[$i] = 'F';
                    }    

                    if ($string[$i] == 'Q') {
                        // Jika string [i] = Q, maka petakan menjadi K
                        $string[$i] = 'K';
                    }

                    if ($string[$i] == 'S' && $i < $string_len-1 && $string[$i+1] == 'Z') {
                        // Jika string [i] = S dan berada sebelum Z, maka petakan menjadi F
                        $string[$i] = "\0";
                        $string_len = strlen($string);
                    }

                    if ($string[$i] == 'X') {
                        // Jika string [i] = X, maka petakan menjadi KS
                        $string = substr_replace($string, "KS", $i+1, 0);
                        $string[$i] = "\0";
                        $i++;
                    }

                    if ($string[$i] == 'Y') {
                        if (strpos($konsonan, $string[$i-1]) !== false || strpos($vokal, $string[$i-1]) !== false) {
                            // Jika string [i] = Y dan berada setelah huruf konsonan dan setelah huruf vokal, maka petakan menjadi Y
                            $string[$i] = 'Y';
                        }else if($i < $string_len-1){
                            if (strpos($vokal, $string[$i+1]) !== false) {
                                // Jika string [i] = Y dan berada sebelum huruf vokal, maka petakan menjadi Y
                                $string[$i] = 'Y';
                            }else if ($string[$i+1] == 'S' || $string[$i+1] == 'H') {
                                //  Jika string [i] = Y dan berada sebelum huruf S atau huruf H, maka petakan menjadi Y
                                $string[$i] = 'Y';
                            }else if($i == $string_len - 1){
                                // Jika string [i] = Y dan kondisinya selain 7.ff sampai 7.hh, maka buang Y (diakhir kalimat)
                                $string[$i] = "\0";
                            }
                        }
                    }

                    if ($string[$i] == 'Z') {
                        if($i == $string_len - 1){
                            if ($string[$i-1] == 'I' || $string[$i-1] == 'M') {
                                $string[$i] = 'S';
                            }else{
                                $string[$i] = 'Y';
                            }
                        }else{
                            if ($string[$i-1] == 'M' || $string[$i-1] == 'I' || $string[$i+1] == 'I') {
                                $string[$i] = 'S';   
                            }else{
                                $string[$i] = 'Y';   
                            }
                        }
                    }

                    if ($string[$i] == 'O' && $i < $string_len -1) {
                        if (strpos($vokal, $string[$i+1]) !== false && $string[$i+2] != 'E') {
                            $string[$i] = 'W';
                        }
                    }

                    if ($string[$i] == 'U' && $i < $string_len - 2) {
                        if (strpos($vokal, $string[$i+1]) !== false && $string[$i+2] != 'I') {
                            $string[$i] = 'W';
                        }
                    }

                    if(strpos($vokal, $string[$i]) !== false && $i != 0){
                        // Jika string [i] adalah huruf vokal, buang string [i] dan bukan huruf pertama
                        $string[$i] = "\0";
                        
                        $string_len = strlen($string);
                    }


                    $i++;
                }
            }
        }
        $string = preg_replace('/\\0/', "", $string);
        $string = preg_replace('/\s+/', '', $string);
        return $string;
    }
}
