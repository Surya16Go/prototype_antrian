<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\QueueStatus;
use App\Models\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Feature tests untuk AdminQueueController.
 */
class AdminQueueControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman admin antrian dapat diakses.
     */
    public function test_admin_queue_index_is_accessible(): void
    {
        $response = $this->get('/queues');

        $response->assertOk();
    }

    /**
     * Test memproses antrian mengubah status ke processing.
     */
    public function test_can_process_queue(): void
    {
        $queue = Queue::create([
            'number' => 'A - 001',
            'request' => 'Test Request',
            'status' => QueueStatus::PENDING,
        ]);

        $response = $this->get("/queues/{$queue->id}");

        $response->assertOk();

        $queue->refresh();
        $this->assertEquals(QueueStatus::PROCESSING, $queue->status);
    }

    /**
     * Test menyelesaikan antrian mengubah status ke completed.
     */
    public function test_can_complete_queue(): void
    {
        $queue = Queue::create([
            'number' => 'A - 001',
            'request' => 'Test Request',
            'status' => QueueStatus::PROCESSING,
        ]);

        $response = $this->put("/queues/{$queue->id}");

        $response->assertRedirect(route('admin.queues.index'));

        $queue->refresh();
        $this->assertEquals(QueueStatus::COMPLETED, $queue->status);
    }

    /**
     * Test antrian yang tidak ditemukan menghasilkan 404.
     */
    public function test_process_nonexistent_queue_returns_404(): void
    {
        $response = $this->get('/queues/999');

        $response->assertNotFound();
    }

    /**
     * Test DataTables AJAX response.
     */
    public function test_returns_datatables_json_for_ajax_request(): void
    {
        Queue::create([
            'number' => 'A - 001',
            'request' => 'Test Request',
            'status' => QueueStatus::PENDING,
        ]);

        $response = $this->getJson('/queues', [
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['data']);
    }
}
