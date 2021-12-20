<?php

namespace App\Observers;

use App\Models\Student;

class StudentObserver
{
    /**
     * Handle the Student "creating" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function creating(Student $student)
    {
        $student->password = bcrypt($student->password);
    }

    /**
     * Handle the Student "updating" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function updating(Student $student)
    {
        // 
    }

    /**
     * Handle the Student "deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
