<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\QueueStatus;
use App\Models\Queue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

/**
 * Controller untuk halaman admin pengelolaan antrian.
 * Digunakan oleh petugas untuk memanggil dan menyelesaikan antrian.
 */
class AdminQueueController extends Controller
{
    /**
     * Menampilkan daftar antrian.
     */
    public function index(Request $request): mixed
    {
        $queues = Queue::processing()->first();

        if (! $queues) {
            $queues = Queue::pending()->first();
        }

        if ($request->ajax()) {
            $datatables = Queue::select(['id', 'number', 'request', 'status'])
                ->latest()
                ->get();

            return DataTables::of($datatables)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $this->renderActionButtons($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.queues.index', compact('queues'));
    }

    /**
     * Memproses antrian (mengubah status ke processing).
     */
    public function process(int $id): View
    {
        $queue = Queue::findOrFail($id);
        $queue->status = QueueStatus::PROCESSING;
        $queue->save();

        return view('pages.queues.show', compact('queue'));
    }

    /**
     * Menyelesaikan antrian (mengubah status ke completed).
     */
    public function complete(int $id): RedirectResponse
    {
        $queue = Queue::findOrFail($id);
        $queue->status = QueueStatus::COMPLETED;
        $queue->save();

        return redirect()->route('admin.queues.index');
    }

    /**
     * Render tombol aksi untuk DataTables.
     */
    private function renderActionButtons(Queue $row): string
    {
        $processUrl = route('admin.queues.process', $row->id);

        $btn = '<div class="d-inline-block text-nowrap">';
        $btn .= '<a href="'.$processUrl.'" class="btn btn-sm btn-icon"><i class="ti ti-edit"></i></a>';
        $btn .= '<div class="btn-group dropdown">';
        $btn .= '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></button>';
        $btn .= '<div class="dropdown-menu dropdown-menu-end m-0">';
        $btn .= '<a href="javascript:void(0)" class="dropdown-item">Edit</a>';
        $btn .= '</div></div></div>';

        return $btn;
    }
}
