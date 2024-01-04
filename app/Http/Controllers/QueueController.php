<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QueueController extends Controller
{
  public function getLatestQueue()
  {
    // mengambil jumlah antrian
    $pendingCount = Queue::where('status', 'pending')->count();

    // mengambil antrian terakhir berdasarkan waktu pembuatan (created_at), ambil 1 saja.
    $latestQueue = Queue::where('status', 'processing')->orderBy('id', 'asc')->first();
    if (!$latestQueue) {
      $latestQueue = Queue::where('status', 'completed')->orderBy('id', 'desc')->first();
    }

    // kita akan merespons dengan JSON
    if ($latestQueue == null) {
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

  public function printReceipt()
  {
    $queue = Queue::where('status', 'pending')->orderBy('id', 'desc')->first();
    $waitQueue = Queue::where('status', 'pending')->count();
    // Kirim data ke template Blade
    return view('pages.queue.print', compact('queue', 'waitQueue'));

  }

  public function index()
  {
    $queue = Queue::where('status', 'processing')->orderBy('id', 'asc')->first();
    if (!$queue) {
      $queue = Queue::where('status', 'pending')->orderBy('id', 'asc')->first();
    }
    $pendingCount = Queue::where('status', 'pending')->count();
    return view('pages.queue.index', compact('queue', 'pendingCount'));
  }

  public function store(Request $request)
  {
    $rules = [
      'passFoto' => 'required|in:on',
      'fcKTP' => 'required|in:on',
      'fcKK' => 'required|in:on',
      'keperluan' => 'required'
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      $errors = $validator->errors()->messages();
      $fields = array_keys($errors);
      foreach ($fields as $field) {
        if ($field == 'passFoto') {
          $fields[array_search($field, $fields)] = 'Pass Foto';
        } elseif ($field == 'fcKTP') {
          $fields[array_search($field, $fields)] = 'Foto Copy KTP';
        } elseif ($field == 'fcKK') {
          $fields[array_search($field, $fields)] = 'Foto Copy KK';
        }
      }
      $fields_str = implode(', ', $fields);
      return response()->json(['message' => 'Tolong lengkapi persaratan: ' . $fields_str], 400);
    }

    $queue = Queue::create([
      'number' => 'A - ' . str_pad(Queue::count() + 1, 3, '0', STR_PAD_LEFT),
      'request' => $request->keperluan,
      'status' => 'pending'
    ]);

    return response()->json(['message' => 'Antrian berhasil ditambahkan.']);
  }
}
