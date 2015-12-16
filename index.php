<?php

Insulter::main();

class Insulter
{

    private static $nouns = array();
    private static $adjectives = array();
    private static $addition = array();

    private static function init()
    {
        self::$adjectives = include ("adjectives.php");
        self::$nouns = include ("nouns.php");
        self::$addition = include ("addition.php");
    }

    public static function main()
    {
        self::init();

        $adjectives = self::$adjectives;

        $out = "";

        $adjectivesBr = isset($_GET['adjective']) && $_GET['adjective'] !=""  ? (int) $_GET['adjective'] : rand(1, 10);

        for ($i = 0; $i < $adjectivesBr; $i++) {
            $rand = rand(0, count($adjectives) - 1);
            $out .= $adjectives[$rand] . ", ";

            unset($adjectives[$rand]);
            $adjectives = array_values($adjectives);
        }

        $out = substr($out, 0, -2);
        $out .= ' ';
        $out .= self::$nouns[rand(0, count(self::$nouns) - 1)];

        if (rand(1, 10) > 6) {
            $out .= ", " . self::$addition[rand(0, count(self::$addition) - 1)];
        }

        $out .= "!";

        echo $out;

        echo "<br /><br /><br /><br />";
        echo "<form>";
        echo "Брой прилагателни: <input name = 'adjective'>";
        echo "</form>";
    }

}
