<?php
/**
 * User: Pe Ell
 * Date: 07.09.14
 * Time: 1:23
 */

namespace CBR;

class Currency {

    private $date;
    private $data;
    private $rawData;
    private $dollar;
    private $euro;

    public function __construct()
    {
        $this->date = date("d/m/Y");
    }

    public function getEuro()
    {
        return $this->euro;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDollar()
    {
        return $this->dollar;
    }

    public function getData()
    {
        $this->fetchData();
        $this->parseData();
        return $this->data;
    }

    private function parseData()
    {
        $pattern = "{<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)}i";
        preg_match_all($pattern, $this->rawData, $this->data, PREG_SET_ORDER);

        foreach ($this->data as $cur) {
            if ($cur[2] == 840) {
                $this->dollar = str_replace(',', '.', $cur[4]);
            }
            if ($cur[2] == 978) {
                $this->euro = str_replace(',', '.', $cur[4]);
            }
        }
    }

    /**
     * Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru
     */
    private function fetchData()
    {
        // Формируем ссылку
        $link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$this->date;

        // Загружаем HTML-страницу
        $fd = fopen($link, "r");
        if (! $fd) {
            echo "Запрашиваемая страница не найдена";
        }
        else {
            // Чтение содержимого файла в переменную $text
            while (! feof($fd)) {
                $this->rawData .= fgets($fd, 4096);
            }
        }

        // Закрыть открытый файловый дескриптор
        fclose($fd);
    }
}