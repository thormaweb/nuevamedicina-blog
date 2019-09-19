<?php

namespace Tests\Feature;

use App\Magazine;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParsePdfTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Set up class with an auth user
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $user = \App\User::create(['name' => 'Test', 'email' => 'test@user.com', 'password' => bcrypt('pass')]);
        $blog_editor = \App\Role::create(['name' => 'blog_editor', 'display_name' => 'Editor Blog', ]);
        $crudArticles = \App\Permission::create(['name' => 'crudArticles', 'display_name' => 'Gestionar Articulos', ]);
        $blog_editor->attachPermissions([$crudArticles]);
        $user->attachRole($blog_editor);

        Auth::loginUsingId($user->id, true);
    }

    /** @test */
    public function when_a_magazine_is_created_a_pdf_is_parsed()
    {
        // Given a PDF is uploaded by a user with crudArticles permissions
        $stub = __DIR__ . '/stubs/2018_03.pdf';
        $path = sys_get_temp_dir() . '/2018_03.pdf';
        copy($stub, $path);
        $pdf = new UploadedFile($path, '2018_03.pdf', filesize($path), 'application/pdf', null, true);

        $response = $this->post(route('addMagazine'), [
            "month" => "03",
            "year" => "2018",
            "published_on" => "2018-03-01",
            "description" => "<p>Test lalalala</p>",
            'pdf' => $pdf,
            'thumbnail' => UploadedFile::fake()->image('2018_03.jpg')
        ]);


        // When was correctly uploaded and stored in his folde, and Magazine model created
        $this->assertDatabaseHas('magazines', [
            'order' => '201803'
        ]);

        $magazine = Magazine::get()->first();
        $this->assertFileExists(public_path('files/revista/'). $magazine->pdf);

        // Then we espect to see a folder with his images pages generated and the asociates MagazinePage's instances
        $files = count(glob(public_path('files/revista/201803/') . '*.jpg'));

        // 124 is the number of pages the stub pdf file has
        $this->assertEquals(124, $files);
        $this->assertEquals(124, $magazine->pages->count());

        // Clean the files generated
        foreach (glob(public_path('files/revista/') . '2018_03*') as $filename) {
            @unlink($filename);
        }

        foreach (glob(public_path('files/revista/201803/') . 'page*') as $filename) {
            @unlink($filename);
        }
        @rmdir(public_path('files/revista/201803/'));
    }
}
