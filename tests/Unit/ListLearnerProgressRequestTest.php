<?php

namespace Tests\Unit;

use App\Http\Requests\ListLearnerProgressRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ListLearnerProgressRequestTest extends TestCase
{
    public function test_rules_validation()
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
