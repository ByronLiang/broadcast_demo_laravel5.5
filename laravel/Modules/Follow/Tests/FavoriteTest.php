<?php

namespace Modules\Follow\Tests;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Follow\Entities\Follow;

class FavoriteTest extends TestCase
{
    public function testFavorite()
    {
        $morph = \Mockery::mock(MorphToMany::class);
        $morph->shouldReceive('getRelationName')->andReturn('favorites');

        $targets = [1, 2];
        $class = 'Modules\Follow\Tests\User';
        $model = \Mockery::mock(Other::class);
        $model->shouldReceive('favorites')->withNoArgs()->andReturn($morph)->once();
        $model->shouldReceive('favorites')->with('Modules\Follow\Tests\User')->andReturnSelf()->once();
        $model->shouldReceive('sync')->with(\Mockery::type('array'), false)->once()->andReturn([1, 2, 3]);

        $this->assertSame([1, 2, 3], Follow::attachRelations($model, 'favorites', $targets, $class));
    }
}
