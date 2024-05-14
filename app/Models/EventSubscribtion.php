<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSubscribtion extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","team_ids","event_id"];
}
