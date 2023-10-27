<?php

class DataItem
{
    public int $dData;

    public function __construct(int $dd)
    {
        $this->dData = $dd;
    }

    public function displayItem(): void
    {
        printf("/" . $this->dData);
    }
}
