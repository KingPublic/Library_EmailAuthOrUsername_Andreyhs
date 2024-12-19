<?php

namespace Tests\Feature;

use App\Models\InventoryApproval;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryApprovalControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_pending_requests()
    {
        // Arrange: Buat data dummy
        InventoryApproval::factory()->create(['status' => 'pending']);

        // Act: Akses endpoint index
        $response = $this->get(route('inventory-approvals.index'));

        // Assert: Data tampil di view
        $response->assertStatus(200);
        $response->assertSee('pending');
    }

    public function test_approve_updates_status_to_approved()
    {
        // Arrange: Buat data dummy
        $request = InventoryApproval::factory()->create(['status' => 'pending']);

        // Act: Kirim request approve
        $response = $this->post(route('inventory-approvals.approve', $request));

        // Assert: Pastikan status diupdate
        $this->assertDatabaseHas('inventory_approvals', [
            'id' => $request->id,
            'status' => 'approved',
        ]);
    }
}
