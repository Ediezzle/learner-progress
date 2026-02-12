<?php

namespace Tests\Unit;

use App\Http\Requests\ListLearnerProgressRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;


class ListLearnerProgressRequestTest extends TestCase
{
    // this is to ensure course_id 999 won't exists
    use RefreshDatabase;

    #[Test]
    public function test_rules_validation_fails_for_invalid_data()
    {
        $request = new ListLearnerProgressRequest();
        $rules = $request->rules();

        $validator = Validator::make([
            'course_id' => 999,
            'sort_direction' => 'up',
            'per_page' => 0,
            'page' => 0,
        ], $rules);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('course_id', $validator->errors()->toArray());
        $this->assertArrayHasKey('sort_direction', $validator->errors()->toArray());
        $this->assertArrayHasKey('per_page', $validator->errors()->toArray());
        $this->assertArrayHasKey('page', $validator->errors()->toArray());
    }

    #[Test]
    public function test_rules_validation_passes_for_valid_data()
    {
        $request = new ListLearnerProgressRequest();
        $rules = $request->rules();

        $validator = Validator::make([
            'course_id' => null,
            'sort_direction' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ], $rules);

        $this->assertFalse($validator->fails());
    }
}
