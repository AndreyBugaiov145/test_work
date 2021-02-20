<?php

class ParseFileToTable
{

    protected $file;
    protected $fileContentArray = [];

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Converts csv file to array
     */
    public function parseFileContent()
    {
        $content = file_get_contents($this->file["tmp_name"]);
        $this->fileContentArray = explode("\n", $content);
        foreach ($this->fileContentArray as $key => $row) {
            $this->fileContentArray[$key] = explode("|", $row);
        }
    }

    /**
     * Creates a table from an array
     * @return string
     */
    public function createTable()
    {
        if (count($this->fileContentArray) < 1) {
            return '';
        }

        $content = '';
        $this->parseFileContent();
        $content .= "<table class=\"table\">
                      <thead>
                        <tr>
                          <th scope=\"col\">Название</th>
                          <th scope=\"col\">Артикул</th>
                          <th scope=\"col\">Номер категории</th>
                          <th scope=\"col\">Цена</th>
                        </tr>
                      </thead>
                      <tbody>";
        $content .= $this->createTableBody();
        $content .= "</tbody></table>";

        return $content;

    }

    public function createTableBody()
    {
        $content = "";
        foreach ($this->fileContentArray as $row) {
            $prise = end($row);
            $newPrise = round($prise) - 0.01;
            $color = $newPrise > $prise ? 'text-success' : 'text-danger';
            $content .= "<tr class=$color>";
            $content .= $this->createColumn($row, $newPrise);
            $content .= "</tr>";
        }

        return $content;
    }

    public function createColumn($row, $newPrise)
    {
        $content = "";
        foreach ($row as $key => $column) {
            $elem = isset($row[$key + 1]) ? $column : $newPrise;
            $content .= "<td>$elem</td>";
        }

        return $content;
    }
}