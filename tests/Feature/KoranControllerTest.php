<?php

namespace Tests\Feature;

use App\Models\Koran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KoranControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_korans()
    {
        // Arrange: Buat data dummy
        Koran::factory()->create(['title' => 'Koran Harian']);

        // Act: Akses endpoint index
        $response = $this->get(route('koran.index'));

        // Assert: Periksa data muncul di view
        $response->assertStatus(200);
        $response->assertSee('Koran Harian');
    }

    public function test_store_creates_new_koran()
    {
        // Arrange: Data input
        $data = [
            'title' => 'Koran Baru',
            'publisher' => 'Publisher A',
            'publication_date' => '2024-01-01',
            'description' => 'Deskripsi singkat',
        ];

        // Act: Kirim POST request ke endpoint store
        $response = $this->post(route('koran.store'), $data);

        // Assert: Pastikan data disimpan di database
        $this->assertDatabaseHas('korans', ['title' => 'Koran Baru']);
        $response->assertRedirect(route('librarian.dashboard'));
    }

    public function test_store_fails_with_invalid_data()
    {
        // Arrange: Data input yang salah
        $data = [
            'title' => '', // Title kosong
            'publisher' => 'Publisher A',
            'publication_date' => 'invalid-date', // Format tanggal salah
            'description' => 'Deskripsi singkat',
        ];

        // Act: Kirim POST request ke endpoint store
        $response = $this->post(route('koran.store'), $data);

        // Assert: Validasi gagal
        $response->assertSessionHasErrors(['title', 'publication_date']);
    }
}
