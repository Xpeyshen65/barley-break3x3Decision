<!DOCTYPE html>
<html>
    <head>
        <title>Lab1_Mosklenko</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div class="input-data">
            <p>Задача должна иметь решение!</p>
            <form name="" method="post" action="Lab1_Moskalenko.php">
                <p>Введите максимальное количество уровней:
                    <input type="number" size="1" name="maxLevel"></p>
                <p>Входные данные:</p>
                <p><input type="number" size="1" name="0_in">
                    <input type="number" size="1" name="1_in">
                    <input type="number" size="1" name="2_in"></p>

                <p><input type="number" size="1" name="3_in">
                    <input type="number" size="1" name="4_in">
                    <input type="number" size="1" name="5_in"></p>

                <p><input type="number" size="1" name="6_in">
                    <input type="number" size="1" name="7_in">
                    <input type="number" size="1" name="8_in"></p>

                <p>Выходные данные:</p>
                <p><input type="number" size="1" name="0_out">
                    <input type="number" size="1" name="1_out">
                    <input type="number" size="1" name="2_out"></p>

                <p><input type="number" size="1" name="3_out">
                    <input type="number" size="1" name="4_out">
                    <input type="number" size="1" name="5_out"></p>

                <p><input type="number" size="1" name="6_out">
                    <input type="number" size="1" name="7_out">
                    <input type="number" size="1" name="8_out"></p>
                <p><input type="submit" value="Поиск решения" /></p>
            </form>
        </div>
        <div class="process-data">
            <?php
                if ($_POST) {
                    include 'lab1_class.php';
                    $obj1 = new Functional();
                    $obj1->Init();
                    echo '<br>Исходный массив:<br>';
                    $obj1->showArr($obj1->getArrIn());
                    echo '<br>Целевой массив:<br>';
                    $obj1->showArr($obj1->getArrOut());
                    echo '<br>';

                    $i = 0; $keyIgnore = ''; $countNode = 0; $success = false;
                    $arrRoot = array($keyIgnore => $obj1->getArrIn());
                    $arrChild = array();
                    $arrResult = array();
                    while ($i < $obj1->getMaxLevel()) {
                        $min = 99999; $tmp = 0;
                        foreach ($arrRoot as $keyIgnore => $valueRoot) {
                            if ($countNode % 2 != 0) {
                                echo $countNode . '<br>';
                                $obj1->showArr($valueRoot);
                                echo '<br>';
                            }
                            $countNode++;
                            $arrResult = array( "left" => $obj1->emptyLeft($valueRoot, $keyIgnore),
                                                "up" => $obj1->emptyUp($valueRoot, $keyIgnore),
                                                "right" => $obj1->emptyRight($valueRoot, $keyIgnore),
                                                "down" => $obj1->emptyDown($valueRoot, $keyIgnore));
                            echo 'Left:<br>';
                            $obj1->showArr($arrResult["left"]);
                            echo 'Up:<br>';
                            $obj1->showArr($arrResult["up"]);
                            echo 'Right:<br>';
                            $obj1->showArr($arrResult["right"]);
                            echo 'Down:<br>';
                            $obj1->showArr($arrResult["down"]);

                            foreach ($arrResult as $key => $value) {
                                $tmp = $obj1->countDiff($value) + $i + 1;
                                if ($tmp < $min) {
                                    $min = $tmp;
                                    $keyIgnore = Functional::getKeyIgnrore($key);
                                    $arrChild = array($keyIgnore => $value);
                                } else if ($tmp == $min) {
                                    $keyIgnore = Functional::getKeyIgnrore($key);
                                    $arrChild[$keyIgnore] = $value;
                                }
                                if ($obj1->countDiff($value) == 0) {
                                    $success = true;
                                    echo '<br>SUCCESS!<br>';
                                    $obj1->showArr($value);
                                    echo '<br>--------------------------------------------------<br>';
                                    break 3;
                                }
                            }
                        }
                        echo '<br>-----------------------------------------------------<br>';
                        $arrRoot = array();
                        foreach ($arrChild as $keyIgnore => $valueChild) {
                            $arrRoot[$keyIgnore] = $valueChild;
                        }
                        $i++;
                    };
                    if ($success == false) {
                        echo 'Невозможно решить задачу за заданное число уровней или задача не имеет решение.';
                    } else {
                        echo '<br>Значение оценочной функции: ' . $min . '<br>Число раскрытых вершин: ' . ($countNode);
                    }
                    //echo '<br>Значение оценочной функции: ' . $min . '<br>Число раскрытых вершин: ' . ($countNode);

                }
            ?>
        </div>

    </body>
</html>