<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // correct any existing progress values that are out of bounds
        DB::table('enrolments')->where('progress', '>', 100)->update(['progress' => 100]);
        DB::table('enrolments')->where('progress', '<', 0)->update(['progress' => 0]);

        // Disable foreign keys temporarily (important if table has relations)
        DB::statement('PRAGMA foreign_keys=OFF');

        // Rename existing table
        DB::statement('ALTER TABLE enrolments RENAME TO enrolments_old');

        // Create new table with CHECK constraint as sqlite does not support altering existing columns
        DB::statement('
            CREATE TABLE enrolments (
                learner_id INTEGER NOT NULL,
                course_id INTEGER NOT NULL,

                progress DECIMAL(5,2) NOT NULL DEFAULT 0
                    CHECK (progress >= 0 AND progress <= 100),

                created_at DATETIME NULL,
                updated_at DATETIME NULL,

                PRIMARY KEY (learner_id, course_id),

                FOREIGN KEY (learner_id)
                    REFERENCES learners(id)
                    ON DELETE CASCADE,

                FOREIGN KEY (course_id)
                    REFERENCES courses(id)
                    ON DELETE CASCADE
            )
        ');

        // Copy data
        DB::statement('
            INSERT INTO enrolments (learner_id, course_id, progress, created_at, updated_at)
            SELECT learner_id, course_id, progress, created_at, updated_at
            FROM enrolments_old;
        ');

        // Drop old table
        DB::statement('DROP TABLE enrolments_old');

        DB::statement('PRAGMA foreign_keys=ON');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('PRAGMA foreign_keys=OFF');

        DB::statement('ALTER TABLE enrolments RENAME TO enrolments_old');

        Schema::create('enrolments', function (Blueprint $table) {
            $table->foreignId('learner_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->decimal('progress', 5, 2)->nullable();
            $table->primary(['learner_id', 'course_id']);

            $table->timestamps();
        });

        DB::statement('
            INSERT INTO enrolments (learner_id, course_id, progress, created_at, updated_at)
            SELECT learner_id, course_id, progress, created_at, updated_at
            FROM enrolments_old
        ');

        DB::statement('DROP TABLE enrolments_old');

        DB::statement('PRAGMA foreign_keys=ON');
    }
};
