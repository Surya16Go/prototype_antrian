<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\QueueStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Queue untuk sistem antrian.
 *
 * @property int $id
 * @property string $number
 * @property string $request
 * @property QueueStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Queue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'request',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => QueueStatus::class,
    ];

    /**
     * Scope untuk antrian dengan status pending.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', QueueStatus::PENDING);
    }

    /**
     * Scope untuk antrian dengan status processing.
     */
    public function scopeProcessing(Builder $query): Builder
    {
        return $query->where('status', QueueStatus::PROCESSING);
    }

    /**
     * Scope untuk antrian dengan status completed.
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', QueueStatus::COMPLETED);
    }

    /**
     * Scope untuk mendapatkan antrian yang sedang aktif (processing atau pending pertama).
     */
    public function scopeCurrentActive(Builder $query): Builder
    {
        return $query->where('status', QueueStatus::PROCESSING)
            ->orWhere('status', QueueStatus::PENDING)
            ->orderBy('id', 'asc');
    }

    /**
     * Generate nomor antrian berikutnya.
     */
    public static function generateNextNumber(): string
    {
        $count = self::count() + 1;

        return 'A - '.str_pad((string) $count, 3, '0', STR_PAD_LEFT);
    }
}
