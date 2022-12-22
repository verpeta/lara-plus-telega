<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpseclib3\Math\BigInteger;

/**
 * @property BigInteger chat_id
 * @property string username
 * @property string last_message_at
 */
class TelegramChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'username',
        'last_message_at',
    ];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array
     */
    public function uniqueIds()
    {
        return ['id', 'chat_id', 'username'];
    }
}
