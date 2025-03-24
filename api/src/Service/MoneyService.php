<?php
namespace App\Service;

class MoneyService {
    public int $ratPS = 20;
    public int $ratSD = 12;

    public function parse(string $str): int {
        if(preg_match('/(\d+)p (\d+)s (\d+)d/', $str, $matches) !== false){
            list($str, $p, $s, $d) = $matches;
            if(!empty($matches)){
                return (((intval($p) * $this->ratPS) + intval($s)) * $this->ratSD) + intval($d);
            }
        }
        return false;
    }

    public function format(int $d): string {
        $invPS = $this->ratPS * $this->ratSD;

        $p = intdiv($d, $invPS);
        $d %= $invPS;
        $s = intdiv($d, $this->ratSD);
        $d %= $this->ratSD;

        return  trim(
            (($p) ? "{$p}p " : "") .
            (($s) ? "{$s}s " : "") .
            (($d) ? "{$d}d " : "")
        );
    }

    public function somma(string $val1, string $val2): string {
        return $this->format($this->parse($val1) + $this->parse($val2));
    }

    public function sottrai(string $val1, string $val2): string {
        return $this->format($this->parse($val1) - $this->parse($val2));
    }

    public function moltiplica(string $val1, string $val2): string {
        $n1 = (is_numeric($val1)) ? $val1 : $this->parse($val1);
        $n2 = (is_numeric($val2)) ? $val2 : $this->parse($val2);
        return $this->format($n1 * $n2);
    }

    public function dividi(string $val1, string $val2): string {
        $number = (is_numeric($val1)) ? $val1 : $this->parse($val1);
        $divider = (is_numeric($val2)) ? $val2 : $this->parse($val2);

        $divisione = intdiv($number, $divider);
        $resto = $number % $divider;

        $restoStr = $resto > 0 ? " (" . $this->format($resto) . ")" : "";
        return $this->format($divisione) . $restoStr;
    }
}