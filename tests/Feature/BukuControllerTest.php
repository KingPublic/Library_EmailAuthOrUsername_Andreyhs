<?php

namespace Tests\Feature;

use App\Models\Buku;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BukuControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_bukus()
    {
        // Arrange: Buat data dummy
        Buku::factory()->create(['judul' => 'Buku Test']);

        // Act: Akses endpoint index
        $response = $this->get(route('buku.index'));

        // Assert: Periksa data tampil di view
        $response->assertStatus(200);
        $response->assertSee('Buku Test');
    }

    public function test_store_creates_new_buku()
    {
        // Arrange: Data input
        $data = [
            'judul' => 'Buku Baru',
            'penulis' => 'Penulis A',
            'penerbit' => 'Penerbit X',
            'tahun_terbit' => 2024,
        ];

        // Act: Kirim POST request ke endpoint store
        $response = $this->post(route('buku.store'), $data);

        // Assert: Pastikan data tersimpan di database
        $this->assertDatabaseHas('bukus', ['judul' => 'Buku Baru']);
        $response->assertRedirect(route('buku.index'));
    }

    public function test_update_edits_existing_buku()
    {
        // Arrange: Buat data dummy
        $buku = Buku::factory()->create();

        // Act: Kirim PUT request untuk mengupdate data
        $updatedData = ['judul' => 'Judul Baru'];
        $response = $this->put(route('buku.update', $buku->id), $updatedData);

        // Assert: Pastikan data terupdate di database
        $this->assertDatabaseHas('bukus', ['id' => $buku->id, 'judul' => 'Judul Baru']);
        $response->assertRedirect(route('buku.index'));
    }

    public function test_destroy_deletes_existing_buku()
    {
        // Arrange: Buat data dummy
        $buku = Buku::factory()->create();

        // Act: Kirim DELETE request
        $response = $this->delete(route('buku.destroy', $buku->id));

        // Assert: Pastikan data terhapus dari database
        $this->assertDatabaseMissing('bukus', ['id' => $buku->id]);
        $response->assertRedirect(route('buku.index'));
    }
}
