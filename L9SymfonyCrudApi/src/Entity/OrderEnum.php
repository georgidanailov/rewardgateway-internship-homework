<?php

namespace App\Entity;

enum OrderEnum: string
{

    case Pending = "Pending";
    case Completed = "Completed";
    case Cancelled = "Cancelled";
}