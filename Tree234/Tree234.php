<?php

require_once ('C:\Users\zhsve\PhpstormProjects\TestTask/Tree234/Node.php');

class Tree234
{
    private Node $root;

    public function __construct()
    {
        $this->root = new Node();
    }

    public function find($key): int
    {
        $curNode = $this->root;
        $childNumber = 0;
        while (true) {
            $childNumber = $curNode->findItem($key);
            if ($childNumber !== -1) {
                return $childNumber;
            } elseif ($curNode->isLeaf()) {
                return -1;
            } else {
                $curNode = $this->getNextChild($curNode, $key);
            }
        }
    }

    public function insert($dValue): void
    {
        $curNode = $this->root;
        $tempItem = new DataItem($dValue);
        while (true) {
            if ($curNode->isFull()) {
                $this->split($curNode);
                $curNode = $curNode->getParent();
                $curNode = $this->getNextChild($curNode, $dValue);
            } elseif ($curNode->isLeaf()) {
                break;
            } else {
                $curNode = $this->getNextChild($curNode, $dValue);
            }
        }
        $curNode->insertItem($tempItem);
    }

    public function split($thisNode): void
    {
        $itemB = $thisNode->removeItem();
        $itemC = $thisNode->removeItem();
        $child2 = $thisNode->disconnectChild(2);
        $child3 = $thisNode->disconnectChild(3);
        $newRight = new Node();
        if ($thisNode === $this->root) {
            $this->root = new Node();
            $parent = $this->root;
            $this->root->connectChild(0, $thisNode);
        } else {
            $parent = $thisNode->getParent();
        }
        $itemIndex = $parent->insertItem($itemB);
        $n = $parent->getNumItems();
        for ($j = $n - 1; $j > $itemIndex; $j--) {
            $temp = $parent->disconnectChild($j);
            $parent->connectChild($j + 1, $temp);
        }
        $parent->connectChild($itemIndex + 1, $newRight);
        $newRight->insertItem($itemC);
        $newRight->connectChild(0, $child2);
        $newRight->connectChild(1, $child3);
    }

    public function getNextChild($theNode, $theValue): Node
    {
        $numItems = $theNode->getNumItems();
        $j = 0;
        while ($j < $numItems) {
            if ($theValue < $theNode->getItem($j)->dData) {
                return $theNode->getChild($j);
            }
            $j++;
        }
        return $theNode->getChild($j);
    }

    public function displayTree(): void
    {
        $this->recDisplayTree($this->root, 0, 0);
        echo "\n";
    }

    private function recDisplayTree($thisNode, $level, $childNumber): void
    {
        echo "\nlevel=" . $level . " child=" . $childNumber . " ";
        $thisNode->displayNode();
        $numItems = $thisNode->getNumItems();
        for ($j = 0; $j < $numItems + 1; $j++) {
            $nextNode = $thisNode->getChild($j);
            if ($nextNode !== null) {
                $this->recDisplayTree($nextNode, $level + 1, $j);
            } else {
                return;
            }
        }
    }

    public function symmetricTraversal(): void
    {
        echo " \n";
        $curNode = $this->root;
        $this->recSymmetricTraversal($curNode);
        echo " \n";
    }

    private function recSymmetricTraversal($curNode): void
    {
        $numItems = $curNode->getNumItems();
        if ($curNode->isLeaf()) {
            for ($j = 0; $j < $numItems; $j++) {
                echo $curNode->getItem($j)->dData . " ";
            }
        } else {
            for ($j = 0; $j < $numItems + 1; $j++) {
                $nextNode = $curNode->getChild($j);
                if ($nextNode !== null) {
                    $this->recSymmetricTraversal($nextNode);
                }
                if ($j == $numItems) {
                    return;
                } else {
                    echo $curNode->getItem($j)->dData . " ";
                }
            }
        }
    }
}
