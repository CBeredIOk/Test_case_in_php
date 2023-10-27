<?php

require_once ('C:\Users\zhsve\PhpstormProjects\TestTask/Tree234/Tree234.php');

class Tree234App
{
    public static function main()
    {
        $theTree = new Tree234();

        while (true) {
            echo "\nEnter first letter of ";
            echo "show, insert, find, traversal or create: ";
            $choice = self::getChar();
            switch ($choice) {
                case 's':
                    $theTree->displayTree();
                    break;
                case 'i':
                    echo "\nEnter value to insert: ";
                    $value = self::getInt();
                    $theTree->insert($value);
                    break;
                case 'f':
                    echo "\nEnter value to find: ";
                    $value = self::getInt();
                    $found = $theTree->find($value);
                    if ($found !== -1) {
                        echo "\nFound " . $value . "\n";
                    } else {
                        echo "\nCould not find " . $value . "\n";
                    }
                    break;
                case 't':
                    $theTree->symmetricTraversal();
                    break;
                case 'c':
                    $theTree->insert(50);
                    $theTree->insert(40);
                    $theTree->insert(60);
                    $theTree->insert(30);
                    $theTree->insert(70);
                    break;
                default:
                    echo "\nInvalid entry\n";
            }
        }
    }

    public static function getString(): false|string
    {
        return readline();
    }

    public static function getChar()
    {
        $s = self::getString();
        return $s[0];
    }

    public static function getInt(): int
    {
        $s = self::getString();
        return intval($s);
    }
}

Tree234App::main();

