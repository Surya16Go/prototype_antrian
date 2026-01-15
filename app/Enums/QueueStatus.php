<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Status antrian dalam sistem.
 */
enum QueueStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case UNCOMPLETED = 'uncompleted';

    /**
     * Mendapatkan label yang bisa ditampilkan ke user.
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Menunggu',
            self::PROCESSING => 'Sedang Diproses',
            self::COMPLETED => 'Selesai',
            self::UNCOMPLETED => 'Tidak Selesai',
        };
    }
}
