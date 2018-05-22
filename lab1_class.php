<?php
    class Functional{

        private $arrIn = array();
        private $arrOut = array();
        private $maxI = 3;
        private $maxJ = 3;
        private $maxLevel = 0;

        function Init() {
            $this->maxLevel = (int)htmlspecialchars($_POST['maxLevel']);
            if ($this->maxLevel == '') $this->maxLevel = 0;
            $k = 0;
            for ($i = 0; $i < $this->maxI; $i++) {
                for ($j = 0; $j < $this->maxJ; $j++) {
                    if (htmlspecialchars($_POST[($k) . '_in']) == '') {
                        $this->arrIn[$i][$j] = '-';
                    } else {
                        $this->arrIn[$i][$j] = (int)htmlspecialchars($_POST[($k) . '_in']);
                    }
                    if (htmlspecialchars($_POST[($k) . '_out']) == '') {
                        $this->arrOut[$i][$j] = '-';
                    } else {
                        $this->arrOut[$i][$j] = (int)htmlspecialchars($_POST[($k) . '_out']);
                    }
                    $k++;
                }
            }
        }

        function showArr($arr) {
            for ($i = 0; $i < $this->maxI; $i++) {
                for ($j = 0; $j < $this->maxJ; $j++) {
                    echo $arr[$i][$j] . '   ';
                }
                echo '<br>';
            }
        }

        function getMaxLevel() {
            return $this->maxLevel;
        }

        function getArrIn() {
            return $this->arrIn;
        }

        function getArrOut() {
            return $this->arrOut;
        }

        static function getKeyIgnrore($key) {
            if (strcmp($key, 'left') == 0) return 'right';
            if (strcmp($key, 'right') == 0) return 'left';
            if (strcmp($key, 'up') == 0) return 'down';
            if (strcmp($key, 'down') == 0) return 'up';
        }

        function emptyLeft($arrIn_l, $keyIgnore) {
            if (strcmp($keyIgnore, 'left') == 0) return false;
            $arr = $arrIn_l;
            for($i = 0; $i < $this->maxI; $i++) {
                for ($j = 0; $j < $this->maxJ; $j++) {
                    if ($arr[$i][$j] == '-') {
                        if ($j > 0) {
                            $tmp = $arr[$i][$j];
                            $arr[$i][$j] = $arr[$i][$j - 1];
                            $arr[$i][$j - 1] = $tmp;
                            break 2;
                        } else {
                            return false;
                        }
                    }
                }
            }
            return $arr;
        }

        function emptyUp($arrIn_l, $keyIgnore) {
            if (strcmp($keyIgnore, 'up') == 0) return false;
            $arr = $arrIn_l;
            for($i = 0; $i < $this->maxI; $i++) {
                for ($j = 0; $j < $this->maxJ; $j++) {
                    if ($arr[$i][$j] == '-') {
                        if ($i > 0) {
                            $tmp = $arr[$i][$j];
                            $arr[$i][$j] = $arr[$i - 1][$j];
                            $arr[$i - 1][$j] = $tmp;
                            break 2;
                        } else {
                            return false;
                        }
                    }
                }
            }
            return $arr;
        }

        function emptyRight($arrIn_l, $keyIgnore) {
            if (strcmp($keyIgnore, 'right') == 0) return false;
            $arr = $arrIn_l;
            for($i = 0; $i < $this->maxI; $i++) {
                for ($j = 0; $j < $this->maxJ; $j++) {
                    if ($arr[$i][$j] == '-') {
                        if ($j < ($this->maxJ - 1)) {
                            $tmp = $arr[$i][$j];
                            $arr[$i][$j] = $arr[$i][$j + 1];
                            $arr[$i][$j + 1] = $tmp;
                            break 2;
                        } else {
                            return false;
                        }
                    }
                }
            }
            return $arr;
        }

        function emptyDown($arrIn_l, $keyIgnore) {
            if (strcmp($keyIgnore, 'down') == 0) return false;
            $arr = $arrIn_l;
            for($i = 0; $i < $this->maxI; $i++) {
                for ($j = 0; $j < $this->maxJ; $j++) {
                    if ($arr[$i][$j] == '-') {
                        if ($i < ($this->maxI - 1)) {
                            $tmp = $arr[$i][$j];
                            $arr[$i][$j] = $arr[$i + 1][$j];
                            $arr[$i + 1][$j] = $tmp;
                            break 2;
                        } else {
                            return false;
                        }
                    }
                }
            }
            return $arr;
        }

        function countDiff($arr) {
            if (!$arr) return 999999;
            $count = 0;
            for ($i = 0; $i < $this->maxI; $i++) {
                for ($j = 0; $j < $this->maxJ; $j++) {
                    if ($arr[$i][$j] != $this->arrOut[$i][$j]) $count++;
                }
            }
            If ($count > 0) $count--;
            return $count;
        }
    }

?>