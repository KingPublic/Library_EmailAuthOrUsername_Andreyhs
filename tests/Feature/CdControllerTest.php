<?php

namespace Tests\Feature;

use App\Models\Cd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CdControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_cds()
    {
        // Arrange: Buat data dummy
        Cd::factory()->create(['title' => 'CD Test']);

        // Act: Akses endpoint index
        $response = $this->get(route('cd.index'));

        // Assert: Periksa data tampil di view
        $response->assertStatus(200);
        $response->assertSee('CD Test');
    }

    public function test_store_creates_new_cd()
    {
        // Arrange: Data input
        $data = [
            'title' => 'CD Baru',
            'artist' => 'Artist X',
            'release_year' => 2024,
        ];

        // Act: Kirim POST request
        $response = $this->post(route('cd.store'), $data);

        // Assert: Pastikan data tersimpan
        $this->assertDatabaseHas('cds', ['title' => 'CD Baru']);
        $response->assertRedirect(route('cd.index'));
    }

    public function test_destroy_deletes_existing_cd()
    {
        // Arrange: Buat data dummy
        $cd = Cd::factory()->create();

        // Act: Kirim DELETE request
        $response = $this->delete(route('cd.destroy', $cd->id));

        // Assert: Pastikan data terhapus
        $this->assertDatabaseMissing('cds', ['id' => $cd->id]);
        $response->assertRedirect(route('cd.index'));
    }
}
