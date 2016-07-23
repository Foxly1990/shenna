<?php
class Content {
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "123";
    protected $data_base = "databasename";

    /**
     * Возвращает объект подключения к БД
     * @return object
     */
    private function connectDB ()
    {
        try {
            $msqli = new mysqli($this->host, $this->user, $this->password, $this->data_base);
            $msqli->set_charset("utf8");
        } catch (Exception $err) {
            echo $err->getFile();
            $msqli->close();
        }

        return $msqli;
    }

    /**
     * Возвращает контент из таблицы БД
     * @param string $table название таблицы БД
     * @param array|string выбираем селекторы
     * @return array
     */
    function getContent ($table, $selector)
    {
        if (!$table) {
            echo "Fill: table name of DB";
            return;}

        $sel = $selector ? $selector : "*";

        if (is_array($selector)) {
            $sel = implode(", ", $selector);
        }

        try {
            $msqli = $this->connectDB();
            $query = $msqli->query("SELECT {$sel} FROM {$table}");
        } catch (Exception $err) {
            echo $err->getFile();
        }

        $result = [];

        while ($row = $query->fetch_assoc()) {
            $result[] = $row;
        }

        if ($msqli->close()) {
            return $result;
        }
    }

    /**
     * Устанавливает значение строк уже созданной таблицы в БД
     * @param string имя таблицы БД
     * @return array записалось ли значение?
     */
    function setContent ($table)
    {
        $keys = array();
        $vals = array();
        $post = $_POST;

        if (sizeof($post) == 0) return;

        foreach ($post as $key => $value) {
            $keys[] = $key;
            $vals[] = quotemeta($value);
        }

        $names = implode(", ", $keys);
        $value = implode("', '", $vals);
        $query = "INSERT INTO {$table} ({$names}) VALUES ('{$value}')";

        $msqli = $this->connectDB();
        $query = $msqli->query($query);

        if (!$query) {
            throw new Exception('Неправильный запрос');
        }

        return array("success" => "Запись произведена");
    }
}
?>
