<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\QueueStatus;
use App\Http\Requests\StoreQueueRequest;
use App\Models\Queue;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Controller untuk halaman publik antrian.
 * Digunakan oleh pengunjung untuk mengambil nomor antrian.
 */
class QueueController extends Controller
{
    /**
     * Mendapatkan informasi antrian terbaru.
     * Digunakan untuk polling dari halaman display.
     */
    public function getLatestQueue(): JsonResponse
    {
        $pendingCount = Queue::pending()->count();

        $latestQueue = Queue::processing()->orderBy('id', 'asc')->first();

        if (! $latestQueue) {
            $latestQueue = Queue::completed()->orderBy('id', 'desc')->first();
        }

        if ($latestQueue === null) {
            return response()->json([
                'pendingCount' => $pendingCount,
                'lastQueueNumber' => 'N/A',
            ]);
        }

        return response()->json([
            'pendingCount' => $pendingCount,
            'lastQueueNumber' => $latestQueue->number,
        ]);
    }

    /**
     * Menampilkan halaman cetak struk antrian.
     */
    public function printReceipt(): View
    {
        $queue = Queue::pending()->orderBy('id', 'desc')->first();
        $waitQueue = Queue::pending()->count();

        return view('pages.queue.print', compact('queue', 'waitQueue'));
    }

    /**
     * Menampilkan halaman utama antrian publik.
     */
    public function index(): View
    {
        $queue = Queue::processing()->orderBy('id', 'asc')->first();

        if (! $queue) {
            $queue = Queue::pending()->orderBy('id', 'asc')->first();
        }

        $pendingCount = Queue::pending()->count();

        return view('pages.queue.index', compact('queue', 'pendingCount'));
    }

    /**
     * Menyimpan antrian baru.
     */
    public function store(StoreQueueRequest $request): JsonResponse
    {
        Queue::create([
            'number' => Queue::generateNextNumber(),
            'request' => $request->validated()['keperluan'],
            'status' => QueueStatus::PENDING,
        ]);

        return response()->json(['message' => 'Antrian berhasil ditambahkan.']);
    }
}
