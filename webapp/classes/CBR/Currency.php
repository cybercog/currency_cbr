<?php
/**
 * User: Pe Ell
 * Date: 07.09.14
 * Time: 1:23
 */

namespace CBR;

class Currency {

    private $data;
    private $rawData;

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
    }

    /**
     * Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru
     */
    private function fetchData()
    {
        // Формируем сегодняшнюю дату
        $date = date("d/m/Y");

        // Формируем ссылку
        $link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date;

        // Загружаем HTML-страницу
        $fd = fopen($link, "r");
        $text = '';
        if (! $fd) {
            echo "Запрашиваемая страница не найдена";
        }
        else {
            // Чтение содержимого файла в переменную $text
            while (! feof($fd)) $this->rawData .= fgets($fd, 4096);
        }

        // Закрыть открытый файловый дескриптор
        fclose($fd);
    }
}