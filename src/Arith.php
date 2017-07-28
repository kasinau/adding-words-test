<?php
namespace Evaluation;

class Arith
{
    const LINK_WORD = 'and';
    const SEPARATOR_WORD = ' ';
    private $initialData;

    private $valuesDictionary = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'fourty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
    ];

    private $multiplicatorDictionary = [
        100 => 'hundred',
        1000 => 'thouzand',
    ];

    public function __construct($initialData)
    {
        $this->initialData = $initialData;
    }

    public function add($data)
    {
        $initialValue = $this->getInitialValueNumber();
        $valueToAdd = $this->convertStringToNumber($data);
        return $this->convertNumberToString($initialValue + $valueToAdd);
    }

    private function getInitialValueNumber()
    {
        return $this->convertStringToNumber($this->initialData);
    }

    private function convertStringToNumber($string)
    {
        $stringData = explode(self::SEPARATOR_WORD, $string);
        $result = 0;
        $multiplicateTo = 1;
        for ($i = (count($stringData) - 1); $i >= 0; $i--) {
            if ($stringData[$i] == self::LINK_WORD) {
                continue;
            }
            $tmpResult = array_search($stringData[$i], $this->valuesDictionary);
            if ($tmpResult !== false) {
                $result += $tmpResult * $multiplicateTo;
            }
            $multiplicateResult = array_search($stringData[$i], $this->multiplicatorDictionary);
            if ($multiplicateResult !== false) {
                $multiplicateTo = $multiplicateResult;
            }
        }
        return (int)$result;
    }

    private function convertNumberToString($number)
    {
        if (isset($this->valuesDictionary[$number])) {
            return $this->valuesDictionary[$number];
        }
        $result = '';
        $i = 0;
        do {
            if (isset($this->valuesDictionary[$number])) {
                break;
            }
            $modulo = $number % 10;
            if ($modulo > 0 && isset($this->valuesDictionary[$modulo])) {
                $result = $this->valuesDictionary[$modulo] . ' ' . $result;
            }
            $number = ($modulo > 0) ? ($number - $modulo) : ($number / 10);
            $result = $this->convertNumberToString((int) $number) . ' ' . $result;
            $i++;
        } while ($number > 10);
        return trim($result);
    }
}