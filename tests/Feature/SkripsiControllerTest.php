<?php

namespace Tests\Feature;

use App\Models\Skripsi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkripsiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_skripsis()
    {
        // Arrange: Buat data dummy
        Skripsi::factory()->create(['title' => 'Skripsi Test']);

        // Act: Akses endpoint index
        $response = $this->get(route('skripsi.index'));

        // Assert: Data tampil di view
        $response->assertStatus(200);
        $response->assertSee('Skripsi Test');
    }

    public function test_store_creates_new_skripsi()
    {
        // Arrange: Data input
        $data = [
            'title' => 'Skripsi Baru',
            'author' => 'Author X',
            'year' => 2024,
            'abstract' => 'Abstract singkat.',
        ];

        // Act: Kirim POST request
        $response = $this->post(route('skripsi.store'), $data);

        // Assert: Pastikan data tersimpan
        $this->assertDatabaseHas('skripsis', ['title' => 'Skripsi Baru']);
        $response->assertRedirect(route('skripsi.index'));
    }
}
