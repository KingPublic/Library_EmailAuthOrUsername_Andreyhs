<?php

namespace Tests\Feature;

use App\Models\Librarian;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibrarianControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_librarians()
    {
        // Arrange: Buat data dummy
        Librarian::factory()->create(['name' => 'Librarian Test']);

        // Act: Akses endpoint index
        $response = $this->get(route('librarian.index'));

        // Assert: Data tampil di view
        $response->assertStatus(200);
        $response->assertSee('Librarian Test');
    }

    public function test_store_creates_new_librarian()
    {
        // Arrange: Data input
        $data = [
            'name' => 'Librarian Baru',
            'email' => 'librarian@library.com',
            'password' => 'password123',
        ];

        // Act: Kirim POST request
        $response = $this->post(route('librarian.store'), $data);

        // Assert: Pastikan data tersimpan
        $this->assertDatabaseHas('librarians', ['email' => 'librarian@library.com']);
        $response->assertRedirect(route('librarian.index'));
    }
}
