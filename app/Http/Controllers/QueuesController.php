<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class QueuesController extends Controller
{
  public function index(Request $request)
  {
    $checkQueue = Queue::where('status', 'processing')->first();
    $queues = $checkQueue;
    if (!$checkQueue) {
      $queues = Queue::where('status', 'pending')->first();
    }
    if ($request->ajax()) {
      $datatables = Queue::select('id', 'number', 'request', 'status')->latest()->get();
      return Datatables::of($datatables)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $btn = '<div class="d-inline-block text-nowrap">';
          // Add edit button
          $btn .= '<a href="' . route('queues.show', $row->id) . '" class="btn btn-sm btn-icon"><i class="ti ti-edit"></i></a>';
          // Add delete button
          $btn .= '<div class="btn-group dropdown">';
          $btn .= '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></button>';
          $btn .= '<div class="dropdown-menu dropdown-menu-end m-0" style="">';
          $btn .= '<a href="javascript:void(0)" class="dropdown-item">Edit</a>';
          $btn .= '</div>';
          $btn .= '</div>';
          $btn .= '</div>';
          return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    return view('pages.queues.index', compact('queues'));
  }

  public function update($id)
  {
    $queue = Queue::findOrFail($id);
    $queue->status = 'completed';
    $queue->save();
    return redirect::to('/queues');
  }

  public function show($id)
  {
    $queue = Queue::findOrFail($id);
    $queue->status = 'processing';
    $queue->save();
    return view('pages.queues.show', compact('queue'));
  }
}
