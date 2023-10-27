<?php

require_once ('C:\Users\zhsve\PhpstormProjects\TestTask/Tree234/DataItem.php');

class Node
{
    private const ORDER = 4;
    private int $numItems;
    private Node|null $parent;
    private array $childArray = array();
    private array $itemArray = array();

    public function __construct()
    {
        $this->numItems = 0;
        $this->parent = null;
        for ($i = 0; $i < self::ORDER; $i++) {
            $this->childArray[$i] = null;
        }
        for ($i = 0; $i < (self::ORDER - 1); $i++) {
            $this->itemArray[$i] = null;
        }
    }

    public function connectChild($childNum, $child): void
    {
        $this->childArray[$childNum] = $child;
        if ($child !== null) {
            $child->parent = $this;
        }
    }

    public function disconnectChild($childNum)
    {
        $tempNode = $this->childArray[$childNum];
        $this->childArray[$childNum] = null;
        return $tempNode;
    }

    public function getChild($childNum)
    {
        return $this->childArray[$childNum];
    }

    public function getParent(): Node
    {
        return $this->parent;
    }

    public function isLeaf(): bool
    {
        return $this->childArray[0] === null;
    }

    public function getNumItems(): int
    {
        return $this->numItems;
    }

    public function getItem($index): DataItem
    {
        return $this->itemArray[$index];
    }

    public function isFull(): int
    {
        return $this->numItems === (self::ORDER - 1);
    }

    public function findItem($key): int
    {
        for ($j = 0; $j < (self::ORDER - 1); $j++) {
            if ($this->itemArray[$j] === null) {
                break;
            } elseif ($this->itemArray[$j]->dData === $key) {
                return $j;
            }
        }
        return -1;
    }

    public function insertItem($newItem): int
    {
        $this->numItems++;
        $newKey = $newItem->dData;

        for ($j = (self::ORDER - 2); $j >= 0; $j--) {
            if ($this->itemArray[$j] === null) {
                continue;
            } else {
                $itsKey = $this->itemArray[$j]->dData;
                if ($newKey < $itsKey) {
                    $this->itemArray[$j + 1] = $this->itemArray[$j];
                } else {
                    $this->itemArray[$j + 1] = $newItem;
                    return $j + 1;
                }
            }
        }

        $this->itemArray[0] = $newItem;
        return 0;
    }

    public function removeItem()
    {
        $temp = $this->itemArray[$this->numItems - 1];
        $this->itemArray[$this->numItems - 1] = null;
        $this->numItems--;
        return $temp;
    }

    public function displayNode(): void
    {
        for ($j = 0; $j < $this->numItems; $j++) {
            $this->itemArray[$j]->displayItem();
        }
        echo "/";
    }
}
