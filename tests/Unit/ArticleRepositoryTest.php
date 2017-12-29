<?php

namespace Tests\Unit;

use App\Article;
use App\Repositories\ArticleRepository;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleRepositoryTest extends TestCase
{
    /**
     * @var Collection
     */
    protected $articles;

    /**
     * @var ArticleRepository
     */
    protected $repository;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        $this->articles   = factory(Article::class, 10)->create();
        $this->repository = new ArticleRepository(new Article());
    }

    public function testAll()
    {
        $articleCollections = $this->repository->all();

        foreach ($articleCollections as $key => $article) {
            /** @var $article Article */
            $this->assertEquals($this->articles[$key]->id, $article->id);
        }
    }
}
