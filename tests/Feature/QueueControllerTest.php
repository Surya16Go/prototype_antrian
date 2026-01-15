<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\QueueStatus;
use App\Models\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Feature tests untuk QueueController.
 */
class QueueControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test mendapatkan informasi antrian terbaru ketika tidak ada antrian.
     */
    public function test_can_get_latest_queue_when_empty(): void
    {
        $response = $this->get('/get-latest-queue');

        $response->assertOk();
        $response->assertJson([
            'pendingCount' => 0,
            'lastQueueNumber' => 'N/A',
        ]);
    }

    /**
     * Test mendapatkan informasi antrian terbaru ketika ada antrian processing.
     */
    public function test_can_get_latest_queue_with_processing(): void
    {
        $queue = Queue::create([
            'number' => 'A - 001',
            'request' => 'Test Request',
            'status' => QueueStatus::PROCESSING,
        ]);

        $response = $this->get('/get-latest-queue');

        $response->assertOk();
        $response->assertJson([
            'pendingCount' => 0,
            'lastQueueNumber' => 'A - 001',
        ]);
    }

    /**
     * Test membuat antrian baru dengan data valid.
     */
    public function test_can_store_queue_with_valid_data(): void
    {
        $response = $this->postJson('/queue', [
            'passFoto' => 'on',
            'fcKTP' => 'on',
            'fcKK' => 'on',
            'keperluan' => 'Pembuatan KTP Baru',
        ]);

        $response->assertOk();
        $response->assertJson(['message' => 'Antrian berhasil ditambahkan.']);

        $this->assertDatabaseHas('queues', [
            'request' => 'Pembuatan KTP Baru',
            'status' => QueueStatus::PENDING->value,
        ]);
    }

    /**
     * Test tidak bisa membuat antrian tanpa persyaratan lengkap.
     */
    public function test_cannot_store_queue_without_requirements(): void
    {
        $response = $this->postJson('/queue', [
            'keperluan' => 'Test',
        ]);

        $response->assertStatus(400);
        $response->assertJsonStructure(['message', 'errors']);
    }

    /**
     * Test tidak bisa membuat antrian tanpa keperluan.
     */
    public function test_cannot_store_queue_without_keperluan(): void
    {
        $response = $this->postJson('/queue', [
            'passFoto' => 'on',
            'fcKTP' => 'on',
            'fcKK' => 'on',
        ]);

        $response->assertStatus(400);
    }

    /**
     * Test halaman index antrian publik dapat diakses.
     */
    public function test_queue_index_page_is_accessible(): void
    {
        $response = $this->get('/queue');

        $response->assertOk();
    }

    /**
     * Test generate nomor antrian berurutan.
     */
    public function test_queue_number_is_generated_sequentially(): void
    {
        // Buat antrian pertama
        $this->postJson('/queue', [
            'passFoto' => 'on',
            'fcKTP' => 'on',
            'fcKK' => 'on',
            'keperluan' => 'Request 1',
        ]);

        $this->assertDatabaseHas('queues', ['number' => 'A - 001']);

        // Buat antrian kedua
        $this->postJson('/queue', [
            'passFoto' => 'on',
            'fcKTP' => 'on',
            'fcKK' => 'on',
            'keperluan' => 'Request 2',
        ]);

        $this->assertDatabaseHas('queues', ['number' => 'A - 002']);
    }
}
